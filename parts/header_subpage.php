<div class="helpbarcontainer">

	<div class="helpbar">
		<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false) : //Check if browser is IE or mobile
		 locate_template('parts/helpbar_ie.php', true, false);
		 else :
		 locate_template('parts/helpbar_all.php', true, false);
		 endif;
		 ?>
		 	<div class="helpbarright">
			<div class="searchbar">
				<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
				    <div><input type="text" size="put_a_size_here" name="s" id="s" value="" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
				    <input type="submit" id="searchsubmit" value="Search" class="btn">
				    </div>
				</form>
			</div> <!--End searchbar-->

			</div> <!--End helpbarright--> 
			
	</div> <!--End helpbar-->
</div> <!--End helpbarcontainer-->
		<div id="container-head">
			
			<div id="header">
	
				<div id="subheader-left">
				<div id="logosub"><a href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/subpage_logo.png" alt="Johns Hopkins Univeristy Zanvyl Krieger School of Arts & Sciences Magazine" /></a></div>
				</div> <!-- End header-left -->
			
				<div id="subheader-right">									
					<div id="nav">
					<?php wp_nav_menu( array( 'theme_location' => 'subpage-menu' ) ); ?>
					</div> <!--End nav -->
				</div><!-- End header-right -->
<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!-- End header -->
		</div> <!-- End container-head-->
<div id="nav-break"></div>
