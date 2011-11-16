<?php
/*
Template Name: Vol 9 No 1 Fancy Title
*/
?>
<?php get_header('v9n1feature'); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
	<style>
	#feature-head {
		background-image: url(<?php echo get_post_meta($post->ID, 'header_background', true); ?>);
		}
	<?php echo get_post_meta($post->ID, 'asmag_css', true); ?></style> <!--Add features custom CSS-->
	<?php if ( get_post_meta($post->ID, 'javascript', true) ) : ?><?php echo get_post_meta($post->ID, 'javascript', true); ?><?php endif; ?>
				<div class="titlesection">
				<?php if ( get_post_meta($post->ID, 'fancy_title', true) ) : ?><div class="fancytitle"><?php echo get_post_meta($post->ID, 'fancy_title', true); ?></div><?php endif; ?>
				<h4 class="tagline"><?php if ( get_post_meta($post->ID, 'tagline', true) ) : ?><?php echo get_post_meta($post->ID, 'tagline', true); ?><?php endif; ?></h4>
				<p class="othercredits"><?php if ( get_post_meta($post->ID, 'other_credits', true) ) : ?>  <?php echo get_post_meta($post->ID, 'other_credits', true); ?><?php endif; ?></p>
			</div>

	<div id="feature-head">
		<div class="intro-container">
		<div class="feature-intro">
			<div class="introcopy">	
				<div class="pullquote"><?php if ( get_post_meta($post->ID, 'pull_quote', true) ) : ?>  <?php echo get_post_meta($post->ID, 'pull_quote', true); ?><?php endif; ?></div>
			</div><!--End intro copy-->
		</div><!--end feature-intro-->
		</div><!--end intro-containter-->
	</div><!--end feature-head-->
	<div class="headerbreak"></div>
	<div id="container-mid">
	<div id="feature">
	    
		<div class="postmaterial">
		
		<?php the_content(); ?>
		
		</div><!--End postmaterial -->
	
	<?php endwhile; ?> <?php endif; ?>
	
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
				
			<div id="footer-top">
			<div class="featurelisting">
				<div class="title-wrapper"><h4><span class="title">MORE FEATURE STORIES</span></h4></div>

					<?php $features_query = new WP_Query(array(
						'post_type' => 'page',
						'volume' => 'v9n1',
						'order' => 'ASC',
						'posts_per_page' => '-1')); ?>
		
			<?php while ($features_query->have_posts()) : $features_query->the_post(); ?>
		
	    			<div class="alumarticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'alumni', true);
	    			    						echo $image_url[0];  ?>" align="left" class="alumthumb" /></a>
	    			    <?php	} ?>
	    			    <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    			    <?php if ( get_post_meta($post->ID, 'tagline', true) ) : ?><p><?php echo get_post_meta($post->ID, 'tagline', true); ?></p> <?php endif; ?>
	    			</div><!--End snippet -->
	    			<?php endwhile; //End loop ?>
						<div class="clearboth"></div> <!--to have background work properly -->

			</div>

			</div>
<?php get_footer('v9n1feature'); ?>