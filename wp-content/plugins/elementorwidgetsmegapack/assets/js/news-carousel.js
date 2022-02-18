jQuery(document).ready(function($){
	"use strict";
		
    $('.newslayouts-np-vc-element-carousel-news').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("newslayouts-news-carousel-owl-pagination"),
			margin : $carousel.data("newslayouts-news-carousel-owl-margin"),
			nav : $carousel.data("newslayouts-news-carousel-owl-navigation"),
			rtl : $carousel.data("newslayouts-news-carousel-owl-rtl"),
			loop: $carousel.data("newslayouts-news-carousel-owl-loop"),
			smartSpeed: $carousel.data("newslayouts-news-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("newslayouts-news-carousel-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("newslayouts-news-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("newslayouts-news-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("newslayouts-news-carousel-owl-items")
				}
			}			
        });
    });		
	
});

var newslayoutsCarouselHandler = function($scope, $) {
    $('.newslayouts-np-vc-element-carousel-news').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("newslayouts-news-carousel-owl-pagination"),
			margin : $carousel.data("newslayouts-news-carousel-owl-margin"),
			nav : $carousel.data("newslayouts-news-carousel-owl-navigation"),
			rtl : $carousel.data("newslayouts-news-carousel-owl-rtl"),
			loop: $carousel.data("newslayouts-news-carousel-owl-loop"),
			smartSpeed: $carousel.data("newslayouts-news-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("newslayouts-news-carousel-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("newslayouts-news-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("newslayouts-news-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("newslayouts-news-carousel-owl-items")
				}
			}			
        });
    });			
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/news-carousel-layouts.default",
		 newslayoutsCarouselHandler
    );
});	