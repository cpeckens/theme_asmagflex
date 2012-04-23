//Contains tabs.js, comment-reply.js, flyoutscroll.js


//*************************Comment Reply**************************//
addComment={moveForm:function(d,f,i,c){var m=this,a,h=m.I(d),b=m.I(i),l=m.I("cancel-comment-reply-link"),j=m.I("comment_parent"),k=m.I("comment_post_ID");if(!h||!b||!l||!j){return}m.respondId=i;c=c||false;if(!m.I("wp-temp-form-div")){a=document.createElement("div");a.id="wp-temp-form-div";a.style.display="none";b.parentNode.insertBefore(a,b)}h.parentNode.insertBefore(b,h.nextSibling);if(k&&c){k.value=c}j.value=f;l.style.display="";l.onclick=function(){var n=addComment,e=n.I("wp-temp-form-div"),o=n.I(n.respondId);if(!e||!o){return}n.I("comment_parent").value="0";e.parentNode.insertBefore(o,e);e.parentNode.removeChild(e);this.style.display="none";this.onclick=null;return false};try{m.I("comment").focus()}catch(g){}return false},I:function(a){return document.getElementById(a)}};

  

//*************************Table of Contents Dropdown**************************//

//Figure out height of user's window
 var $t = jQuery.noConflict();
 var viewportwidth = window.innerWidth;
 var maxHeight = window.innerHeight;
 
$t(function(){

    $t(".dropdown").hover(function() {

         var $container = $t(this),
             $list = $container.find("ul"),
             $anchor = $container.find(".toc"),
             height = $list.height();       // make sure there is enough room at the bottom

        // need to save height here so it can revert on mouseout
        $container.data("origHeight", $container.height());

        // so it can retain it's rollover color all the while the dropdown is open
        $anchor.addClass("hover");

        // make sure dropdown appears directly below parent list item
        $list
            .show()
            .css({
                paddingTop: $container.data("origHeight"),
                height: maxHeight
            });
		$container
                .css({
                    height: maxHeight,
                    overflow: "hidden"
                });
$t('ul.menu_options').scrollbar();
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

//*************************Tabs**************************//

var $j = jQuery.noConflict();

$j(document).ready(function() {

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

//*************************Read More/Read **************************//
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