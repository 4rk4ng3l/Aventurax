jQuery(document).ready(function($){
	"use strict";
	
	$( document ).on( 'click', '.ajax_add_to_cart', function(e) {
		$( this ).append('<i class="fa fa-spinner animated rotateIn infinite"></i>');
	});
	
	$('.fg-gallery-caption').on('mouseover mouseout', function(event) {
			if (event.type == 'mouseover') {
				$(this).parents('.woocommerceproductsshowcase-gallery-icon').find('.fg_zoom').addClass('fg_over');
				return false;
			} else {
				$(this).parents('.woocommerceproductsshowcase-gallery-icon').find('.fg_zoom').removeClass('fg_over');
				return false;				
			}
			
	});
	
    $('.woocommerceproductsshowcaseelementor').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("fast-carousel-owl-pagination"),
			margin : $carousel.data("fast-carousel-owl-margin"),
			nav : $carousel.data("fast-carousel-owl-navigation"),
			rtl : $carousel.data("fast-carousel-owl-rtl"),
			loop: $carousel.data("fast-carousel-owl-loop"),
			smartSpeed: $carousel.data("fast-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("fast-carousel-owl-autoplay"),
			autoplayHoverPause:true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("fast-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("fast-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("fast-carousel-owl-items")
				}
			}			
        });
    });		
	
	
});		


var woocommerceproductsshowcaseHandler = function($scope, $) {
    $('.woocommerceproductsshowcaseelementor').each( function() {
        var $carousel = $(this);
		
        $carousel.owlCarousel({
			dots : $carousel.data("fast-carousel-owl-pagination"),
			margin : $carousel.data("fast-carousel-owl-margin"),
			nav : $carousel.data("fast-carousel-owl-navigation"),
			rtl : $carousel.data("fast-carousel-owl-rtl"),
			loop: $carousel.data("fast-carousel-owl-loop"),
			smartSpeed: $carousel.data("fast-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("fast-carousel-owl-autoplay"),
			autoplayHoverPause:true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("fast-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("fast-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("fast-carousel-owl-items")
				}
			}			
        });	
	});		
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/woocommerce-products-showcase.default",
		 woocommerceproductsshowcaseHandler
    );
});			