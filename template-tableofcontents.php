<?php
/*
Template Name: Issue Table of Contents
*/
?>
	
<?php get_header(); ?>
		
		<?php 	    	// Get any existing copy of our transient data
			global $wp_query;
			foreach(get_the_terms($wp_query->post->ID, 'volume') as $term);
			$volume = $term->slug; 
 	    	if ( false === ( $my_accordion_query = get_transient( 'ksas_accordion' . $volume . '_query' ) ) ) { 
        	// It wasn't there, so regenerate the data and save the transient
        	$my_accordion_query = new WP_Query(array(
			'post_type' => 'accordion',
			'volume' => $volume)); 
        	set_transient( 'ksas_accordion' . $volume . '_query', $my_accordion_query, 86400 );
	    	}  ?>
		
		<?php if ($my_accordion_query->have_posts()) : ?>				
				<div id="accordion_background">
				<div id="accordion-container-wrapper">
				<div id="accordion-container">		
				
			<?php while ($my_accordion_query->have_posts()) : $my_accordion_query->the_post(); ?>

				<div id="as<?php echo the_ID() ?>" class="slide">
        			<a id="slideimg<?php echo the_ID() ?>" class="image async-img" href="<?php echo get_post_meta($post->ID, 'ecpt_accordion_destination', true); ?>">
        				<img alt="" src="<?php echo get_post_meta($post->ID, 'ecpt_accordion_photo', true); ?>">
        			<div class="text-back"></div>
        				<div class="text">
        					<h3><?php the_title() ?></h3>
        					<?php the_content() ?>
        				</div>
        			</a>
        			<img alt="" src="<?php echo get_post_meta($post->ID, 'ecpt_accordion_strip', true); ?>">
        		</div>
        		
		<?php endwhile; ?>
        	
    </div> <!-- accordion-container -->
	</div> <!-- accordion-container-wrapper --> 
	</div> <!-- accordion background -->
	<?php endif; ?>	 
	
	<div id="container-mid">
	<div id="homepage">
	    
	    <div id="issue">
<!--*************************** News Section ********************************************* --> 
  			<div class="title-wrapper"><h4><span class="title">NEWS: The latest from the school of Arts and Sciences</span></h4></div>
	<?php  	    	if ( false === ( $asmag_news_query = get_transient( 'asmag_news' . $volume . '_query' ) ) ) { 
        	// It wasn't there, so regenerate the data and save the transient
        	$asmag_news_query = new WP_Query(array(
		'cat' => '4',
		'volume' => $volume,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => '-1')); 
        	set_transient( 'asmag_news' . $volume . '_query', $asmag_news_query, 86400 );
	    	} ?>
		
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
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    <?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> <p><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></p>
	    			    <?php else : the_excerpt(); endif; ?></a>
	    			    <div class="extranames">
	    				<?php if ( in_category( 'audio' )) : ?>&nbsp;AUDIO<?php endif; ?>
	    				<?php if ( in_category( 'video' )) : ?>&nbsp;VIDEO<?php endif; ?>
	    				<?php if ( in_category( 'slideshow' )) : ?>&nbsp;SLIDESHOW<?php endif; ?></div>
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>
	    			
<!--*************************** Insights Section ********************************************* --> 	    			
<div class="clearboth"></div> <!--to have background work properly -->

	<div class="title-wrapper"><h4><span class="title">INSIGHTS: From the classroom to the laboratory</span></h4></div>
	<?php  	    	if ( false === ( $asmag_insights_query = get_transient( 'asmag_insights' . $volume . '_query' ) ) ) { 
        	// It wasn't there, so regenerate the data and save the transient
        	$asmag_insights_query = new WP_Query(array(
		'cat' => '27',
		'volume' => $volume,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => '-1'));
        	set_transient( 'asmag_insights' . $volume . '_query', $asmag_insights_query, 86400 );
	    	} ?>
		
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
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> <p><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></p>
	    			    <?php else : the_excerpt(); endif; ?></a>
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
	<?php  	    	if ( false === ( $asmag_alumni_query = get_transient( 'asmag_alumni' . $volume . '_query' ) ) ) { 
        	// It wasn't there, so regenerate the data and save the transient
        	$asmag_alumni_query = new WP_Query(array(
		'cat' => '28',
		'volume' => $volume,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => '-1'));
        	set_transient( 'asmag_alumni' . $volume . '_query', $asmag_alumni_query, 86400 );
	    	} ?>
		
		<?php while ($asmag_alumni_query->have_posts()) : $asmag_alumni_query->the_post(); ?>
			
	    			<div class="alumarticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'alumni', true);
	    			    						echo $image_url[0];  ?>" class="alumthumb" /></a>
	    			    <?php	} ?>
	    			    <h5><?php if ( in_category( 'web-extra' )) : ?><div class="extra"></div><?php endif; ?><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> <p><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></p>
	    			    <?php else : the_excerpt(); endif; ?></a>
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
	<?php	if ( false === ( $asmag_exclusives_query = get_transient( 'web_exclusives_query' ) ) ) {
	$asmag_exclusives_query = new WP_Query(array(
		'cat' => '31',
		'order' => 'ASC',
		'posts_per_page' => '-1'));
	set_transient( 'web_exclusives_query', $asmag_exclusives_query, 86400 ); }	 ?>
		
		<?php while ($asmag_exclusives_query->have_posts()) : $asmag_exclusives_query->the_post(); ?>
			
	    			<div class="webarticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'exclusive', true);
	    			    						echo $image_url[0];  ?>" class="webthumb" /></a>
	    			    <?php	} ?>
	    			    <div class="webtext"><h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> <p><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></p>
	    			    <?php else : the_excerpt(); endif; ?></a></div>
	    			
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>	    					    		

	    	
 </div> <!--End sidebar-right -->
 	    		

	    		<div class="clearboth"></div> <!--to have background work properly -->
	    		<div class="dean">
	    		<?php 	    		if ( false === ( $asmag_dean_query = get_transient( 'asmag_dean' . $volume . '_query' ) ) ) {
	    		$asmag_dean_query = new WP_Query(array(
					'cat' => '30',
					'volume' => $volume,
					'posts_per_page' => '1'));
				set_transient( 'asmag_dean' . $volume . '_query', $asmag_dean_query, 86400 ); } ?>
		
			<?php while ($asmag_dean_query->have_posts()) : $asmag_dean_query->the_post(); ?>
	    		<a href="<?php the_permalink(); ?>"><img alt="" src="<?php bloginfo('template_url'); ?>/assets/img/dean.png">
	    	<div class="deantext"><h5><?php the_title(); ?></h5></a></div>
	    	</div>
	    	<?php endwhile; ?>
	    	</div> <!--End homepage -->
	    		
		</div> <!--End container-mid -->

<?php get_footer(); ?>