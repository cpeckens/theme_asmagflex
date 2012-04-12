// contains resposive_accordion.js and jquery_easing.js
/********************************************************************
    File:   
        responsive_accordion.js
    Brief:  
         Modified from Digital Cavalry's slider accordion http://graphicriver.net/user/DigitalCavalry to be used in responsive designs.
    Author:
        Cara Peckens 
    Author URI:
        http://ww.cpeckens.com
*********************************************************************/
		var $j = jQuery.noConflict();
		$j(document).ready(function() {
   		 slider_acc.setup('#accordion-container'); } );
/**********************************************
    Slider object definition.
***********************************************/
var slider_acc = new Object();
slider_acc.width = 100; //This should always be 100 as in 100%
slider_acc.slide_off_width = 9.75; // This will need to be adjusted to properly place slides 
slider_acc.easing = 'easeOutCirc';              
slider_acc.slide_time = 850;
slider_acc.slide_desc_time = 800;
slider_acc.slide_desc_off_time = 300;
slider_acc.strip_desc_time = 150; 
slider_acc.slide_image_time_on = 600;
slider_acc.slide_image_time_out = 600;
slider_acc.strip_time_on = 200;
slider_acc.strip_time_out = 500;
slider_acc.slide_distance = 0;
slider_acc.slides = new Array;
slider_acc.slides_count = 0;
slider_acc.hovered_slide_index = null;
slider_acc.id = null;
slider_acc.auto_close = true;
slider_acc.auto_close_after_time = false; 
slider_acc.auto_close_time = 8000;
slider_acc.auto_close_timer_handle = null;
slider_acc.auto_play = true;
slider_acc.auto_play_time = 3000;
slider_acc.auto_play_closed_time = 1000; 
slider_acc.auto_play_timer_handle = null;
slider_acc.auto_play_closed = false;
slider_acc.slide_desc_height = 95;

slider_acc.setup = function(id)
{
    var q = jQuery.noConflict(); 
    
    slider_acc.id = id;
    // if slider not exist return from function
    if(0 == q(slider_acc.id).length)
    {        
        return;
    }

    // get slider context
    var c = q(slider_acc.id)[0];
    
    //alert(q('.slide', c).length);
    slider_acc.init_slides();     
}



/**********************************************
    INIT SLIDES
***********************************************/
slider_acc.init_slides = function()
{
    var q = jQuery.noConflict(); 
    
    var c = q(slider_acc.id)[0];
    
    q('.slide:first', c).css('border', 'none');
    
    slider_acc.slides_count = q('.slide', c).length;
    slider_acc.slide_distance = slider_acc.width / slider_acc.slides_count; 
    
    for(var i = 0; i < slider_acc.slides_count; i++)
    {
        var obj = new Object(); 
        obj.id = "#" + q('.slide:eq('+i+')', c).attr('id');  
        obj.left = i*slider_acc.slide_distance;
        obj.out = false;          
        obj.strip = false;
        if(q('.slide:eq('+i+')', c).find('.stripe').length) { obj.strip = true; }
        slider_acc.slides.push(obj);
        
        q(obj.id, c).css('left', i*slider_acc.slide_distance + '%');

    } 
    
    q('.slide', c).hover(
        function()
        {
            if(slider_acc.auto_play)
            {
                clearTimeout(slider_acc.auto_play_timer_handle);
                slider_acc.auto_play_timer_handle = null;
            }
            
            var index = q('.slide', c).index(this);
            slider_acc.hovered_slide_index = index;
            
            slider_acc.mouse_out_all_slide(index);
            slider_acc.mouse_on_slide(index); 
            
            slider_acc.slides[index].out = false;
            slider_acc.move_slides(index);  
        },
        function()
        {
            if(slider_acc.auto_close)
            {
                var index = q('.slide', c).index(this);
                if(slider_acc.slides[index].out == false)
                {
                    slider_acc.slides[index].out = true;
                    slider_acc.mouse_out_slide(index);
                }
            }              
             
        }    
    );
    
    q(slider_acc.id).hover( 
        function()
        {
            clearTimeout(slider_acc.auto_close_timer_handle);
            slider_acc.auto_close_timer_handle = null;
        },
        function ()
        {
            if(slider_acc.auto_close)
            {            
                slider_acc.mouse_out_accor();
            }
                        
            if(!slider_acc.auto_play && !slider_acc.auto_close && slider_acc.auto_close_after_time)
            {
                slider_acc.auto_close_timer_handle = setTimeout(slider_acc.close_after_time, slider_acc.auto_close_time);
            }
            
            if(slider_acc.auto_play)
            {
                if(slider_acc.auto_play_timer_handle == null)
                {
                    slider_acc.auto_play_timer_handle = setTimeout(slider_acc.play, slider_acc.auto_play_time);
                }
            }            
        }
    );
    
    q('.slide .shadow', c).hover(
      function (e)
      {
          var c = q(slider_acc.id)[0]; 
          
          var p = q(this).parent();
          var index = q('.slide', c).index(p);         
          index = index - 1;  
          
          if(index >= 0)
          {   
            slider_acc.hovered_slide_index = index;
            
            slider_acc.mouse_out_all_slide(index);
            slider_acc.mouse_on_slide(index); 
            
            slider_acc.slides[index].out = false;
            slider_acc.move_slides(index); 
                                       
          }
                 
      },
      function (e)
      {

                  
      }
    
    );   
    
    if(slider_acc.auto_play)
    {
        if(slider_acc.auto_play_timer_handle == null)
        {
            slider_acc.auto_play_timer_handle = setTimeout(slider_acc.play, slider_acc.auto_play_time);
        }
    }      
      
}


