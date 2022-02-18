jQuery(function($){
	"use script";
	
	$(".calltoaction-custom-js").each(function( index ) {
		var custom_css = $(this).attr("data-calltoaction-custom-css");
		$( custom_css ).appendTo( "head" );
	});
	
});	

var calltoactionHandler = function($scope, $) {
	$(".calltoaction-custom-js").each(function( index ) {
		var custom_css = $(this).attr("data-calltoaction-custom-css");
		$( custom_css ).appendTo( "head" );
	});
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/calltoaction.default",
		 calltoactionHandler
    );
});	