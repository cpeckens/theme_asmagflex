//*************************Table of Contents Dropdown**************************//

//Figure out height of user's window
 var $t = jQuery.noConflict();
 var viewportwidth = window.innerWidth;
 var maxHeight = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    maxHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    maxHeight = document.documentElement.clientHeight;
    }
    
$t(function(){

    $t(".dropdown").mouseover(function() {

         var $container = $t(this),
             $list = $container.find("ul"),
             $anchor = $container.find(".toc"),
             height = maxHeight;       // make sure there is enough room at the bottom

        // need to save height here so it can revert on mouseout
        $container.data("origHeight", $container.height());

        // so it can retain it's rollover color all the while the dropdown is open
/*         $anchor.addClass("hover"); */

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
    }), 

$t(".dropdown").mouseout(function() {

        var $el = $t(this);

        // put things back to normal
        $el
            .height('30')
            .find("ul")
            .hide()
            .end()
            .find("a")
            .removeClass("hover");
    });
   });