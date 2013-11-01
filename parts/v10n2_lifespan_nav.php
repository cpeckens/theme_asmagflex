<?php wp_nav_menu( array( 
	'container' => 'nav',
	'container_id' => 'lifespan',
	'menu' => 'Lifespan', 
	'menu_class' => 'accordion', 
	'depth' => 2 )); ?> 

<script>
	var $l = jQuery.noConflict();
	$l('li.trigger a').click(function () {
        if ($l(this).parent().hasClass('active')) {
          $l(this).parent().removeClass('active');
        } else {
          $l(this).parent().addClass('active');
          };
        });
          
      
    
 </script>

