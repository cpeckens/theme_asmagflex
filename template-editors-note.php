<?php
/*
Template Name: Editors Note
*/
?>	
<?php get_header(); 
	$issue = $_GET['volume'];
?>
<div id="container-mid">
	<div class="row" id="content">
	    <article class="eight columns" id="article">
	    		<div class="postmaterial">
				<?php $dean_query = new WP_Query(array(
						'post_type' => 'post',
						'category_name' => 'editors-note',
						'volume' => $issue,
						'order' => 'DESC',
						'posts_per_page' => '1')); ?>
		
						<?php while ($dean_query->have_posts()) : $dean_query->the_post(); ?>
						    	<h3><?php the_title(); ?></h3>
						    		<?php the_post_thumbnail('full', array('class'=>'floatleft'));
						    		 the_content(); ?>
						<?php $volume = get_the_volume($post); $volume_name = get_the_volume_name($post); endwhile; wp_reset_query() ?>

				</div>
		</article> <!--article -->
	
	
	<?php if ( false === ( $features_query = get_transient( 'features' . $volume . '_query' ) ) ) { 

				$features_query = new WP_Query(array(
						'post_type' => 'page',
						'tax_query' => array ( 
						'relation' => 'AND',
						array (
							'taxonomy' => 'volume',
							'terms' => array( $volume ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'IN'),
						array (
							'taxonomy' => 'volume',
							'terms' => array( 'feature' ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'IN'),	
							),
						'order' => 'ASC',
						'posts_per_page' => '-1')); 
				set_transient( 'features' . $volume . '_query', $features_query, 86400 ); } ?>
				
	<div class="four columns" id="sidebar">
		<div class="row">
			<div class="twelve columns table">
				<a href="#" data-reveal-id="modal_toc" onclick="ga('send', 'event', 'Table of Contents', '<?php echo $volume_name ?>');">	
					<h4>View <?php echo $volume_name; ?> Contents<span class="spacer"></span></h4>
				</a>
			</div>		
			<div class="twelve columns features">
				<h4>Current Feature Stories<span class="spacer"></span></h4>
			</div>
			
			<?php while ($features_query->have_posts()) : $features_query->the_post(); ?>
	    		<div class="twelve columns">
	    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
		    			<h5><?php the_title(); ?></h5>
			    			<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo get_post_meta($post->ID, 'ecpt_tagline', true); else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?>
	    			</a>
	    		</div><!-- End subtext -->
   			<?php endwhile; wp_reset_query() ?>
	</div> 
	
	</div> <!--End content -->
</div> <!--End container-mid -->
<?php get_footer(); ?>
