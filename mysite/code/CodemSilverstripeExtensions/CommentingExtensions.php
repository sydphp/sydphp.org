<?php
//PAGE COMMENT EXTENSIONS
//Overrides certain core parts of the SS comment system
class Codem_PageComment extends DataObjectDecorator {

	function augmentSQL(SQLQuery &$query) {}

	function extraStatics() {
		return array(
			'db' => array(
				'Email' => 'varchar',
				'LastName' => 'varchar',
				'UpdateMe' => 'Boolean'//can be turned off
			)
		);
	}
	
	//and send an email to the admin
	function onAfterWrite() {
		$post = DataObject::get_one('SiteTree', "`SiteTree`.ID=".$this->owner->getField('ParentID'));
		if(defined('CODEM_FORM_MAIL_TO')) {
			$e = new Email(
				$this->owner->getField('Email'),//From Address
					CODEM_FORM_MAIL_TO,//To Address - Currently hard coded should get admin address and/or posters address
					"Comment posted for '" . $post->title . "'",//Subject
					"" . $this->owner->getField('Name') . " " . $this->owner->getField('LastName'). " said " . '"' . $this->owner->getField('Comment') . '"<br/><br/>' .
					'<a href="http://' . $_SERVER['SERVER_NAME'] . '/admin/comments/EditForm/field/Comments/item/' . $this->owner->getField('ID') . '?methodName=spam">Mark as SPAM</a><br/>'.
					'<a href="http://' . $_SERVER['SERVER_NAME'] . '/admin/comments/EditForm/field/Comments/item/' . $this->owner->getField('ID') . '/delete">DELETE</a>'
			);//Body
			$e->send();
		}
	}
}

/**
 * @package cms
 * @subpackage comments
 */
class Codem_PageCommentInterface_Form extends PageCommentInterface_Form {
	function postcomment($data) {
		Cookie::set("PageCommentInterface_Email", $data['Email']);
		Cookie::set("PageCommentInterface_LastName", $data['LastName']);
		$updateme = isset($data['UpdateMe'][1]) && $data['UpdateMe'][1] == 1 ? TRUE : FALSE;
		Cookie::set("PageCommentInterface_UpdateMe", $updateme ? 1 : 0);
		try {
			if(Codem_PageCommentInterface::Subscriptions()) {
				//notify  configured admin of updates
				$em = new Codem_UpdateMeEmail;
				$em->Send($data);
				if($updateme) {
					//only subscribe if asked
					//subscribe em
					$cm = new Codem_CampaignMonitor;
					$cm->Add($data);
				}
			}
		} catch (Exception $e) {}
		return parent::postcomment($data);
	}
}

class Codem_PageCommentInterface extends PageCommentInterface {
	
	public static function Subscriptions() {
		return (defined('CODEM_COMMENTS_ENABLE_SUBSCRIPTIONS') && CODEM_COMMENTS_ENABLE_SUBSCRIPTIONS == TRUE);
	}
	
