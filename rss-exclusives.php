<?php
/*
Template Name: krieger.jhu.edu Feed
*/
 
$numposts = 3;
 
function yoast_rss_date( $timestamp = null ) {
  $timestamp = ($timestamp==null) ? time() : $timestamp;
  echo date(DATE_RSS, $timestamp);
}
 
function yoast_rss_text_limit($string, $length, $replacer = '...') { 
  $string = strip_tags($string);
  if(strlen($string) > $length) 
    return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;   
  return $string; 
}
 
$posts = query_posts(array ( 'category_name' => 'exclusive', 'showposts' => $numposts));
 
$lastpost = $numposts - 1;
 
header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0"?>';
?><rss version="2.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:media="http://search.yahoo.com/mrss/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	<?php do_action('rss2_ns'); ?>
>

<channel>
	<title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss("description") ?></description>
	<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<language><?php echo get_option('rss_language'); ?></language>
	<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
	<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
	<?php do_action('rss2_head'); ?>
	<?php while( have_posts()) : the_post(); ?>
	
    
    
    <item>
		<pubDate>
			<?php echo mysql2date('F j, Y', get_post_time('Y-m-d H:i:s', true), false); ?>
        </pubDate> 
		<title><?php the_title_rss(); ?></title>
		<link><?php the_permalink_rss(); ?></link>
		<?php $image_id = get_post_thumbnail_id();
		             $image_url = wp_get_attachment_image_src($image_id,'medium', true);
		             ?>
        <media:content url="<?php echo $image_url[0];  ?>" />        
		<description>
	        <?php the_excerpt(); ?>
        </description>

<?php rss_enclosure(); ?>
	<?php do_action('rss2_item'); ?>
	</item>
	
	
	<?php endwhile; ?>
</channel>
</rss>
