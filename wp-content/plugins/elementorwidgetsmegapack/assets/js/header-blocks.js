jQuery(document).ready(function($){
	"use strict";
		
    $('.headerblocks-owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("headerblocks-owl-pagination"),
			margin : $carousel.data("headerblocks-owl-margin"),
			nav : $carousel.data("headerblocks-owl-navigation"),
			rtl : $carousel.data("headerblocks-owl-rtl"),
			loop: $carousel.data("headerblocks-owl-loop"),
			smartSpeed: $carousel.data("headerblocks-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("headerblocks-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("headerblocks-owl-items-600")
				},
				600:{
					items: $carousel.data("headerblocks-owl-items-900")
				},
				1000:{
					items: $carousel.data("headerblocks-owl-items")
				}
			}			
        });
    });		
	
});

var headerblocksCarouselHandler = function($scope, $) {
    $('.headerblocks-owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("headerblocks-owl-pagination"),
			margin : $carousel.data("headerblocks-owl-margin"),
			nav : $carousel.data("headerblocks-owl-navigation"),
			rtl : $carousel.data("headerblocks-owl-rtl"),
			loop: $carousel.data("headerblocks-owl-loop"),
			smartSpeed: $carousel.data("headerblocks-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("headerblocks-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("headerblocks-owl-items-600")
				},
				600:{
					items: $carousel.data("headerblocks-owl-items-900")
				},
				1000:{
					items: $carousel.data("headerblocks-owl-items")
				}
			}			
        });
    });			
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/header-blocks.default",
		 headerblocksCarouselHandler
    );
});	