	function PostCommentForm() {
		if(!$this->page->ProvideComments){ 
			return false;
		}
		$fields = new FieldSet(
			new HiddenField("ParentID", "ParentID", $this->page->ID)
		);
		
		$member = Member::currentUser();
		
		if((self::$comments_require_login || self::$comments_require_permission) && $member && $member->FirstName) {
			// note this was a ReadonlyField - which displayed the name in a span as well as the hidden field but
			// it was not saving correctly. Have changed it to a hidden field. It passes the data correctly but I 
			// believe the id of the form field is wrong.
			$fields->push(new ReadonlyField("NameView", 'First Name: <sup>*</sup>', $member->FirstName));
			$fields->push(new HiddenField("Name", "", $member->getName()));
			$fields->push(new ReadonlyField("LastNameView",'Last Name: <sup>*</sup>', $member->Surname));
			$fields->push(new HiddenField("LastName", "", $member->Surname));
		} else {
			$fields->push(new TextField("Name", 'First Name: <sup>*</sup>'));
			$fields->push(new TextField("LastName", 'Last Name: <sup>*</sup>'));
		}
		
		// commenter email field
		$fields->push(new EmailField("Email", "Email: <sup>*</sup>"));
		
		// optional commenter URL
		$fields->push(new TextField("CommenterURL", "Website"));
		
		if(MathSpamProtection::isEnabled()) {
			$fields->push(new TextField("Math", sprintf(_t('PageCommentInterface.SPAMQUESTION', "Spam protection question: %s"), MathSpamProtection::getMathQuestion())));
		}
		
		$fields->push(new TextareaField("Comment", "Comments"));
		
		if(self::Subscriptions()) {
			//Register for updates checkbox
			$register = new CheckboxsetField(
					'UpdateMe',
					'',
					array(1 => 'Receive project updates via our Newsletter')
			);
			$register->addExtraClass('updateme');
			$fields->push($register);
		}
		
		// Create actions
		$button = new FormAction('postcomment', 'Post');
		$button->addExtraClass('submit hoverable');
		$actions = new FieldSet($button);
		
		// Create validator
		$validator = new RequiredFields('Email','Name','LastName');
		
		$form = new Codem_PageCommentInterface_Form($this, "PostCommentForm", $fields, $actions, $validator);
		
		// Set it so the user gets redirected back down to the form upon form fail
		$form->setRedirectToFormOnValidationError(true);
		
		// Optional Spam Protection.
		if(class_exists('SpamProtectorManager')) {
			SpamProtectorManager::update_form($form, null, array('Name' => 'author_name', 'CommenterURL' => 'author_url', 'Comment' => 'post_body'));
			self::set_use_ajax_commenting(false);
		}
		
		// Shall We use AJAX?
		if(self::$use_ajax_commenting) {
			Requirements::javascript(SAPPHIRE_DIR . '/thirdparty/behaviour/behaviour.js');
			Requirements::javascript(SAPPHIRE_DIR . '/thirdparty/prototype/prototype.js');
			Requirements::javascript(THIRDPARTY_DIR . '/scriptaculous/effects.js');
			Requirements::javascript(CMS_DIR . '/javascript/PageCommentInterface.js');
		}
		
		$fields = array();
		
		if(self::Subscriptions()) {
			$fields["UpdateMe"] = Cookie::get("PageCommentInterface_UpdateMe");
		}
		
		// Load the data from Session
		$form->loadDataFrom(
			array_merge(
				array(
				"Name" => Cookie::get("PageCommentInterface_Name"),
				"LastName" => Cookie::get("PageCommentInterface_LastName"),
				"Email" => Cookie::get("PageCommentInterface_Email"),
				"Comment" => Cookie::get("PageCommentInterface_Comment"),
				"CommenterURL" => Cookie::get("PageCommentInterface_CommenterURL"),
				),
			$fields)
		);
		
		return $form;
	}
}


