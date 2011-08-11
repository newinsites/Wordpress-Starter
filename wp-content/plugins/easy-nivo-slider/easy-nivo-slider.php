<?php
/*
Plugin Name: Easy Nivo Slider

Description: Easily add the Nivo Slider to your website without writing any code.  Choose images attached to a post, featured images from a category / custom post type / taxonomy, or a NextGen gallery.  Add sliders to any post or page from the Visual editor, or to the sidebar with a slider widget.  The plugin writes the shortcode for you and allows you to define slider size, navigation, animation, and speed.  Over a dozen beautiful slider animations to choose from.

Version: 1.6.1
Author: Phillip Bryan
Author URI: http://www.theemeraldcurtain.com/
*/ 

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define ('EASY_NIVO_SLIDER_VERSION', '1.6.1');
define ('EASY_NIVO_SLIDER_NIVO_VERSION', '2.5');
define ('EASY_NIVO_SLIDER_CUSTOM_IMAGE_SIZES_VERSION', '1.0');
define ('EASY_NIVO_SLIDER_NEXTGEN_VERSION', '1.7.4');

//---------------------------------------------------------------------
// LOAD STYLES and SETTINGS for the FRONT END and ADMIN PANEL
//---------------------------------------------------------------------
add_action('wp_print_styles', 'easy_nivo_slider_print_styles'); 

function easy_nivo_slider_print_styles() { 

	// Should register_style go in init?
	if ('true' == get_easy_nivo_slider_option( 'load_nivo' )) {
		wp_register_style( 'nivo-slider',plugins_url('/3rd-party/nivo-slider.css', __FILE__),array(),EASY_NIVO_SLIDER_NIVO_VERSION);
		wp_enqueue_style( 'nivo-slider' );
	}	
	wp_register_style( 'easy-nivo-slider',plugins_url('/css/easy-nivo-slider.css', __FILE__),array(),EASY_NIVO_SLIDER_VERSION);
	
	wp_enqueue_style( 'easy-nivo-slider' );
}

//---------------------------------------------------------------------
// LOAD STYLES for ADMIN 
//---------------------------------------------------------------------
add_action('admin_print_styles', 'easy_nivo_slider_admin_print_styles');

function easy_nivo_slider_admin_print_styles() {

	if ('true' == get_easy_nivo_slider_option( 'load_nivo' )) {
		wp_register_style( 'nivo-slider',plugins_url('/3rd-party/nivo-slider.css', __FILE__),array(),EASY_NIVO_SLIDER_NIVO_VERSION);
	}	
	wp_register_style( 'easy-nivo-slider',plugins_url('/css/easy-nivo-slider.css', __FILE__),array(),EASY_NIVO_SLIDER_VERSION);
	wp_register_style( 'easy-nivo-slider-admin',plugins_url('/css/admin.css', __FILE__),array(), EASY_NIVO_SLIDER_VERSION);

	wp_enqueue_style( 'easy-nivo-slider-admin' );	
}


//---------------------------------------------------------------------
// LOAD SCRIPTS
//---------------------------------------------------------------------
add_action('wp_print_scripts', 'easy_nivo_slider_print_scripts');

function easy_nivo_slider_print_scripts() {
	if ('true' == get_easy_nivo_slider_option( 'load_nivo' )) {
//		wp_enqueue_script('nivo-slider',plugins_url('/3rd-party/jquery.nivo.slider.pack.js',__FILE__),array('jquery'),EASY_NIVO_SLIDER_NIVO_VERSION);
		wp_enqueue_script('nivo-slider',plugins_url('/3rd-party/jquery.nivo.slider.js',__FILE__),array('jquery'),EASY_NIVO_SLIDER_NIVO_VERSION);
	}	

}

//---------------------------------------------------------------------
// LOAD SCRIPTS for ADMIN
//---------------------------------------------------------------------
add_action('admin_print_scripts', 'easy_nivo_slider_admin_print_scripts');

function easy_nivo_slider_admin_print_scripts() {    
	wp_enqueue_script('easy_nivo_slider_tax', plugins_url('/js/admin.js', __FILE__), array('jquery'));

}

//---------------------------------------------------------------------
// ADD IMAGE GENERATION FOR THE THREE SLIDER SIZES
//---------------------------------------------------------------------
add_theme_support('post-thumbnails');

add_image_size('easy-nivo-slider-thumb', 
	get_easy_nivo_slider_option(60, 60, true)); 

add_image_size('easy-nivo-slider-first', 
	get_easy_nivo_slider_option('first_width', 300), get_easy_nivo_slider_option('first_height',400), true); 
		
add_image_size('easy-nivo-slider-second', 
	get_easy_nivo_slider_option('second_width',300), get_easy_nivo_slider_option('second_height',400),  true);

add_image_size('easy-nivo-slider-widget', 
	get_easy_nivo_slider_option('widget_width',100), get_easy_nivo_slider_option('widget_height',200),  true);
 
 
//---------------------------------------------------------------------
// LOAD PLUGIN COMPONENTS
//---------------------------------------------------------------------
if (is_admin()) {

	if(!isset($_SESSION)) { session_start(); }	

	include_once ('settings.php');
	include_once ('editor.php');
	include_once ('misc/forms.php');      
}

include_once('misc/functions.php'); 
if ('true' == get_easy_nivo_slider_option( 'load_cis' )) {
	include_once('3rd-party/filosofo-custom-image-sizes.php'); 
}	

