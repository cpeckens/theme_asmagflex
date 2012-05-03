<?php get_header(); ?>
	<div id="container-mid">
	<div id="content">
	    
	    <div id="article">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
		<?php if ( get_post_meta($post->ID, 'ecpt_asmag_css', true) ) : ?><style><?php echo get_post_meta($post->ID, 'ecpt_asmag_css', true); ?></style><?php endif; ?> <!--Add features custom CSS-->
		<div class="postmaterial">
		<h3><?php the_title(); ?></h3>
		<?php the_content(); ?>
		</div><!--End postmaterial -->
	<?php endwhile; endif; ?>
	</div> <!--article -->
	
	<div id="article-right">
	<div class="otherstories">
		<h4>Current Feature Stories</h4>
				<?php global $wp_query;
					foreach(get_the_terms($wp_query->post->ID, 'volume') as $term);
					$volume = $term->slug;
					if ($volume == null) { 
			$volume = $asmag_option['asmag_current_issue']; }

					
				if ( false === ( $features_query = get_transient( 'features' . $volume . '_query' ) ) ) { 

				$features_query = new WP_Query(array(
						'post_type' => 'page',
						'tax_query' => array ( 
						'relation' => 'AND',
						array (
							'taxonomy' => 'volume',
							'terms' => array( $volume ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'IN'),
						array (
							'taxonomy' => 'volume',
							'terms' => array( 'feature' ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'IN'),	
							),
						'order' => 'ASC',
						'posts_per_page' => '-1')); 
				set_transient( 'features' . $volume . '_query', $features_query, 86400 ); }
				
				while ($features_query->have_posts()) : $features_query->the_post(); ?>

	    		<div class="subtext"><h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="blue"><?php the_title(); ?></a></h5>
	    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> <p><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></p>
	    			    <?php else : the_excerpt(); endif; ?></a>	    			    
	    		<?php if ( in_category( 'web-extra' )) : ?><div class="extra"></div><?php endif; ?>
	    				<div class="extranames">
	    				<?php if ( in_category( 'expanded-story' )) : ?>&nbsp;EXPANDED STORY<?php endif; ?>
	    				<?php if ( in_category( 'audio' )) : ?>&nbsp;AUDIO<?php endif; ?>
	    				<?php if ( in_category( 'video' )) : ?>&nbsp;VIDEO<?php endif; ?>
	    				<?php if ( in_category( 'slideshow' )) : ?>&nbsp;SLIDESHOW<?php endif; ?>
	    				</div><!-- End extranames -->
	    				
	    				</div><!-- End subtext -->


   			<?php endwhile; ?>
	
	</div> <!--End otherstories -->

	<div class="web-wrapper"><h5><span class="web">WEB EXCLUSIVES</span></h5></div>
		<?php 
			if ( false === ( $asmag_exclusives_query = get_transient( 'web_exclusives_query' ) ) ) {
			$asmag_exclusives_query = new WP_Query(array(
				'cat' => '31',
				'order' => 'DESC',
				'posts_per_page' => '6'));
			set_transient( 'web_exclusives_query', $asmag_exclusives_query, 86400 ); }	
			 while ($asmag_exclusives_query->have_posts()) : $asmag_exclusives_query->the_post(); ?>
			
	    			<div class="subarticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'homethumb', true);
	    			    						echo $image_url[0];  ?>" align="left" class="homethumb" /></a>
	    			    <?php	} ?>
	    			    <div class="subtext"><h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="blue"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> <p><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></p>
	    			    <?php else : the_excerpt(); endif; ?></a></div>
	    			
	    			</div><!--End subarticle -->
	    			<?php endwhile; //End loop ?>	    					    		
	    	
 </div> <!--End sidebar-right -->
	    	</div> <!--End content -->
	    		<div class="clearboth"></div> <!--to have background work properly -->
		</div> <!--End container-mid -->

<?php get_footer(); ?>