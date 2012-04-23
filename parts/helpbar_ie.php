<?php global $wp_query;
	foreach(get_the_terms($wp_query->post->ID, 'volume') as $term);
	$volume = $term->slug;
	$issue = $term->name;
	if ($volume == null) { 
	$volume = 'v9n1'; } //change this to current issue
	if ($issue == null) { 
	$issue = 'Arts & Sciences Magazine'; }
 ?>		
 <div class="helpbarleft">
		<div class="home"><a href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/home.png" alt="Home" /></a></div>

						<form name="jump" class="tocdrop">
						<select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
						<option><?php echo $issue;?></option>
				<?php 
					 
					
					if ( false === ( $features_query = get_transient( 'features' . $volume . '_query' ) ) ) { 
        			// It wasn't there, so regenerate the data and save the transient

				$features_query = new WP_Query(array(
						'post_type' => 'page',
						'tax_query' => array ( 
						'relation' => 'AND',array (
							'taxonomy' => 'volume',
							'terms' => array( $volume, 'feature' ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'AND')),
						'order' => 'ASC',
						'posts_per_page' => '-1')); 
				set_transient( 'features' . $volume . '_query', $features_query, 86400 ); }
				
				 while ($features_query->have_posts()) : $features_query->the_post(); ?>
						<option value="<?php the_permalink() ?>"><?php the_title(); ?></option>					
						<?php endwhile; //End loop ?>

						<?php 
						if ( false === ( $toc_dropdown_query = get_transient( 'toc_dropdown' . $volume . '_query' ) ) ) { 
        				// It wasn't there, so regenerate the data and save the transient

						$toc_dropdown_query = new WP_Query(array(
							'post_type' => 'post',
							'volume' => $volume,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'posts_per_page' => '-1')); 
				set_transient( 'toc_dropdown' . $volume . '_query', $toc_dropdown_query, 86400 ); }
	
				 while ($toc_dropdown_query->have_posts()) : $toc_dropdown_query->the_post(); ?>
						<option value="<?php the_permalink() ?>"><?php the_title(); ?> : 
						<span class="dim">
	    			    	<?php if ( in_category( 'exclusive' )) : ?>Web Exclusive<?php endif; ?>
	    			    	<?php if ( in_category( 'editors-note' )) : ?>Editor's Note<?php endif; ?>
	    			    	<?php if ( in_category( 'dean' )) : ?>From the Dean<?php endif; ?>
	    			    	<?php if ( in_category( 'news' )) : ?>News<?php endif; ?>
	    					<?php if ( in_category( 'insights' )) : ?>Insights<?php endif; ?>
	    					<?php if ( in_category( 'alumni' )) : ?>Alumni<?php endif; ?></span>
	    				</option>	
						<?php endwhile; //End loop ?>
					</select>
					</form>
					<h3><span class="articlename"><?php wp_title(); ?></span></h3>
						 	</div> <!-- End helpbarleft -->