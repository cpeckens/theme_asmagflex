		<div id="container-head">
			
			<div id="header">
				
				<div id="header-left">
				<div id="logo"><a href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/logo.png" alt="Johns Hopkins Univeristy Zanvyl Krieger School of Arts & Sciences Magazine" /></a></div>
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
