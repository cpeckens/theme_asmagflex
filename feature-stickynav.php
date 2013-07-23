<?php
/*
Template Name: Feature - Sticky Nav
*/
?>
<?php get_header(); ?>
<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery-scrollspy.js"></script>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
	<style>
	#feature-head {
		background-image: url(<?php echo get_post_meta($post->ID, 'ecpt_header_background', true); ?>);
		}
	<?php echo get_post_meta($post->ID, 'ecpt_asmag_css', true); ?></style> <!--Add features custom CSS-->
	<?php if ( get_post_meta($post->ID, 'javascript', true) ) : ?><?php echo get_post_meta($post->ID, 'javascript', true); ?><?php endif; ?>
	<div id="feature-head">
		<div class="intro-container">
		<div class="feature-intro">
		<?php if(has_post_thumbnail()): ?>
		<div class="nonbackground"><?php $image = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
		<img src="<?php echo $image; ?>"></div> <?php endif; ?>
			<div class="textblock">
				<?php if ( get_post_meta($post->ID, 'fancy_title', true) ) : ?><div class="fancytitle"><?php echo get_post_meta($post->ID, 'fancy_title', true); ?></div><?php endif; ?>
				<h3 class="featuretitle"><?php the_title(); ?></h3>
				<h4 class="tagline"><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?><?php endif; ?></h4>
				<p class="credit">By&nbsp;<?php the_author(); ?></p>
				<p class="othercredits"><?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_other_credits', true); ?><?php endif; ?></p>
			</div>
			<div class="introcopy">	
				<div class="pullquote"><?php if ( get_post_meta($post->ID, 'ecpt_pull_quote', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?><?php endif; ?></div>
			</div><!--End intro copy-->

		</div><!--end feature-intro-->
			<?php if ( get_post_meta($post->ID, 'stickynav', true) ) : ?><?php echo get_post_meta($post->ID, 'stickynav', true); ?><?php endif; ?>
		</div><!--end intro-containter-->
	</div><!--end feature-head-->

	<div class="headerbreak"></div>
	<div id="container-mid">

	<div id="feature">
	    
		<div class="postmaterial">
		
		<?php the_content(); ?>
		
		</div><!--End postmaterial -->
	
	<?php endwhile; ?> <?php endif; ?>



        	<script type="text/javascript">
	        jQuery(document).ready(function($) {
        			$('#sticky').scrollspy({
        				min: 1250,
        				max: 30000,
        				onEnter: function(element, position) {
    						$("#sticky").addClass('fixed');
    					},
    					onLeave: function(element, position) {
    						$("#sticky").removeClass('fixed');
    					}
        			});
        		});
        		
	        jQuery(document).ready(function($) {
        			$('#stickygallery').scrollspy({
        				min: 2200,
        				max: 11000,
        				onEnter: function(element, position) {
    						$("#stickygallery").addClass('fixedgallery');
    					},
    					onLeave: function(element, position) {
    						$("#stickygallery").removeClass('fixedgallery');
    					}
        			});
        		});        	
        	</script>

	
<?php locate_template('parts/footer_feature.php', true, false);				
 get_footer(); ?>