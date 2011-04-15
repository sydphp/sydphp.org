<?php
/**
 * Security section of the CMS
 * @package cms
 * @subpackage security
 */
class SecurityAdmin extends LeftAndMain implements PermissionProvider {

	static $url_segment = 'security';
	
	static $url_rule = '/$Action/$ID/$OtherID';
	
	static $menu_title = 'Security';
	
	static $tree_class = 'Group';
	
	static $subitem_class = 'Member';
	
	static $allowed_actions = array(
		'addgroup',
		'autocomplete',
		'removememberfromgroup',
		'savemember',
		'AddRecordForm',
		'EditForm',
		'MemberImportForm',
		'memberimport',
		'GroupImportForm',
		'groupimport',
		'RootForm'
	);

	/**
	 * @var Array
	 */
	static $hidden_permissions = array();

	public function init() {
		parent::init();

		Requirements::javascript(CMS_DIR . '/javascript/hover.js');
		Requirements::javascript(THIRDPARTY_DIR . "/scriptaculous/controls.js");
		Requirements::javascript(THIRDPARTY_DIR . '/jquery-livequery/jquery.livequery.js');

		// needed for MemberTableField (Requirements not determined before Ajax-Call)
		Requirements::add_i18n_javascript(SAPPHIRE_DIR . '/javascript/lang');
		Requirements::javascript(SAPPHIRE_DIR . "/javascript/TableListField.js");
		Requirements::javascript(SAPPHIRE_DIR . "/javascript/TableField.js");
		Requirements::javascript(SAPPHIRE_DIR . "/javascript/ComplexTableField.js");
		Requirements::javascript(CMS_DIR . "/javascript/MemberTableField.js");
		Requirements::css(THIRDPARTY_DIR . "/greybox/greybox.css");
		Requirements::css(SAPPHIRE_DIR . "/css/ComplexTableField.css");

		Requirements::javascript(CMS_DIR . '/javascript/SecurityAdmin_left.js');
		Requirements::javascript(CMS_DIR . '/javascript/SecurityAdmin_right.js');
		
		Requirements::javascript(THIRDPARTY_DIR . "/greybox/AmiJS.js");
		Requirements::javascript(THIRDPARTY_DIR . "/greybox/greybox.js");
	}
	
	function getEditForm($id = null) {
		if(!$id) $id = $this->currentPageID();

		if($id && $id != 'root') {
			$record = DataObject::get_by_id($this->stat('tree_class'), $id);
			if(!$record) return false;
		}		

		if($id && is_numeric($id)) {
			$fields = $record->getCMSFields();

			if($fields->hasTabSet()) {
				$fields->findOrMakeTab('Root.Import',_t('Group.IMPORTTABTITLE', 'Import'));
				$fields->addFieldToTab('Root.Import', 
					new LiteralField(
						'MemberImportFormIframe', 
						sprintf(
							'<iframe src="%s" id="MemberImportFormIframe" width="100%%" height="400px" border="0"></iframe>',
							$this->Link('memberimport')
						)
					)
				);
				if(Permission::check('APPLY_ROLES')) { 
					$fields->addFieldToTab(
						'Root.Roles',
						new LiteralField(
							'RolesAddEditLink', 
							sprintf(
								'<p class="add-role"><a href="%s">%s</a></p>',
								$this->Link('show/root'),
								// TODO This should include #Root_Roles to switch directly to the tab,
								// but tabstrip.js doesn't display tabs when directly adressed through a URL pragma
								_t('Group.RolesAddEditLink', 'Add/edit roles')
							)
						)
					);
				}
			}
		
			$actions = new FieldSet(
				new FormAction('addmember',_t('SecurityAdmin.ADDMEMBER','Add Member')),
				new FormAction('save',_t('SecurityAdmin.SAVE','Save'))
			);
			
			$form = new Form($this, "EditForm", $fields, $actions);
			$form->loadDataFrom($record);

			if(!$record->canEdit()) {
				$readonlyFields = $form->Fields()->makeReadonly();
				$form->setFields($readonlyFields);
			}
		
			// Filter permissions
			$permissionField = $form->Fields()->dataFieldByName('Permissions');
			if($permissionField) $permissionField->setHiddenPermissions(self::$hidden_permissions);
			
			$this->extend('updateEditForm', $form);
		} else {
			$form = $this->RootForm();
		}
		
		return $form;
	}

