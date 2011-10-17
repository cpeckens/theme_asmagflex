		<div id="container-foot">
			
			<div id="footer">
				
				<div id="footer-left">
					<small>Table of Contents | Editor's Note | Web Exclusives | Letters to the Editor | Archive | Contact</small>
					<small>&copy; Johns Hopkins University. All rights reserved.</small>
					<img src="<?php bloginfo('template_url'); ?>/assets/img/footlogo.png" alt="Johns Hopkins University" />
				</div>
				
				<div id="footer-right">
						<ul id="social-media">
							<li class="facebook"><a href="http://www.facebook.com"><span>Facebook</span></a></li>
							<li class="vimeo"><span>YouTube</span</li>
							<li class="rss"><span>RSS</span></li>
						</ul>
				
				</div>
				
			</div> <!--End footer -->
			
			<div class="clearboth"></div> <!--to have background work properly -->
		
		</div> <!--End container-foot -->

	</body>
		<!-- JavaScript -->
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="<?php bloginfo('template_url'); ?>/assets/js/respond.min.js"></script>
		<?php if (is_front_page()) { ?>
			<script src="<?php bloginfo('template_url'); ?>/assets/js/responsive_accordion.js"></script>
			<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery_easing.js"></script>
		<?php } ?>
</html>
