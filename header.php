<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title><?php if ( is_front_page() ) { ?><? bloginfo('name'); ?> - <?php bloginfo('description'); } else { wp_title(''); } ?></title>

		<!-- Meta tags -->
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<?php $volume = get_the_volume($post); ?>
		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/foundation.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/magazine.css">
		<script async type="text/javascript" src="http://fast.fonts.net/jsapi/1db25190-910a-4ab7-bd9b-5582bf1b2833.js"></script>
		
		<?php if (is_page('on-display')) { ?>
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/stylesheets/features/on-display.css">
		<?php } ?>
		
		<?php if (is_page_template( 'lifespan-adult.php' ) || is_page_template( 'lifespan-baby.php' ) || is_page_template( 'lifespan-elder.php' ) || is_page_template( 'lifespan-expert.php' ) || is_page_template( 'lifespan-home.php' ) || is_page_template( 'lifespan-teen.php' ) ){ ?><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/stylesheets/features/learning-along-the-lifespan.css"> <?php } ?>
		
		<?php if(is_page() && is_page_template('template-tableofcontents.php') == false) { ?>
			<script async type="text/javascript" src="http://fast.fonts.net/jsapi/a5273dfb-2de2-4945-99ec-e9d381669740.js"></script>		
		<?php } ?>
		
		<?php wp_enqueue_script('jquery'); ?>
		<script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/modernizr.foundation.js"></script>
		<?php wp_head(); ?>
		
  <!-- Make IE a modern browser -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/lte-ie7.js"></script>
  <![endif]-->
	</head>

<body <?php body_class($volume); ?>>

	<header>
		<?php if (is_page_template('template-tableofcontents.php')) {locate_template('/parts/header_homepage.php', true, false);} 
		else { locate_template('/parts/header_subpage.php', true, false); } ?>
	</header>

