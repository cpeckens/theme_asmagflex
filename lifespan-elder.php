<?php
/*
Template Name: Lifespan - Elder
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
	<style>
		<?php echo get_post_meta($post->ID, 'ecpt_asmag_css', true); ?>
	</style> <!--Add features custom CSS-->
	<?php if ( get_post_meta($post->ID, 'javascript', true) ) : ?><?php echo get_post_meta($post->ID, 'javascript', true); ?><?php endif; ?>

<div id="lifespan_elder" class="lifespan">
<div class="row">

	
	<div class="six columns" id="story">
		<h3><?php the_title(); ?></h3>
		<?php the_content(); ?>
		<p><em>&#8212;<?php the_author(); ?></em></p>
	</div>
	
	<div class="four columns">
		<?php locate_template('parts/v10n2_lifespan_nav.php', true, false);	?>			
	</div>
</div>
</div>
<?php endwhile; endif;
 	locate_template('parts/footer_feature.php', true, false);				
 	get_footer(); ?>