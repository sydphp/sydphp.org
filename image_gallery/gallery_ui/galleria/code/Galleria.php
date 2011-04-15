<?php

class Galleria extends ImageGalleryUI
{
	static $link_to_demo = "http://devkick.com/lab/galleria/";
	static $label = "Galleria";
	public $item_template = "Galleria";
	public $layout_template = "Galleria_layout";
	
	public function initialize()
	{
		Requirements::javascript('jsparty/jquery/jquery.js'); 
		Requirements::javascript('image_gallery/gallery_ui/galleria/javascript/jquery.galleria.js');
		Requirements::javascript('image_gallery/gallery_ui/galleria/javascript/galleria.settings.js');

		Requirements::css('image_gallery/gallery_ui/galleria/css/galleria.css');
		
	}
	
}