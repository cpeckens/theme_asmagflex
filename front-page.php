<?php get_header() ?>
	
	<script type="text/javascript"> //Setup accordion
		var $j = jQuery.noConflict();
		$j(document).ready(function() {
   		 slider_acc.setup('#accordion-container'); } );
   	</script>
	
	<div id="accordion-container-wrapper">
	<div id="accordion-container">
        <div id="as10" class="slide">
        	<a id="slideimg10" class="image async-img">
        		<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/JoshLiba_07.jpg">
        	</a>
        	<div class="text-back"></div>
        	<div class="text">
        		<h3>Neon Dichotomy</h3>
        		Author: Josh Liba. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elite
        	</div>
        		<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/JoshLiba_07_strip.jpg">
        </div>
        
        <div id="as11" class="slide">
        		<a id="slideimg11" class="image async-img">
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/JoshLiba_09_acc.jpg">
        		</a>
        		<div class="text-back"></div>
        		<div class="text">
        		<h3>Times Square shots</h3>
        		Author: Josh Liba. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        		</div>
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/JoshLiba_09_strip.jpg">
        	</div>
        	
        	<div id="as12" class="slide">
        		<a id="slideimg12" class="image async-img" >
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/JoshLiba_10_acc.jpg">
        		</a>
        		<div class="text-back"></div>
        		<div class="text">
        			<h3>Breakdancers in the Big Apple!</h3>
        			Author: Josh Liba. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        		</div>
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/JoshLiba_10_strip.jpg">
        	</div>
        	
        	<div id="as13" class="slide">
        		<a id="slideimg13" class="image async-img">
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/JoshLiba_11_acc.jpg">
        		</a>
        		<div class="text-back"></div>
        		<div class="text" >
        			<h3>Chevy Chase</h3>
        			Author: Josh Liba. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        		</div>
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/JoshLiba_11_strip.jpg">
        	</div>
        </div> <!-- accordion-container -->
	</div> <!-- accordion-container-wrapper --> 
	
	<div id="container-mid">
	<div id="homepage">
	    
	    <div id="issue">
<!--*************************** News Section ********************************************* --> 
  			<div class="title-wrapper"><h4>NEWS: The latest from the school of Arts and Sciences</h4></div>
	<?php $asmag_news_query = new WP_Query(array(
		'cat' => '4',
		'volume' => 'v8n2',
		'order' => 'ASC',
		'posts_per_page' => '-1')); ?>
		
		<?php while ($asmag_news_query->have_posts()) : $asmag_news_query->the_post(); ?>
			
	    			<div class="homearticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    	<div class="homethumb">
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'homethumb', true);
	    			    						echo $image_url[0];  ?>" align="left" /></a>
	    			    	</div> <!--end thumbnail-->
	    			    <?php	} ?>
	    			    <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>
	    			
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>
	    			
<!--*************************** Insights Section ********************************************* --> 	    			
<div class="clearboth"></div> <!--to have background work properly -->

	<div class="title-wrapper"><h4>INSIGHTS: From the classroom to the laboratory</h4></div>
	<?php $asmag_insights_query = new WP_Query(array(
		'cat' => '27',
		'volume' => 'v8n2',
		'order' => 'ASC',
		'posts_per_page' => '-1')); ?>
		
		<?php while ($asmag_insights_query->have_posts()) : $asmag_insights_query->the_post(); ?>
			
	    			<div class="homearticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    	<div class="homethumb">
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'homethumb', true);
	    			    						echo $image_url[0];  ?>" align="left" /></a>
	    			    	</div> <!--end thumbnail-->
	    			    <?php	} ?>
	    			    <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>
	    			
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>
	    			
<!--*************************** Alumni Section ********************************************* --> 	    	
<div class="clearboth"></div> <!--to have background work properly -->
	<div class="title-wrapper"><h4>ALUMNI: Arts and Sciences grads on the move</h4></div>
	<?php $asmag_alumni_query = new WP_Query(array(
		'cat' => '28',
		'volume' => 'v8n2',
		'order' => 'ASC',
		'posts_per_page' => '-1')); ?>
		
		<?php while ($asmag_alumni_query->have_posts()) : $asmag_alumni_query->the_post(); ?>
			
	    			<div class="homearticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    	<div class="homethumb">
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'alumni', true);
	    			    						echo $image_url[0];  ?>" align="left" /></a>
	    			    	</div> <!--end thumbnail-->
	    			    <?php	} ?>
	    			    <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>
	    			
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>	    		</div> <!--End issue -->


<!--*************************** Sidebar Section ********************************************* --> 	    	
	
<div id="sidebar-right">
	<div class="title-wrapper"><h4>WEB EXCLUSIVES</h4></div>
	<?php $asmag_exclusives_query = new WP_Query(array(
		'cat' => '31',
		'volume' => 'v8n2',
		'order' => 'ASC',
		'posts_per_page' => '-1')); ?>
		
		<?php while ($asmag_exclusives_query->have_posts()) : $asmag_exclusives_query->the_post(); ?>
			
	    			<div class="homearticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    	<div class="homethumb">
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'alumni', true);
	    			    						echo $image_url[0];  ?>" align="left" /></a>
	    			    	</div> <!--end thumbnail-->
	    			    <?php	} ?>
	    			    <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>
	    			
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>	    					    		

	    	<div class="dean">
	    	<h5>Headline for the Article</h5>
	    	<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
	    	</div>
 </div> <!--End sidebar-right -->
 
	    		<div class="clearboth"></div> <!--to have background work properly -->
	    	</div> <!--End homepage -->
	    		
		</div> <!--End container-mid -->

<?php get_footer() ?>