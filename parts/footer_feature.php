<?php if (is_page_template( 'feature-complex.php' ) == false) : ?>
	<div class="row" id="comments">
		<div class="twelve columns">	
			<?php comments_template( '/comments.php' ); ?> 
		</div>
	</div>
	</div> <!--end feature -->
		
</div> <!--End container-mid -->
<?php endif; $volume = get_the_volume($post); $volume_name = get_the_volume_name($post);?>
			<div id="footer-top">
			<div class="featurelisting row">
			
			<div class="twelve columns table">
				<h4><?php echo $volume_name; ?> Feature Stories<span class="spacer"></span></h4>
			</div>

		<?php 
						
				
				
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
		
	    			<div class="three columns">
	    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    <?php the_post_thumbnail('filterthumb'); ?>
	    			    <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
			    			<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo get_post_meta($post->ID, 'ecpt_tagline', true); else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?>
	    			</div><!--End snippet -->
	    			<?php endwhile; //End loop ?>

			</div>

			</div>
