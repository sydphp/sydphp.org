//turn off CC errors
var curvyCornersVerbose = false;

jQuery(document).ready(
	function($) {
	
	
		jQuery('#slides').jCarouselLite({
			vertical : true,//vertical position
			auto : true,
			timeout : 100000,//auto scroll
			scroll : 1,//number of items to scroll
			visible : 1,//only one item visible
			speed : 800,//speed of scroll
			
			//easing : 'swing',//easing plugin (default)
			
			btnNext: jQuery('.slides-actions .slide-next'),//no button
			btnPrev: jQuery('.slides-actions .slide-previous'),//no button
			
			pause : true, //do not auto pause
			mouseWheel : false,//do not do mouse wheel events
			
			//callbacks
			//beforeStart : rv_carousel_beforestart,
			//afterEnd : rv_carousel_afterend
		});
		
		jQuery('.slides-actions .slide-pause').click(
			function() {
				if(jQuery(this).hasClass('slide-button-on')) {
					jQuery('#slides').trigger('resumeCarousel');
					jQuery(this).removeClass('slide-button-on');
				} else {
					jQuery('#slides').trigger('pauseCarousel');
					jQuery(this).addClass('slide-button-on');
				}
			}
		);
	
		//reverse category z-index on li's
		//$('ul.rz li.root').each( function(i) { $(this).css('z-index', 9000 - i); } );
		
		$('#categories ul.root li.root').hover(
			function() {
				$(this).addClass('hover');
				$(this).children('ul.sub:first').css('display','block');
			},
			function() {
				$(this).removeClass('hover');
				$(this).children('ul.sub:first').css('display','none');
			}
		);
	
		//form messages
		$('form .message').live(
			'click',
			function() {
				$(this).fadeOut('fast');
			}
		);
		$('form :input').live(
			'blur',
			function() {
				setTimeout(
					function(e) {
						$('form .message').fadeOut('fast');
					},
					5000
				);
			}
		);
	}
);