// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
    (function() {
        var noop = function() {};
        var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
        var length = methods.length;
        var console = window.console = {};
        while (length--) {
            console[methods[length]] = noop;
        }
    }());
}

// Place any jQuery/helper plugins in here.





/*-- Animate width to "auto" plugin (customized for use here)
from http://css-tricks.com/snippets/jquery/animate-heightwidth-to-auto/
--*/

jQuery.fn.animateAuto = function(prop, speed, leftCss, callback){
	var $t = jQuery.noConflict();
    var elem, height, width;
    return this.each(function(i, el){

	    if($t("html").hasClass("lt-ie8")){
			el = jQuery(el), elem = el.clone().css({"display":"inline","height":"auto","width":"auto"}).appendTo("body");
			
	    }else {
		    el = jQuery(el), elem = el.clone().css({"display":"inline-block","height":"auto","width":"auto"}).appendTo("body");
	    }
        
        
        height = elem.height(),
        width = elem.width()+37,
        widPos = parseInt(leftCss) - width;
 
        
        elem.remove();
        
        if(prop === "height")
            el.animate({"height":height}, speed, callback);
        else if(prop === "width")
            el.animate({"width":width}, speed, callback);
        else if(prop === "widthL")
            el.animate({"width":width,"left":widPos}, speed, callback); 
        else if(prop === "both")
            el.animate({"width":width,"height":height}, speed, callback);
    });  
}

