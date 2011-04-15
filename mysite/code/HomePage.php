<?php
class HomePage extends Codem_ImageGalleryPage {

	public static $db = array(
	);

	public static $has_one = array(
	);
	
	static $hide_ancestor = "Codem_ImageGalleryPage";

}
class HomePage_Controller extends Codem_ImageGalleryPage_Controller {
	public function index() {
		return $this->renderWith(array('HomePage','Page'));
	}

	public function CssClass() {
		return "page homepage";
	}
	
	public function IsHomePage() {
		return TRUE;
	}
}
?>