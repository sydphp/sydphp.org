<?php
/**
 * @note this is a Centrik library © 2010 James Ellis
 * @note CSS opacity handler
 */
class NCSS_Opacity extends NCSSHandler {
	public function __construct() {}
	
	public function Render() {
		$css = "";
		if(is_int($this->options['amount'])) {
			$css .= "\t-khtml-opacity : " . number_format($this->options['amount']/100, 2) . ";\n";
			$css .= "\t-webkit-opacity : " . number_format($this->options['amount']/100, 2) . ";\n";
			$css .= "\t-moz-opacity : " . number_format($this->options['amount']/100, 2) . ";\n";
			$css .= "\tfilter: alpha(opacity = " . (int)$this->options['amount'] . ");\n";
			$css .= "opacity : " . number_format($this->options['amount']/100, 2) . ";\n";
		}
		print $css;
	}
}
