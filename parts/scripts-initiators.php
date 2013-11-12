<?php 
	wp_reset_query();
	$volume = get_the_volume($post);
	if ( false === ( $features_query = get_transient( 'features_' . $volume . '_query' ) ) ) { 
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
	set_transient( 'features_' . $volume . '_query', $features_query, 86400 ); } 
	
	if ( false === ( $toc_dropdown_query = get_transient( 'toc_dropdown_' . $volume . '_query' ) ) ) { 
	    	// It wasn't there, so regenerate the data and save the transient

	    	$toc_dropdown_query = new WP_Query(array(
	    		'post_type' => 'post',
	    		'volume' => $volume,
	    		'category__not_in' => array( 28, 31 ),
	    		'orderby' => 'menu_order',
	    		'order' => 'ASC',
	    		'posts_per_page' => '-1')); 
	set_transient( 'toc_dropdown_' . $volume . '_query', $toc_dropdown_query, 86400 ); }	
	
	if ( false === ( $alumni_query = get_transient( 'alumni' . $volume . '_query' ) ) ) { 
	    	// It wasn't there, so regenerate the data and save the transient

	    	$alumni_query = new WP_Query(array(
	    		'post_type' => 'post',
	    		'volume' => $volume,
	    		'category__in' => array( 28 ),
	    		'orderby' => 'menu_order',
	    		'order' => 'ASC',
	    		'posts_per_page' => '-1')); 
	set_transient( 'alumni_' . $volume . '_query', $alumni_query, 86400 ); }	

	if ( false === ( $exclusive_query = get_transient( 'exclusive_' . $volume . '_query' ) ) ) { 
	    	// It wasn't there, so regenerate the data and save the transient

	    	$exclusive_query = new WP_Query(array(
	    		'post_type' => 'post',
	    		'volume' => $volume,
	    		'category__in' => array( 31 ),
	    		'orderby' => 'menu_order',
	    		'order' => 'ASC',
	    		'posts_per_page' => '-1')); 
	set_transient( 'exclusive_' . $volume . '_query', $exclusive_query, 86400 ); }	

?>

<div id="modal_toc" class="reveal-modal large">
		<div class="row">
		<div class="eight columns push-four">
		<h2 class="toc_header features">Features</h2>
		<div class="row">
		<?php while ($features_query->have_posts()) : $features_query->the_post(); ?>
		
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<article class="six columns vertical">
						<?php if ( has_post_thumbnail()) { the_post_thumbnail('filterthumb'); } ?> 
						<h4 class="feature"><?php the_title(); ?></h4>
				</article>
			</a>
		<?php endwhile; ?>
		</div>
		<h2 class="toc_header alumni">Alumni</h2>
			<div class="row">
		<?php while ($alumni_query->have_posts()) : $alumni_query->the_post(); ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<article class="six columns horizontal">
						<?php if ( has_post_thumbnail()) { the_post_thumbnail('homethumb', array('class' => 'floatleft')); } ?> 
						<h4 class="alumni"><?php the_title(); ?></h4>
				</article>
			</a>
		<?php endwhile; ?>			</div>
		</div>
			<div class="four columns pull-eight">
				<h2 class="toc_header departments">Departments</h2>
				<ul>
		<?php while ($toc_dropdown_query->have_posts()) : $toc_dropdown_query->the_post(); ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<li><?php 
	    				the_title(); 
	    				$posttags = get_the_tags();
	    				if ($posttags) {
						  foreach($posttags as $tag) {
	    				    echo '<br><span class="uppercase dim">' . $tag->name . '</span>'; 
	    				  }
	    				} ?>
				</li>
			</a>
		<?php endwhile; ?>
				</ul>
			</div>
		
		</div>
		<?php if($exclusive_query->have_posts()) : ?>
		<h2 class="toc_header exclusive">Web Exclusives</h2>
		<div class="row">
		<?php while ($exclusive_query->have_posts()) : $exclusive_query->the_post(); ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<article class="four columns horizontal">
						<?php if ( has_post_thumbnail()) { the_post_thumbnail('homethumb', array('class' => 'floatleft')); } ?> 
						<h4 class="alumni"><?php the_title(); ?></h4>
				</article>
			</a>
		<?php endwhile; ?>		
		</div>
		<?php endif; ?>
	<a class="close-reveal-modal">&#215;</a>
</div>	


		<!-- JavaScript -->
		<script async src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/asmag_custom.js"></script>
		
		<?php if (is_front_page() || is_page_template( 'template-tableofcontents.php' ) ){ ?>
			<script async src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/asmag_front.js"></script>
		<?php } ?>
		
		<?php if (is_page() && !is_front_page()) { ?>
			<script async src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/asmag_feature.js"></script>
		<?php } ?>
		<!--[if lt IE 9]>
		<script>
			var head = document.getElementsByTagName('head')[0],
			style = document.createElement('style');
			style.type = 'text/css';
			style.styleSheet.cssText = ':before,:after{content:none !important';
			head.appendChild(style);
			setTimeout(function(){
				head.removeChild(style);
			}, 0);
			</script>
		<![endif]-->
<?php if (is_page_template( 'lifespan-adult.php' ) || is_page_template( 'lifespan-baby.php' ) || is_page_template( 'lifespan-elder.php' ) || is_page_template( 'lifespan-expert.php' ) || is_page_template( 'lifespan-home.php' ) || is_page_template( 'lifespan-teen.php' ) ){ ?>		
<script>
 jQuery(document).ready(function($) {
	$('#menu-lifespan li.trigger:not(.active)').click(function () {
          $(this).addClass('active');
        });
	$('#menu-lifespan li.active').click(function () {
          $(this).removeClass('active');
        }); });          
        </script>	
<?php } ?>
