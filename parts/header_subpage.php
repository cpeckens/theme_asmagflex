<div class="helpbarcontainer">
<?php global $wp_query;
	foreach(get_the_terms($wp_query->post->ID, 'volume') as $term);
	$volume = $term->slug;
	$issue = $term->name;
	if ($volume == null) { 
	$volume = 'v9n1'; } //change this to current issue
	if ($issue == null) { 
	$issue = 'Arts & Sciences Magazine'; }
 ?>
	<div class="helpbar">
		<div class="helpbarleft">
		<div class="home"><a href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/home.png" alt="Home" /></a></div>
				<div class="dropdown">
					<div class="toc">
						<a href="#" title="Table of Contents">
						<img src="<?php bloginfo('template_url'); ?>/assets/img/toc.png" alt="Table of Contents" style="float:left;" class="tocbutton" /></a>
						<h3><a href="<?php echo get_home_url(); ?>"><span class="highlight"><?php echo $issue;?></span></a> <span class="articlename"><?php wp_title(); ?></span></h3>
					</div>
					<ul class="menu_options">
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
						<li><div class="snippet">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php if ( has_post_thumbnail()) { ?> 
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'homethumb', true);
	    			    						echo $image_url[0];  ?>" align="left" class="homethumb" />
	    			    <?php	} ?>
	    			    <h4><span class="dim">Feature</span></h4>
						<h4><?php the_title(); ?></h4></a>
						</div></li>									
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
						<li><div class="snippet">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php if ( has_post_thumbnail()) { ?> 
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'homethumb', true);
	    			    						echo $image_url[0];  ?>" align="left" class="homethumb" />
	    			    <?php	} ?>
	    			    <h4><span class="dim">
	    			    	<?php if ( in_category( 'exclusive' )) : ?>Web Exclusive<?php endif; ?>
	    			    	<?php if ( in_category( 'editors-note' )) : ?>Editor's Note<?php endif; ?>
	    			    	<?php if ( in_category( 'dean' )) : ?>From the Dean<?php endif; ?>
	    			    	<?php if ( in_category( 'news' )) : ?>News<?php endif; ?>
	    					<?php if ( in_category( 'insights' )) : ?>Insights<?php endif; ?>
	    					<?php if ( in_category( 'alumni' )) : ?>Alumni<?php endif; ?>
						</span></h4>
						<h4><?php the_title(); ?></h4></a>
						</div></li>									
						<?php endwhile; //End loop ?>
					</ul>
					</div><!-- End dropdown -->
			
		 	</div> <!-- End helpbarleft -->
		 	<div class="helpbarright">
			<div class="searchbar">
				<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
				    <div><input type="text" size="put_a_size_here" name="s" id="s" value="" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
				    <input type="submit" id="searchsubmit" value="Search" class="btn">
				    </div>
				</form>
			</div> <!--End searchbar-->

			</div> <!--End helpbarright--> 
			
	</div> <!--End helpbar-->
</div> <!--End helpbarcontainer-->
		<div id="container-head">
			
			<div id="header">
	
				<div id="subheader-left">
				<div id="logosub"><a href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/subpage_logo.png" alt="Johns Hopkins Univeristy Zanvyl Krieger School of Arts & Sciences Magazine" /></a></div>
				</div> <!-- End header-left -->
			
				<div id="subheader-right">									
					<div id="nav">
					<?php wp_nav_menu( array( 'theme_location' => 'subpage-menu' ) ); ?>
					</div> <!--End nav -->
				</div><!-- End header-right -->
<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!-- End header -->
		</div> <!-- End container-head-->
<div id="nav-break"></div>
