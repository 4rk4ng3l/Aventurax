<?php

/**
 * Main Class for the Super Product Variation Swatches Plugin
 */
final class SPS_WCVariation_Swatches {
	/**
	 * The single class instance
	 *
	 * @var SPS_WCVariation_Swatches
	 */
	protected static $instance = null;

	/**
	 * Extra attribute types
	 *
	 * @var array
	 */
	public $types = array();

	/**
	 * Main instance
	 *
	 * @return SPS_WCVariation_Swatches
	 */
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->types = array(
			'color' => esc_html__( 'Color', 'sps' ),
			'image' => esc_html__( 'Image', 'sps' ),
			'label' => esc_html__( 'Label', 'sps' ),
		);

		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Include the required core files utilized in admin and on the frontend.
	 */
	public function includes() {
		require_once dirname( __FILE__ ) . '/class-frontend.php';

		if ( is_admin() ) {
			require_once dirname( __FILE__ ) . '/class-admin.php';
		}
	}

	/**
	 * Initialize hooks
	 */
	public function init_hooks() {
		add_action( 'init', array( $this, 'load_textdomain' ) );

		add_filter( 'product_attributes_type_selector', array( $this, 'add_attribute_types' ) );

		if ( is_admin() ) {
			add_action( 'init', array( 'SPS_WCVariation_Swatches_Admin', 'instance' ) );
		}

		if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			add_action( 'init', array( 'SPS_WCVariation_Swatches_Frontend', 'instance' ) );
		}
	}

	/**
	 * Load plugin text domain
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'sps', false, dirname( plugin_basename( SPS_VS_PLUGIN_FILE ) ) . '/languages/' );
	}

	/**
	 * Add extra attribute types
	 * Add Color, Image and Label type
	 *
	 * @param array $types
	 *
	 * @return array
	 */
	public function add_attribute_types( $types ) {
		$types = array_merge( $types, $this->types );

		return $types;
	}

	/**
	 * Get attribute's properties data
	 *
	 * @param string $taxonomy
	 *
	 * @return object
	 */
	public function get_tax_attribute( $taxonomy ) {
		global $wpdb;

		$attr = substr( $taxonomy, 3 );
		$attr = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name = '$attr'" );

		return $attr;
	}

	/**
	 * Instance of admin
	 *
	 * @return object
	 */
	public function admin() {
		return SPS_WCVariation_Swatches_Admin::instance();
	}

	/**
	 * Instance of frontend
	 *
	 * @return object
	 */
	public function frontend() {
		return SPS_WCVariation_Swatches_Frontend::instance();
	}
}

if ( ! function_exists( 'S_PS' ) ) {
	/**
	 * Main Instance for the Super Product Variation Swatches Plugin
	 *
	 * @return SPS_WCVariation_Swatches
	 */
	function S_PS() {
		return SPS_WCVariation_Swatches::instance();
	}
}