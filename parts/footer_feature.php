	<?php if (is_page_template( 'feature-complex.php' ) == false) : ?>
	<div class="share">
		<span  class="st_twitter_large"></span>
		<span  class="st_facebook_large"></span>
		<span  class="st_email_large"></span>
		<span  class="st_sharethis_large"></span>
	</div><!--end share-->
	
	<?php comments_template( '/comments.php' ); ?> 
	</div> <!--end feature -->
	
	
	    		<div class="clearboth"></div> <!--to have background work properly -->
		</div> <!--End container-mid -->
		<?php endif;?>
			<div id="footer-top">
			<div class="featurelisting">
				<div class="title-wrapper"><h4><span class="title">MORE FEATURE STORIES</span></h4></div>

					<?php 
					global $wp_query;
					foreach(get_the_terms($wp_query->post->ID, 'volume') as $term);
					$volume = $term->slug; 
					
				if ( false === ( $features_query = get_transient( 'features' . $volume . '_query' ) ) ) { 

				$features_query = new WP_Query(array(
						'post_type' => 'page',
						'tax_query' => array ( 
						'relation' => 'AND',array (
							'taxonomy' => 'volume',
							'terms' => array( $volume, 'feature' ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'AND')),
						'order' => 'ASC',
						'posts_per_page' => '-1')); 
				set_transient( 'features' . $volume . '_query', $features_query, 86400 ); }
				
				while ($features_query->have_posts()) : $features_query->the_post(); ?>
		
	    			<div class="alumarticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'alumni', true);
	    			    						echo $image_url[0];  ?>" class="alumthumb" /></a>
	    			    <?php	} ?>
	    			    <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?><p><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></p> <?php endif; ?>
	    			</div><!--End snippet -->
	    			<?php endwhile; //End loop ?>
						<div class="clearboth"></div> <!--to have background work properly -->

			</div>

			</div>
