<?php
/**
 * Enqueue scripts and stylesheets
 *
 * @package pluginslug
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register and enqueue scripts and stylesheets
 *
 * @return void.
 */
function pluginslug_enqueue_scripts_stylesheets() {

	// Plugin styles.
	wp_enqueue_style( 
		'pluginslug-styles', 
		PLUGINBASENAME_PATH . 'dist/css/pluginslug-styles.css', 
		array(), 
		PLUGINBASENAME_VERSION, 
		'screen'
	);
	
	// Plugin scripts.
	wp_enqueue_script( 
		'pluginslug-scripts', 
		PLUGINBASENAME_PATH . 'dist/js/pluginslug-scripts.js', 
		array( 'jquery' ), 
		PLUGINBASENAME_VERSION, 
		true 
	);
}
add_action( 'wp_enqueue_scripts', 'pluginslug_enqueue_scripts_stylesheets' );

/**
 * Admin enqueues
 */
function pluginslug_enqueue_scripts_stylesheets_admin() {
}
add_action( 'admin_enqueue_scripts', 'pluginslug_enqueue_scripts_stylesheets_admin' );
