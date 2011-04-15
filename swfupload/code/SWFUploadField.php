<?php

class SWFUploadField extends FileField
{
	
	function __construct($form_name, $name, $title = null, $configuration = array())
	{			
		parent::__construct($name, $title);
		if(isset($value)) $this->value = $value;
		
		SWFUploadConfig::$form_name = $form_name;
		
		if(!empty($configuration)) {
			SWFUploadConfig::Configure($configuration);
		}
		$url = SWFUploadConfig::get_var('upload_url');
		if(empty($url))
			SWFUploadConfig::set_var('upload_url',Director::absoluteURL(Controller::curr()->Link('handleswfupload')));
		
		SWFUploadConfig::addPostParam('PHPSESSID',session_id());			
		SWFUploadConfig::Bootstrap();		
		
	}
			
	function FieldHolder() {
		$Title = $this->XML_val('Title');
		$Message = $this->XML_val('Message');
		$MessageType = $this->XML_val('MessageType');
		$RightTitle = $this->XML_val('RightTitle');
		$Type = $this->XML_val('Type');
		$extraClass = $this->XML_val('extraClass');
		$Name = $this->XML_val('Name');
		$Field = $this->XML_val('Field');
		
		$titleBlock = (!empty($Title)) ? "<label class=\"left\" for=\"{$this->id()}\">$Title</label>" : "";
		$messageBlock = (!empty($Message)) ? "<span class=\"message $MessageType\">$Message</span>" : "";
		$rightTitleBlock = (!empty($RightTitle)) ? "<label class=\"right\" for=\"{$this->id()}\">$RightTitle</label>" : "";

		return <<<HTML
<div id="$Name" class="field $Type $extraClass">$titleBlock

<div id="flashUI">
		<span id="spanButtonPlaceholder"></span>
	<ul id="file_list"></ul>
</div>

$rightTitleBlock$messageBlock</div>
HTML;
	}
	
	function Value()
	{
		return !empty($_POST['uploaded_files']) ? $_POST['uploaded_files'] : (isset($_FILES[$this->Name]) ? $_FILES[$this->Name] : "");
	}

	function dataValue()
	{
		return $this->Value();
	}
	
	function Field() {return <<<HTML
<div id="$this->Name" class="field">$this->Title

<div id="flashUI">
		<span id="spanButtonPlaceholder"></span>
	<ul id="file_list"></ul>
</div>

</div>
HTML;
}
}

?>