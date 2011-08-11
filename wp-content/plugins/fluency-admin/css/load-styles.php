<?php

/* Based on wp-admin/load-styles.php */

/**
 * Disable error reporting
 *
 * Set this to error_reporting( E_ALL ) or error_reporting( E_ALL | E_STRICT ) for debugging
 */
error_reporting(E_ALL);

/** Set ABSPATH for execution */
$abspath = dirname(dirname(__FILE__)) . '/';
define( 'THISABSPATH' ,substr($abspath,strpos($abspath,'wp-content/')));
define( 'ABSPATH' ,substr($abspath,0,strpos($abspath,'/wp-content/')) . '/');
define( 'WPINC', 'wp-includes' );

/**
 * @ignore
 */
function __() {}

/**
 * @ignore
 */
function _x() {}


/**
 * @ignore
 */
function add_filter() {}

/**
 * @ignore
 */
function esc_attr() {}

/**
 * @ignore
 */
function apply_filters() {}

/**
 * @ignore
 */
function get_option() {}

/**
 * @ignore
 */
function is_lighttpd_before_150() {}

/**
 * @ignore
 */
function add_action() {}

/**
 * @ignore
 */
function do_action_ref_array() {}

/**
 * @ignore
 */
function get_bloginfo() {}

/**
 * @ignore
 */
function is_admin() {return true;}

/**
 * @ignore
 */
function site_url() {}

/**
 * @ignore
 */
function admin_url() {}

/**
 * @ignore
 */
function wp_guess_url() {}

function get_file($path) {

	if ( function_exists('realpath') )
		$path = realpath($path);

	if ( ! $path || ! @is_file($path) )
		return '';

	return @file_get_contents($path);

}


function fluency_default_styles(&$wp_styles) {

	$wp_styles->add('fluency',THISABSPATH.'css/wp-admin.css',array(),$_GET['ver']);
	$wp_styles->add('adminbar',THISABSPATH.'css/wp-admin-bar.css',array(),$_GET['ver']);
	$wp_styles->add('fresh',THISABSPATH.'css/fluency-fresh.css',array(),$_GET['ver']);
	$wp_styles->add('classic',THISABSPATH.'css/fluency-classic.css',array(),$_GET['ver']);

}


require( ABSPATH . 'wp-includes/class.wp-dependencies.php' );
require( ABSPATH . 'wp-includes/class.wp-styles.php' );
require( ABSPATH . 'wp-includes/functions.wp-styles.php' );

$load = preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['load'] );
$load = explode(',', $load);

if ( empty($load) )
	exit;

$compress = ( isset($_GET['c']) && $_GET['c'] );
$force_gzip = ( $compress && 'gzip' == $_GET['c'] );
$rtl = ( isset($_GET['dir']) && 'rtl' == $_GET['dir'] );
$custom_color = !empty($_GET['color']) ? $_GET['color'] : null;
$expires_offset = 31536000;
$out = '';

$wp_styles = new WP_Styles();
fluency_default_styles($wp_styles);

foreach( $load as $handle ) {
	if ( !array_key_exists($handle, $wp_styles->registered) )
		continue;

	$style = $wp_styles->registered[$handle];
	$path = ABSPATH . $style->src;

	$content = get_file($path) . "\n";

	// Need to test that this still works...
	if ( $rtl && isset($style->extra['rtl']) && $style->extra['rtl'] ) {
		$rtl_path = is_bool($style->extra['rtl']) ? str_replace( '.css', '-rtl.css', $path ) : ABSPATH . $style->extra['rtl'];
		$content .= get_file($rtl_path) . "\n";
	}
	
	$out .= $content;
	// $out .= str_replace( '../images/', 'images/', $content );
}


header('Content-Type: text/css');
header('Expires: ' . gmdate( "D, d M Y H:i:s", time() + $expires_offset ) . ' GMT');
header("Cache-Control: public, max-age=$expires_offset");

if ( $compress && ! ini_get('zlib.output_compression') && 'ob_gzhandler' != ini_get('output_handler') && isset($_SERVER['HTTP_ACCEPT_ENCODING']) ) {
	header('Vary: Accept-Encoding'); // Handle proxies
	if ( false !== stripos($_SERVER['HTTP_ACCEPT_ENCODING'], 'deflate') && function_exists('gzdeflate') && ! $force_gzip ) {
		header('Content-Encoding: deflate');
		$out = gzdeflate( $out, 3 );
	} elseif ( false !== stripos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') && function_exists('gzencode') ) {
		header('Content-Encoding: gzip');
		$out = gzencode( $out, 3 );
	}
}

echo $out;

exit;
