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
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" />
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/<?php echo $volume; ?>.css" />
		<link href="http://fast.fonts.com/cssapi/45b7db8e-5721-4859-baeb-a0cd73eb2a76.css" rel="stylesheet" type="text/css" />
		<?php if (is_front_page() || is_page_template( 'template-tableofcontents.php' ) ){ ?><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/slider_accordion.css" /><?php } ?>
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