/**********************************************
    AUTOPLAY SLIDER
***********************************************/
slider_acc.play = function()
{    
    var q = jQuery.noConflict(); 
    
    if(slider_acc.hovered_slide_index == null)
    {
        slider_acc.hovered_slide_index = 0;
    } else
    {
        if(!slider_acc.auto_play_closed)
        {
            slider_acc.hovered_slide_index = slider_acc.hovered_slide_index+1;
        } else
        {
            slider_acc.auto_play_closed = false;
        }
        
        if(slider_acc.hovered_slide_index >= slider_acc.slides_count)
        {
            slider_acc.hovered_slide_index = 0;
            slider_acc.auto_play_closed = true;
            slider_acc.mouse_out_accor();
        }        
    }
    
    if(!slider_acc.auto_play_closed)
    {
        var index = slider_acc.hovered_slide_index;
        slider_acc.mouse_out_all_slide(index);
        slider_acc.mouse_on_slide(index); 
        
        slider_acc.slides[index].out = false;
        slider_acc.move_slides(index);
    }    
    

    var time = slider_acc.auto_play_time;
    if(slider_acc.auto_play_closed)
    {
        time = slider_acc.auto_play_closed_time;
    }
    slider_acc.auto_play_timer_handle = setTimeout(slider_acc.play, time);
       
}

/**********************************************
    CLOSE SLIDER
***********************************************/
slider_acc.close_after_time = function()
{
    var q = jQuery.noConflict(); 
    
    slider_acc.auto_close_timer_handle = null;
    slider_acc.mouse_out_accor(); 
}


/**********************************************
    MOUSE ON SLIDE
***********************************************/
slider_acc.mouse_on_slide = function(index) 
{
    var q = jQuery.noConflict(); 
    
    var c = q(slider_acc.id)[0]; 
    q('.strip-title', c).stop().animate({opacity: 0.2}, slider_acc.strip_desc_time, function(){q(this).css('display', 'none');});
    q('.slide:eq('+index+') .stripe', c).stop().animate({opacity: 0.0}, slider_acc.strip_time_on, function(){q(this).css('display', 'none');});
    
    q('.slide:eq('+index+') .text', c).stop().animate({bottom: 0, opacity: 0.85}, slider_acc.slide_desc_time);
    q('.slide:eq('+index+') .text-back', c).stop().animate({bottom: 0, opacity: 0.90}, slider_acc.slide_desc_time);
    q('.slide:eq('+index+') .image', c).stop().animate({opacity: 1.0}, slider_acc.slide_image_time_on);     
    
    slider_acc.slides[index].out = false;  
} 

