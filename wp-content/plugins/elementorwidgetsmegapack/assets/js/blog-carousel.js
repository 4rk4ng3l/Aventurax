jQuery(document).ready(function($){
	"use strict";
		
    $('.bloglayouts-bp-vc-element-carousel-blog').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("bloglayouts-blog-carousel-owl-pagination"),
			margin : $carousel.data("bloglayouts-blog-carousel-owl-margin"),
			nav : $carousel.data("bloglayouts-blog-carousel-owl-navigation"),
			rtl : $carousel.data("bloglayouts-blog-carousel-owl-rtl"),
			loop: $carousel.data("bloglayouts-blog-carousel-owl-loop"),
			smartSpeed: $carousel.data("bloglayouts-blog-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("bloglayouts-blog-carousel-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("bloglayouts-blog-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("bloglayouts-blog-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("bloglayouts-blog-carousel-owl-items")
				}
			}			
        });
    });		
	
});

var bloglayoutsCarouselHandler = function($scope, $) {
    $('.bloglayouts-bp-vc-element-carousel-blog').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("bloglayouts-blog-carousel-owl-pagination"),
			margin : $carousel.data("bloglayouts-blog-carousel-owl-margin"),
			nav : $carousel.data("bloglayouts-blog-carousel-owl-navigation"),
			rtl : $carousel.data("bloglayouts-blog-carousel-owl-rtl"),
			loop: $carousel.data("bloglayouts-blog-carousel-owl-loop"),
			smartSpeed: $carousel.data("bloglayouts-blog-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("bloglayouts-blog-carousel-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("bloglayouts-blog-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("bloglayouts-blog-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("bloglayouts-blog-carousel-owl-items")
				}
			}			
        });
    });			
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/blog-carousel-layouts.default",
		 bloglayoutsCarouselHandler
    );
});	