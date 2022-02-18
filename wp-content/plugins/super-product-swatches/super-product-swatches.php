<?php
/**
 * Plugin Name: Super Product Variation Swatches
 * Plugin URI: http://superstorefinder.net/superproductswatches
 * Description: Elegant and Fully Customizable Product Variation Swatches / Selector extension for WooCommerce.
 * Version: 2.0
 * Author: Joe Iz
 * Author URI: http://superstorefinder.net
 * Requires at least: 4.0
 * Tested up to: 5.7
 * Text Domain: sps
 * Domain Path: /languages/
 * WC requires at least: 3.0
 * WC tested up to: 5.3
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define SPS_DEALS_PLUGIN_FILE
if ( ! defined( 'SPS_VS_PLUGIN_FILE' ) ) {
	define( 'SPS_VS_PLUGIN_FILE', __FILE__ );
}

if ( ! function_exists( 'sps_wc_variation_swatches_wc_notice' ) ) {
	/**
	 * Display notice when WooCommerce plugin is not activated
	 */
	function sps_wc_variation_swatches_wc_notice() {
		?>

		<div class="error">
			<p><?php esc_html_e( 'Super Product Variation Swatches is enabled but not effective. It requires WooCommerce in order to work.', 'sps' ); ?></p>
		</div>

		<?php
	}
}



if ( ! function_exists( 'sps_wc_variation_swatches_constructor' ) ) {
	/**
	 * Plugin Contructor when plugin is loaded in order to make sure WooCommerce API is fully loaded
	 * Check if WooCommerce is not activated then show an admin notice
	 * or create the main instance of plugin
	 */
	function sps_wc_variation_swatches_constructor() {
		if ( ! function_exists( 'WC' ) ) {
			add_action( 'admin_notices', 'sps_wc_variation_swatches_wc_notice' );
		} elseif ( defined( 'SPS_VS_PRO' ) ) {
			add_action( 'admin_notices', 'sps_wc_variation_swatches_pro_notice' );
			deactivate_plugins( plugin_basename( __FILE__ ) );
		} else {
			require_once plugin_dir_path( __FILE__ ) . '/includes/class-variation-swatches.php';
			S_PS();
		}
	}
}

if ( ! function_exists( 'sps_wc_variation_swatches_deactivate' ) ) {
	/**
	 * Deactivation hook.
	 * Backup all unsupported types of attributes then reset them to "select".
	 *
	 * @param bool $network_deactivating Whether the plugin is deactivated for all sites in the network or current site. For multi-site.
	 */
	function sps_wc_variation_swatches_deactivate( $network_deactivating ) {
		global $wpdb;

		$blog_ids         = array( 1 );
		$original_blog_id = 1;
		$network          = false;

		if ( is_multisite() && $network_deactivating ) {
			$blog_ids         = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->blogs}" );
			$original_blog_id = get_current_blog_id();
			$network          = true;
		}

		foreach ( $blog_ids as $blog_id ) {
			if ( $network ) {
				switch_to_blog( $blog_id );
			}

			// Backuping attribute types
			$attributes         = wc_get_attribute_taxonomies();
			$default_types      = array( 'text', 'select' );
			$sps_attributes = array();

			if ( ! empty( $attributes ) ) {
				foreach ( $attributes as $attribute ) {
					if ( ! in_array( $attribute->attribute_type, $default_types ) ) {
						$sps_attributes[ $attribute->attribute_id ] = $attribute;
					}
				}
			}

			if ( ! empty( $sps_attributes ) ) {
				set_transient( 'sps_attribute_taxonomies', $sps_attributes );
				delete_transient( 'wc_attribute_taxonomies' );
				update_option( 'sps_backup_attributes_time', time() );
			}


			// Delete the ignore restore
			delete_option( 'sps_ignore_restore_attributes' );
		}

		if ( $network ) {
			switch_to_blog( $original_blog_id );
		}
	}
}

add_action( 'plugins_loaded', 'sps_wc_variation_swatches_constructor', 20 );
register_deactivation_hook( __FILE__, 'sps_wc_variation_swatches_deactivate' );

add_action('admin_menu', 'sps_admin_menu');
function sps_admin_menu()
{
    add_options_page('Super Product Variation Swatches Settings', '<span class="dashicons dashicons-heart"></span> Super Product Variation Swatches', 'manage_options', 'super-product-swatches/options.php');
}