		<div class="row show-for-small black_bg">
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
				<?php if (is_page_template('template-tableofcontents.php')) {$menu = 'header-menu';} else { $menu = 'subpage-menu'; }
				wp_nav_menu( array( 
							'theme_location' => $menu, 
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
						<input type="submit" class="icon-search" value="&#xe810;" />
						<input type="hidden" name="site" value="ksas_magazine" />
					</form>
					</div>
				</div>	
			</div>	<!-- End #search-bar	 -->
		</div>		<div class="row hide-for-small">
			<div class="twelve columns" id="logo_nav">
				<li class="logo"><a href="<?php echo site_url(); ?>" title="Krieger School of Arts & Sciences"><span class="hide">Arts & Sciences</span></a>
								<select class="issue" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
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
								</select><span class="logo-sub">Magazine</span></li>
							
			</div>
		</div>
			<form action="#" class="row hide-for-print"  id="fields_search" role="search">
				<fieldset class="radius10">
					
					<div class="seven columns offset-by-three filter hide-for-mobile option-set" data-filter-group="structure">
						<div class="button bright_blue_bg"><a href="#" data-filter="" class="selected">View All</a></div>
						<div class="button green_bg"><a href="#" data-filter=".features" onclick="ga('send', 'event', 'Stories', 'Filter', 'Features');">Features</a></div>
						<div class="button purple_bg"><a href="#" data-filter=".news" onclick="ga('send', 'event', 'Stories', 'Filter', 'News');">News</a></div>
						<div class="button fushia"><a href="#" data-filter=".insights" onclick="ga('send', 'event', 'Stories', 'Filter', 'Insights');">Insights</a></div>
						<div class="button yellow_bg"><a href="#" data-filter=".research" onclick="ga('send', 'event', 'Stories', 'Filter', 'Research');">Research</a></div>
						<div class="button orange_bg"><a href="#" data-filter=".alumni" onclick="ga('send', 'event', 'Stories', 'Filter', 'Alumni');">Alumni</a></div>
						<div class="button bright_blue_bg"><a href="#" data-filter=".exclusives" onclick="ga('send', 'event', 'Stories', 'Filter', 'Web Extras');">Web Extras</a></div>
					</div>
					<div class="two columns offset-gutter">
						<label for="search" class="hide">Search by keyword:</label>	
						<input type="submit" class="icon-search" placeholder="Filter by keyword"value="&#xe810;" />
						<input type="text" name="search" id="id_search" aria-label="Search"  /> 	
					</div>			
				</fieldset>
			</form>	
		</div>
