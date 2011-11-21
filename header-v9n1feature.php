<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title><?php if ( is_front_page() ) { ?><? bloginfo('name'); ?> - <?php bloginfo('description'); } else { wp_title(''); } ?></title>

		<!-- Meta tags -->
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Don't forget to update the bookmark icons (favicon.ico and apple-touch-icons) in the root: http://mathiasbynens.be/notes/touch-icons -->

		<!-- CSS -->
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" />
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/fall2011.css" />
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/v8n2feature.css" />		
		<link href="http://fast.fonts.com/cssapi/45b7db8e-5721-4859-baeb-a0cd73eb2a76.css" rel="stylesheet" type="text/css" />
		<?php if (is_front_page() || is_page_template( 'front-v9n1.php' ) ){ ?><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/slider_accordion.css" /><?php } ?>
		<!--[if lt IE 9]>		
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/ie.css" />
		<![endif]-->
		<!--Wordpress Neccessities -->
		<?php wp_enqueue_script('jquery'); ?> 
		<?php wp_head(); ?>
		<!-- JavaScript -->
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

<body>
<!--Pulled the subheader template file-->
<body style="background: url('<?php echo get_post_meta($post->ID, 'feature_background', true); ?>') top left repeat;">
<div class="helpbarcontainer">
	<div class="helpbar">
		<div class="helpbarleft">
		<div class="home"><a href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/home.png" alt="Home" /></a></div>
				<div class="dropdown">
					<div class="toc">
						<a href="#" title="Table of Contents">
						<img src="<?php bloginfo('template_url'); ?>/assets/img/toc.png" alt="Table of Contents" style="float:left;" class="tocbutton" /></a>
						<h3><a href="<?php echo get_home_url(); ?>"><span class="highlight">Fall 2011</span></a> <span class="articlename"><?php wp_title(); ?></span></h3>
					</div>
					<ul class="menu_options">
				<?php $features_query = new WP_Query(array(
						'post_type' => 'page',
						'volume' => 'v9n1',
						'order' => 'ASC',
						'posts_per_page' => '-1')); ?>
		
						<?php while ($features_query->have_posts()) : $features_query->the_post(); ?>
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

						<?php $asmag_v8n2_query = new WP_Query(array(
							'post_type' => 'post',
							'volume' => 'v9n1',
							'order' => 'ASC',
							'posts_per_page' => '-1')); ?>
		
						<?php while ($asmag_v8n2_query->have_posts()) : $asmag_v8n2_query->the_post(); ?>
						<li><div class="snippet">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php if ( has_post_thumbnail()) { ?> 
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'homethumb', true);
	    			    						echo $image_url[0];  ?>" align="left" class="homethumb" />
	    			    <?php	} ?>
	    			    <h4><span class="dim">
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
					<?php wp_nav_menu( array( 'theme_location' => 'v8n2-menu' ) ); ?>
					</div> <!--End nav -->
				</div><!-- End header-right -->
						<div class="clearboth"></div> <!--to have background work properly -->
			
			
			</div> <!-- End header -->
			
		</div> <!-- End container-head-->
		
		<div id="nav-break"></div>
