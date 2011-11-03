<?php
/*
Template Name: Vol 8 No 2 Feature
*/
?>
<?php get_template_part( 'header', 'v8n2feature' ); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
	<?php if ( get_post_meta($post->ID, 'asmag_css', true) ) : ?><style><?php echo get_post_meta($post->ID, 'asmag_css', true); ?></style><?php endif; ?> <!--Add features custom CSS-->
	
	<div id="feature-head" style="background: url('<?php echo get_post_meta($post->ID, 'header_background', true); ?>') top center;">
		<div class="intro-container">
		<div class="feature-intro">
		<div class="nonbackground"><?php $image = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
<img src="<?php echo $image; ?>"></div>
			<h3><?php the_title(); ?></h3>
			<h4 class="tagline"><?php if ( get_post_meta($post->ID, 'tagline', true) ) : ?>  <?php echo get_post_meta($post->ID, 'tagline', true); ?><?php endif; ?></h4>
			<p class="credit">By&nbsp;<?php the_author(); ?></p>
			<p class="othercredits"><?php if ( get_post_meta($post->ID, 'other_credits', true) ) : ?>  <?php echo get_post_meta($post->ID, 'other_credits', true); ?><?php endif; ?></p>

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

<?php get_template_part( 'footer', 'v8n2feature' ); ?>