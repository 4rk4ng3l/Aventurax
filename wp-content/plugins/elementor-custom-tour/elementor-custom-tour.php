<?php
/**
 * Elementor Custom WordPress Plugin
 *
 * @package ElementorCustomTour
 *
 * Plugin Name: Elementor Custom Form
 * Description: Formulario de detalle tour
 * Plugin URI:  https://www.benmarshall.me/build-custom-elementor-widgets/
 * Version:     1.0.0
 * Author:      German Fonseca
 * Author URI:  https://www.3darteweb.com
 * Text Domain: elementor-custom-tour
 */

define( 'ELEMENTOR_CUSTOM_TOUR', __FILE__ );

/**
 * Include the ELEMENTOR_CUSTOR_TOUR class.
 */
require plugin_dir_path( ELEMENTOR_CUSTOM_TOUR ) . 'class-elementor-custom-tour.php';
