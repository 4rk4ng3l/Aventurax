jQuery(document).ready(function($){
	"use strict";

	$('.fg-gallery-caption').on('mouseover mouseout', function(event) {
			if (event.type == 'mouseover') {
				$(this).parents('.teamvision-gallery-icon').find('.fg_zoom').addClass('fg_over');
				return false;
			} else {
				$(this).parents('.teamvision-gallery-icon').find('.fg_zoom').removeClass('fg_over');
				return false;				
			}
			
	});
		
    $('.teamvision-team-owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("teamvision-carousel-owl-pagination"),
			margin : $carousel.data("teamvision-carousel-owl-margin"),
			nav : $carousel.data("teamvision-carousel-owl-navigation"),
			rtl : $carousel.data("teamvision-carousel-owl-rtl"),
			loop: $carousel.data("teamvision-carousel-owl-loop"),
			smartSpeed: $carousel.data("teamvision-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("teamvision-carousel-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("teamvision-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("teamvision-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("teamvision-carousel-owl-items")
				}
			}			
        });
    });		
	
});		


var teamvisionCarouselStyle1Handler = function($scope, $) {
    $('.teamvision-team-owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("teamvision-carousel-owl-pagination"),
			margin : $carousel.data("teamvision-carousel-owl-margin"),
			nav : $carousel.data("teamvision-carousel-owl-navigation"),
			rtl : $carousel.data("teamvision-carousel-owl-rtl"),
			loop: $carousel.data("teamvision-carousel-owl-loop"),
			smartSpeed: $carousel.data("teamvision-carousel-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("teamvision-carousel-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("teamvision-carousel-owl-items-600")
				},
				600:{
					items: $carousel.data("teamvision-carousel-owl-items-900")
				},
				1000:{
					items: $carousel.data("teamvision-carousel-owl-items")
				}
			}			
        });
    });			
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/team-vision-carousel-style1.default",
		 teamvisionCarouselStyle1Handler
    );
});			