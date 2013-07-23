<?php
/*
Template Name: Lifespan - Home
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
	<style>
		<?php echo get_post_meta($post->ID, 'ecpt_asmag_css', true); ?>
	</style> <!--Add features custom CSS-->
	<?php if ( get_post_meta($post->ID, 'javascript', true) ) : ?><?php echo get_post_meta($post->ID, 'javascript', true); ?><?php endif; ?>

<div id="lifespan_home">
<div id="head" class="lifespan"></div>
<div class="row">
	<div class="twelve columns">
		<h3 class="featuretitle"><?php the_title(); ?></h3>
		<h4 class="tagline"><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?><?php endif; ?></h4>
	</div>
</div>

<div class="row">
	<div class="four columns">
		<?php locate_template('parts/v10n2_lifespan_nav.php', true, false);	?>			
	</div>
	
	<div class="five columns">
		<?php the_content(); ?>
	</div>
	
	<div class="two columns">
		<?php locate_template('parts/v10n2_lifespan_stats.php', true, false);	?>
	</div>
</div>
</div>
<?php endwhile; endif;
 locate_template('parts/footer_feature.php', true, false);				
 get_footer(); ?>