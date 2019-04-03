<?php 
/* *
 * $text_domain plugin textdomain
 *
 * */
?>

<span class="kas-wl-container">
	<span title="<?php _e($vendor_like. ' customers like this', $text_domain);?>" class="kas_like_count" id="kas_like_<?php echo $seller->ID; ?>"><?php echo $vendor_like; ?></span>
	<span title="<?php _e('Add to wishlist', $text_domain);?>" onclick="kas_addRemove_wishlist(<?php echo $seller->ID; ?>);" class="heart <?php echo $active; ?>" id="kas_wishlist_<?php echo $seller->ID; ?>"></span>
</span>                     
