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