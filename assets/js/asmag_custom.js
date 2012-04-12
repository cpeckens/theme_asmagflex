//Contains tabs.js, comment-reply.js, flyoutscroll.js

addComment={moveForm:function(d,f,i,c){var m=this,a,h=m.I(d),b=m.I(i),l=m.I("cancel-comment-reply-link"),j=m.I("comment_parent"),k=m.I("comment_post_ID");if(!h||!b||!l||!j){return}m.respondId=i;c=c||false;if(!m.I("wp-temp-form-div")){a=document.createElement("div");a.id="wp-temp-form-div";a.style.display="none";b.parentNode.insertBefore(a,b)}h.parentNode.insertBefore(b,h.nextSibling);if(k&&c){k.value=c}j.value=f;l.style.display="";l.onclick=function(){var n=addComment,e=n.I("wp-temp-form-div"),o=n.I(n.respondId);if(!e||!o){return}n.I("comment_parent").value="0";e.parentNode.insertBefore(o,e);e.parentNode.removeChild(e);this.style.display="none";this.onclick=null;return false};try{m.I("comment").focus()}catch(g){}return false},I:function(a){return document.getElementById(a)}};
 var $t = jQuery.noConflict();
 var viewportwidth = window.innerWidth;
 var maxHeight = window.innerHeight;
  


$t(function(){

    $t(".dropdown").hover(function() {

         var $container = $t(this),
             $list = $container.find("ul"),
             $anchor = $container.find(".toc"),
             height = $list.height() * 1.1,       // make sure there is enough room at the bottom
             multiplier = height / maxHeight;     // needs to move faster if list is taller

        // need to save height here so it can revert on mouseout
        $container.data("origHeight", $container.height());

        // so it can retain it's rollover color all the while the dropdown is open
        $anchor.addClass("hover");

        // make sure dropdown appears directly below parent list item
        $list
            .show()
            .css({
                paddingTop: $container.data("origHeight")
            });

        // don't do any animation if list shorter than max
        if (multiplier > 1) {
            $container
                .css({
                    height: maxHeight,
                    overflow: "hidden"
                })
                .mouseover(function(e) {
                    var offset = $container.offset();
                    var relativeY = ((e.pageY - offset.top) * multiplier) - ($container.data("origHeight") * multiplier);
                    if (relativeY > $container.data("origHeight")) {
                        $list.css("top", -relativeY + $container.data("origHeight"));
                    };
                });
        }

    }, function() {

        var $el = $t(this);

        // put things back to normal
        $el
            .height($t(this).data("origHeight"))
            .find("ul")
            .css({ top: 0 })
            .hide()
            .end()
            .find("a")
            .removeClass("hover");

    });

});

/*
* Skeleton V1.1
* Copyright 2011, Dave Gamache
* www.getskeleton.com
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
* 8/17/2011
*/
var $j = jQuery.noConflict();

$j(document).ready(function() {

	/* Tabs Activiation
	================================================== */

	var tabs = $j('ul.tabs');

	tabs.each(function(i) {

		//Get all tabs
		var tab = $j(this).find('> li > a');
		tab.click(function(e) {

			//Get Location of tab's content
			var contentLocation = $j(this).attr('href');

			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {

				e.preventDefault();

				//Make Tab Active
				tab.removeClass('active');
				$j(this).addClass('active');

				//Show Tab Content & add active class
				$j(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

			}
		});
	});
});
$j(document).ready(function() {
					$j(".wysiwyg-read-more-link").toggle(function() {
					$j(this).text("Read Less").stop();
					$j(this).css({'background-position' : '0px -17px'});
					$j(this).parents(".wysiwyg-more-less").find(".wysiwyg-more-less-toggle").show();
				}, function() {
					$j(this).text("Read More").stop();
					$j(this).css({'background-position' : '0px 3px'});
					$j(this).parents(".wysiwyg-more-less").find(".wysiwyg-more-less-toggle").hide();
				});

});