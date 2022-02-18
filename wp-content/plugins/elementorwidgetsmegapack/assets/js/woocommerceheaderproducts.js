jQuery(document).ready(function($){
	"use strict";
	
	$( document ).on( 'click', '.ajax_add_to_cart', function(e) {
		$( this ).append('<i class="fa fa-spinner animated rotateIn infinite"></i>');
	});
	
    $('.woocommerceheaderproducts-owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("woocommerceheaderproducts-owl-pagination"),
			margin : $carousel.data("woocommerceheaderproducts-owl-margin"),
			nav : $carousel.data("woocommerceheaderproducts-owl-navigation"),
			rtl : $carousel.data("woocommerceheaderproducts-owl-rtl"),
			loop: $carousel.data("woocommerceheaderproducts-owl-loop"),
			smartSpeed: $carousel.data("woocommerceheaderproducts-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("woocommerceheaderproducts-owl-autoplay"),
			autoplayHoverPause:true,
			navText : ['<i class="icon-arrow-left"></i>','<i class="icon-arrow-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("woocommerceheaderproducts-owl-items-600")
				},
				600:{
					items: $carousel.data("woocommerceheaderproducts-owl-items-900")
				},
				1000:{
					items: $carousel.data("woocommerceheaderproducts-owl-items")
				}
			}			
        });
    });		
	
});

var woocommerceheaderproductsCarouselHandler = function($scope, $) {
    $('.woocommerceheaderproducts-owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("woocommerceheaderproducts-owl-pagination"),
			margin : $carousel.data("woocommerceheaderproducts-owl-margin"),
			nav : $carousel.data("woocommerceheaderproducts-owl-navigation"),
			rtl : $carousel.data("woocommerceheaderproducts-owl-rtl"),
			loop: $carousel.data("woocommerceheaderproducts-owl-loop"),
			smartSpeed: $carousel.data("woocommerceheaderproducts-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("woocommerceheaderproducts-owl-autoplay"),
			autoplayHoverPause:true,
			navText : ['<i class="icon-arrow-left"></i>','<i class="icon-arrow-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("woocommerceheaderproducts-owl-items-600")
				},
				600:{
					items: $carousel.data("woocommerceheaderproducts-owl-items-900")
				},
				1000:{
					items: $carousel.data("woocommerceheaderproducts-owl-items")
				}
			}			
        });
    });			
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/woocommerce-header-products.default",
		 woocommerceheaderproductsCarouselHandler
    );
});	