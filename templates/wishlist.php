<?php
/* *
 * $text_domain plugin textdomain
 *
 * */

	if (!empty($wishlist)){

?>

<h2><?php _e('My Vendors Wishlist',$text_domain); ?></h2>

<form action="" method="post">
<table class="shop_table shop_table_responsive">
	<thead>
		<tr>
			<th><?php _e('Action',$text_domain);?></th>
			<th><?php _e('Vendor Logo', $text_domain);?></th>
			<th><?php _e('Vendor Details', $text_domain);?></th>
		</tr>
	</thead>
	<tbody>

	<?php
	if (strpos($wishlist, ',') !== false) {
		$wishlist = explode(',', $wishlist);
			
		foreach ($wishlist as $vendor_id){

			if(!empty($vendor_id) && intval($vendor_id)){
				$store_info = dokan_get_store_info($vendor_id);
				$store_url  = dokan_get_store_url( $vendor_id );
				$store_address = dokan_get_seller_short_address( $vendor_id, false );
			?>
				<tr id="kas_wishlist_item_<?php echo $vendor_id;?>">
					<td>
						<button type="button" onclick="kas_addRemove_wishlist(<?php echo $vendor_id;?>);">X</button>
					</td>
					<td>
						<a href="<?php echo $store_url;?>"><?php echo get_avatar( $vendor_id, 100 ); ?></a>
					</td>
					<td>
						<h3><a href="<?php echo $store_url;?>"> <?php echo $store_info['store_name']; ?></a></h3>
					 <?php echo $store_address; ?>
					</td>
				</tr>
		<?php }
			
		}
	}else {
		if(!empty($wishlist) && intval($wishlist)){
			$store_info = dokan_get_store_info($wishlist);
			$store_url  = dokan_get_store_url( $wishlist );
			$store_address = dokan_get_seller_short_address( $wishlist, false );
			?>
		<tr id="kas_wishlist_item_<?php echo $wishlist;?>">
			<td>
			<button type="button"
				onclick="kas_addRemove_wishlist(<?php echo $wishlist;?>);">X</button>
			</td>
			<td><a href="<?php echo $store_url;?>"><?php echo get_avatar( $vendor_id, 100 ); ?></a></td>
			<td>
				<h3><a href="<?php echo $store_url;?>"> <?php echo $store_info['store_name']; ?></a></h3>
			<?php echo $store_address; ?>	
			
			</td>
		</tr>
		<?php }?>
	<?php } ?>


<?php }else{ ?>
	<tr>
		<td colspan="3"><?php _e('No Seller in wishlist.',$text_domain);?></td>
	</tr>

<?php } ?>
	</tbody>
</table>
</form>