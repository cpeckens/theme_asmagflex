<?php
/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function asmag_options_page_sections() {
	
	$sections = array();
	// $sections[$id] 				= __($title, 'asmag_textdomain');
	$sections['txt_section'] 	= __('Magazine Options/Settings', 'asmag_textdomain');
	
	return $sections;	
}

/**
 * Define our form fields (settings) 
 *
 * @return array
 */
function asmag_options_page_fields() {
	// Text Form Fields section
	// Select Form Fields section
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => ASMAG_SHORTNAME . "_current_issue",
		"title"   => __( 'Current Issue', 'asmag_textdomain' ),
		"desc"    => __( 'Enter the slug for the current issue. (i.e. v9n1)', 'asmag_textdomain' ),
		"type"    => "text",
		"std"     => __('v9n1','asmag_textdomain'));
	return $options;	
}

?>