include_once('misc/post-type-list-images.php'); 
include_once('misc/post-type-widget.php');
include_once('misc/post-type-functions.php');

include_once('misc/current-post-list-images.php'); 
include_once('misc/current-post-widget.php');

if ('true' == get_easy_nivo_slider_option( 'activate_nextgen' )) {
	include_once('nextgen/functions.php'); 
	include_once('nextgen/list-images.php'); 
	include_once('nextgen/widget.php');
}


//---------------------------------------------------------------------
// REGISTER OUR SETTINGS
//---------------------------------------------------------------------
function easy_nivo_slider_register_settings() {
	register_setting( 'easy_nivo_slider_group', 'easy_nivo_slider_options' );
}

//---------------------------------------------------------------------
// Retrieve a plugin option with a default value
//---------------------------------------------------------------------
function get_easy_nivo_slider_option($option, $default=false) {
	
        $options = get_option('easy_nivo_slider_options');
		if ($options) 
			if ($options[$option] && $options[$option]!='')
				return $options[$option];

		return $default;
}		

//---------------------------------------------------------------------
// Plugin Activation Function
//---------------------------------------------------------------------
register_activation_hook( __FILE__, 'easy_nivo_slider_activation' );

function easy_nivo_slider_activation() {
	
	$options = get_option('easy_nivo_slider_options');
	
	if (false ==$options) {
		$options=array();
		
		// Plugin settings
		$options[ 'uninstall'] = false;
		$options[ 'debug'] = false;
		$options[ 'activate_nextgen'] = false;
		$options[ 'load_nivo'] = 'true';
		$options[ 'load_cis'] = 'true';
		
		// Start on tab 1
		$options[ 'nivo_settings_current_tab'] = 'tab_first';	
		
		// Standard animation settings
		$options[ 'effect'] = 'random';	
		$options[ 'speed'] = '500';	
		$options[ 'pause'] = '4000';
		$options[ 'number'] = '10';		
		
		// Initialize slider settings for each size
		$options = easy_nivo_slider_activation_for_size( $options, 'first');
		$options = easy_nivo_slider_activation_for_size( $options, 'second');
		$options = easy_nivo_slider_activation_for_size( $options, 'widget');
		
		// Simplify things a bit for the widget
		$options[ 'widget_width' ] = 200;
		$options[ 'widget_height' ] = 200;
		$options[ 'widget_caption' ] = 'false';
		$options[ 'widget_slices' ] = 5;
		$options[ 'widget_arrows' ] = 'false';
		$options[ '_controls_buttons' ] = 'false';
	
		// Whew, that's a lot of options
		add_option('easy_nivo_slider_options', $options);
	}
}

//---------------------------------------------------------------------
// Initialize the slider paramters for a given size
//---------------------------------------------------------------------
function easy_nivo_slider_activation_for_size($options, $size) {

	$options[ $size.'_width'] = 400;
	$options[ $size.'_height'] = 300;
	$options[ $size.'_caption'] = 'true';
	$options[ $size.'_captionOpacity'] = '0.8';
	$options[ $size.'_linking'] = 'true';
	$options[ $size.'_slices'] = 15;
	$options[ $size.'_effect'] = 'random';
	$options[ $size.'_speed'] = 500;
	$options[ $size.'_pause'] = 4000;
	$options[ $size.'_pause_on_hover'] = 'true';
	$options[ $size.'_arrows'] = 'true';
	$options[ $size.'_hide_arrows'] = 'true';
	$options[ $size.'_controls_buttons'] = 'true';
	$options[ $size.'_controls_numbers'] = 'false';
	$options[ $size.'_controls_thumbs'] = 'false';
	$options[ $size.'_controls_offset'] = 0;
	return $options;
}

//---------------------------------------------------------------------
// Plugin Deactivation Function
//---------------------------------------------------------------------
register_deactivation_hook(__FILE__, 'easy_nivo_slider_deactivation');
function easy_nivo_slider_deactivation() {
    $options = get_option('easy_nivo_slider_options');
    if (is_array($options) && $options['uninstall'] === 'true') {        
		delete_option('easy_nivo_slider_options');		
    }
}


//---------------------------------------------------------------------
// SHORTCODE FUNCTIONS
//---------------------------------------------------------------------
function show_easy_nivo_slider($atts) {
	echo get_easy_nivo_slider($atts);
}

add_shortcode("nivo", "get_easy_nivo_slider");

function get_easy_nivo_slider($atts) {
	
	if (!$atts) {
		$atts = array();
		$atts['post_type'] = 'post';
	}
	
	if ('' != $atts['category']) {
		$atts['taxonomy'] = 'category';
		$atts['term'] =  $atts['category'];
	}
	
	switch ($atts['source']) {
	
		// ----------------
		//
		// ----------------
		case 'current-post':
			return get_easy_nivo_slider_for_current_post ($atts);
			break;
			
		// ----------------
		// Handle NextGen gallery.  
		// If Nivo-NextGen was deactivated, reactivate it rather than throw an error message
		// ----------------		
		case 'nextgen':
			if (!function_exists('get_easy_nivo_slider_for_nextgen')) {
				include_once('nextgen/functions.php'); 
				include_once('nextgen/list-images.php'); 
			}
			return get_easy_nivo_slider_for_nextgen ($atts);
			break;
			
		// ----------------
		//
		// ----------------
		default:	
			return get_easy_nivo_slider_for_featured_images ($atts);
	}
}
?>