// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

jQuery(document).ready(function() {

	/*********************************
    **  Main Menu minimization
    ********************************/
	function calcWidth() {
		var navwidth = 0;
		var morewidth = jQuery('ul.main_menu .more').outerWidth(true);
		jQuery('ul.main_menu > li:not(.more)').each(function() {
			navwidth += jQuery(this).outerWidth( true );
		});
		
		//var availablespace = jQuery('nav').outerWidth(true) - morewidth;
		var availablespace = jQuery('#main_nav_wrap').width() - morewidth;
	  
		if (navwidth > availablespace) {
			var lastItem = jQuery('ul.main_menu > li:not(.more)').last();
			lastItem.attr('data-width', lastItem.outerWidth(true));
			lastItem.prependTo(jQuery('ul.main_menu .more > ul'));
			calcWidth();
		} else {
			
		var firstMoreElement = jQuery('ul.main_menu li.more li').first();
		if (navwidth + firstMoreElement.data('width') < availablespace) {
			firstMoreElement.insertBefore(jQuery('ul.main_menu .more'));
		}
	}
	  
	if (jQuery('.more li').length > 0) {
		jQuery('.more').css('display','inline-block');
		} else {
			jQuery('.more').css('display','none');
		}
	}

	jQuery(window).on('resize load',function(){
		calcWidth();
	});
    
    
    /***********************************
    * jQuery News ticker
    * liScroll 1.0
    ***********************************/

    jQuery.fn.liScroll = function(settings) {
        settings = jQuery.extend({
        travelocity: 0.07
        }, settings);		
        return this.each(function(){
                var $strip = jQuery(this);
                $strip.addClass("newsticker")
                var stripWidth = 1;
                $strip.find("li").each(function(i){
                stripWidth += jQuery(this, i).outerWidth(true); // thanks to Michael Haszprunar and Fabien Volpi
                });
                var $mask = $strip.wrap("<div class='mask'></div>");
                var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
                var containerWidth = $strip.parent().parent().width();	//a.k.a. 'mask' width 	
                $strip.width(stripWidth);			
                var totalTravel = stripWidth+containerWidth;
                var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
                function scrollnews(spazio, tempo){
                $strip.animate({left: '-='+ spazio}, tempo, "linear", function(){$strip.css("left", containerWidth); scrollnews(totalTravel, defTiming);});
                }
                scrollnews(totalTravel, defTiming);				
                $strip.hover(function(){
                jQuery(this).stop();
                },
                function(){
                var offset = jQuery(this).offset();
                var residualSpace = offset.left + stripWidth;
                var residualTime = residualSpace/settings.travelocity;
                scrollnews(residualSpace, residualTime);
                });			
        });	
    };
    
    
    
    
    
});