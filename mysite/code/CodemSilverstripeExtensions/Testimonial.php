<?php
class Testimonial extends DataObject
{
	static $db = array (
		'DateTime' => 'Date',
		'Author' => 'Text',
		'Position' => 'Text',
		'Project' => 'Text',
		'Heading' => 'HTMLText',
		'Quote' => 'Text',
		'Note' => 'Text',
		//transformed to link page
		'InternalLink' => 'Int',
		'ExternalLink' => 'Text',
		'UseBubble' => 'Boolean',
	);
 
	static $has_one = array (
		'Page' => 'Page',
		'AssociatedImage' => 'Image'
	);
 
	public function getCMSFields_forPopup()
	{
		return new FieldSet(
			//new DatePickerField('DateTime', 'Date'),
			new TextField('Author', 'Author'),
			new TextField('Position', 'Position/Organisation'),
			new CheckboxField('UseBubble', 'Display as speech bubble?'),
			new TextareaField('Quote'),
			new TextareaField('Note', 'Footnote'),
			new TextareaField('Project', 'Project (text will link to internal or external link provided)'),
			new TextField("ExternalLink", "External Link (leave blank to use internal link)"),
			new SimpleTreeDropdownField("InternalLink", 'Internal Link', 'SiteTree'),
			new ImageUploadField('AssociatedImage','Image associated with testimonial')
		);
	}
}
?>
