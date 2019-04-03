<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://ideas.echopointer.com
 * @since      1.0.0
 *
 * @package    Dokan_Wishlist
 * @subpackage Dokan_Wishlist/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dokan_Wishlist
 * @subpackage Dokan_Wishlist/public
 * @author     Syed Muhammad Shafiq <shafiq_shaheen@hotmail.com>
 */
class Dokan_Wishlist_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dokan_Printful_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dokan_Printful_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dokan-wishlist-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dokan_Wishlist_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dokan_Wishlist_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dokan-wishlist-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'kas_wishlist_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}
	
	/**
	 * dokan vendor wishlist full shortcode.
	 *
	 * @since    1.0.0
	 */
	public function vendor_wishlist() { 
		$args = array();
		$args['text_domain'] = $this->plugin_name;
		
		$user_id = get_current_user_id();
		$wishlist = get_user_meta( $user_id, 'kas_wishlist', true );		
		
		$args['wishlist'] = $wishlist;
		
		kas_dwl_get_template('wishlist.php',$args);
	}
	
	/**
	 * Add customer sidebar link.
	 *
	 * @since    1.0.0
	 */
	public function wishlist_account_menu_items( $items ) {
	 
	    $items['dvw-wishlist'] = __( 'Vendor Wishlist', $this->plugin_name );
	 
	    return $items;
	 
	}
	
	/**
	 * Register customer sidebar link.
	 *
	 * @since    1.0.0
	 */
	public function wishlist_add_my_account_endpoint() {
	 
	    add_rewrite_endpoint( 'dvw-wishlist', EP_PAGES );
	 
	}
	
	/**
	 * add like button.
	 *
	 * @since    1.0.0
	 */
	public function add_wishlist($seller, $store_info) {
		$args = array();
		$args['seller'] = $seller;
		$args['store_info'] = $store_info;
		$args['text_domain'] = $this->plugin_name;
		$wished = '';
		$vendor_like = get_user_meta($seller->ID, 'kas_vendor_like', true);
		if($vendor_like){
			$vendor_like = intval($vendor_like);
		}else{
			$vendor_like = 0;
		}	
		if ( is_user_logged_in() ) {
	
			$user_id = get_current_user_id();
			$wishlist = get_user_meta( $user_id, 'kas_wishlist', true );
			$wishlist = rtrim(trim($wishlist), ',');
				
			if (!empty($wishlist)){	
			
				if (strpos($wishlist, ',') !== false ) {

					$wishlist_array = explode(',', $wishlist);
					foreach ($wishlist_array as $wish){
						
						if (strcasecmp($wish,$seller->ID) == 0) {
							//echo $wish;
							$wished = 'heart-active';
							//echo $wished;
						}
					}
					
				}else{
	
					if (strcasecmp($wishlist,$seller->ID) == 0) {
							$wished = 'heart-active';
					}else{
						
						$wished = '';
					}										
				}
			}else{
				$wished = '';		
			}
		}else {
			$wished = '';	
		}
		$args['vendor_like'] = $vendor_like;	
		$args['active'] = $wished;
		kas_dwl_get_template('button.php',$args);
	}
	
	/**
	 * dokan vendor wishlist ajax call.
	 *
	 * @since    1.0.0
	 */	
	public function wishlist_action_call() {
		global $wpdb; // this is how you get access to the database
	
		$vendor_id = intval( $_POST['vendor_id'] );
		$vendor_like = get_user_meta($vendor_id, 'kas_vendor_like', true);
		$vendor_like = rtrim(trim($vendor_like),',');
		$liked_vendor = $vendor_id;
		if ($vendor_like) {
			$vendor_like = intval($vendor_like);
		}else{
			$vendor_like = 0;
		}
		
		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();
			$wishlist = get_user_meta( $user_id, 'kas_wishlist', true ); 
			$wishlist = rtrim($wishlist,',');
			
			
			if (!empty($wishlist)) {
				$wishlist = rtrim($wishlist, ',');
				if (strpos($wishlist, ',') !== false ) {
					$to_insert = array();
					$wishlist_array = explode(',', $wishlist);
					foreach ($wishlist_array as $wish){
						if ($wish != $vendor_id) {
							if(!in_array($wish, $to_insert) && !empty($wish)){
								array_push($to_insert, $wish);
								
							}
						}else{
							$vendor_id = '';
						}
					}
					if(!empty($vendor_id)){
						$vendor_like = ($vendor_like + 1);
					}else{
						if($vendor_like > 0){
							$vendor_like = ($vendor_like - 1);
						}
					}
					
					array_push($to_insert, $vendor_id);
					update_user_meta($user_id, 'kas_wishlist', implode(',', $to_insert));
					update_user_meta( $liked_vendor, 'kas_vendor_like', $vendor_like );
				}else{
					$wishlist = rtrim($wishlist, ',');
					if ($wishlist != $vendor_id) {
						if (!empty($wishlist) && strpos($wishlist, ',') === false) {
							$wishlist = $wishlist . ',' . $vendor_id;
							$vendor_like = ($vendor_like + 1);
						}else {
							$wishlist = $vendor_id;
							$vendor_like = ($vendor_like + 1);
						}
					}else {
						$wishlist = str_replace($vendor_id, '', $wishlist);//$vendor_id;
						if($vendor_like > 0){
							$vendor_like = ($vendor_like - 1);
						}
					}
					update_user_meta($user_id, 'kas_wishlist', $wishlist);
					update_user_meta( $liked_vendor, 'kas_vendor_like', $vendor_like );
				}
			}else{
				
				if (isset($wishlist)) {
					$vendor_like = ($vendor_like + 1);
					update_user_meta($user_id, 'kas_wishlist', $vendor_id);
					update_user_meta( $vendor_id, 'kas_vendor_like', $vendor_like );
				}else{
					add_user_meta( $user_id, 'kas_wishlist', $vendor_id);
					add_user_meta( $liked_vendor, 'kas_vendor_like', 1 );
				}
			}
			
			echo $vendor_like;	
		}else{
			//doSomething...
		}
		wp_die(); // this is required to terminate immediately and return a proper response
	}	

}
