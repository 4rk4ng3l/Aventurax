<?php

class Wn_Elementor_Glassy_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected function __construct() {

		require_once('wn_elementor_glassy.php');
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		add_action('elementor/editor/before_enqueue_scripts', function() {			
			// wp_enqueue_style( 'wn_elementor_glassy_css_four', WN_ELEMENTOR_GLASSY_URL . 'css/wn-elementor-glassy-icon-three.css');	
			wp_enqueue_style( 'wn_elementor_glassy_css', WN_ELEMENTOR_GLASSY_URL . 'css/wn-elementor-glassy-icon-three.css', array(), current_time('mysql') );	
		});
		
	}


	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Wn_Elementor_Glassy() );
	}

}

add_action( 'init', 'wn_elementor_glassy_init' );

function wn_elementor_glassy_init() {
	Wn_Elementor_Glassy_Widgets::get_instance();	
}
