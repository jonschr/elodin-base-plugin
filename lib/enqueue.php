<?php
/**
 * Enqueue scripts and stylesheets
 *
 * @package plugintextdomain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Register and enqueue scripts and stylesheets
 *
 * @return void.
 */
function plugintextdomain_enqueue_scripts_stylesheets() {
	
	// Plugin styles.
	wp_enqueue_style( 'plugin-styles', PLUGINBASENAME_PATH . 'dist/css/plugin-styles.css', array(), PLUGINBASENAME_VERSION, 'screen' );
}
add_action( 'wp_enqueue_scripts', 'plugintextdomain_enqueue_scripts_stylesheets' );

/**
 * Admin enqueues
 */
function plugintextdomain_enqueue_scripts_stylesheets_admin() {

}
add_action( 'admin_enqueue_scripts', 'plugintextdomain_enqueue_scripts_stylesheets_admin' );
