// GALLERY
try {

	function show_gallery() {
		jQuery('#ImageGallery').css('visibility','visible');
	}
	
	function gallery_selection() {
		return '#ImageGallery ul#GalleryList';
	}
	
	function item_selection() {
		return gallery_selection() + ' li';
	}
	
	function get_random_item() {
		return jQuery(item_selection() + ':random');
	}
	
	function active_item_selection() {
		return gallery_selection() + ' li.active';
	}
	
	function fade_out_speed() {
		return 650;
	}
	
	function fade_in_speed() {
		return 550;
	}
	
	function gallery_image_selector() {
		return '#GalleryMainImage';
	}
	
	function gallery_image_image_selector() {
		return '#GalleryMainImage img';
	}
	
	function gallery_caption_selector() {
		return '#GalleryMainImageCaption';
	}
	
	function has_gallery() {
		return jQuery(gallery_image_selector()).length == 1;
	}
	
	function set_main_image(el) {
		jQuery(gallery_image_selector()).empty().append('<img src="' + jQuery(el).find('span.item').attr('rel') + '" />');
		jQuery(gallery_image_image_selector()).fadeIn(fade_in_speed());
		jQuery(gallery_caption_selector()).empty().append('<p>' + jQuery(el).find('img').attr('alt')).fadeIn(fade_in_speed());
		//set the height of the container
		
	}
	
	function replace_main_image(el) {
		jQuery(el).addClass('active');
		jQuery(el).siblings().removeClass('active');
		jQuery(gallery_image_image_selector()).fadeOut(
			150,
			function() {
				set_main_image(el);
			}
		)
	}
	
	function handle_gallery_navigation() {
		//when clicking a main image, the next image is shown
		if(jQuery(item_selection()).length > 1) {
			jQuery(gallery_image_selector()).click(
				function() {
					//find the active item in the list
					//does this item have next sibling with an image ?
					var n = jQuery(active_item_selection()).next().find('img');
					if(n.length == 0) {
						//no more image, use first
						replace_main_image(jQuery(item_selection()).find('img').first().parents('li'));
					} else {
						replace_main_image(jQuery(n.parents('li')));
					}
				}
			);
		}
	}
	
	function prevent_item_clickthrough(el) {
		jQuery(el).find('a').click(
			function(e) {
				if(jQuery(this).attr('href') == '') {
					//stop clicks through to image if no link
					e.preventDefault();
				}
			}
		);
	}

	jQuery(document).ready(
		function($) {
			
			handle_gallery_navigation();
			
			//IMAGE ROTATION
			var ci = 0;
			jQuery(item_selection()).each(
				function(i) {
				
					//if the link is empty, prevent clickthrough
					prevent_item_clickthrough(this);
					
					if(ci == 0) {
						//set the first element
						set_main_image(this);
					}
					jQuery(this).click(
						function() {
							replace_main_image(this);
						}
					);
					ci++;
				}
			);
			
			//make it visible
			//show_gallery();
			
		}
	);
} catch (e) {}