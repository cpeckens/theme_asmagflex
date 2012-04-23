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
		<?php 
			global $wp_query;
			foreach(get_the_terms($wp_query->post->ID, 'volume') as $term);
			$volume = $term->slug;
			$asmag_option = asmag_get_global_options();
			if ($volume == null) { 
			$volume = $asmag_option['asmag_current_issue']; } 
		?>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/min/?f=wp-content/themes/asmagflex/assets/css/main.css,wp-content/themes/asmagflex/assets/css/classes.css,wp-content/themes/asmagflex/assets/css/media.css,wp-content/themes/asmagflex/assets/css/<?php echo $volume; ?>.css<?php if (is_front_page() || is_page_template( 'template-tableofcontents.php' ) ){ ?>,wp-content/themes/asmagflex/assets/css/slider_accordion.css<?php } ?><?php if ( is_page_template( 'feature-complex.php' ) || is_page_template( 'feature-fancytitle.php' ) || is_page_template( 'feature-generic.php' ) || is_page_template( 'feature-slides.php' ) ){ ?>,wp-content/themes/asmagflex/assets/css/<?php echo $volume; ?>fonts.css<?php } ?>" />
		<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false) { ?><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/firefox.css" /> <?php }?>
		<?php wp_enqueue_script('jquery'); ?>
		<?php if (is_page_template('feature-slides.php')) { ?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/sequence.js"></script> <?php } ?>
		<?php wp_head(); ?>
		<!-- IE Stipulations -->
		<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/ie.css" />
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

<!--Set the appropropriate body class based on volume and page template-->
<?php if (get_post_meta($post->ID, 'ecpt_feature_background', true)) : ?>
<body style="background: url('<?php echo get_post_meta($post->ID, 'ecpt_feature_background', true); ?>') top left repeat;">
<?php else : ?>
<body class="<?php if (is_page_template( 'template-tableofcontents.php' )) { echo $volume; } 
					else echo $volume . 'sub'; endif; ?>">

<!--Do not display helpbar on table of content pages-->
<?php if (is_page_template( 'template-tableofcontents.php' )) : 
locate_template('parts/header_toc.php', true, false);
else : locate_template('parts/header_subpage.php', true, false);
?>

<?php endif; // End if tableofcontents page conditional ?>