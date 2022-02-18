jQuery(document).ready(function($){
	"use strict";
		
    $('.fpg-type-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("fpg-carousel-owl-pagination"),
			margin : $carousel.data("fpg-carousel-owl-margin"),
			nav : $carousel.data("fpg-carousel-owl-navigation"),
			rtl : $carousel.data("fpg-carousel-owl-rtl"),
			loop: $carousel.data("fpg-carousel-owl-loop"),
			smartSpeed: $carousel.data("fpg-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("fpg-carousel-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("fpg-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("fpg-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("fpg-carousel-owl-items")
				}
			}			
        });
    });		
	
});

var fpgCarouselHandler = function($scope, $) {
    $('.fpg-type-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("fpg-carousel-owl-pagination"),
			margin : $carousel.data("fpg-carousel-owl-margin"),
			nav : $carousel.data("fpg-carousel-owl-navigation"),
			rtl : $carousel.data("fpg-carousel-owl-rtl"),
			loop: $carousel.data("fpg-carousel-owl-loop"),
			smartSpeed: $carousel.data("fpg-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("fpg-carousel-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("fpg-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("fpg-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("fpg-carousel-owl-items")
				}
			}			
        });
    });			
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/fpg-carousel.default",
		 fpgCarouselHandler
    );
});	