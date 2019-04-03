<?php
/**
 * @link              http://ideas.echopointer.com
 * @since             1.0.1
 * @package           Dokan_Wishlist
 *
 * @wordpress-plugin
 * Plugin Name:       Dokan Vendor Wishlist2.
 * Plugin URI:        http://ideas.echopointer.com
 * Description:       Allow constomers to add vendors in their wishlist.
 * Version:           1.0.0
 * Author:            Syed Muhammad Shafiq
 * Author URI:        http://ideas.echopointer.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dokan-wishlist
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//The plugin directory path
define( 'DP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in classes/class-dokan-wishlist-activator.php
 */
function activate_dokan_wishlist() {
	require_once plugin_dir_path( __FILE__ ) . 'classes/class-dokan-wishlist-activator.php';
	Dokan_Wishlist_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in classes/class-dokan-wishlist-deactivator.php
 */
function deactivate_dokan_wishlist() {
	require_once plugin_dir_path( __FILE__ ) . 'classes/class-dokan-wishlist-deactivator.php';
	Dokan_Wishlist_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dokan_wishlist' );
register_deactivation_hook( __FILE__, 'deactivate_dokan_wishlist' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'classes/class-dokan-wishlist.php';
require plugin_dir_path( __FILE__ ) . 'includes/template-functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dokan_wishlist() {

	$plugin = new Dokan_Wishlist();
	$plugin->run();

}
run_dokan_wishlist();
