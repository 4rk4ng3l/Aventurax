jQuery(function($){
	"use script";

	$( document ).on( 'click', '.ajax_add_to_cart', function(e) {
		$( this ).append('<i class="fa fa-spinner animated rotateIn infinite"></i>');
	});
	
	$(".woocommerceaddtocartbutton-custom-js").each(function( index ) {
		var custom_css = $(this).attr("data-woocommerceaddtocartbutton-custom-css");
		$( custom_css ).appendTo( "head" );
	});
	
});	

var woocommerceaddtocartbuttonHandler = function($scope, $) {
	$(".woocommerceaddtocartbutton-custom-js").each(function( index ) {
		var custom_css = $(this).attr("data-woocommerceaddtocartbutton-custom-css");
		$( custom_css ).appendTo( "head" );
	});
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/woocommerceaddtocartbutton.default",
		 woocommerceaddtocartbuttonHandler
    );
});	