<?php
/**
 * @note this is a Centrik library © 2010 James Ellis
 * @note CSS radius handler
 */
class NCSS_Radius extends NCSSHandler {
	
	protected $needs_pie = TRUE;

	public function __construct() {}
	
	public function Render() {
		$css = "";
		
		//we use shorthand properties here... to support PIE
		$props = array(
			//in this order
			'-moz-border-radius', '-webkit-border-radius','-khtml-border-radius', 'border-radius',
		);
		
		$ordering = array('tl','tr','br','bl');
		
		if(isset($this->options['all'])) {
			foreach($props as $prop) {
				$css .= "\t{$prop}:{$this->options['all']};\n";
			}
		} else {
			reset($props);
			foreach($props as $prop) {
				$parts = "";
				foreach($ordering as $corner) {
					if(isset($this->options[$corner])) {
						$parts .= " " . $this->options[$corner];
					} else {
						$parts .= " 0";
					}
				}
				if($parts !== "") {
					$css .= $prop . " : " . $parts . ";\n";
				}
			}
		}
		print $css;
	}
}