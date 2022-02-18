jQuery(document).ready(function($){
	"use strict";
		
    $('.woocommerceproductsdisplay-bp-vc-element-carousel-blog').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-pagination"),
			margin : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-margin"),
			nav : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-navigation"),
			rtl : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-rtl"),
			loop: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-loop"),
			smartSpeed: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-autoplay"),
			autoplayHoverPause: true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-items")
				}
			}			
        });
    });		
	
});

var woocommerceproductsdisplayCarouselHandler = function($scope, $) {
    $('.woocommerceproductsdisplay-bp-vc-element-carousel-blog').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-pagination"),
			margin : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-margin"),
			nav : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-navigation"),
			rtl : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-rtl"),
			loop: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-loop"),
			smartSpeed: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-autoplay"),
			autoplayHoverPause: true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("woocommerceproductsdisplay-blog-carousel-owl-items")
				}
			}			
        });
    });			
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/woocommerce-products-carousel-layouts.default",
		 woocommerceproductsdisplayCarouselHandler
    );
});	