/**********************************************
    MOUSE OUT SLIDE
***********************************************/
slider_acc.mouse_out_slide = function(index) 
{
    var q = jQuery.noConflict(); 
    var c = q(slider_acc.id)[0]; 
    
    q('.slide:eq('+index+') .text', c).stop().animate({bottom: -slider_acc.slide_desc_height, opacity: 0.0}, slider_acc.slide_desc_off_time);
    q('.slide:eq('+index+') .text-back', c).stop().animate({bottom: -slider_acc.slide_desc_height, opacity: 0.0}, slider_acc.slide_desc_off_time);    
    
        if(slider_acc.slides[index].strip)
        {
            
        q('.slide:eq('+index+') .image', c).stop().animate({opacity: 0.0}, slider_acc.slide_image_time_off, function() {
            q('.slide:eq('+index+') .stripe', c).stop().css('display', 'block').animate({opacity: 1.0}, slider_acc.strip_time_out);                        
        }); 
        
        }               
}

/**********************************************
    MOUSE OUT ALL SLIDES
***********************************************/
slider_acc.mouse_out_all_slide = function(index) 
{
    var q = jQuery.noConflict(); 
    var c = q(slider_acc.id)[0]; 
    
    for(var i = 0; i < slider_acc.slides_count; i++) 
    {
        if(i == index && index != null) { continue; }
        
        if(slider_acc.slides[i].out == false)
        {
            slider_acc.slides[i].out = true;
            slider_acc.mouse_out_slide(i);
        }    
    }
}
              
slider_acc.mouse_out_accor = function()
{
    var q = jQuery.noConflict(); 
    var c = q(slider_acc.id)[0];
    
    q('.strip-title', c).stop().css('display', 'block').animate({opacity: 1.0}, slider_acc.strip_time_out);
    for(var i = 0; i < slider_acc.slides_count; i++) 
    {        
        var obj = q('.slide:eq('+i+')', c);
        var left = i * slider_acc.slide_distance;
        slider_acc.slides[i].left = left; 
        obj.stop().animate(
            {left: left + '%'}, 
            {duration: slider_acc.slide_time, easing: slider_acc.easing});
        if(slider_acc.slides[i].out == false)
        {
            slider_acc.mouse_out_slide(i);
            slider_acc.slides[i].out = true; 
        }            
    }
    
   //q('.slide .stripe', c).stop().animate({opacity: 1.0}, slider_acc.strip_time_out);     
}   

/**********************************************
    MOVE SLIDES
***********************************************/
slider_acc.move_slides = function(index)
{   
    var q = jQuery.noConflict(); 
    var c = q(slider_acc.id)[0]; 
     
    for(var i = 0; i < slider_acc.slides_count; i++)
    {
        var obj = q('.slide:eq('+i+')', c);
        
        if(i <= index)
        {
            var left = i * slider_acc.slide_off_width;
            if(slider_acc.slides[i].left != left)
            {
                
                slider_acc.slides[i].left = left;
                obj.stop().animate(
                    {left: left + '%'}, 
                    {duration: slider_acc.slide_time, easing: slider_acc.easing});
                
            } // if
        } // if
       
        if(i > index)
        {
            var left = (slider_acc.width - ((slider_acc.slides_count - i) * slider_acc.slide_off_width)); 
            if(slider_acc.slides[i].left != left)
            {
                
                slider_acc.slides[i].left = left;
                obj.stop().animate(
                    {left: left + '%'}, 
                    {duration: slider_acc.slide_time, easing: slider_acc.easing});
                
            } // if
        } // if       
        
    } // for   
}  


/*
 * jQuery EasIng v1.1.2 - http://gsgd.co.uk/sandbox/jquery.easIng.php
 *
 * Uses the built In easIng capabilities added In jQuery 1.1
 * to offer multiple easIng options
 *
 * Copyright (c) 2007 George Smith
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */

// t: current time, b: begInnIng value, c: change In value, d: duration

jQuery.extend( jQuery.easing,
{
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});