<?php
/**
 * Adds a button to the single product pages
 * for adding a vendor to wishlist
 * dp.rahman@gmail.com
 */

class Dp_Single_Product_Page_Vendor_Wishlist extends Dokan_Wishlist_Public
{
    public function display_button(){
        $vendor_id = get_the_author_meta('ID');
        require_once DP_PLUGIN_DIR.'templates/deep-single-product-button.php';
    }
}