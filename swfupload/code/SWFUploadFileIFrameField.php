<?php

class SWFUploadFileIFrameField extends FileField
{
	
	protected $controller = "swfuploadfile";
	
	public function Field() {
		$data = $this->form->getRecord();
		
		if($data->ID && is_numeric($data->ID)) {
			$idxField = $this->name . 'ID';
			$hiddenField =  "<input type=\"hidden\" id=\"" . $this->id() . "\" name=\"$idxField\" value=\"" . $this->attrValue() . "\" />";
			
			$parentClass = $data->class;

			$parentID = $data->ID;
			$parentField = $this->name;
			$iframe = "<iframe name=\"{$this->name}_iframe\" src=\"{$this->controller}/iframe/$parentClass/$parentID/$parentField\" style=\"height: 202px; width: 600px; border-style: none;\"></iframe>";
	
			return $iframe . $hiddenField;
			
		} else {
			$this->value = _t('FileIframeField.NOTEADDFILES', 'You can add files once you have saved for the first time.');
			return FormField::Field();
		}
	}
	
	public function saveInto(DataObject $record) {
		$fieldName = $this->name . 'ID';
		$hasOnes = $record->has_one($this->name);
		if(!$hasOnes) $hasOnes = $record->has_one($fieldName);
		
		// assume that the file is connected via a has-one
		if( !$hasOnes || !isset($_FILES[$this->name]) ||  !$_FILES[$this->name]['name']){
			return;
		}
		
		$file = new File();
		$file->loadUploaded($_FILES[$this->name]);
		
		$record->$fieldName = $file->ID;	
	}

}

class SWFUploadFileIFrameField_Uploader extends Image_Uploader
{
	/**
	 * Ensures the css is loaded for the iframe.
	 */
	function iframe() {
		if(!Permission::check('ADMIN')) Security::permissionFailure($this);
		
		Requirements::css("cms/css/Image_iframe.css");
		return array();
	}
	
	public function RelativeLink($action = null)
	{
		if($action === null) $action = "index";
		return "/swfuploadfile/$action/".$this->urlParams['Class']."/".$this->urlParams['ID']."/".$this->urlParams['Field'];
	}
	
	protected function getSWFUploadField($form_name)
	{
		return new SWFUploadField($form_name,"Upload","", array(
			'file_queue_limit' => '1',
			'file_upload_limit' => '1',
			'upload_url' => Director::absoluteURL($this->RelativeLink('handleswfupload'))
		));
	}
	
	/**
	 * Form to show the current image and allow you to upload another one.
	 * @return Form
	 */
	function EditImageForm() {
		$isImage = $this->IsImage();
		$type =  $isImage ? _t('Controller.IMAGE', "Image") : _t('Controller.FILE', "File");
		if($this->Image()->ID) {
			$title = sprintf(
				_t('ImageUploader.REPLACE', "Replace %s", PR_MEDIUM, 'Replace file/image'), 
				$type
			);
			$fromYourPC = _t('ImageUploader.ONEFROMCOMPUTER', "With one from your computer");
			$fromTheDB = _t('ImageUplaoder.ONEFROMFILESTORE', "With one from the file store");
		} else {
			$title = sprintf(
				_t('ImageUploader.ATTACH', "Attach %s", PR_MEDIUM, 'Attach image/file'),
				$type
			);
			$fromYourPC = _t('ImageUploader.FROMCOMPUTER', "From your computer");
			$fromTheDB = _t('ImageUploader.FROMFILESTORE', "From the file store");
		}
		
		
		return new Form(
			$this, 
			'EditImageForm', 
			new FieldSet(
				new HiddenField("Field","",$this->urlParams['Field']),
				new HeaderField($title),

				new SelectionGroup("ImageSource", array(
					"new//$fromYourPC" => new FieldGroup("",
						$this->getSWFUploadField('EditImageForm')					
					),
					"existing//$fromTheDB" => new FieldGroup("",
						new TreeDropdownField("ExistingFile", "","File")
					)
				))
				
			),
			new FieldSet(
				new FormAction("save",$title)
			)
		);
	}
	
	/**
	 * A simple version of the upload form.
	 * @returns string
	 */
	function EditImageSimpleForm() {
		$isImage = $this->IsImage();
		$type =  $isImage ? _t('Controller.IMAGE') : _t('Controller.FILE');
		if($this->Image()->ID) {
			$title = sprintf(
				_t('ImageUploader.REPLACE'), 
				$type
			);
			$fromYourPC = _t('ImageUploader.ONEFROMCOMPUTER');
		} else {
			$title = sprintf(
				_t('ImageUploader.ATTACH'), 
				$type
			);
			$fromTheDB = _t('ImageUploader.ONEFROMFILESTORE');
		}
		
		return new Form($this, 'EditImageSimpleForm', new FieldSet(
			new HiddenField("Class", null, $this->urlParams['Class']),
			new HiddenField("ID", null, $this->urlParams['ID']),
			new HiddenField("Field", null, $this->urlParams['Field']),
			new FileField("Upload","")
		),
		new FieldSet(
			new FormAction("save",$title)
		));
	}

	function handleswfupload() {
		set_time_limit(1200); // 20 minutes
		$data = $_POST;
		$owner = DataObject::get_by_id($this->urlParams['Class'], $this->urlParams['ID']);
		$fieldName = $this->urlParams['Field'] . 'ID';
		
			// TODO We need to replace this with a way to get the type of a field
			$imageClass = $owner->has_one($this->urlParams['Field']);
		
			// If we can't find the relationship, assume its an Image.
			if( !$imageClass) {
				if(!is_subclass_of( $imageClass, 'Image' )){
					$imageClass = 'Image';	
				}
			}
			
			// Assuming its a decendant of File
			$image = new $imageClass();
			if(class_exists("Upload")) {
				$u = new Upload();
				$u->loadIntoFile($_FILES['swfupload_file'], $image);
			}
			else {
				$image->loadUploaded($_FILES['swfupload_file']);
			}
			$owner->$fieldName = $image->ID;
			
		    // store the owner id with the uploaded image
			$image->write();

		$owner->write();
		echo $owner->ID;
	
	}

	
	
	/**
	 * Save the data in this form.
	 */
	function save($data, $form) {
		if($data['ImageSource'] == 'existing') {
			$owner = DataObject::get_by_id($this->urlParams['Class'], $this->urlParams['ID']);
			$fieldName = $this->urlParams['Field'] . 'ID';
			if(!$data['ExistingFile']) {
				// No image has been selected
				Director::redirectBack();
				return;
			}
			
			$owner->$fieldName = $data['ExistingFile'];

			// Edit the class name, if applicable
			$existingFile = DataObject::get_by_id("File", $data['ExistingFile']);
			$desiredClass = $owner->has_one($data['Field']);
			
			// Unless specifically asked, we don't want the user to be able
			// to select a folder
			if(is_a($existingFile, 'Folder') && $desiredClass != 'Folder') {
				Director::redirectBack();
				return;
			}
			
			if(!is_a($existingFile, $desiredClass)) {
				$existingFile->ClassName = $desiredClass;
				$existingFile->write();
			}
		
			$owner->write();
			Director::redirectBack();

		} else {
			// Nothing to do here. It has handled by handleswfupload()
			Director::redirectBack();
		}	
	}

}
?>