//and the admin extension
class Codem_CommentAdminExtension extends CommentAdmin {
	public function EditForm() {
		$section = $this->Section();

		if($section == 'approved') {
			$filter = "\"IsSpam\" = 0 AND \"NeedsModeration\" = 0";
			$title = "<h2>". _t('CommentAdmin.APPROVEDCOMMENTS', 'Approved Comments')."</h2>";
		} else if($section == 'unmoderated') {
			$filter = '"NeedsModeration" = 1';
			$title = "<h2>"._t('CommentAdmin.COMMENTSAWAITINGMODERATION', 'Comments Awaiting Moderation')."</h2>";
		} else {
			$filter = '"IsSpam" = 1';
			$title = "<h2>"._t('CommentAdmin.SPAM', 'Spam')."</h2>";
		}

		$filter .= ' AND "ParentID">0';

		$tableFields = array(
			"Name" => _t('CommentAdmin.FIRSTNAME', 'First Name'),
			"LastName" => _t('CommentAdmin.LASTNAME', 'Last Name'),
			"Email" => _t('CommentAdmin.EMAIL', 'Email'),
			"Comment" => _t('CommentAdmin.COMMENT', 'Comment'),
			"Parent.Title" => _t('CommentAdmin.PAGE', 'Page'),
			"CommenterURL" => _t('CommentAdmin.COMMENTERURL', 'URL'),
			"Created" => _t('CommentAdmin.DATEPOSTED', 'Date Posted')
		);
		
		

		$popupFields = new FieldSet(
			new TextField('Name', _t('CommentAdmin.NAME', 'First Name')),
			new TextField('LastName', _t('CommentAdmin.NAME', 'Last Name')),
			new TextField('Email', _t('CommentAdmin.EMAIL', 'Email')),
			new TextField('CommenterURL', _t('CommentAdmin.COMMENTERURL', 'URL')),
			new TextareaField('Comment', _t('CommentAdmin.COMMENT', 'Comment'))
		);
		
		if(Codem_PageCommentInterface::Subscriptions()) {
			$tableFields["UpdateMe"] = _t('CommentAdmin.UPDATEME', 'Receive Updates');
			$popupFields->push(new CheckboxsetField('UpdateMe', _t('CommentAdmin.UPDATEME', 'Receive Updates'), array(1 => 'Receive project updates via our Newsletter')));
		}

		$idField = new HiddenField('ID', '', $section);
		$table = new CommentTableField($this, "Comments", "PageComment", $section, $tableFields, $popupFields, array($filter), 'Created DESC');
		
		$table->setParentClass(false);
		$table->setFieldCasting(array(
			'Created' => 'SSDatetime->Full',
			'Comment' => array('HTMLText->LimitCharacters', 150)
		));
		
		$table->setPageSize(self::get_comments_per_page());
		$table->addSelectOptions(array('all'=>'All', 'none'=>'None'));
		$table->Markable = true;
		//allow the RV admin to export
		$table->setPermissions(array_merge($table->getPermissions(), array('export')));
		
		$fields = new FieldSet(
			new LiteralField("Title", $title),
			$idField,
			$table
		);

		$actions = new FieldSet();

		if($section == 'unmoderated') {
			$actions->push(new FormAction('acceptmarked', _t('CommentAdmin.ACCEPT', 'Accept')));
		}

		if($section == 'approved' || $section == 'unmoderated') {
			$actions->push(new FormAction('spammarked', _t('CommentAdmin.SPAMMARKED', 'Mark as spam')));
		}

		if($section == 'spam') {
			$actions->push(new FormAction('hammarked', _t('CommentAdmin.MARKASNOTSPAM', 'Mark as not spam')));
		}

		$actions->push(new FormAction('moderatemarked', _t('CommentAdmin.MODERATE', 'Moderate')));
		$actions->push(new FormAction('deletemarked', _t('CommentAdmin.DELETE', 'Delete')));

		if($section == 'spam') {
			$actions->push(new FormAction('deleteall', _t('CommentAdmin.DELETEALL', 'Delete All')));
		}

		$form = new Form($this, "EditForm", $fields, $actions);

		return $form;
	}
	
	function moderatemarked() {
			$numComments = 0;
			$folderID = 0;
			$deleteList = '';

			if($_REQUEST['Comments']) {
				foreach($_REQUEST['Comments'] as $commentid) {
					$comment = DataObject::get_by_id('PageComment', $commentid);
					if($comment) {
						$comment->NeedsModeration = true;
						$comment->write();
						$numComments++;
					}
				}
			} else {
				user_error("No comments in $commentList could be found!", E_USER_ERROR);
			}

			$msg = sprintf(_t('CommentAdmin.MODERATE', 'Moderated %s comments.'), $numComments);
			echo <<<JS
				$deleteList
				$('Form_EditForm').getPageFromServer($('Form_EditForm_ID').value);
				statusMessage("$msg");
JS;
	}
}
?>