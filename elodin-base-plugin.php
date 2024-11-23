<?php
/**
	Plugin Name:    PLUGINNAME
	Plugin URI:     https://elod.in
	Description:    Just another WordPress plugin
	Version:        0.1
	Author:         Jon Schroeder
	Author URI:     https://elod.in
	Text Domain:    pluginslug-textdomain
	License:        GPLv2 or later
	License URI:    http://www.gnu.org/licenses/gpl-2.0.html
 *
	@package pluginslug
 */

//! PLUGIN STARTER CHECKLIST
// Find/replace PLUGINNAME to the name (Mixed Case) of your plugin
// Find/replace PLUGINBASENAME to be the unique identifier for your plugin (ALL CAPS)
// Find/replace pluginslug to your plugin's textdomain/slug (all lowercase)
// Change the assets/css/pluginslug-syles.scss and dist/js/pluginslug-scripts.js to your own plugin name
// Run npm install to install the necessary dependencies
// Run npx webpack --watch to compile the assets
// Uncomment the PUC include below and find/replace AUTHORREPO (if using GitHub with a public repo)


// Prevent direct access to the plugin.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Sorry, you are not allowed to access this page directly.' );
}

// Plugin base values.
define( 'PLUGINBASENAME', __DIR__ );
define( 'PLUGINBASENAME_VERSION', '0.1' );

// Set up plugin directories.
define( 'PLUGINBASENAME_DIR', plugin_dir_path( __FILE__ ) );
define( 'PLUGINBASENAME_PATH', plugin_dir_url( __FILE__ ) );
define( 'PLUGINBASENAME_BASENAME', plugin_basename( __FILE__ ) );
define( 'PLUGINBASENAME_FILE', __FILE__ );

/**
 * Load the files
 *
 * @param   string $directory  the path to the directory to load.
 * @return  void
 */
function pluginslug_require_files_recursive( $directory ) {
	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $directory, RecursiveDirectoryIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ( $iterator as $file ) {
		if ( $file->isFile() && $file->getExtension() === 'php' ) {
			require_once $file->getPathname();
		}
	}
}

// Require_once all files in /lib and its subdirectories.
pluginslug_require_files_recursive( PLUGINBASENAME_DIR . 'lib' );

// // Load Plugin Update Checker.
// require PLUGINBASENAME_DIR . 'vendor/plugin-update-checker/plugin-update-checker.php';
// $update_checker = Puc_v4_Factory::buildUpdateChecker(
// 	'https://github.com/AUTHORREPO/pluginslug/',
// 	__FILE__,
// 	'pluginslug'
// );

// // Optional: Set the branch that contains the stable release.
// $update_checker->setBranch( 'master' );