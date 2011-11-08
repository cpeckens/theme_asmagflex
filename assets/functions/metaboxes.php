<?
//Create Meta boxes
// Intiate create meta boxes
add_action("admin_init", "create_feature_meta_boxes");
function create_feature_meta_boxes(){
	add_meta_box("feature_extras", "Feature Extras", "feature_extras", "page", "normal", "high");
	add_meta_box("feature_extras", "Article Extras", "feature_extras", "post", "normal", "high");
	add_meta_box("feature_uploads", "Feature Background", "feature_uploads", "page", "side", "high");
}

//Add AJAX file upload capability
//Save image via AJAX
add_action('wp_ajax_asmag_ajax_upload', 'asmag_ajax_upload'); //Add support for AJAX save

function asmag_ajax_upload(){
	
	global $wpdb; //Now WP database can be accessed
	
	
	$image_id=$_POST['data'];
	$image_filename=$_FILES[$image_id];	
	$override['test_form']=false; //see http://wordpress.org/support/topic/269518?replies=6
	$override['action']='wp_handle_upload';    
	
	$uploaded_image = wp_handle_upload($image_filename,$override);
	
	if(!empty($uploaded_image['error'])){
		echo 'Error: ' . $uploaded_image['error'];
	}	
	else{ 
		update_option($image_id, $uploaded_image['url']);		 
		echo $uploaded_image['url'];
	}
			
	die();

}
// Add meta box stylesheet and WYSIWYG JAvascript
	add_action("admin_head", "asmag_admin_stylesheet");
	
	function asmag_admin_stylesheet () {
		echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/assets/css/meta.css" type="text/css" media="screen" />';
		echo '<script language="javascript" type="text/javascript" src="'.get_bloginfo('template_url').'/assets/js/tiny_mce/tiny_mce.js"></script>';
	}
	
//function to create extras meta box
function feature_extras() {
  global $post;
  $custom = get_post_custom($post->ID);
  $tagline = $custom["tagline"][0];
  $pull_quote = $custom["pull_quote"][0];
  $other_credits = $custom["other_credits"][0];
  $asmag_css = $custom["asmag_css"][0];
  
  ?>
  <div class="meta-group"> 
  <div class="meta-box meta-box-large"><strong>Tagline:</strong><br><textarea name="tagline"><?php echo $tagline; ?></textarea></div> 
  <div class="meta-box meta-box-large"><strong>Pull Quote:</strong><br><textarea name="pull_quote"><?php echo $pull_quote; ?></textarea></div>
  <div class="meta-box meta-box-large"><strong>Custom CSS:</strong><br><textarea name="asmag_css"><?php echo $asmag_css; ?></textarea></div>
  <div class="meta-box meta-box-large"><strong>Other Credits:</strong><br><textarea name="other_credits"><?php echo $other_credits; ?></textarea></div>
  </div>
  <div class="clear"></div>

  <?php
}

//function to create uploads meta box
function feature_uploads() {
  global $post;
  $custom = get_post_custom($post->ID);
  $feature_background = $custom["feature_background"][0];
  $header_background = $custom["header_background"][0];
  ?>
  
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#uploadPhoto').each(function(){
            var the_button = jQuery(this);
            var image_input = jQuery('#feature_background');
            var image_id = jQuery(this).attr('id');
            new AjaxUpload(image_id, {
                action: ajaxurl,
                name: image_id,
                // Additional data
                data: {
                    action: 'asmag_ajax_upload',
                    data: image_id
                },
                autoSubmit: true,
                responseType: false,
                onChange: function(file, extension){},
                onSubmit: function(file, extension) {
                    the_button.attr('disabled', 'disabled').val("Uploading...");
                },
                onComplete: function(file, response) {
                    the_button.removeAttr('disabled').val("Upload Image");
                    if(response.search("Error") > -1){
                        alert("There was an error uploading:\n"+response);
                    }
                    else{
                        image_input.val(response);
                    }
                }
            });
        });
    });
</script>
<p>

    <label for="feature_background"><strong>Upload Background Image:</strong></label>
    <input type="text" class="widefat" name="feature_background" id="feature_background" value="<?php echo $feature_background; ?>" />
    </p>
<p style="text-align: right;">
    <input type="button" name="" class="button-primary autowidth" id="uploadPhoto" value="Upload Background Image" />
</p>

<script type="text/javascript">

    jQuery(document).ready(function() {

        jQuery('#upload_header_background').each(function(){

            var the_button = jQuery(this);
            var image_input = jQuery('#header_background');
            var image_id = jQuery(this).attr('id');

            new AjaxUpload(image_id, {

                action: ajaxurl,
                name: image_id,

                // Additional data
                data: {
                    action: 'asmag_ajax_upload',
                    data: image_id
                },

                autoSubmit: true,
                responseType: false,
                onChange: function(file, extension){},
                onSubmit: function(file, extension) {

                    the_button.attr('disabled', 'disabled').val("Uploading...");

                },

                onComplete: function(file, response) {

                    the_button.removeAttr('disabled').val("Upload Image");

                    if(response.search("Error") > -1){

                        alert("There was an error uploading:\n"+response);

                    }

                    else{

                        image_input.val(response);

                    }

                }
            });
        });

    });

</script>
<p>

    <label for="header_background"><strong>Upload Abstract (for Job Candidates):</strong></label>
    <input type="text" class="widefat" name="header_background" id="header_background" value="<?php echo $header_background; ?>" />

    </p>

<p style="text-align: right;">

    <input type="button" name="" class="button-primary autowidth" id="upload_header_background" value="Upload Header Background" />

</p>

   <?php
}
// Save meta 
add_action('save_post', 'profile_save_details');
//Save and update function
function profile_save_details(){
  global $post;
  update_post_meta($post->ID, "header_background", $_POST["header_background"]);
  update_post_meta($post->ID, "feature_background", $_POST["feature_background"]);
  update_post_meta($post->ID, "tagline", $_POST["tagline"]);
  update_post_meta($post->ID, "pull_quote", $_POST["pull_quote"]);
  update_post_meta($post->ID, "other_credits", $_POST["other_credits"]);
  update_post_meta($post->ID, "asmag_css", $_POST["asmag_css"]);
}


?>