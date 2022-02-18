/*
 * Logo Showcase for Elementor
 */
 
 jQuery(document).ready(function($){
	"use strict"; 
	$(".logo-showcase-elementor-custom-js").each(function( index ) {
		var custom_css = $(this).attr("data-logo-showcase-elementor-custom-css");
		$( custom_css ).appendTo( "head" );
	});

    $('.logo-showcase-elementor-logo-owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("logo-showcase-elementor-logo-owl-pagination"),
			margin : $carousel.data("logo-showcase-elementor-logo-owl-margin"),
			nav : $carousel.data("logo-showcase-elementor-logo-owl-navigation"),
			rtl : $carousel.data("logo-showcase-elementor-logo-owl-rtl"),
			loop: $carousel.data("logo-showcase-elementor-logo-owl-loop"),
			smartSpeed: $carousel.data("logo-showcase-elementor-logo-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("logo-showcase-elementor-logo-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("logo-showcase-elementor-logo-owl-items-600")
				},
				600:{
					items: $carousel.data("logo-showcase-elementor-logo-owl-items-900")
				},
				1000:{
					items: $carousel.data("logo-showcase-elementor-logo-owl-items")
				}
			}			
        });
    });	

 });
 
 var LogoShowcaseHandler = function($scope, $) {
	$(".logo-showcase-elementor-custom-js").each(function( index ) {
		var custom_css = $(this).attr("data-logo-showcase-elementor-custom-css");
		$( custom_css ).appendTo( "head" );
	});

    $('.logo-showcase-elementor-logo-owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
			dots : $carousel.data("logo-showcase-elementor-logo-owl-pagination"),
			margin : $carousel.data("logo-showcase-elementor-logo-owl-margin"),
			nav : $carousel.data("logo-showcase-elementor-logo-owl-navigation"),
			rtl : $carousel.data("logo-showcase-elementor-logo-owl-rtl"),
			loop: $carousel.data("logo-showcase-elementor-logo-owl-loop"),
			smartSpeed: $carousel.data("logo-showcase-elementor-logo-owl-smart-speed"),
			autoplay : true,
			autoplayTimeout : $carousel.data("logo-showcase-elementor-logo-owl-autoplay"),
			navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items: $carousel.data("logo-showcase-elementor-logo-owl-items-600")
				},
				600:{
					items: $carousel.data("logo-showcase-elementor-logo-owl-items-900")
				},
				1000:{
					items: $carousel.data("logo-showcase-elementor-logo-owl-items")
				}
			}			
        });
    });
};	
 
 jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/logo-showcase.default",
		 LogoShowcaseHandler
    );
});	