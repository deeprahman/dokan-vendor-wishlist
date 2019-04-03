<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://ideas.echopointer.com
 * @since      1.0.0
 *
 * @package    Dokan_Wishlist
 * @subpackage Dokan_Wishlist/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ) . ' ' . $this->version; ?></h2>

	

	<form method="post" name="wishlist_options" action="options.php">

	<?php
	//Grab all options

		$options = get_option($this->plugin_name);

		// Cleanup
		$allow = $options['allow'];
		
	?>


	<?php
		settings_fields( $this->plugin_name );
		do_settings_sections( $this->plugin_name );
	?>

	<!-- remove some meta and generators from the <head> -->
	
	<h3><?php _e('Wishlist ShortCode',$this->plugin_name);?> : <b>[dokan_vendor_wishlist]</b></h3>
	
	<fieldset>

		<label for="<?php echo $this->plugin_name;?>-allow">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-allow" name="<?php echo $this->plugin_name;?>[allow]" value="1" <?php checked( $allow, 1 ); ?> />
			<span><?php esc_attr_e( 'Allow Customers to add Vendors in their wishlist.', $this->plugin_name ); ?></span>
		</label>
	</fieldset>




            <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>
