/*
* All non jQuery activations
*/
var $ = jQuery.noConflict();

//google translator 
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'newsflow_google_translate');
}

/*=====================================
*********** Proloader script ***********
======================================*/
jQuery(window).load(function() {
 // executes when complete page is fully loaded, including all frames, objects and images
    $("div#preloader").fadeOut('slow',function(){$(this).remove();});
});


/*
* all jQuery activations
*/
jQuery(document).ready(function(){
    //active newsticker   
    jQuery("#news_tickers ul").liScroll();

    //scroll to top 
    $(window).scroll(function(){
		if ($(this).scrollTop() > 200) {
			$('#scscrollto-top').fadeIn();
		} else {
			$('#scscrollto-top').fadeOut();
		}
	});
    //Click event to scroll to top
	$('#scscrollto-top').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
    
    
    
    
});
