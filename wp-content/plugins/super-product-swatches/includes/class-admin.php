<?php

/**
 * Class SPS_WCVariation_Swatches_Admin
 */
class SPS_WCVariation_Swatches_Admin {
	/**
	 * The class instance
	 *
	 * @var SPS_WCVariation_Swatches_Admin
	 */
	protected static $instance = null;

	/**
	 * Main instance
	 *
	 * @return SPS_WCVariation_Swatches_Admin
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
		add_action( 'admin_init', array( $this, 'includes' ) );
		add_action( 'admin_init', array( $this, 'init_attribute_hooks' ) );
		add_action( 'admin_print_scripts', array( $this, 'enqueue_scripts' ) );

		// Display attribute fields
		add_action( 'sps_product_attribute_field', array( $this, 'attribute_fields' ), 10, 3 );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		include_once( dirname( __FILE__ ) . '/class-admin-product.php' );
	}

	/**
	 * Init hooks for adding fields to attribute screen
	 * Save new term meta
	 * Add thumbnail column for attribute term
	 */
	public function init_attribute_hooks() {
		$attribute_taxonomies = wc_get_attribute_taxonomies();

		if ( empty( $attribute_taxonomies ) ) {
			return;
		}

		foreach ( $attribute_taxonomies as $tax ) {
			add_action( 'pa_' . $tax->attribute_name . '_add_form_fields', array( $this, 'add_attribute_fields' ) );
			add_action( 'pa_' . $tax->attribute_name . '_edit_form_fields', array( $this, 'edit_attribute_fields' ), 10, 2 );

			add_filter( 'manage_edit-pa_' . $tax->attribute_name . '_columns', array( $this, 'add_attribute_columns' ) );
			add_filter( 'manage_pa_' . $tax->attribute_name . '_custom_column', array( $this, 'add_attribute_column_content' ), 10, 3 );
		}

		add_action( 'created_term', array( $this, 'save_term_meta' ), 10, 2 );
		add_action( 'edit_term', array( $this, 'save_term_meta' ), 10, 2 );
	}

	/**
	 * Load stylesheet and scripts in edit product attribute screen
	 */
	public function enqueue_scripts() {
		$screen = get_current_screen();
		if ( strpos( $screen->id, 'edit-pa_' ) === false && strpos( $screen->id, 'product' ) === false ) {
			return;
		}

		wp_enqueue_media();

		wp_enqueue_style( 'sps-admin', plugins_url( '/assets/css/admin.css', dirname( __FILE__ ) ), array( 'wp-color-picker' ), '1.0' );
		wp_enqueue_script( 'sps-admin', plugins_url( '/assets/js/admin.js', dirname( __FILE__ ) ), array( 'jquery', 'wp-color-picker', 'wp-util' ), '1.0', true );
		
		wp_localize_script(
			'sps-admin',
			'sps',
			array(
				'i18n'        => array(
					'mediaTitle'  => esc_html__( 'Choose an image', 'sps' ),
					'mediaButton' => esc_html__( 'Use image', 'sps' ),
				),
				'placeholder' => WC()->plugin_url() . '/assets/images/placeholder.png'
			)
		);
	}

	/**
	 * Create hook to add fields for add attribute term screen
	 *
	 * @param string $taxonomy
	 */
	public function add_attribute_fields( $taxonomy ) {
		$attr = S_PS()->get_tax_attribute( $taxonomy );

		do_action( 'sps_product_attribute_field', $attr->attribute_type, '', 'add' );
	}

	/**
	 * Create hook to fields for edit attribute term screen
	 *
	 * @param object $term
	 * @param string $taxonomy
	 */
	public function edit_attribute_fields( $term, $taxonomy ) {
		$attr  = S_PS()->get_tax_attribute( $taxonomy );
		$value = get_term_meta( $term->term_id, $attr->attribute_type, true );

		do_action( 'sps_product_attribute_field', $attr->attribute_type, $value, 'edit' );
	}

	/**
	 * Print HTML of custom fields on attribute term screens
	 *
	 * @param $type
	 * @param $value
	 * @param $form
	 */
	public function attribute_fields( $type, $value, $form ) {
		// Return if this is a default attribute type
		if ( in_array( $type, array( 'select', 'text' ) ) ) {
			return;
		}

		// Print the open tag on the field container
		printf(
			'<%s class="form-field">%s<label for="term-%s">%s</label>%s',
			'edit' == $form ? 'tr' : 'div',
			'edit' == $form ? '<th>' : '',
			esc_attr( $type ),
			S_PS()->types[$type],
			'edit' == $form ? '</th><td>' : ''
		);

		switch ( $type ) {
			case 'image':
				$image = $value ? wp_get_attachment_image_src( $value ) : '';
				$image = $image ? $image[0] : WC()->plugin_url() . '/assets/images/placeholder.png';
				?>
				<div class="sps-term-image-thumbnail">
					<img src="<?php echo esc_url( $image ) ?>" class="sps-img" />
				</div>
				<div class="sps-add-remove-image">
					<input type="hidden" class="sps-term-image" name="image" value="<?php echo esc_attr( $value ) ?>" />
					<button type="button" class="sps-upload-image-button button"><?php esc_html_e( 'Upload/Add image', 'sps' ); ?></button>
					<button type="button" class="sps-remove-image-button button <?php echo $value ? '' : 'hidden' ?>"><?php esc_html_e( 'Remove image', 'sps' ); ?></button>
				</div>
				<?php
				break;

			default:
				?>
				<input type="text" id="term-<?php echo esc_attr( $type ) ?>" name="<?php echo esc_attr( $type ) ?>" value="<?php echo esc_attr( $value ) ?>" />
				<?php
				break;
		}

		// Print the close tag of field container
		echo 'edit' == $form ? '</td></tr>' : '</div>';
	}

	/**
	 * Save term meta data
	 *
	 * @param int $term_id
	 * @param int $tt_id
	 */
	public function save_term_meta( $term_id, $tt_id ) {
		foreach ( S_PS()->types as $type => $label ) {
			if ( isset( $_POST[$type] ) ) {
				update_term_meta( $term_id, $type, $_POST[$type] );
			}
		}
	}

	/**
	 * Add thumbnail column to column list
	 *
	 * @param array $columns
	 *
	 * @return array
	 */
	public function add_attribute_columns( $columns ) {
		$new_columns          = array();
		$new_columns['cb']    = $columns['cb'];
		$new_columns['thumb'] = '';
		unset( $columns['cb'] );

		return array_merge( $new_columns, $columns );
	}

	/**
	 * Render thumbnail HTML depend on the attribute type
	 *
	 * @param $columns
	 * @param $column
	 * @param $term_id
	 */
	public function add_attribute_column_content( $columns, $column, $term_id ) {
		$attr  = S_PS()->get_tax_attribute( $_REQUEST['taxonomy'] );
		$value = get_term_meta( $term_id, $attr->attribute_type, true );

		switch ( $attr->attribute_type ) {
			case 'color':
				printf( '<div class="swatch-preview swatch-color" style="background-color:%s;"></div>', esc_attr( $value ) );
				break;

			case 'image':
				$image = $value ? wp_get_attachment_image_src( $value ) : '';
				$image = $image ? $image[0] : WC()->plugin_url() . '/assets/images/placeholder.png';
				printf( '<img class="swatch-preview swatch-image" src="%s" width="44px" height="44px">', esc_url( $image ) );
				break;

			case 'label':
				printf( '<div class="swatch-preview swatch-label">%s</div>', esc_html( $value ) );
				break;
		}
	}
}
