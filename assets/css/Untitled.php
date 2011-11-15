<?php
/*
Template Name: Letters to the Editor
*/
?>	
<?php get_template_part( 'header', 'v9n1' ); ?>
	
<!--Pulled the taxonomy template-->
	<div id="container-mid">
	<div id="content">
	    
	    <div id="article">
				<?php $letters_query = new WP_Query(array(
						'post_type' => 'post',
						'cat' => 'v9n1',
						'order' => 'ASC',
						'posts_per_page' => '-1')); ?>
		
						<?php while ($features_query->have_posts()) : $features_query->the_post(); ?>

	<?php if ( get_post_meta($post->ID, 'asmag_css', true) ) : ?><style><?php echo get_post_meta($post->ID, 'asmag_css', true); ?></style><?php endif; ?> <!--Add features custom CSS-->

		<div class="postmaterial">
		<h3><?php the_title(); ?></h3>
		<p class="author">By&nbsp;<?php the_author(); ?></p>
		<p class="othercredits"><?php if ( get_post_meta($post->ID, 'other_credits', true) ) : ?>  <?php echo get_post_meta($post->ID, 'other_credits', true); ?><?php endif; ?></p>

		<?php $image = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
		<div class="topimage"><img src="<?php echo $image; ?>" class="floatleft"></div>
		<?php the_content(); ?>
		
		</div><!--End postmaterial -->
	
	<?php endwhile; ?>

	<?php endif; ?>
	<div class="share">
	<span  class="st_twitter_large"></span>
	<span  class="st_facebook_large"></span>
	<span  class="st_email_large"></span>
	<span  class="st_sharethis_large"></span>
	</div>
	<?php comments_template( '/comments.php' ); ?> 
	</div> <!--article -->
	
	
	<div id="article-right">
	
	<div class="otherstories">
		<h4>Current Feature Stories</h4>
				<?php $features_query = new WP_Query(array(
						'post_type' => 'page',
						'volume' => 'v9n1',
						'order' => 'ASC',
						'posts_per_page' => '-1')); ?>
		
						<?php while ($features_query->have_posts()) : $features_query->the_post(); ?>

	    		<div class="subtext"><h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="blue"><?php the_title(); ?></a></h5>
	    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>	    			    
	    		<?php if ( in_category( 'web-extra' )) : ?><div class="extra"></div><?php endif; ?>
	    				<div class="extranames">
	    				<?php if ( in_category( 'audio' )) : ?>&nbsp;AUDIO<?php endif; ?>
	    				<?php if ( in_category( 'video' )) : ?>&nbsp;VIDEO<?php endif; ?>
	    				<?php if ( in_category( 'slideshow' )) : ?>&nbsp;SLIDESHOW<?php endif; ?>
	    				</div><!-- End extranames -->
	    				
	    				</div><!-- End subtext -->


   			<?php endwhile; ?>
	
	</div> <!--End otherstories -->

	<div class="web-wrapper"><h5><span class="web">WEB EXCLUSIVES</span></h5></div>
	<?php $asmag_exclusives_query = new WP_Query(array(
		'cat' => '31',
		'order' => 'ASC',
		'posts_per_page' => '5')); ?>
		
		<?php while ($asmag_exclusives_query->have_posts()) : $asmag_exclusives_query->the_post(); ?>
			
	    			<div class="subarticle">
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'homethumb', true);
	    			    						echo $image_url[0];  ?>" align="left" class="homethumb" /></a>
	    			    <?php	} ?>
	    			    <div class="subtext"><h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="blue"><?php the_title(); ?></a></h5>
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a></div>
	    			
	    			</div><!--End subarticle -->
	    			
	    				
	    			<?php endwhile; //End loop ?>	    					    		

	    	
 </div> <!--End sidebar-right -->
	    	</div> <!--End content -->
	    		<div class="clearboth"></div> <!--to have background work properly -->
		</div> <!--End container-mid -->


<?php get_footer('v9n1') ?>