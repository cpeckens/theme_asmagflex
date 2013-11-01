<?php
/*
Template Name: Brody Learning Commpons
*/
?>
<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); endwhile;  endif; ?>
	<?php locate_template('parts/brody-learning-commons.php', true, false);
		  get_footer(); ?>