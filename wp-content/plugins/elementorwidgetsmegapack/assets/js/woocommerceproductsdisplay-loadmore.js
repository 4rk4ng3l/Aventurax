jQuery(document).ready(function($) {
	"use strict"; 
	
	var pageNum = parseInt(fnwp_.startPage) + 1;
	var max = parseInt(fnwp_.maxPages);
	var nextLink = fnwp_.nextLink;
	var readmore = fnwp_.readtext;
	var loading = fnwp_.loading;
	var nomoreposts = fnwp_.nomoreposts;
	var cssLink = fnwp_.cssLink;
	var style = fnwp_.style;
	
	if(pageNum <= max) {
		$('.woocommerceproductsdisplay-bp-load-more-'+ style +' .woocommerceproductsdisplay-bp-vc-element-blogs-article-container')
			.append('<div class="woocommerceproductsdisplay-bp-load-more-container woocommerceproductsdisplay-bp-placeholder-'+ pageNum +'-'+ style +'"></div><div class="clearfix"></div>')
			.append('<div id="woocommerceproductsdisplay-bp-load-blogs" class="woocommerceproductsdisplay-bp-load-blogs-'+ style +'"><a href="#" '+ cssLink +'>'+ readmore + '</a></div>');
	}
	
	$('.woocommerceproductsdisplay-bp-load-blogs-'+ style +' a').on( "click", function() {
		if(pageNum <= max) {		
			$(this).text(loading);			
			$('.woocommerceproductsdisplay-bp-placeholder-'+ pageNum +'-'+ style +'').load(nextLink + ' .woocommerceproductsdisplay-bp-item-load-more-'+ style +'',
				function() {
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
					$('.woocommerceproductsdisplay-bp-load-blogs-'+ style +'')
						.before('<div class="woocommerceproductsdisplay-bp-load-more-container woocommerceproductsdisplay-bp-placeholder-'+ pageNum +'-'+ style +'"></div><div class="clearfix"></div>')
					if(pageNum <= max) {
						$('.woocommerceproductsdisplay-bp-load-blogs-'+ style +' a').text(readmore);
					} else {
						$('.woocommerceproductsdisplay-bp-load-blogs-'+ style +' a').text(nomoreposts);
					}
				}
			);
		} else {
			$('.woocommerceproductsdisplay-bp-load-blogs-'+ style +' a').append('.');
		}	
		
		return false;
	});
	
	
	$( document ).on( 'click', '.ajax_add_to_cart', function(e) {
		this.hide();
	});
	
	
	
	
});