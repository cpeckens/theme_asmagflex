<?php
/*
Template Name: Vol 9 No 1 Homepage
*/
?>	
<?php get_header(); ?>
	
	<script type="text/javascript"> //Setup accordion
		var $j = jQuery.noConflict();
		$j(document).ready(function() {
   		 slider_acc.setup('#accordion-container'); } );
   	</script>
	
	<div id="accordion-container-wrapper">
	<div id="accordion-container">
        <div id="as10" class="slide">
        	<a id="slideimg10" class="image async-img" href="/fall-2011/interns-make-an-impact/">
        		<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/feature1.jpg">
        	
        	<div class="text-back"></div>
        	<div class="text">
        		<h3>Toward a Better Baltimore</h3>
        		<p>Last summer, 25 student interns made their mark in the city's neediest neighborhoods.</p>
        	</div></a>
        		<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/spring11/feature1strip.jpg">
        </div>
        
        <div id="as11" class="slide">
        		<a id="slideimg11" class="image async-img" href="/fall-2011/thanks-for-the-memories/">
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/fall11/feature2.jpg">
        		
        		<div class="text-back"></div>
        		<div class="text">
        		<h3>Thanks for the Memories</h3>
        		<p>Mike Yassa is making great strides in memory research, and taking his students along with him.</p>
        		</div></a>
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/fall11/feature2strip.jpg">
        	</div>
        	
        	<div id="as12" class="slide">
        		<a id="slideimg12" class="image async-img" href="/fall-2011/the-great-wall-of-waverly/">
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/fall11/feature3.jpg">
        		
        		<div class="text-back"></div>
        		<div class="text">
        			<h3>The Great Wall of Waverly</h3>
        			<p>Hopkins artists, led by Tom Chalkley, have created a striking tribute to a vibrant community.</p>
        		</div></a>
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/fall11/feature3strip.jpg">
        	</div>
        	
        	<div id="as13" class="slide">
        		<a id="slideimg13" class="image async-img" href="/fall-2011/a-poem-lovely-as-a-smartphone/">
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/fall11/feature4.jpg">
        		
        		<div class="text-back"></div>
        		<div class="text" >
        			<h3>A poem lovely as &hellip; a smartphone?</h3>
        			<p>Is there a place for poetry in today's high-tech world? Absolutely, says Mary Jo Salter.</p>
        		</div></a>
        			<img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/fall11/feature4strip.jpg">
        	</div>
        </div> <!-- accordion-container -->
	</div> <!-- accordion-container-wrapper --> 
	
	<div id="container-mid">
	<div id="homepage">
	    
	    <div id="issue">
<!--*************************** News Section ********************************************* --> 
  			<div class="title-wrapper"><h4><span class="title">NEWS: The latest from the school of Arts and Sciences</span></h4></div>
	<?php $asmag_news_query = new WP_Query(array(
		'cat' => '4',
		'volume' => 'v9n1',
		'order' => 'ASC',
		'posts_per_page' => '-1')); ?>
		
		<?php while ($asmag_news_query->have_posts()) : $asmag_news_query->the_post(); ?>
			
	    			<div class="homearticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'homethumb', true);
	    			    						echo $image_url[0];  ?>" align="left" class="homethumb" /></a>
	    			    <?php	} ?>
	    			    <?php the_tags( '<h6>', ', ', '</h6>' ); ?>
	    			    <h5><?php if ( in_category( 'web-extra' )) : ?><div class="extra"></div><?php endif; ?><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>
	    			    <div class="extranames">
	    				<?php if ( in_category( 'audio' )) : ?>&nbsp;AUDIO<?php endif; ?>
	    				<?php if ( in_category( 'video' )) : ?>&nbsp;VIDEO<?php endif; ?>
	    				<?php if ( in_category( 'slideshow' )) : ?>&nbsp;SLIDESHOW<?php endif; ?></div>
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>
	    			
