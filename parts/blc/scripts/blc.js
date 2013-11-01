jQuery(document).ready(function($) {


	// Clicking anything with a href of "#"
	$('a[href$="#"]').on("click", function(e){
		e.preventDefault();
	});
	
	// Click Explore button on Welcome screen
	$("#explore").on("click", function(){
		$("#welcome").fadeOut();
		$("#maps, #maps .active").fadeIn();
		makePins();
		return false;
	});

	// Make and position the pins
	function makePins(){
			
		$(".points .point").each(function(index, domEle){
			$(this).html("<div class='info'><img src='/magazine/wp-content/themes/asmagflex/parts/blc/marker.png'></div>");
		});
			
			if( $(this).data("x") > 1100 ) {
				$(this).addClass("left");
			}
		
		dropPins();
	}
	
	// Drop the pins
	function dropPins() {
		$(".points .point").each(function(index, domEle){
			$(this).css({top: "-50px", left: $(this).data('x') });
			$(this).delay(index*100).animate({
		   		top: $(this).data('y')
			}, 1200, 'easeOutBounce');
		});		
	}

	// Hovering over the pins
	var config = {    
	     over: function(){
	     	if ($(this).hasClass("left")){
				$(this).after("<div class='desc left' style='z-index: 16; left: " + $(this).data('x') + 140 +"px; top: " + $(this).data('y') +"px;'><div class='text'>" + $(this).data('desc') + "</div></div>");
	     	}else {
		 		$(this).after("<div class='desc' style='z-index: 16; left: " + $(this).data('x') +"px; top: " + $(this).data('y') +"px;'><div class='text'>" + $(this).data('desc') + "</div></div>");
	     	}
		 	$(this).css("z-index", "17");
		 	
		 	var thisLeft = $(this).css("left");
		 	
		 	if( $(this).hasClass("left")) {
				 	$(".points .desc").animateAuto("widthL", 500, thisLeft); 
		 	}else {
			 	$(".points .desc").animateAuto("width", 500, thisLeft); 
			}
	     },
	    
	     timeout: 0, // number = milliseconds delay before onMouseOut    
	     
	     out: function(){
		     $(this).siblings(".desc").remove();
		     $(this).css("z-index", "10");
	     }  
	};
	$(".point").hoverIntent(config);	
	
	var configInfo = {    
	     over: function(){
	     	$(this).css("z-index", "20");
	     	$(this).after("<div class='descInfo' style='z-index: 15; left: " + ($(this).data('x')-345) +"px; top: " + ($(this).data('y')-132) +"px;'>" +
	     		"<div class='image' style='background-position: -" + $(this).data('imgx') + "px -" + $(this).data('imgy') +"px'></div>" +
	     		"<div class='title'>" + $(this).data('title') + "</div>" +
	     		"<div class='descr'>" + $(this).data('desc') + "</div>" +
	     	"</div>");
	     },
	    
	     timeout: 100, // number = milliseconds delay before onMouseOut    
	     
	     out: function(){
	     $(this).css("z-index", "15");
		     $(".descInfo").remove();
	     }  
	};
	$(".infoPoint").hoverIntent(configInfo);


	var descHeight = 0;
	
	
	function getDecimal(num) {
	    return parseFloat(num.toString().split(".")[1]);
	}
	
	
	// Clicking a point
	$(".point").on("click", function(){
		var clicked = $(this).data("source");
		var percent = $("#datas #"+clicked).find(".fill").data("percent");
		var cost = $("#datas #"+clicked).find(".countUp").data("countto");
		$("#datas #"+clicked).modal({ 
			onShow: 
				function(dialog){
				
					// Hides the "current" div
					$(".current", dialog.data).hide();
					dialog.data.find(".description").height("auto");
				
					// Filling the Progress Bar
					$(".fill, dialog.data").width("0").animate({width: percent}, 2000, function(){
										  // percent bar's width  - width of the text "as of..." / 2   + margin
						var currentLeft = Math.round(percent + parseInt($("#simplemodal-container .progress").css("marginLeft")));
						$("#simplemodal-container .current").css("left", currentLeft);
						$(".current, dialog.data").fadeIn("500");				
					});
					
					// Counting the Cost
					
					var counting = dialog.data.find(".countUp");
					var theNum = counting.data("countto");
					var theDecimal = getDecimal(theNum);
					
					if(theDecimal > 9) {
						numDecimals = 2;
					}else if (theDecimal > 0){
						numDecimals = 1;
					}else {
						numDecimals = 0;
					}
										
					counting.countTo({
			            from: 0,
			            to: cost,
			            decimals: numDecimals,
			            speed: 2000,
			            refreshInterval: 50
			        });
			        
			        dialog.data.find(".description").height("auto");
			        // Gets the description height for restoring later
			        descHeight = dialog.data.find(".description").height();
			        		
			        resizeStuff();

			}, onClose:
				function(dialog){
					dialog.container.fadeOut(500, function () {
						closeDoors();
						$(".current", dialog.data).hide();
						$(".fill, dialog.data").stop();
						dialog.data.find(".description").height();
						$.modal.close();
					});
					resizeStuff();
				}
		});


		
	
	});
	
	// Back to Description Click
	$(".goBack, dialog.data").on("click", closeDoors);
	
	function closeDoors(){
		$(".banner, dialog.data").animate({marginTop: "0px"}, 500);
		$(".videoBox, dialog.data").animate({height: "0px"}, 500);
		$("#simplemodal-container").animate({height: "770px"}, 500);
		
		$(".data > .location, dialog.data").animate({height: "110px"}, 500);
		$(".data > .description, dialog.data").animate({height: descHeight}, 500);
		$(".data > .timeline, dialog.data").animate({height: "175px"}, 500);
		
		$("img.video, dialog.data").fadeIn();
	}
	
	
	// Switching maps via the legend
	$("#legend li").on("click", function(){
		$("#legend li").removeClass("active");
		$(this).addClass("active");
		
		var clicked = $(this).data("campus");	
		$("#maps .actamap:not('."+clicked+"')").fadeOut().removeClass("active");
		$("#maps .actamap."+clicked).fadeIn();
		
		$(".points .point").stop();
		$(".info-points .infoPoint").stop();
		
		dropPins();
	});
	
	// Lengend Instructions and Comments Modals
	$("#legend .instructions").on("click", function(){
		$("#instructions").modal();
		
		var winHeight = $(window).height() - $("#menu").height();
        var modHeight = $("#simplemodal-container").height();
        
        if(winHeight <= modHeight) {
	        $("#maps .actamap").height((modHeight+60)+"px");

	        $("#simplemodal-container").addClass("smaller");

	        
	        $('html, body').animate({scrollTop:100}, 'slow');
	        
        }else {
	        $("#simplemodal-container").addClass("larger");
        }

		
		
	});
	
	$("#legend .comments").on("click", function(){
		$("#comments").modal();
		
		var winHeight = $(window).height() - $("#menu").height();
        var modHeight = $("#simplemodal-container").height();
        
        if(winHeight <= modHeight) {
	        $("#maps .actamap").height((modHeight+60)+"px");

	        $("#simplemodal-container").addClass("smaller");

	        
	        $('html, body').animate({scrollTop:100}, 'slow');
	        
        }else {
	        $("#simplemodal-container").addClass("larger");
        }

		
		
	});	
		$("#vision .video").on("click", function(){
		$("#video").modal();
		
		var winHeight = $(window).height() - $("#menu").height();
        var modHeight = $("#simplemodal-container").height();
        
        if(winHeight <= modHeight) {
	        $("#maps .actamap").height((modHeight+60)+"px");

	        $("#simplemodal-container").addClass("smaller");

	        
	        $('html, body').animate({scrollTop:100}, 'slow');
	        
        }else {
	        $("#simplemodal-container").addClass("larger");
        }

		
		
	});	
	
		$("#legend .arch").on("click", function(){
		$("#arch").modal();
		
		var winHeight = $(window).height() - $("#menu").height();
        var modHeight = $("#simplemodal-container").height();
        
        if(winHeight <= modHeight) {
	        $("#maps .actamap").height((modHeight+60)+"px");

	        $("#simplemodal-container").addClass("smaller");

	        
	        $('html, body').animate({scrollTop:100}, 'slow');
	        
        }else {
	        $("#simplemodal-container").addClass("larger");
        }

		
		
	});	
	

	// Resizing the maps
	
	var newWidth = $(window).width();
	var newHeight = $(window).height() - $("#menu").height();
	if (newWidth >= 1400){
		mapX = 0;
	}else {
		mapX = -195;
	}
	if (newHeight >= (1400 - $("#menu").height()) ){
		mapY = 0;
	}else {
		mapY = -145;
	}
	
	
	function resizeStuff() {
		newHeight = $(window).height() - $("#menu").height();
		newWidth = $(window).width();

		if (newWidth <= 1020) { 
			newWidth = 1020;
		}else {
			
			$("#maps").width(1800);
		}
		if (newWidth >= 1800) {
			newWidth = 1800;
		}
		
		if (newHeight <= 550) { 
			newHeight = 550; 
		}
		if (newHeight >= 1400){
			newHeight = 1400;
		}
		
		if ($("#simplemodal-container").length > 0) {
			if($("#simplemodal-container").height() > $(window).height() ){
				newHeight = $("#simplemodal-container").height() +100;
				$("html").css("overflowY", "auto");
			}
		}
		$(".actamap").height(newHeight);
		$(".actamap").width(newWidth);
		
	}
	
	
	// Map Draggable
	 
	// Default parameters are listed as the parameters below
	var mapC = new SpryMap({
	   // The ID of the element being transformed into a map
	   id : "blcMap",
	   // The width of the map (in px)
	   width: newWidth,
	   // The height of the map (in px)
	   height: newHeight,
	   // The X value of the starting map position
	   startX: mapX,
	   // The Y value of the starting map position
	   startY: mapY,
	   // Boolean true if the map should animate to a stop
	   scrolling: true,
	   // The time (in ms) that the above scrolling lasts
	   scrollTime: 300,
	   // Boolean true if the map disallows moving past its edges
	   lockEdges: true,
	   // The CSS class attached to the wrapping map div
	   cssClass: "blcMap actamap active"
	});
	$("#blcMAP").css({left: mapX, top: mapY});
	
	
	$(window).resize(function(){
		resizeStuff()
	});
	resizeStuff();
	

});
