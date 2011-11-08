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
		<link href="http://fast.fonts.com/cssapi/45b7db8e-5721-4859-baeb-a0cd73eb2a76.css" rel="stylesheet" type="text/css" />
		<!--[if lte IE 8]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/ie.css" />
		<![endif]-->
	<?php if (is_front_page()) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/slider_accordion.css" />
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/spring2011.css" />
	<?php } ?>
		<!--Wordpress Neccessities -->
		<?php wp_enqueue_script('jquery'); ?> 
		<?php wp_head(); ?>
		<!-- JavaScript -->
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

<body class="spring2011">
		<div id="container-head">
			
			<div id="header">
				
				<div id="header-left">
				<div id="logo"><a href="http://krieger.jhu.edu/magazine" title="Johns Hopkins Univeristy Zanvyl Krieger School of Arts & Sciences Magazine"><img src="<?php bloginfo('template_url'); ?>/assets/img/logo.png" alt="Johns Hopkins Univeristy Zanvyl Krieger School of Arts & Sciences Magazine" /></a></div>
				</div> <!-- End header-left -->
			
				<div id="header-right">
									
					<div class="searchbar">
					<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
						<div>
						<input type="text" size="put_a_size_here" name="s" id="s" value="Search this site" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
						<input type="submit" id="searchsubmit" value="Search" class="btn" />
						</div>
					</form>
					</div>
					<div id="nav">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
					</div> <!--End nav -->
				</div><!-- End header-right -->
						<div class="clearboth"></div> <!--to have background work properly -->
			
			
			</div> <!-- End header -->
			
		</div> <!-- End container-head-->
		
		<div id="nav-break"></div>
