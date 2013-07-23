<?php
/*
Template Name: Brody Learning Commpons
*/
?>
<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); endwhile;  endif; ?>
	<?php locate_template('parts/v10n1_blc.php', true, false);
		  get_footer(); ?>