jQuery(document).ready(function($){
	"use strict";
	$('.fastgallery.brick-masonry.fg-masonry').each( function() {
		var $container = $(this).masonry({
			columnWidth: 1
		});
		$container.imagesLoaded( function() {
			$container.masonry();
		});		
	});	
	$('.fg-gallery-caption').on('mouseover mouseout', function(event) {

			if (event.type == 'mouseover') {
				$(this).parents('.fastgallery-gallery-icon').find('.fg_zoom').addClass('fg_over');
				return false;
			} else {
				$(this).parents('.fastgallery-gallery-icon').find('.fg_zoom').removeClass('fg_over');
				return false;				
			}
			
	});
	
	$('.FGM-Collage .fg-gallery-caption').on('mouseover mouseout', function(event) {

			if (event.type == 'mouseover') {
				$(this).parents('.gallery-icon').find('.fg_zoom').addClass('fg_over');
				return false;
			} else {
				$(this).parents('.gallery-icon').find('.fg_zoom').removeClass('fg_over');
				return false;				
			}
			
	});	
});		


var fastgalleryHandler = function($scope, $) {
	$('.fastgallery.brick-masonry.fg-masonry').each( function() {
		var $container = $(this).masonry({
			columnWidth: 1
		});
		$container.imagesLoaded( function() {
			$container.masonry();
		});		
	});		
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/fast-gallery.default",
		 fastgalleryHandler
    );
});			