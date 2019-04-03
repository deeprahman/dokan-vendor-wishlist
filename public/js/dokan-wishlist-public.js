(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

})( jQuery );

function kas_addRemove_wishlist(vendor_id){
	
	var data = {
		'action': 'wishlist_action_call',
		'vendor_id': vendor_id
	};

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(kas_wishlist_ajax_object.ajax_url, data, function(response) {
		//alert(response);
		
		if(jQuery('#kas_wishlist_item_' + vendor_id).length){
			jQuery('#kas_wishlist_item_' + vendor_id).remove();
		}
		
		if(jQuery('#kas_like_' + vendor_id).length){
			jQuery('#kas_like_' + vendor_id).html(response);
			jQuery('#kas_like_' + vendor_id).prop('title', response+' customers like this');
		}		
		
		if(jQuery( '#kas_wishlist_'+ vendor_id ).length){
			if(jQuery( '#kas_wishlist_'+ vendor_id ).hasClass( "heart-active" )){
				jQuery( '#kas_wishlist_'+ vendor_id ).removeClass("heart-active");
			}else{
				jQuery('#kas_wishlist_'+ vendor_id).addClass('heart-active');
			}
		}
		
	});
}
