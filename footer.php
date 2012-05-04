		<div id="container-foot">
			
			<div id="footer">
				
				<div id="footer-left">
				<?php 				global $wp_query;
				foreach(get_the_terms($wp_query->post->ID, 'volume') as $term);
				$volume = $term->slug;
					$asmag_option = asmag_get_global_options();
					if ($volume == null) { 
					$volume = $asmag_option['asmag_current_issue']; } ?>
					<p><a href="<?php echo get_home_url(); ?>/<?php echo $volume; ?>">Table of Contents</a> |
				<?php 

				$asmag_editor_query = new WP_Query(array(
					'cat' => '56',
					'volume' => $volume,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'posts_per_page' => '1')); ?>
		
				<?php while ($asmag_editor_query->have_posts()) : $asmag_editor_query->the_post(); ?>
 
					<a href="<?php echo the_permalink(); ?>">Editor's Note</a> |
					<?php endwhile; ?> 
					<a href="<?php echo get_home_url(); ?>/category/exclusive/">Web Exclusives</a> | 
					<a href="<?php echo get_home_url(); ?>/archive/">Archive</a> | 
					<a href="<?php echo get_home_url(); ?>/letters/">Letters to the Editor</a> | 
					<a href="<?php echo get_home_url(); ?>/contact/">Contact</a>
					<br>&copy; <a href="http://www.jhu.edu">Johns Hopkins University</a>. All rights reserved.</p>					
					<img src="<?php bloginfo('template_url'); ?>/assets/img/footlogo.png" alt="Johns Hopkins University" />
				</div>
				
				<div id="footer-right">
						<ul id="social-media">
							<a href="http://www.facebook.com/JHUKSAS"><li class="facebook"><span>Facebook</span></li></a>
							<a href="http://vimeo.com/jhuksas"><li class="vimeo"><span>Vimeo</span></li></a>
							<a href="<?php echo get_home_url(); ?>/feed/"><li class="rss"><span>RSS</span></li></a>
						</ul>
				
				</div>
				
			</div> <!--End footer -->
			
			<div class="clearboth"></div> <!--to have background work properly -->
		
		</div> <!--End container-foot -->
	<?php wp_footer(); ?>
	</body>
		<!-- JavaScript -->
		<script src="<?php echo site_url(); ?>/min/?f=wp-content/themes/asmagflex/assets/js/respond.min.js,wp-content/themes/asmagflex/assets/js/asmag_custom.js,wp-content/themes/asmagflex/assets/js/jquery.scroll.js<?php if (is_front_page() || is_page_template( 'template-tableofcontents.php' ) ){ ?>,wp-content/themes/asmagflex/assets/js/asmag_front.js<?php } ?><?php if (is_page_template( 'feature-generic.php' ) || is_page_template( 'feature-fancytitle.php' )|| is_page_template( 'feature-complex.php' )) { ?>,wp-content/themes/asmagflex/assets/js/asmag_feature.js<?php } ?>&debug"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/jquery.scroll.js"></script>
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'b7fa1cfa-1d01-4da1-8de7-ae74dea18d43'});</script>
</html>
