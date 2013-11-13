<?php
/*
Template Name: Search Results
*/
?>
<?php
require_once TEMPLATEPATH . "/assets/functions/GoogleSearch.php";
get_header(); ?>
<div id="container-mid">
	<div class="row" id="content">
	    <article class="eight columns" id="article">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
				<div class="postmaterial">
					<h3>Search Results</h3>
<?php 
try {
    $search = new KSAS_GoogleSearch();
    $resultsPageNum = 1;
    if (array_key_exists('resultsPageNum', $_REQUEST)) {
        $resultsPageNum = $_REQUEST['resultsPageNum'];
    }
    $resultsPerPage = 10;
    $baseQueryURL = 'http://search.johnshopkins.edu/search?site=krieger_collection&client=ksas_frontend';
    $results = $search->query($_REQUEST['q'], $baseQueryURL, $resultsPageNum, $resultsPerPage);
     
    $hits = $results->getNumHits();
    $displayQuery = $results->getDisplayQuery();
    $docTitle = 'Search Results';
    $sponsored_result = $results->getSponsoredResult();
    ?>

    <?php
    if ($hits > 0) {
        ?>
       <form class="search-form" action="<?php echo site_url('/search'); ?>" method="get">
                    <fieldset>
                        <input type="text" class="input-text" name="q" value="<?php echo $displayQuery ?>" />
                        <input type="submit" class="button blue_bg" value="Search Again" />
                    </fieldset>
       </form>        
       <h6>Results <span class="black"><?php echo $results->getFirstResultNum() ?> - <?php echo $results->getLastResultNum() ?></span> of about <span class="black"><?php echo $hits ?></span></h6>
           
        <?php if (empty($sponsored_result) == false) { ?>
	        <div class="panel callout radius10" id="sponsored">
	        	<h6 class="black">Sponsored Result</h6>
	        	<a href="<?php echo $sponsored_result['sponsored_url']; ?>"><h3><?php echo $sponsored_result['sponsored_title']; ?><small class="italic">-- <?php echo $sponsored_result['sponsored_url']; ?></small></h3></a>
	        </div>
         <?php } ?>   
            <div id="search-results">
                <ul>
           
        <?php
        while ($result = $results->getNextResult()) {
            // note what results are PDFs
            $pdfNote = '';
            if (preg_match('{application/pdf}', $result['mimeType'])) {
                $pdfNote = '<span class="black">[PDF]</span> ';
            }
            ?>
                    <li>
                        <h5><?php echo $pdfNote ?><a href="<?php echo $result['path'] ?>"><?php echo $result['title'] ?></a></h5>
            <?php
            if (array_key_exists('description', $result) && $result['description']) {
                ?>
                        <p><?php echo $result['description'] ?></p>
                <?php
            }
            ?>
                        <div class="url"><?php echo $result['path'] ?> - <?php echo $result['sizeHumanReadable'] ?></div>
                    </li>
                    <hr>
            <?php
        }
        ?>
                </ul>
            </div>
             
            <div class="section">
        <?php
            $notices = $results->getNotices();
            foreach ($notices as $notice) {
                ?>
                <p class="notice"><?php echo $notice ?></p>
                <?php
            }
        ?>
                <div class="pagination">
                     
        <?php
        foreach ($results->getResultsetLinks() as $resultsetLink) {
            print "$resultsetLink ";
        }
        ?>
                    <?php echo $results->getNextLink() ?> 
                </div>
                 
            </div>
        <?php
    } else {
        // no hits
        ?>
            
             
        <?php
            $notices = $results->getNotices();
            foreach ($notices as $notice) {
                ?>
            <p class="notice"><?php echo $notice ?></p>
                <?php
            }
        ?>
             
            <p style="font-weight: bold;">There are no pages matching your search.</p>
                   <form class="search-form" action="<?php echo site_url('/search'); ?>" method="get">
                    <fieldset>
                        <input type="text" class="input-text" name="q" value="<?php echo $displayQuery ?>" />
                        <input type="submit" class="button blue_bg" value="Search Again" />
                    </fieldset>
       </form>        

        <?php
    }
} catch (KSAS_GoogleSearchException $e) {
    $docTitle = "Search Temporarily Unavailable";
    ?>
    <div class="section">
        <p>We're sorry, the search engine is temporarily unavailable. Please try your search again later.</p>
    </div>
    <?php
} ?>				</div><!--End postmaterial -->
			<?php $volume = get_the_volume($post); $volume_name = get_the_volume_name($post); endwhile; endif; wp_reset_query();?>
		</article> <!--article -->
	
	<?php if ( false === ( $features_query = get_transient( 'features' . $volume . '_query' ) ) ) { 

				$features_query = new WP_Query(array(
						'post_type' => 'page',
						'tax_query' => array ( 
						'relation' => 'AND',
						array (
							'taxonomy' => 'volume',
							'terms' => array( $volume ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'IN'),
						array (
							'taxonomy' => 'volume',
							'terms' => array( 'feature' ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'IN'),	
							),
						'order' => 'ASC',
						'posts_per_page' => '-1')); 
				set_transient( 'features' . $volume . '_query', $features_query, 86400 ); } ?>
				
	<div class="four columns" id="sidebar">
		<div class="row">
			<div class="twelve columns table">
				<a href="#" data-reveal-id="modal_toc" onclick="ga('send', 'event', 'Table of Contents', '<?php echo $volume_name ?>');">	
					<h4>View <?php echo $volume_name; ?> Contents<span class="spacer"></span></h4>
				</a>
			</div>		
			<div class="twelve columns features">
				<h4>Current Feature Stories<span class="spacer"></span></h4>
			</div>
			
			<?php while ($features_query->have_posts()) : $features_query->the_post(); ?>
	    		<div class="twelve columns">
	    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
		    			<h5><?php the_title(); ?><br>
		    			<span class="<?php echo $catname; ?>"><?php echo $issue_name; ?></h5>
			    			<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo get_post_meta($post->ID, 'ecpt_tagline', true); else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?>
	    			</a>
	    		</div><!-- End subtext -->
   			<?php endwhile; wp_reset_query() ?>
	</div> 
	
	<div class="row">
		<div class="twelve columns">
			<h4>Web Exclusives<span class="spacer"></span></h4>
		</div>
	<?php if ( false === ( $asmag_exclusives_query = get_transient( 'web_exclusives_query' ) ) ) {
			$asmag_exclusives_query = new WP_Query(array(
				'cat' => '31',
				'order' => 'ASC',
				'posts_per_page' => '5'));
		set_transient( 'web_exclusives_query', $asmag_exclusives_query, 86400 ); }	 
		while ($asmag_exclusives_query->have_posts()) : $asmag_exclusives_query->the_post(); ?>
	    			<div class="twelve columns">
	    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    <?php if ( has_post_thumbnail()) { the_post_thumbnail('homethumb', array('class'=>'floatleft')); }?> 
	    			<h5><?php the_title(); ?></h5>
			    		<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo get_post_meta($post->ID, 'ecpt_tagline', true); else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?>
	    			</div>
	    			<?php endwhile; wp_reset_query(); ?>	    					    		
	</div> <!--End sidebar -->
	</div> <!--End content -->
</div> <!--End container-mid -->
<?php get_footer(); ?>
