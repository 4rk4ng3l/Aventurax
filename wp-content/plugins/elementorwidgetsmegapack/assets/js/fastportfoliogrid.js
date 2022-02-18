jQuery(document).ready(function($) {
	"use strict"; 

    $('.fpg-filter-on').each( function() {
        var $filter = $(this);
        $filter.mixitup({
				targetSelector: '.fpg-grid-item',
				filterSelector: '.filter',
				sortSelector: '.sort',
				buttonEvent: 'click',
				effects: ['fade','scale','rotateX','rotateY','rotateZ'],
				listEffects: null,
				easing: 'smooth',
				layoutMode: 'grid',
				targetDisplayGrid: 'inline-block',
				targetDisplayList: 'block',
				gridClass: '',
				listClass: '',
				transitionSpeed: 600,
				showOnLoad: 'all',
				sortOnLoad: false,
				multiFilter: false,
				filterLogic: 'or',
				resizeContainer: true,
				minHeight: 0,
				failClass: 'fail',
				perspectiveDistance: '3000',
				perspectiveOrigin: '50% 50%',
				animateGridList: true,
				onMixLoad: null,
				onMixStart: null,
				onMixEnd: null
        });
    });


    $('.fpg-type-grid').each( function() {
        var $mp = $(this);
        $mp.magnificPopup({
			delegate: '.fpg-zoom-image',
		 	type: 'image',
		  	gallery:{
				enabled:true
  			}
        });
    });

	$('.wpfpg_masonry').each( function() {
		var $container = $(this).masonry({
			columnWidth: 1
		});
		$container.imagesLoaded( function() {
			$container.masonry();
		});		
	});	
	
});

var fpgPortfolioHandler = function($scope, $) {
    $('.fpg-filter-on').each( function() {
        var $filter = $(this);
        $filter.mixitup({
				targetSelector: '.fpg-grid-item',
				filterSelector: '.filter',
				sortSelector: '.sort',
				buttonEvent: 'click',
				effects: ['fade','scale','rotateX','rotateY','rotateZ'],
				listEffects: null,
				easing: 'smooth',
				layoutMode: 'grid',
				targetDisplayGrid: 'inline-block',
				targetDisplayList: 'block',
				gridClass: '',
				listClass: '',
				transitionSpeed: 600,
				showOnLoad: 'all',
				sortOnLoad: false,
				multiFilter: false,
				filterLogic: 'or',
				resizeContainer: true,
				minHeight: 0,
				failClass: 'fail',
				perspectiveDistance: '3000',
				perspectiveOrigin: '50% 50%',
				animateGridList: true,
				onMixLoad: null,
				onMixStart: null,
				onMixEnd: null
        });
    });	
    $('.fpg-type-grid').each( function() {
        var $mp = $(this);
        $mp.magnificPopup({
			delegate: '.fpg-zoom-image',
		 	type: 'image',
		  	gallery:{
				enabled:true
  			}
        });
    });	
	$('.wpfpg_masonry').each( function() {
		var $container = $(this).masonry({
			columnWidth: 1
		});
		$container.imagesLoaded( function() {
			$container.masonry();
		});		
	});		
};	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/fpg-portfolio.default",
		 fpgPortfolioHandler
    );
});	

jQuery(window).on("elementor/frontend/init", function() {
	"use strict";
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/fpg-grid.default",
		 fpgPortfolioHandler
    );
});	