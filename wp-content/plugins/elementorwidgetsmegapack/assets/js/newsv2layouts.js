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
		$('.newslayouts-np-v2-load-more-news-'+ style +' .newslayouts-np-v2-vc-element-news-article-container')
			.append('<div class="newslayouts-np-v2-load-more-container newslayouts-np-v2-placeholder-'+ pageNum +'-'+ style +'"></div><div class="clearfix"></div>')
			.append('<div id="newslayouts-np-v2-load-news" class="newslayouts-np-v2-load-news-'+ style +'"><a href="#" '+ cssLink +'>'+ readmore + '</a></div>');
	}
	
	$('.newslayouts-np-v2-load-news-'+ style +' a').on( "click", function() {
		if(pageNum <= max) {		
			$(this).text(loading);			
			$('.newslayouts-np-v2-placeholder-'+ pageNum +'-'+ style +'').load(nextLink + ' .newslayouts-np-v2-item-load-more-'+ style +'',
				function() {
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
					$('.newslayouts-np-v2-load-news-'+ style +'')
						.before('<div class="newslayouts-np-v2-load-more-container newslayouts-np-v2-placeholder-'+ pageNum +'-'+ style +'"></div><div class="clearfix"></div>')
					if(pageNum <= max) {
						$('.newslayouts-np-v2-load-news-'+ style +' a').text(readmore);
					} else {
						$('.newslayouts-np-v2-load-news-'+ style +' a').text(nomoreposts);
					}
				}
			);
		} else {
			$('.newslayouts-np-v2-load-news-'+ style +' a').append('.');
		}	
		
		return false;
	});
	
});