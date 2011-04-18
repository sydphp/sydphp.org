<?php
class RegisterableEventPresenter extends DataObject
{
	static $db = array (
		'Name' => 'Text',
		'Company' => 'Text',
		'Topic' => 'Text',
		'Twitter' => 'Text',
		'SourcePage' => 'Text',
		'Note' => 'HTMLText',
		'URL' => 'Text',
		'Confirmed' => 'Boolean',
	);
 
	static $has_one = array (
		'Page' => 'Page',
		'AssociatedImage' => 'Image'
	);
 
	public function getCMSFields_forPopup() {
		return new FieldSet(
			//new DatePickerField('DateTime', 'Date'),
			new TextField('Name', 'Presenter Name'),
			new TextField('Topic', 'Topic'),
			new TextField('Company', 'Position/Organisation'),
			new CheckboxField('Confirmed', 'Confirmed?'),
			new TextareaField('Note', 'Presenter Notes/Bio etc'),
			new TextField("URL", "Presenter URL"),
			new TextField("Twitter", "Twitter handle"),
			new TextField("Source Page", "Code Source URL"),
			new ImageUploadField('AssociatedImage','Presenter Image')
		);
	}
}
?>
