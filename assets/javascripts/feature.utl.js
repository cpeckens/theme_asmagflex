 jQuery(document).ready(function($) {
 	//Set Variables
  	$view = $( window ).height();
  	if ($view < 630 ) { 
	  	$(".utl-container").empty();
		$(".utl-container").load("../../wp-content/themes/asmagflex/parts/utl-print.html");
		$("#nav-container").addClass("hide");
  	}
  	if ($view > 993 ) { $height = 673; } else {$height = $view - 320;}
  	$scroll_max = $height - 50;
  	$scroll_min = $height - 49;
  	$("section").height($height);
  	$("#nav-container").css({top: $height + 80 + "px"});
  	//Reset Variables if window is resized
	$(window).on('resize', function(){
		$view = $( window ).height();
	  	if ($view > 993 ) { $height = 673; } else {$height = $view - 320;}
	  	$scroll_max = $height - 12;
	  	$scroll_min = $height - 11;
	  	$("section").height($height);
	  	$("#nav-container").css({top: $height + 80 + "px"});
	});  	
		$two_link = ($scroll_min) + 20 + "px";
		$three_link = (2 * $scroll_min) + 30 + "px";
		$four_link = (3 * $scroll_min) + 40 + "px";
		$five_link = (4 * $scroll_min) + 50 + "px";
		$six_link = (5 * $scroll_min) + 60 + "px";
		$seven_link = (6 * $scroll_min) + 70 + "px";
		
  				$('#nav-one h3').click(function() {
	  				$( window ).scrollTo(0,800); });
  				$('#nav-two h3').click(function() {
	  				$( window ).scrollTo($two_link,800).stop();
	  				 });
  				$('#nav-three h3').click(function() {
	  				$( window ).scrollTo($three_link,800).stop();
	  				 });
  				$('#nav-four h3').click(function() {
	  				$( window ).scrollTo($four_link,800).stop();
	  				 });
  				$('#nav-five h3').click(function() {
	  				$( window ).scrollTo($five_link,800).stop();
	  				 });
  				$('#nav-six h3').click(function() {
	  				$( window ).scrollTo($six_link,800).stop();
	  				 });
  				$('#nav-seven h3').click(function() {
	  				$( window ).scrollTo($seven_link,800).stop();
	  				 });
        		$('#compass').scrollspy({
        				min: 0,
        				max: $scroll_max,
        				onEnter: function(element, position) {
    						$("#nav-container").removeClass();
    						$("#nav-two").removeClass('fixed');
    						$("#nav-three").removeClass('fixed');
    						$("#nav-four").removeClass('fixed');
    						$("#nav-five").removeClass('fixed');
    						$("#nav-six").removeClass('fixed');
    						$("#nav-seven").removeClass('fixed');
    					}
        			});        		
        		$('#compass').scrollspy({
        				min: $scroll_min,
        				max: 2 * $scroll_max,
        				onEnter: function(element, position) {
    						$("#nav-three").removeClass('fixed');
    						$("#nav-four").removeClass('fixed');
    						$("#nav-five").removeClass('fixed');
    						$("#nav-six").removeClass('fixed');
    						$("#nav-seven").removeClass('fixed');
    						$("#nav-container").removeClass();
    						$("#nav-two").addClass('fixed');
    						$("#nav-container").addClass('top-two');
							$("#nav-container.top-two").css({top: $height + 80 + "px"});
    					}
        			});
        		$('#compass').scrollspy({
        				min: 2 * $scroll_min,
        				max: 3 * $scroll_max,
        				onEnter: function(element, position) {
    						$("#nav-four").removeClass('fixed');
    						$("#nav-five").removeClass('fixed');
    						$("#nav-six").removeClass('fixed');
    						$("#nav-seven").removeClass('fixed');
    						$("#nav-container").removeClass();
    						$("#nav-three").addClass('fixed');
    						$("#nav-container").addClass('top-three');
							$("#nav-container.top-three").css({top: $height + 120 + "px"});
    					}
        			});
        		$('#compass').scrollspy({
        				min: 3 * $scroll_min,
        				max: 4 * $scroll_max,
        				onEnter: function(element, position) {
    						$("#nav-five").removeClass('fixed');
    						$("#nav-six").removeClass('fixed');
    						$("#nav-seven").removeClass('fixed');
    						$("#nav-container").removeClass();
    						$("#nav-four").addClass('fixed');
    						$("#nav-container").addClass('top-four');
							$("#nav-container.top-four").css({top: $height + 160 + "px"});
    					}
        			});
        		$('#compass').scrollspy({
        				min: 4 * $scroll_min,
        				max: 5 * $scroll_max,
        				onEnter: function(element, position) {
    						$("#nav-six").removeClass('fixed');
    						$("#nav-seven").removeClass('fixed');
    						$("#nav-container").removeClass();
    						$("#nav-five").addClass('fixed');
    						$("#nav-container").addClass('top-five');
							$("#nav-container.top-five").css({top: $height + 200 + "px"});
    					}
    					
        			});
        		$('#compass').scrollspy({
        				min: 5 * $scroll_min,
        				max: 6 * $scroll_max,
        				onEnter: function(element, position) {
    						$("#nav-seven").removeClass('fixed');
    						$("#nav-container").removeClass();
    						$("#nav-six").addClass('fixed');
    						$("#nav-container").addClass('top-six');
							$("#nav-container.top-six").css({top: $height + 240 + "px"});
    					}
        			});
        		$('#compass').scrollspy({
        				min: 6 * $scroll_min,
        				max: 8000,
        				onEnter: function(element, position) {
    						$("#nav-container").removeClass();
    						$("#nav-seven").addClass('fixed');
    						$("#nav-container").addClass('top-seven');
							$("#nav-container.top-seven").css({top: $height + 280 + "px"});
    					},
        			});        		
        		});