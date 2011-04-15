<?php

class SimpleTreeDropdownField extends HTMLDropdownField
{
	protected $sourceClass;
	protected $labelField;
	
	function __construct($name, $title = "", $sourceClass = "SiteTree", $value = "", $labelField = "Title", $form = null, $emptyString = null)
	{
		$this->sourceClass = $sourceClass;
		$this->labelField = $labelField;
		parent::__construct($name, $title, $this->getHierarchy(0), $value, $form, $emptyString);
	}
	
	public function setLabelField($field)
	{
		$this->labelField = $field;
	}
	
	private function getHierarchy($parentID, $level = 0)
	{
		$options = array();		
		if($children = DataObject::get($this->sourceClass, "ParentID = $parentID")) {
			foreach($children as $child) {
				$indent="";
				for($i=0;$i<$level;$i++) $indent .= "&nbsp;&nbsp;";
				$text = $child->__get($this->labelField);
				$options[$child->ID] = empty($text) ? "<em>$indent Untitled</em>" : $indent.$text;
				$options += $this->getHierarchy($child->ID, $level+1);
			}
		}
		return $options;	
	}
}
