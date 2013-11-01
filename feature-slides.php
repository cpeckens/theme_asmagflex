<?php
/*
Template Name: Feature - Slides
*/
?>
<?php get_header(); ?>
<script>
var $k = jQuery.noConflict();
$k(document).ready(function(){
	// load index page when the page loads
	$k(".feature-copy").load("<?php bloginfo('template_url'); ?>/parts/slides/2.html");	
	$k("#part2nav").click(function(){
	// load home page on click
		$k(".feature-copy").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/2.html").hide();
		$k(".feature-copy").fadeToggle('slow', function() {});
		$k(".lower-content").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/blank.html");
	});
	$k("#part3nav, #3bot").click(function(){
	// load home page on click
		$k(".feature-copy").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/3.html").hide();
		$k(".feature-copy").fadeToggle('slow', function() {});
		$k(".lower-content").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/blank.html").hide();
	});
	$k("#part4nav, #4bot").click(function(){
	// load home page on click
		$k(".feature-copy").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/4.html").hide();
		$k(".feature-copy").fadeToggle('slow', function() {});
		$k(".lower-content").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/blank.html");
	});
	$k("#part5nav, #5bot").click(function(){
	// load home page on click
		$k(".feature-copy").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/5.html").hide();
		$k(".feature-copy").fadeToggle('slow', function() {});
		$k(".lower-content").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/blank.html");
	});
	$k("#part6nav, #6bot").click(function(){
	// load home page on click
		$k(".lower-content").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/6.html").hide();
		$k(".lower-content").fadeToggle('slow', function() {});
		$k(".feature-copy").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/blank.html");
	});
	$k("#part7nav, #7bot").click(function(){
	// load home page on click
		$k(".lower-content").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/7.html").hide();
		$k(".lower-content").fadeToggle('slow', function() {});
		$k(".feature-copy").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/blank.html");
	});
	$k("#part8nav, #8bot").click(function(){
	// load home page on click
		$k(".feature-copy").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/8.html").hide();
		$k(".feature-copy").fadeToggle('slow', function() {});
		$k(".lower-content").load("http://magazine.dev/wp-content/themes/asmagflex/parts/slides/blank.html");
	});
});
</script>
<script type="text/javascript" src="http://magazine.dev/wp-content/themes/asmagflex/assets/javascripts/lightbox.js"></script>
<div id="slides">
<div class="slide-container">
	<div class="slide-content">
		<div class="left-nav">
			<h4>Cover Story</h4>
			<h5>On Display</h5>
			<p>Finding Museums in Unlikely Places</p>
			<h4>By Mary Zajac</h4>
			<a href="#" id="part2nav" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/main-180x120.jpg"></a>
			<ul>
				<li><a href="#" id="part3nav" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/1-60x60.jpg"></a></li>
				<li><a href="#" id="part4nav" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/2-60x60.jpg"></a></li>
				<li><a href="#" id="part5nav" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/3-60x60.jpg"></a></li>
				<li><a href="#" id="part6nav" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/4-60x60.jpg"></a></li>
				<li><a href="#" id="part7nav" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/5-60x60.jpg"></a></li>
				<li><a href="#" id="part8nav" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/6-60x60.jpg"></a></li>
			</ul>
			<p class="photocredit1">Background photo:<br>
			Art is on display in and around Johns Hopkins, including in the Levi Sculpture Garden at the nearby Baltimore Museum of Art, home to this 14-foot-high, red metal sculpture called <em>100 Yard Dash</em> by James Van Rensseleaer</p>
		</div>
		
		<div class="feature-copy">
		</div>
		<div class="clearboth"></div>

	</div>
</div>
</div>
<div class="clearboth"></div>
<div class="lower-section">
<div class="lower-content">

</div>
<div class="clearboth"></div>
</div>
<div class="clearboth"></div>
<ul class="block-grid eight-up" data-clearing><li>
				<a href="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Anthropology-Department-002.jpg" title="Anthropology-Department-002" class="cboxElement"><img src="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Anthropology-Department-002-150x150.jpg" class="attachment-thumbnail" alt="Anthropology-Department-002" title="Anthropology-Department-002"></a>
			</li><li>
				<a href="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Earth-and-Planetary-Sciences-056.jpg" title="Earth-and-Planetary-Sciences-056" class="cboxElement"><img src="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Earth-and-Planetary-Sciences-056-150x150.jpg" class="attachment-thumbnail" alt="Earth-and-Planetary-Sciences-056" title="Earth-and-Planetary-Sciences-056"></a>
			</li><li>
				<a href="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Field-Kit-Chesney.jpg" title="Field-Kit-Chesney" class="cboxElement"><img src="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Field-Kit-Chesney-150x150.jpg" class="attachment-thumbnail" alt="Field-Kit-Chesney" title="Field-Kit-Chesney"></a>
			</li><li>
				<a href="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Hisotry-of-Medicine.jpg" title="Hisotry-of-Medicine" class="cboxElement"><img src="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Hisotry-of-Medicine-150x150.jpg" class="attachment-thumbnail" alt="Hisotry-of-Medicine" title="Hisotry-of-Medicine"></a>
			</li><li>
				<a href="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/IMG_3485.jpg" title="IMG_3485" class="cboxElement"><img src="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/IMG_3485-150x150.jpg" class="attachment-thumbnail" alt="IMG_3485" title="IMG_3485"></a>
			</li><li>
				<a href="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Peabody-objects-001.jpg" title="Peabody-objects-001" class="cboxElement"><img src="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Peabody-objects-001-150x150.jpg" class="attachment-thumbnail" alt="Peabody-objects-001" title="Peabody-objects-001"></a>
			</li><li>
				<a href="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Roseman-Lab-022.jpg" title="Roseman-Lab-022" class="cboxElement"><img src="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Roseman-Lab-022-150x150.jpg" class="attachment-thumbnail" alt="Roseman-Lab-022" title="Roseman-Lab-022"></a>
			</li><li>
				<a href="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Typewriters-Physics-004.jpg" title="Typewriters-Physics-004" class="cboxElement"><img src="http://krieger.jhu.edu/magazine/wp-content/uploads/2012/05/Typewriters-Physics-004-150x150.jpg" class="attachment-thumbnail" alt="Typewriters-Physics-004" title="Typewriters-Physics-004"></a>
			</li>
</ul>

				<div class="bottom-nav">
			<ul>
				<li><h3 class="storynav">Story Navigation:</h3></li>
				<li><a href="#" id="3bot" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/1-60x60.jpg"></a></li>
				<li><a href="#" id="4bot" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/2-60x60.jpg"></a></li>
				<li><a href="#" id="5bot" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/3-60x60.jpg"></a></li>
				<li><a href="#" id="6bot" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/4-60x60.jpg"></a></li>
				<li><a href="#" id="7bot" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/5-60x60.jpg"></a></li>
				<li><a href="#" id="8bot" class="leftnav"><img src="http://magazine.dev/wp-content/themes/asmagflex/assets/images/v9n2/6-60x60.jpg"></a></li>
			</ul>

		</div><div class="clearboth"></div>


<?php locate_template('parts/footer_feature.php', true, false);	get_footer(); ?>