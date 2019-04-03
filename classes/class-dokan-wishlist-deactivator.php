<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://ideas.echopointer.com
 * @since      1.0.0
 *
 * @package    Dokan_Wishlist
 * @subpackage Dokan_Wishlist/classes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Dokan_Wishlist
 * @subpackage Dokan_Wishlist/classes
 * @author     Syed Muhammad Shafiq <shafiq_shaheen@hotmail.com>
 */
class Dokan_Wishlist_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		add_rewrite_endpoint( 'dvw-wishlist', EP_ROOT | EP_PAGES );
		flush_rewrite_rules();
	}

}
