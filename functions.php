<?php

//add menu support
	add_theme_support( 'menus' );

//register menus
	function asmag_register_my_menus() {
  		register_nav_menus(
    		array( 'header-menu' => __( 'Homepage Menu' ),'subpage-menu' => __( 'Subpage Menu' ))
  		);
	}
	
// initiate register menus
	add_action( 'init', 'asmag_register_my_menus' );

//register thumbnail/featured image support
	add_theme_support( 'post-thumbnails' );

// name of the thumbnail, width, height, crop mode
	add_image_size( 'exclusive', 220, 110, true );
	add_image_size( 'homethumb', 60, 70, true );
	add_image_size( 'alumni', 150, 130, true );

//pagination function
	function asmag_pagination($prev = 'Ç', $next = 'È') {
    	global $wp_query, $wp_rewrite;
    	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    	$pagination = array(
    	    'base' => @add_query_arg('paged','%#%'),
    	    'format' => '',
    	    'total' => $wp_query->max_num_pages,
    	    'current' => $current,
    	    'prev_text' => __($prev),
    	    'next_text' => __($next),
    	    'type' => 'plain'
		);		
    	if( $wp_rewrite->using_permalinks() )
    	    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
		
    	if( !empty($wp_query->query_vars['s']) )
    	    $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
		
    	echo paginate_links( $pagination );
	};		

//register sidebars
	if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name'          => 'Homepage Sidebar',
			'id'            => 'homepage-sb',
			'description'   => '',
			'before_widget' => '<div id="homepage-widget" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' 
			));	

// remove junk from head
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// remove version info from head and feeds
function complete_version_removal() {
    return '';
}

add_filter('the_generator', 'complete_version_removal');

//Add Theme Options Page
	if(is_admin()){	
		require_once('assets/functions/asmag-theme-settings-basic.php');
	}
	
	//Collect current theme option values
		function asmag_get_global_options(){
			$asmag_option = array();
			$asmag_option 	= get_option('asmag_options');
		return $asmag_option;
		}
	
	//Function to call theme options in theme files 
		$asmag_option = asmag_get_global_options();
		
//Change Excerpt Length -- Add to functions.php
function asmag_new_excerpt_length($length) {
	return 10; //Change word count
}
add_filter('excerpt_length', 'asmag_new_excerpt_length');

//Add iframe shortcode
if ( !function_exists( 'iframe_embed_shortcode' ) ) {
	function iframe_embed_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'width' => '100%',
			'height' => '480',
			'src' => '',
			'frameborder' => '0',
			'scrolling' => 'no',
			'marginheight' => '0',
			'marginwidth' => '0',
			'allowtransparency' => 'true',
			'id' => '',
			'same_height_as' => ''
		), $atts));
		$src_cut = substr($src, 0, 35);
		if(strpos($src_cut, 'maps.google' )){
			$google_map_fix = '&output=embed';
		}else{
			$google_map_fix = '';
		}
		$return = '';
		if( $id != '' ){
			$id_text = 'id="'.$id.'" ';
		}else{
			$id_text = '';
		}
		$return .= '<div class="video-container"><iframe '.$id_text.' width="'.$width.'" height="'.$height.'" src="'.$src.$google_map_fix.'?wmode=transparent" frameborder="'.$frameborder.'" scrolling="'.$scrolling.'" marginheight="'.$marginheight.'" marginwidth="'.$marginwidth.'" allowtransparency="'.$allowtransparency.'" webkitAllowFullScreen allowFullScreen  wmode="transparent"></iframe></div>';
		// &amp;output=embed
		return $return;
	}
	add_shortcode('iframe', 'iframe_embed_shortcode');
}

//Add Volume/Issue Taxonomy
function create_my_taxonomies() {
	register_taxonomy('volume', array( 'post', 'page', 'accordion' ), array( 'hierarchical' => true, 'label' => 'Volume/Issue', 'query_var' => true, 'rewrite' => true));
} 

add_action('init', 'create_my_taxonomies', 0);

//Conditional for Taxonomy
	function asmag_in_taxonomy($tax, $term, $_post = NULL) {
		// if neither tax nor term are specified, return false
		if ( !$tax || !$term ) { return FALSE; }
		// if post parameter is given, get it, otherwise use $GLOBALS to get post
		if ( $_post ) {
		$_post = get_post( $_post );
		} else {
		$_post =& $GLOBALS['post'];
		}
		// if no post return false
		if ( !$_post ) { return FALSE; }
		// check whether post matches term belongin to tax
		$return = is_object_in_term( $_post->ID, $tax, $term );
		// if error returned, then return false
		if ( is_wp_error( $return ) ) { return FALSE; }
	return $return;
	}

//Custom comment display
function asmag_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<div <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author">
				<?php printf(__('%1$s'), get_comment_date()) ?><?php printf(__(' by <cite class="fn">%s</cite>'), get_comment_author_link()) ?>
			</div>

			<?php comment_text() ?>

			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
<?php
}

include_once (TEMPLATEPATH . '/assets/functions/asmag-metabox.php');
include_once (TEMPLATEPATH . '/assets/functions/asmag-accordion.php');
?>