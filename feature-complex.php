<?php
/*
Template Name: Feature - Complex
*/
?>
<?php get_header(); ?>
<?php if(is_page('interns-make-an-impact')) : ?>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/coverstory.css" />
<?php endif; ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
	<style>
	#feature-head {
		background-image: url(<?php echo get_post_meta($post->ID, 'ecpt_header_background', true); ?>);
		}
	</style> <!--Add features custom CSS-->
	<?php if ( get_post_meta($post->ID, 'javascript', true) ) : ?><?php echo get_post_meta($post->ID, 'javascript', true); ?><?php endif; ?>
	
	<div id="feature-head">
		<div class="intro-container">
		<div class="feature-intro">
			<div class="textblock">
				<?php if ( get_post_meta($post->ID, 'fancy_title', true) ) : ?><div class="fancytitle"><?php echo get_post_meta($post->ID, 'fancy_title', true); ?></div><?php endif; ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_pull_quote', true) ) : ?><div class="pullquote">  <?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?></div><?php endif; ?>
				<p class="credit">By&nbsp;<?php the_author(); ?></p>
				<?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) : ?><p class="othercredits">  <?php echo get_post_meta($post->ID, 'ecpt_other_credits', true); ?></p><?php endif; ?>
			</div>
		</div><!--end feature-intro-->
		</div><!--end intro-containter-->
	</div><!--end feature-head-->
		<?php endwhile; ?> <?php endif; ?>
		<?php 
		if(is_page('interns-make-an-impact')) : 
			locate_template('parts/story_v9n1cover.php', true, false);
		endif;
		
		locate_template('parts/footer_feature.php', true, false);				
 		get_footer(); ?>