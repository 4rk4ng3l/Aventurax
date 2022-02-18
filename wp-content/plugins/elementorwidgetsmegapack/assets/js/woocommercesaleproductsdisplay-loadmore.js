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
		$('.woocommercesaleproductsdisplay-bp-load-more-'+ style +' .woocommercesaleproductsdisplay-bp-vc-element-blogs-article-container')
			.append('<div class="woocommercesaleproductsdisplay-bp-load-more-container woocommercesaleproductsdisplay-bp-placeholder-'+ pageNum +'-'+ style +'"></div><div class="clearfix"></div>')
			.append('<div id="woocommercesaleproductsdisplay-bp-load-blogs" class="woocommercesaleproductsdisplay-bp-load-blogs-'+ style +'"><a href="#" '+ cssLink +'>'+ readmore + '</a></div>');
	}
	
	$('.woocommercesaleproductsdisplay-bp-load-blogs-'+ style +' a').on( "click", function() {
		if(pageNum <= max) {		
			$(this).text(loading);			
			$('.woocommercesaleproductsdisplay-bp-placeholder-'+ pageNum +'-'+ style +'').load(nextLink + ' .woocommercesaleproductsdisplay-bp-item-load-more-'+ style +'',
				function() {
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
					$('.woocommercesaleproductsdisplay-bp-load-blogs-'+ style +'')
						.before('<div class="woocommercesaleproductsdisplay-bp-load-more-container woocommercesaleproductsdisplay-bp-placeholder-'+ pageNum +'-'+ style +'"></div><div class="clearfix"></div>')
					if(pageNum <= max) {
						$('.woocommercesaleproductsdisplay-bp-load-blogs-'+ style +' a').text(readmore);
					} else {
						$('.woocommercesaleproductsdisplay-bp-load-blogs-'+ style +' a').text(nomoreposts);
					}
				}
			);
		} else {
			$('.woocommercesaleproductsdisplay-bp-load-blogs-'+ style +' a').append('.');
		}	
		
		return false;
	});
	
	
	$( document ).on( 'click', '.ajax_add_to_cart', function(e) {
		this.hide();
	});
	
	
	
	
});