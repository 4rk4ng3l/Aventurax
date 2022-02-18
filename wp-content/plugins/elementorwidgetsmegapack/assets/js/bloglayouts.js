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
		$('.bloglayouts-bp-load-more-'+ style +' .bloglayouts-bp-vc-element-blogs-article-container')
			.append('<div class="bloglayouts-bp-load-more-container bloglayouts-bp-placeholder-'+ pageNum +'-'+ style +'"></div><div class="clearfix"></div>')
			.append('<div id="bloglayouts-bp-load-blogs" class="bloglayouts-bp-load-blogs-'+ style +'"><a href="#" '+ cssLink +'>'+ readmore + '</a></div>');
	}
	
	$('.bloglayouts-bp-load-blogs-'+ style +' a').on( "click", function() {
		if(pageNum <= max) {		
			$(this).text(loading);			
			$('.bloglayouts-bp-placeholder-'+ pageNum +'-'+ style +'').load(nextLink + ' .bloglayouts-bp-item-load-more-'+ style +'',
				function() {
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
					$('.bloglayouts-bp-load-blogs-'+ style +'')
						.before('<div class="bloglayouts-bp-load-more-container bloglayouts-bp-placeholder-'+ pageNum +'-'+ style +'"></div><div class="clearfix"></div>')
					if(pageNum <= max) {
						$('.bloglayouts-bp-load-blogs-'+ style +' a').text(readmore);
					} else {
						$('.bloglayouts-bp-load-blogs-'+ style +' a').text(nomoreposts);
					}
				}
			);
		} else {
			$('.bloglayouts-bp-load-blogs-style1 a').append('.');
		}	
		
		return false;
	});
	
});