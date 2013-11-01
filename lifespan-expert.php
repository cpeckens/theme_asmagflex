<?php
/*
Template Name: Lifespan - Expert
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
<div id="lifespan_expert" class="lifespan">
<div class="row">

	
	<div class="six columns" id="story">
		<h3><?php the_title(); ?></h3>
		<?php the_content(); ?>
	</div>
	
	<div class="four columns">
		<?php locate_template('parts/v10n2_lifespan_nav.php', true, false);	?>			
	</div>
</div>
</div>
<div id="head" class="expert"></div>
<?php endwhile; endif;
 	locate_template('parts/footer_feature.php', true, false);				
 	get_footer(); ?>