	/**
	 * @return FieldSet
	 */
	function RootForm() {
		$memberList = new MemberTableField(
			$this,
			"Members"
		);
		// unset 'inlineadd' permission, we don't want inline addition
		$memberList->setPermissions(array('edit', 'delete', 'add'));
		$memberList->setRelationAutoSetting(false);
		
		$fields = new FieldSet(
			new TabSet(
				'Root',
				new Tab('Members', singleton('Member')->i18n_plural_name(),
					$memberList,
					new LiteralField('MembersCautionText', 
						sprintf('<p class="caution-remove"><strong>%s</strong></p>',
							_t(
								'SecurityAdmin.MemberListCaution', 
								'Caution: Removing members from this list will remove them from all groups and the database'
							)
						)
					)
				),
				new Tab('Import', _t('SecurityAdmin.TABIMPORT', 'Import'),
					new LiteralField(
						'GroupImportFormIframe', 
						sprintf(
							'<iframe src="%s" id="GroupImportFormIframe" width="100%%" height="400px" border="0"></iframe>',
							$this->Link('groupimport')
						)
					)
				)
			),
			// necessary for tree node selection in LeftAndMain.EditForm.js
			new HiddenField('ID', false, 0)
		);

		// Add roles editing interface
		if(Permission::check('APPLY_ROLES')) {
			$rolesCTF = new ComplexTableField(
				$this,
				'Roles',
				'PermissionRole'
			);
			$rolesCTF->setPermissions(array('add', 'edit', 'delete'));

			$rolesTab = $fields->findOrMakeTab('Root.Roles', _t('SecurityAdmin.TABROLES', 'Roles'));
			$rolesTab->push(new LiteralField(
				'RolesDescription', 
				''
			));
			$rolesTab->push($rolesCTF);
		}

		$actions = new FieldSet(
			new FormAction('addmember',_t('SecurityAdmin.ADDMEMBER','Add Member'))
		);
		
		$this->extend('updateRootFormFields', $fields, $actions);
		
		$form = new Form(
			$this,
			'EditForm',
			$fields,
			$actions
		);
		
		return $form;
	}
	
	public function memberimport() {
		Requirements::clear();
		Requirements::css(SAPPHIRE_DIR . '/css/Form.css');
		Requirements::css(CMS_DIR . '/css/typography.css');
		Requirements::css(CMS_DIR . '/css/cms_right.css');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery-livequery/jquery.livequery.js');
		Requirements::javascript(SAPPHIRE_DIR . '/javascript/jquery_improvements.js');
		Requirements::css(CMS_DIR . '/css/MemberImportForm.css');
		Requirements::javascript(CMS_DIR . '/javascript/MemberImportForm.js');
		
		return $this->renderWith('BlankPage', array(
			'Form' => $this->MemberImportForm()
		));
	}
	
	/**
	 * @see SecurityAdmin_MemberImportForm
	 * 
	 * @return Form
	 */
	public function MemberImportForm() {
		$group = $this->currentPage();
		$form = new MemberImportForm(
			$this,
			'MemberImportForm'
		);
		$form->setGroup($group);
		
		return $form;
	}
		
	public function groupimport() {
		Requirements::clear();
		Requirements::css(SAPPHIRE_DIR . '/css/Form.css');
		Requirements::css(CMS_DIR . '/css/typography.css');
		Requirements::css(CMS_DIR . '/css/cms_right.css');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery-livequery/jquery.livequery.js');
		Requirements::javascript(SAPPHIRE_DIR . '/javascript/jquery_improvements.js');
		Requirements::css(CMS_DIR . '/css/MemberImportForm.css');
		Requirements::javascript(CMS_DIR . '/javascript/MemberImportForm.js');
		
		return $this->renderWith('BlankPage', array(
			'Form' => $this->GroupImportForm()
		));
	}
	
	/**
	 * @see SecurityAdmin_MemberImportForm
	 * 
	 * @return Form
	 */
	public function GroupImportForm() {
		$form = new GroupImportForm(
			$this,
			'GroupImportForm'
		);
		
		return $form;
	}

	public function AddRecordForm() {
		$m = Object::create('MemberTableField',
			$this,
			"Members",
			$this->currentPageID()
		);
		return $m->AddRecordForm();
	}

	/**
	 * Ajax autocompletion
	 */
	public function autocomplete() {
		$fieldName = $this->urlParams['ID'];
		$fieldVal = $_REQUEST[$fieldName];
		$result = '';

		// Make sure we only autocomplete on keys that actually exist, and that we don't autocomplete on password
		if(!singleton($this->stat('subitem_class'))->hasDatabaseField($fieldName)  || $fieldName == 'Password') return;

		$matches = DataObject::get($this->stat('subitem_class'),"\"$fieldName\" LIKE '" . Convert::raw2sql($fieldVal) . "%'");
		if($matches) {
			$result .= "<ul>";
			foreach($matches as $match) {
				// If the current user doesnt have permissions on the target user,
				// he's not allowed to add it to a group either: Don't include it in the suggestions.
				if(!$match->canView() || !$match->canEdit()) continue;

				$data = $match->FirstName;
				$data .= ",$match->Surname";
				$data .= ",$match->Email";
				$result .= "<li>" . $match->$fieldName . "<span class=\"informal\">($match->FirstName $match->Surname, $match->Email)</span><span class=\"informal data\">$data</span></li>";
			}
			$result .= "</ul>";
			return $result;
		}
	}

