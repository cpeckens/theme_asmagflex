		<div class="row show-for-small black_bg">
				<div class="toc_nav mobile">
				<a href="<?php echo site_url(); ?>"><span class="icon-home"></span><span class="hide">Home</span></a>
				<a href="#" data-reveal-id="modal_toc" onclick="ga('send', 'event', 'Table of Contents', '<?php echo $volume_name ?>');"><span class="icon-toc"></span><span class="hide">Table of Contents</span>
				<span class="issue"><?php $volume_name = get_the_volume_name($post); echo $volume_name; ?></span></a>
			</div>

			<div class="four columns centered">
			<div class="mobile-logo centered">
				<li class="logo"><a href="<?php echo site_url(); ?>" title="Krieger School of Arts & Sciences"><span class="hide">Arts & Sciences</span></a>
				<select class="bright_blue_bg issue" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
				<?php $volume_name = get_the_volume_name($post); ?>
				<option><?php echo $volume_name; ?></option>
				<?php wp_nav_menu( array( 
					'theme_location' => 'issue-menu', 
					'menu_class' => '', 
					'fallback_cb' => 'foundation_page_menu', 
					'container' => '',
					'depth' => 1,
					'walker'=> new mobile_select_menu,
					'items_wrap' => '%3$s', )); ?>
					</select>
				<span class="logo-sub">Magazine</span></li>
			</div>
		</div>
		</div>
		<div class="row hide-for-print hide-for-small">
			<div id="search-bar" class="offset-by-five seven mobile-four columns">
				<div class="row">
				<?php 
				wp_nav_menu( array( 
							'theme_location' => 'subpage-menu', 
							'menu_class' => '', 
							'fallback_cb' => 'foundation_page_menu', 
							'container' => 'div',
							'container_id' => 'search_links', 
							'container_class' => 'eight columns links mobile-two inline hide-for-mobile',
							'depth' => 1,
							'items_wrap' => '%3$s', )); ?> 
					<div class="four columns mobile-two">
					<form method="GET" action="<?php echo site_url('/search'); ?>">
						<input type="text" name="q" placeholder="Search this site" />
						<input type="submit" class="icon-search" value="&#48;" />
						<input type="hidden" name="site" value="ksas_magazine" />
					</form>
					</div>
				</div>	
			</div>	<!-- End #search-bar	 -->
		</div>		
		
		<div class="row hide-for-small">
			<div class="toc_nav">
				<a href="<?php echo site_url(); ?>"><span class="icon-home"></span><span class="hide">Home</span></a>
				<a href="#" data-reveal-id="modal_toc" onclick="ga('send', 'event', 'Table of Contents', '<?php echo $volume_name ?>');"><span class="icon-toc"></span><span class="hide">Table of Contents</span>
				<span class="issue"><?php $volume_name = get_the_volume_name($post); echo $volume_name; ?></span></a>
			</div>
			<div class="twelve columns sub-page" id="logo_nav">

				<li class="logo"><a href="<?php echo site_url(); ?>" title="Krieger School of Arts & Sciences"><span class="hide">Arts & Sciences</span></a>
								<div class="spacer"></div><span class="logo-sub">Magazine</span></li>

			</div>
		</div>
	</div>
