jQuery(document).ready(function($){
	"use strict";
		
    $('.woocommercesaleproductsdisplay-bp-vc-element-carousel-blog').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-pagination"),
			margin : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-margin"),
			nav : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-navigation"),
			rtl : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-rtl"),
			loop: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-loop"),
			smartSpeed: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-autoplay"),
			autoplayHoverPause: true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-items")
				}
			}			
        });
    });		
	
});

var woocommercesaleproductsdisplayCarouselHandler = function($scope, $) {
    $('.woocommercesaleproductsdisplay-bp-vc-element-carousel-blog').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-pagination"),
			margin : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-margin"),
			nav : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-navigation"),
			rtl : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-rtl"),
			loop: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-loop"),
			smartSpeed: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-autoplay"),
			autoplayHoverPause: true,
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("woocommercesaleproductsdisplay-blog-carousel-owl-items")
				}
			}			
        });
    });			
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/woocommerce-sale-products-carousel-layouts.default",
		 woocommercesaleproductsdisplayCarouselHandler
    );
});	