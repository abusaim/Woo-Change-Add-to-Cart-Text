<?php
/*
 * Plugin Name: Woo Change Add to Cart Text
 * Plugin URI: https://wordpress.org/plugins/woo-change-add-to-cart-text/
 * Description: WooCommerce change the <strong>Add to Cart</strong> text on product <strong>archive</strong> and the <strong>single</strong> product page.
 * Author: Abu Saim
 * Author URI: https://profiles.wordpress.org/abusaim/
 * Version: 1.0.0
 * Text Domain: woocatct
 * Domain Path: /languages/
 * WC requires at least: 3.0.0
 * WC tested up to: 3.5.1
 * Tested up to: 5.2.2
 * Requires PHP: 5.6
 * Requires at least: 4.9
 * Stable tag: 1.0.0 
 * License: GPL version 2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Check if WooCommerce is active
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // warning message if WooCommerce is not active
    add_action( 'admin_notices', 'woo_change_add_to_cart_text_admin_notice' );
    return;
}

function woo_change_add_to_cart_text_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( '"Woo Change Add to Cart Text" requires <strong>WooCommerce</strong> to be installed and active.', 'woocatct' ); ?></p>
    </div>
    <?php
}



// Load plugin textdomain
function woo_change_add_to_cart_text_load_textdomain() {
    load_plugin_textdomain( 'woocatct', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'woo_change_add_to_cart_text_load_textdomain' );

// Add settings link on plugin page
function woo_change_add_to_cart_text_settings_link( $links ) {    
    $settings_link = '<a href="'. admin_url( 'admin.php?page=woo-change-add-to-cart-text' ) .'">' . __( 'Settings', 'woocatct' ) . '</a>';
    array_push( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'woo_change_add_to_cart_text_settings_link' );

// include functions.php
require_once( plugin_dir_path( __FILE__ ) . 'include/functions.php' );