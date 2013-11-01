<?php
/*
Template Name: Issue Table of Contents
*/
?>
	
<?php get_header(); ?>
			
<div id="container-mid">
	<div id="homepage" class="row">
		<section class="row" id="fields_container" role="main">
			<?php 
			$volume = get_the_volume($post);
			$parent = get_queried_object_id();
			$asmag_issue_query = new WP_Query(array(
				'post_type' => 'post',
				'volume' => $volume,
				'category__not_in' => array(55, 30),
				'orderby' => 'rand',
				'posts_per_page' => '-1'));
				
			$asmag_feature_query = new WP_Query(array(
				'post_type' => 'page',
				'volume' => $volume,
				'post_parent' => $parent,
				'posts_per_page' => '-1'));			

			while ($asmag_feature_query->have_posts()) : $asmag_feature_query->the_post(); ?>
				<!-- Set classes for isotype.js filter buttons -->
				<div class="three columns mobile-field features box">
				
					<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field">
						<?php the_post_thumbnail('filterthumb', array('class'=>'no-margin')); ?>						
					<article id="features" class="twelve columns field">
							<div class="row">
								<div class="twelve columns caption-box">
									<h3><?php the_title(); ?></h3>
									<span class="caption">
										<p><?php echo get_the_excerpt(); ?></p>
									</span>
								</div>
								<span class="hide"><?php $posttags = get_the_tags(); if ($posttags) {foreach($posttags as $tag) {echo $tag->name . ' '; }} ?></span>
							</div>
					</article>
					</a>
				</div>
			<?php endwhile; wp_reset_postdata(); 
				
			while ($asmag_issue_query->have_posts()) : $asmag_issue_query->the_post(); 
				$categories = get_the_terms( $post->ID, 'category' );
				if ( $categories && ! is_wp_error( $categories ) ) : 
				$category_names = array();
							foreach ( $categories as $category ) {
								if ($category->parent == 0) {
								$category_names[] = $category->slug;
								} else {
									$multimedia[] = $category->slug;
								}
							}
						$category_name = join( " ", $category_names );
					endif;
			?>
				
				<!-- Set classes for isotype.js filter buttons -->
				<div class="three columns mobile-field box <?php echo $category_name; ?>">
				
					<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field">
					<?php the_post_thumbnail('filterthumb', array('class'=>'no-margin')); ?>
						<article class="twelve columns field" id="<?php echo $category_name; ?>">
							<div class="row">
								<div class="twelve columns caption-box">
									<h3><?php if(is_array($multimedia)) { foreach( $multimedia as $icon) { echo '<span class="icon-' . $icon . '"></span>'; unset($multimedia);}} ?>&nbsp;<?php the_title(); ?></h3>
									<p><?php echo get_the_excerpt(); ?></p>
								</div>
								<span class="hide"><?php $posttags = get_the_tags(); if ($posttags) {foreach($posttags as $tag) {echo $tag->name . ' '; }} ?></span>
							</div>
						</article>
					</a>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
			
			<div class="row" id="noresults">
				<div class="four columns centered">
					<h3> No matching entries</h3>
				</div>
			</div>
		</section>
	</div> <!--End homepage -->
</div> <!--End container-mid -->

<?php get_footer(); ?>