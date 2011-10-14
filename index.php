		
	<?php get_header() ?>
	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
	
	<?php endwhile; ?>

	<?php endif; ?>
	
	<?php get_footer() ?>