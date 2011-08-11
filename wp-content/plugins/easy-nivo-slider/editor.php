<?php
// ---
add_action('init', 'easy_nivo_slider_add_editor_button');
function easy_nivo_slider_add_editor_button() {
	// check user permission
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
		
	// Add button in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "easy_nivo_slider_load_plugin");
		add_filter('mce_buttons', 'easy_nivo_slider_register_button');
	}
} 

// ---
function easy_nivo_slider_load_plugin($plugin_array) {

	// Using session variables to pass these for now.
	// Switch to using wp inside the mce plugin when time permits
	if(!isset($_SESSION)) { session_start(); }	

	// Prepare the website taxonomies
	$nivo_tax = easy_nivo_slider_post_types();	
	$_SESSION['nivo_tax'] = serialize($nivo_tax);

	// Prepare the plugin options
	$nivo_options = get_option('easy_nivo_slider_options');
	$_SESSION['nivo_options'] = serialize($nivo_options);
	
	// If NextGen active, prepare the list of galleries
	if (function_exists('sns_get_nextgen_galleries')) {
		$nivo_nextgen = sns_get_nextgen_galleries();
		$_SESSION['nivo_nextgen'] = serialize($nivo_nextgen);
	}
	
	// Annnnnnnnnd....activate
	$plug = plugins_url('/mce/editor_plugin.js',__FILE__);
	$plugin_array['easy_nivo_slider_plugin'] = $plug;
	return $plugin_array;
}

// ---
function easy_nivo_slider_register_button($buttons) {
	$b[] = "separator";
	$b[] = "easy_nivo_slider_plugin_button";
	if ( is_array($buttons) && !empty($buttons) ) {
		$b = array_merge( $buttons, $b );
	}
	return $b;
}
?>