<?php
require(dirname(__FILE__) . "/Gradient.php");
class NCSS_LinearGradient extends NCSS_Gradient {
	protected $needs_pie = TRUE;
	protected $type = 'linear';
	
	public function __construct() {
		parent::__construct();
	}
}
?>