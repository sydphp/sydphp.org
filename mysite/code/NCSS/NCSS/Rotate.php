<?php
/**
 * @note CSS rotate handler
 */
class NCSS_Rotate extends NCSSHandler {
	public function __construct() {}
	
	public function Render() {
		print "-moz-transform : rotate({$this->options['amount']});\n"
			. "-webkit-transform : rotate({$this->options['amount']});\n"
			. "-o-transform : rotate({$this->options['amount']});\n"
			. "text-rendering : optimizeLegibility;\n";
	}
}
