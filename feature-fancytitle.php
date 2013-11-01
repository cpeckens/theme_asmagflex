<?php
/*
Template Name: Feature - Fancy Title
*/
?>
<?php get_header(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		$page = get_queried_object();
		$page_name = $page->post_name; 
		 ?>
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/stylesheets/features/<?php echo $page_name; ?>.css">
				<div class="titlesection">
				<?php if ( get_post_meta($post->ID, 'fancy_title', true) ) : ?><div class="fancytitle"><?php echo get_post_meta($post->ID, 'fancy_title', true); ?></div><?php endif; ?>
				<h4 class="tagline"><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?><?php endif; ?></h4>
				<p class="othercredits"><?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_other_credits', true); ?><?php endif; ?></p>
			</div>

	<div id="feature-head">
		<div class="intro-container row">
		<div class="feature-intro">
			<div class="introcopy">	
				<div class="pullquote"><?php if ( get_post_meta($post->ID, 'ecpt_pull_quote', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?><?php endif; ?></div>
			</div><!--End intro copy-->
		</div><!--end feature-intro-->
		</div><!--end intro-containter-->
	</div><!--end feature-head-->
	<div class="headerbreak"></div>
	<div id="container-mid">
	<div id="feature" class="row">
	    
		<div class="postmaterial twelve columns">
		
		<?php the_content(); ?>
		
		</div><!--End postmaterial -->
			<?php if (is_page('the-great-wall-of-waverly')) { ?>
		<script>
		var $z = jQuery.noConflict();
		$z(document).ready(function(){
  		$z('#image1').epicZoom({ magnification: 1});
		});
		</script>
		<?php } ?>		<?php endwhile; endif; wp_reset_query();?>

				
<?php locate_template('parts/footer_feature.php', true, false);				
 get_footer(); ?>