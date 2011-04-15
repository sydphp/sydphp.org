<?php
/**
 * @note NCSS gradient handler
 * @note OPERA ? " background:-o-linear-gradient(top, {$this->options['from']}, {$this->options['to']});\n"
 */
class NCSS_Gradient extends NCSSHandler {

	protected $needs_pie = TRUE;
	protected $type = 'linear';
	
	public function __construct() {
		$this->options['default'] = '';
	}
	
	public function Render() {
	
		//ordering important here.
		$rules = array(
			"background:-moz-{$this->type}-gradient",//FF 3.6, Fennec 1.0+
			"background:-webkit-gradient",//SAF 4.0, Chrome, Arora + other webkit
			"-pie-background:{$this->type}-gradient",//for IE via PIE
			"background:{$this->type}-gradient",//CSS3
		);
		
		//defaults for start end end if not specified
		if(!isset($this->options['startpoint'])) {
			$this->options['startpoint'] = 'top center';
		}
		//only used by webkit
		if(!isset($this->options['endpoint'])) {
			$this->options['endpoint'] = 'bottom center';
		}
		
		if(empty($this->options['default'])) {
			$this->options['default'] = $this->options['from'];
		}
		//default colour...
		print "background-color : {$this->options['default']};\n";
		
		foreach($rules as $rule) {
			switch($rule) {
				case "background:-webkit-gradient":
					//WEBKIT - Safari, Chrome, Arora, Midori etc
					print $rule . "({$this->type}, " . $this->WebkitPositionTranslation($this->options['startpoint']) . "," .  $this->WebkitPositionTranslation($this->options['endpoint']) . ", from({$this->options['from']}), to({$this->options['to']}));\n";
					break;
				default:
					//any other browser supporting the CSS3 syntax
					print $rule . "({$this->options['startpoint']}, {$this->options['from']}, {$this->options['to']});\n";
					break;
			}
		 }
	}
	
	/**
	 * WebkitPositionTranslation()
	 * @note due to webkit not using the CSS3 draft syntax, we translate the position  (or try to) into something webkit understands
	 * @return string
	 */
	protected function WebkitPositionTranslation($pos) {
		switch($pos) {
			case 'top center':
				return 'left top';
				break;
			case 'bottom center':
				return 'left bottom';
				break;
			case 'left center':
				return 'left top';
				break;
			case 'right center':
				return 'right top';
				break;
		}
	}
}
