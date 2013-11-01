<?php get_header(); ?>
<div id="container-mid">
	<div class="row" id="content">
	    <article class="eight columns" id="article">
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>
			<?php /* add per post custom CSS */ if ( get_post_meta($post->ID, 'ecpt_asmag_css', true) ) { echo '<style>' . get_post_meta($post->ID, 'ecpt_asmag_css', true) . '</style>'; } ?> 
	
			<div class="postmaterial">
				<h3><?php the_title(); ?></h3>
				<p class="author">By&nbsp;<?php the_author(); ?></p>
				<?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) { echo '<p class="othercredits">' . get_post_meta($post->ID, 'ecpt_other_credits', true) . '</p>'; } ?>
		
				<?php if(has_post_thumbnail()) { echo '<div class="topimage">'; the_post_thumbnail('full', array('class'=>'floatleft')); echo '</div>'; } the_content(); ?>
				<?php //Get data for sidebar
					$categories = get_the_category();
					$thiscat = $categories[0]->cat_ID;
					if ($thiscat == 31) { $thiscat = ''; $catname = '';} else {
					$catname = $categories[0]->name; }
					
					//End and reset query
				$volume = get_the_volume($post); $volume_name = get_the_volume_name($post); endwhile; endif; wp_reset_query();?>
			</div><!--End postmaterial -->
		
		<?php comments_template( '/comments.php' ); ?> 
		</article> 
	
	
<!-- /**************SIDEBAR***********************/	 -->	
	<div class="four columns" id="sidebar">
		<div class="row">
			<div class="twelve columns table">
				<a href="#" data-reveal-id="modal_toc" onclick="ga('send', 'event', 'Table of Contents', '<?php echo $volume_name ?>');">	
					<h4>View <?php echo $volume_name; ?> Contents<span class="spacer"></span></h4>
				</a>
			</div>		
			<?php $sidebar_query = new WP_Query(array(
				'cat' => $thiscat,
				'orderby' => 'rand',
				'posts_per_page' => 3
			));
			?>
		<div class="twelve columns <?php echo $catname; ?>">	 
			<h4>Other <?php echo $catname; ?> articles<span class="spacer"></span></h4>
		</div>
			<?php while ($sidebar_query->have_posts()) : $sidebar_query->the_post();
				$issues = get_the_terms($post->ID, 'volume');
				if($issues && !is_wp_error($issues)) :
				$issue_names = array();
				foreach($issues as $issue) {
					$issue_names[] = $issue->name;
				}
				$issue_name = join(" ", $issue_names); endif; ?>				
	    		<div class="twelve columns">
	    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
		    			<h5><?php the_title(); ?><br>
		    			<span class="<?php echo $catname; ?>"><?php echo $issue_name; ?></h5>
			    			<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo get_post_meta($post->ID, 'ecpt_tagline', true); else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?>
	    			</a>
	    		</div><!-- End subtext -->
   			<?php endwhile; wp_reset_query() ?>
	</div> 

	<div class="row">
		<div class="twelve columns">
			<h4>Web Exclusives<span class="spacer"></span></h4>
		</div>
	<?php if ( false === ( $asmag_exclusives_query = get_transient( 'web_exclusives_query' ) ) ) {
			$asmag_exclusives_query = new WP_Query(array(
				'cat' => '31',
				'order' => 'ASC',
				'posts_per_page' => '5'));
		set_transient( 'web_exclusives_query', $asmag_exclusives_query, 86400 ); }	 
		while ($asmag_exclusives_query->have_posts()) : $asmag_exclusives_query->the_post(); ?>
	    			<div class="twelve columns">
	    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    <?php if ( has_post_thumbnail()) { the_post_thumbnail('homethumb', array('class'=>'floatleft')); }?> 
	    			<h5><?php the_title(); ?></h5>
			    		<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo get_post_meta($post->ID, 'ecpt_tagline', true); else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?></a>
	    			</div>
	    			<?php endwhile; wp_reset_query(); ?>	    					    		
 </div> <!--End sidebar-right -->
	    	</div> <!--End content -->
		</div> <!--End container-mid -->

<?php get_footer(); ?>
