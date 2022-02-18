jQuery(document).ready(function($){
	"use strict";
	
	$( document ).on( 'click', '.ajax_add_to_cart', function(e) {
		$( this ).append('<i class="fa fa-spinner animated rotateIn infinite"></i>');
	});
	
	$('.fg-gallery-caption').on('mouseover mouseout', function(event) {
			if (event.type == 'mouseover') {
				$(this).parents('.woocommerceproductsgallery-gallery-icon').find('.fg_zoom').addClass('fg_over');
				return false;
			} else {
				$(this).parents('.woocommerceproductsgallery-gallery-icon').find('.fg_zoom').removeClass('fg_over');
				return false;				
			}
			
	});
	
	
});		


var woocommerceproductsgalleryHandler = function($scope, $) {
	
	$('.fg-gallery-caption').on('mouseover mouseout', function(event) {
			if (event.type == 'mouseover') {
				$(this).parents('.woocommerceproductsgallery-gallery-icon').find('.fg_zoom').addClass('fg_over');
				return false;
			} else {
				$(this).parents('.woocommerceproductsgallery-gallery-icon').find('.fg_zoom').removeClass('fg_over');
				return false;				
			}
			
	});	
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/woocommerce-products-gallery.default",
		 woocommerceproductsgalleryHandler
    );
});			