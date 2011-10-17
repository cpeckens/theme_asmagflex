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
