<?php
/*
Template Name: Feature - Slides
*/
?>
<?php get_header(); ?>

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
	<script type="text/javascript"> 
		    $(document).ready(function(){
		        var options = {
		            autoPlay: false,
		            nextButton: true,
		            prependNextButton: false,
		            prevButton: true,
		            prependPrevButton: false,
		        var sequence = $("#sequence").sequence(options).data("sequence");
			
		    }
	</script>
	<?php if (is_page('v9n2-cover-story')) { $storyname = 'v9n2cover'; } ?>
	<div id="seqnav">
	<ul>
		<li onclick="sequence.goTo(1)">Part 1</li>
		<li onclick="sequence.goTo(1)">Part 2</li>
		<li onclick="sequence.goTo(1)">Part 3</li>
		<li onclick="sequence.goTo(1)">Part 4</li>
	</ul>
	</div>
	<div id="sequence">
		    <ul>
		        <li>
		            <?php locate_template('parts/' . $storyname . 'part1.php', true, false); ?>
		        </li>
		        <li>
		            <?php locate_template('parts/' . $storyname . 'part2.php', true, false); ?>
		        </li>
		        <li>
		            <?php locate_template('parts/' . $storyname . 'part3.php', true, false); ?>
		        </li>
		    </ul>
		</div>
		<?php 
		locate_template('parts/footer_feature.php', true, false);				
 		get_footer(); ?>