	/**
	 * Return the entire site tree as a nested set of ULs.
	 * @return string Unordered list HTML
	 */
	public function SiteTreeAsUL() {
		$obj = singleton($this->stat('tree_class'));
		$obj->markPartialTree();
		
		if($p = $this->currentPage()) $obj->markToExpose($p);

		// getChildrenAsUL is a flexible and complex way of traversing the tree
		$siteTreeList = $obj->getChildrenAsUL(
			'',
			'"<li id=\"record-$child->ID\" class=\"$child->class " . $child->markingClasses() . ($extraArg->isCurrentPage($child) ? " current" : "") . "\">" . ' .
			'"<a href=\"" . Controller::join_links(substr($extraArg->Link(),0,-1), "show", $child->ID) . "\" >" . $child->TreeTitle() . "</a>" ',
			$this,
			true
		);	

		// Wrap the root if needs be
		$rootLink = $this->Link() . 'show/root';
		$rootTitle = _t('SecurityAdmin.SGROUPS', 'Security Groups');
		if(!isset($rootID)) {
			$siteTree = "<ul id=\"sitetree\" class=\"tree unformatted\"><li id=\"record-root\" class=\"Root\"><a href=\"$rootLink\"><strong>{$rootTitle}</strong></a>"
			. $siteTreeList . "</li></ul>";
		}
							
		return $siteTree;
	}

	public function addgroup($request) {
		// Protect against CSRF on destructive action
		if(!SecurityToken::inst()->checkRequest($request)) return $this->httpError(400);
		
		if(!singleton($this->stat('tree_class'))->canCreate()) return Security::permissionFailure($this);
		
		$newGroup = Object::create($this->stat('tree_class'));
		$newGroup->Title = _t('SecurityAdmin.NEWGROUP',"New Group");
		$newGroup->Code = "new-group";
		$newGroup->ParentID = (is_numeric($_REQUEST['ParentID'])) ? (int)$_REQUEST['ParentID'] : 0;
		$newGroup->write();
		
		return $this->returnItemToUser($newGroup);
	}

	public function EditedMember() {
		if(Session::get('currentMember')) return DataObject::get_by_id('Member', (int) Session::get('currentMember'));
	}

	function providePermissions() {
		return array(
			'EDIT_PERMISSIONS' => array(
				'name' => _t('SecurityAdmin.EDITPERMISSIONS', 'Manage permissions for groups'),
				'category' => _t('Permissions.PERMISSIONS_CATEGORY', 'Roles and access permissions'),
				'help' => _t('SecurityAdmin.EDITPERMISSIONS_HELP', 'Ability to edit Permissions and IP Addresses for a group. Requires the "Access to \'Security\' section" permission.'),
				'sort' => 0
			),
			'APPLY_ROLES' => array(
				'name' => _t('SecurityAdmin.APPLY_ROLES', 'Apply roles to groups'),
				'category' => _t('Permissions.PERMISSIONS_CATEGORY', 'Roles and access permissions'),
				'help' => _t('SecurityAdmin.APPLY_ROLES_HELP', 'Ability to edit the roles assigned to a group. Requires the "Access to \'Security\' section" permission.'),
				'sort' => 0
			)
		);
	}
	
	/**
	 * The permissions represented in the $codes will not appearing in the form
	 * containing {@link PermissionCheckboxSetField} so as not to be checked / unchecked.
	 * 
	 * @param $codes String|Array
	 */
	static function add_hidden_permission($codes){
		if(is_string($codes)) $codes = array($codes);
		self::$hidden_permissions = array_merge(self::$hidden_permissions, $codes);
	}
	
	/**
	 * @param $codes String|Array
	 */
	static function remove_hidden_permission($codes){
		if(is_string($codes)) $codes = array($codes);
		self::$hidden_permissions = array_diff(self::$hidden_permissions, $codes);
	}
	
	/**
	 * @return Array
	 */
	static function get_hidden_permissions(){
		return self::$hidden_permissions;
	}
	
	/**
	 * Clear all permissions previously hidden with {@link add_hidden_permission}
	 */
	static function clear_hidden_permissions(){
		self::$hidden_permissions = array();
	}
}

?>