<!--*************************** Insights Section ********************************************* --> 	    			
<div class="clearboth"></div> <!--to have background work properly -->

	<div class="title-wrapper"><h4><span class="title">INSIGHTS: From the classroom to the laboratory</span></h4></div>
	<?php $asmag_insights_query = new WP_Query(array(
		'cat' => '27',
		'volume' => 'v9n1',
		'order' => 'ASC',
		'posts_per_page' => '-1')); ?>
		
		<?php while ($asmag_insights_query->have_posts()) : $asmag_insights_query->the_post(); ?>
			
	    			<div class="homearticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'homethumb', true);
	    			    						echo $image_url[0];  ?>" align="left" class="homethumb" /></a>
	    			    <?php	} ?>
	    			    <?php the_tags( '<h6>', ', ', '</h6>' ); ?>
	    			    <h5><?php if ( in_category( 'web-extra' )) : ?><div class="extra"></div><?php endif; ?><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>
	    			    <div class="extranames">
	    					<?php if ( in_category( 'audio' )) : ?>&nbsp;AUDIO<?php endif; ?>
	    					<?php if ( in_category( 'video' )) : ?>&nbsp;VIDEO<?php endif; ?>
	    					<?php if ( in_category( 'slideshow' )) : ?>&nbsp;SLIDESHOW<?php endif; ?>
	    				</div><!--End extranames -->

	    			
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>
	    			
<!--*************************** Alumni Section ********************************************* --> 	    	
<div class="clearboth"></div> <!--to have background work properly -->
	<div class="title-wrapper"><h4><span class="title">ALUMNI: Arts and Sciences grads on the move</span></h4></div>
	<?php $asmag_alumni_query = new WP_Query(array(
		'cat' => '28',
		'volume' => 'v9n1',
		'order' => 'ASC',
		'posts_per_page' => '-1')); ?>
		
		<?php while ($asmag_alumni_query->have_posts()) : $asmag_alumni_query->the_post(); ?>
			
	    			<div class="alumarticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'alumni', true);
	    			    						echo $image_url[0];  ?>" class="alumthumb" /></a>
	    			    <?php	} ?>
	    			    <h5><?php if ( in_category( 'web-extra' )) : ?><div class="extra"></div><?php endif; ?><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>
	    				 <div class="extranames">
	    					<?php if ( in_category( 'audio' )) : ?>&nbsp;AUDIO<?php endif; ?>
	    					<?php if ( in_category( 'video' )) : ?>&nbsp;VIDEO<?php endif; ?>
	    					<?php if ( in_category( 'slideshow' )) : ?>&nbsp;SLIDESHOW<?php endif; ?>
	    				</div><!--End extranames -->
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>	    		</div> <!--End issue -->


<!--*************************** Sidebar Section ********************************************* --> 	    	
	
<div id="sidebar-right">
	<div class="web-wrapper"><h5><span class="web">WEB EXCLUSIVES</span></h5></div>
	<?php $asmag_exclusives_query = new WP_Query(array(
		'cat' => '31',
		'order' => 'ASC',
		'posts_per_page' => '5')); ?>
		
		<?php while ($asmag_exclusives_query->have_posts()) : $asmag_exclusives_query->the_post(); ?>
			
	    			<div class="webarticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'exclusive', true);
	    			    						echo $image_url[0];  ?>" align="left" class="webthumb" /></a>
	    			    <?php	} ?>
	    			    <div class="webtext"><h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a></div>
	    			
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>	    					    		

	    	
 </div> <!--End sidebar-right -->
 	    		

	    		<div class="clearboth"></div> <!--to have background work properly -->
	    		<div class="dean">
	    		<a href="/2011/11/baltimore-engaging-a-city/"><img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/dean.png">
	    	<div class="deantext"><h5>Baltimore: Engaging a City</h5></a>
	    	<!-- <p>Pellentesque habitant morbi tristique</p> --></div>
	    	</div>
	    	</div> <!--End homepage -->
	    		
		</div> <!--End container-mid -->

<?php get_footer('v9n1'); ?>