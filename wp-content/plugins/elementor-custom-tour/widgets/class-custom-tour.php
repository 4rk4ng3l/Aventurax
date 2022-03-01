<?php

/**
 * CustomTour class.
 *
 * @category   Class
 * @package    ElementorCustomTour
 * @subpackage WordPress
 * @author     German Fonseca german.fonseca33@gmail.com
 * @copyright  2022 GERMAN FONSECA
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @since      1.0.0
 * php version 7.3.9
 */

namespace ElementorCustomTour\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();


// 
/**
 * CustomTour widget class.
 *
 * @since 1.0.0
 */
class CustomTour extends Widget_Base
{
	/**
	 * Class constructor.
	 *
	 * @param array $data Widget data.
	 * @param array $args Widget arguments.
	 */
	public function __construct($data = array(), $args = null)
	{
		parent::__construct($data, $args);

		wp_register_style('custom_tour', plugins_url('/assets/css/custom-tour.css', ELEMENTOR_CUSTOM_TOUR), array(), '1.0.0');
		wp_enqueue_style('custom_tour');
		wp_register_script('customTour', plugins_url('/assets/js/custom-tour.js', ELEMENTOR_CUSTOM_TOUR), ['elementor-frontend'], '1.0.0', true);
	}


	public function get_script_depends()
	{
		return ['customTour'];
	}


	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'customTour';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('CustomTour', 'elementor-custom-tour');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'fa fa-pencil';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return array('general');
	}

	/**
	 * Enqueue styles.
	 */
	public function get_style_depends()
	{
		return array('customTour');
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls()
	{
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __('Content', 'elementor-customTour'),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __('Title', 'elementor-customTour'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Title', 'elementor-customTour'),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __('Description', 'elementor-CustomTour'),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __('Description', 'elementor-CustomTour'),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __('Content', 'elementor-CustomTour'),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __('Content', 'elementor-CustomTour'),
			)
		);

		$this->end_controls_section();
	}




	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes('title', 'none');
		$this->add_inline_editing_attributes('description', 'basic');
		$this->add_inline_editing_attributes('content', 'advanced');
?>
		<?php
		global $product;
		$id = $product->get_id();
		$hasAcomodacion = $product->get_attribute('acomodacion');


		$origenes = explode(",", $product->get_attribute('origen'));
		$pagos = explode(",", $product->get_attribute('pago'));
		$fechas = explode(",", $product->get_attribute('fecha'));
		$acomodaciones = explode(",", $product->get_attribute('acomodacion'));

		$minimum_price = $product->get_variation_sale_price();
		$max_price = $product->get_variation_regular_price('max');
		$porcentaje_ahorro = 100 - ($minimum_price / $max_price * 100);

		$minimum_price = number_format($minimum_price);
		$max_price = number_format($max_price);
		$porcentaje_ahorro = number_format($porcentaje_ahorro);
		?>
		<div class="BoxTour">
			<div id="IdProduct"><?php echo ($id); ?></div>
			<div class="rectangleYellowDiscount">
				<div class="textYellowDiscount">Ahorra hasta un <?php echo $porcentaje_ahorro ?>%</div>
			</div>
			<div class="textWhiteDiscount">Desde <span style="color:#007CBE"><?php echo '$' . $minimum_price . " COP" ?></span></div>
			<div class="textGrayDiscount"><?php echo '$' . $max_price . "COP" ?></span>
			</div>
			<div class="dropdownTour primerDropdown">
				<div class="icono">
					<svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7 14.9249L10.7125 11.2124C11.4467 10.4782 11.9466 9.54273 12.1492 8.52435C12.3517 7.50596 12.2477 6.45039 11.8503 5.49111C11.4529 4.53183 10.78 3.71192 9.91669 3.13507C9.05334 2.55821 8.03833 2.25032 7 2.25032C5.96167 2.25032 4.94666 2.55821 4.08332 3.13507C3.21997 3.71192 2.54706 4.53183 2.14969 5.49111C1.75231 6.45039 1.64831 7.50596 1.85084 8.52435C2.05337 9.54273 2.55333 10.4782 3.2875 11.2124L7 14.9249ZM7 17.0459L2.227 12.2729C1.28301 11.3289 0.64014 10.1262 0.379696 8.81683C0.119253 7.50746 0.25293 6.15026 0.763824 4.91687C1.27472 3.68347 2.13988 2.62927 3.24991 1.88757C4.35994 1.14588 5.66498 0.75 7 0.75C8.33502 0.75 9.64006 1.14588 10.7501 1.88757C11.8601 2.62927 12.7253 3.68347 13.2362 4.91687C13.7471 6.15026 13.8808 7.50746 13.6203 8.81683C13.3599 10.1262 12.717 11.3289 11.773 12.2729L7 17.0459ZM7 8.99994C7.39783 8.99994 7.77936 8.84191 8.06066 8.5606C8.34197 8.2793 8.5 7.89777 8.5 7.49994C8.5 7.10212 8.34197 6.72059 8.06066 6.43928C7.77936 6.15798 7.39783 5.99994 7 5.99994C6.60218 5.99994 6.22065 6.15798 5.93934 6.43928C5.65804 6.72059 5.5 7.10212 5.5 7.49994C5.5 7.89777 5.65804 8.2793 5.93934 8.5606C6.22065 8.84191 6.60218 8.99994 7 8.99994ZM7 10.4999C6.20435 10.4999 5.44129 10.1839 4.87868 9.62126C4.31607 9.05865 4 8.29559 4 7.49994C4 6.70429 4.31607 5.94123 4.87868 5.37862C5.44129 4.81601 6.20435 4.49994 7 4.49994C7.79565 4.49994 8.55871 4.81601 9.12132 5.37862C9.68393 5.94123 10 6.70429 10 7.49994C10 8.29559 9.68393 9.05865 9.12132 9.62126C8.55871 10.1839 7.79565 10.4999 7 10.4999Z" fill="#6F727C" />
					</svg>
				</div>
				<div class="titleDropdown">
					Origen
				</div>
				<div class="textoDropdown" id="txtOrigen">
					<?php echo $origenes[0]; ?>
				</div>
				<div class="iconoDesplegable">
					<svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.99974 5.17192L11.9497 0.221924L13.3637 1.63592L6.99974 7.99992L0.635742 1.63592L2.04974 0.221924L6.99974 5.17192Z" fill="#757575" />
					</svg>
				</div>
				<ul id="menuOrigenes">
					<?php
					foreach ($origenes as $origen) {
						echo '<li>' . $origen . '</li>';
					}
					?>
				</ul>
			</div>
			<div class="dropdownTour segundoDropdown">
				<div class="icono">
					<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M2 11V2H0.5V0.5H2.75C2.94891 0.5 3.13968 0.579018 3.28033 0.71967C3.42098 0.860322 3.5 1.05109 3.5 1.25V10.25H12.8285L14.3285 4.25H5V2.75H15.29C15.404 2.75 15.5165 2.776 15.619 2.826C15.7214 2.87601 15.8111 2.94871 15.8813 3.03859C15.9514 3.12847 16.0001 3.23315 16.0237 3.34468C16.0473 3.45622 16.0452 3.57166 16.0175 3.68225L14.1425 11.1823C14.1019 11.3444 14.0082 11.4884 13.8764 11.5913C13.7446 11.6941 13.5822 11.75 13.415 11.75H2.75C2.55109 11.75 2.36032 11.671 2.21967 11.5303C2.07902 11.3897 2 11.1989 2 11ZM3.5 16.25C3.10217 16.25 2.72064 16.092 2.43934 15.8107C2.15804 15.5294 2 15.1478 2 14.75C2 14.3522 2.15804 13.9706 2.43934 13.6893C2.72064 13.408 3.10217 13.25 3.5 13.25C3.89782 13.25 4.27936 13.408 4.56066 13.6893C4.84196 13.9706 5 14.3522 5 14.75C5 15.1478 4.84196 15.5294 4.56066 15.8107C4.27936 16.092 3.89782 16.25 3.5 16.25ZM12.5 16.25C12.1022 16.25 11.7206 16.092 11.4393 15.8107C11.158 15.5294 11 15.1478 11 14.75C11 14.3522 11.158 13.9706 11.4393 13.6893C11.7206 13.408 12.1022 13.25 12.5 13.25C12.8978 13.25 13.2794 13.408 13.5607 13.6893C13.842 13.9706 14 14.3522 14 14.75C14 15.1478 13.842 15.5294 13.5607 15.8107C13.2794 16.092 12.8978 16.25 12.5 16.25Z" fill="#6F727C" />
					</svg>
				</div>
				<div class="titleDropdown">
					Pago
				</div>
				<div class="textoDropdown" id="txtPago">
					<?php echo $pagos[0]; ?>
				</div>
				<div class="iconoDesplegable">
					<svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.99974 5.17192L11.9497 0.221924L13.3637 1.63592L6.99974 7.99992L0.635742 1.63592L2.04974 0.221924L6.99974 5.17192Z" fill="#757575" />
					</svg>
				</div>
				<ul id="menuPagos">
					<?php
					foreach ($pagos as $pago) {
						echo '<li>' . $pago . '</li>';
					}
					?>
				</ul>
			</div>
			<div class="dropdownTour tercerDropdown">
				<div class="icono">
					<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M13.75 14C13.75 14.1989 13.671 14.3897 13.5303 14.5303C13.3897 14.671 13.1989 14.75 13 14.75H1C0.801088 14.75 0.610322 14.671 0.46967 14.5303C0.329018 14.3897 0.25 14.1989 0.25 14V6.1175C0.249921 6.00321 0.275963 5.89041 0.326137 5.78772C0.376311 5.68503 0.44929 5.59517 0.5395 5.525L6.5395 0.858498C6.67116 0.756082 6.8332 0.700478 7 0.700478C7.1668 0.700478 7.32884 0.756082 7.4605 0.858498L13.4605 5.525C13.5507 5.59517 13.6237 5.68503 13.6739 5.78772C13.724 5.89041 13.7501 6.00321 13.75 6.1175V14ZM12.25 13.25V6.4835L7 2.4005L1.75 6.4835V13.25H12.25Z" fill="#6F727C" />
					</svg>
				</div>
				<div class="titleDropdown">
					Acomodacion
				</div>
				<div class="textoDropdown" id="txtAcomodacion">
					<?php echo $acomodaciones[0]; ?>
				</div>
				<div class="iconoDesplegable">
					<svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.99974 5.17192L11.9497 0.221924L13.3637 1.63592L6.99974 7.99992L0.635742 1.63592L2.04974 0.221924L6.99974 5.17192Z" fill="#757575" />
					</svg>
				</div>
				<ul id="menuAcomodaciones">
					<?php
					foreach ($acomodaciones as $acomodacion) {
						echo '<li>' . $acomodacion . '</li>';
					}
					?>
				</ul>
			</div>
			<div class="boxFechas">
				<div class="iconoFecha">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M11.75 2H14.75C14.9489 2 15.1397 2.07902 15.2803 2.21967C15.421 2.36032 15.5 2.55109 15.5 2.75V14.75C15.5 14.9489 15.421 15.1397 15.2803 15.2803C15.1397 15.421 14.9489 15.5 14.75 15.5H1.25C1.05109 15.5 0.860322 15.421 0.71967 15.2803C0.579018 15.1397 0.5 14.9489 0.5 14.75V2.75C0.5 2.55109 0.579018 2.36032 0.71967 2.21967C0.860322 2.07902 1.05109 2 1.25 2H4.25V0.5H5.75V2H10.25V0.5H11.75V2ZM10.25 3.5H5.75V5H4.25V3.5H2V6.5H14V3.5H11.75V5H10.25V3.5ZM14 8H2V14H14V8Z" fill="#6F727C" />
					</svg>
				</div>
				<div class="textoFecha">Fecha</div>
				<div class="boxFechasSel">
					<?php
					$first = true;
					foreach ($fechas as $fecha) {
						if ($first) {
							echo '<div class="boxFecha selectedFecha"><span>' . $fecha . '</span></div>';
						} else {
							echo '<div class="boxFecha"><span>' . $fecha . '</span></div>';
						}
						$first = false;
					}
					?>
				</div>
			</div>
			<div class="boxCantidades">
				<div class="textoCantidad">Cantidad</div>
				<div class="cantidades">
					<div class="menos">
						<i class="fa fa-minus-circle aria-hidden=" true"></i>
					</div>
					<div class="cantidad">
						<span>1</span>
					</div>
					<div class="mas">
						<i class="fa fa-plus-circle aria-hidden=" true"></i>
					</div>
				</div>
			</div>
			<div class="total">Total: <span id="txtPrecio">$680.000 COP</span></div>
			<div class="boxCarrito">
				<div class="textCarrito"><span>Añadir al carrito</span>
				</div>
			</div>
		</div>


		<h2 <?php echo $this->get_render_attribute_string('title'); ?><?php echo wp_kses($settings['title'], array()); ?></h2>
			<div <?php echo $this->get_render_attribute_string('description'); ?><?php echo wp_kses($settings['description'], array()); ?></div>
				<div <?php echo $this->get_render_attribute_string('content'); ?><?php echo wp_kses($settings['content'], array()); ?></div>
				<?php
			}

			/**
			 * Render the widget output in the editor.
			 *
			 * Written as a Backbone JavaScript template and used to generate the live preview.
			 *
			 * @since 1.0.0
			 *
			 * @access protected
			 */
			protected function content_template()
			{
				?>
					<# view.addInlineEditingAttributes( 'title' , 'none' ); view.addInlineEditingAttributes( 'description' , 'basic' ); view.addInlineEditingAttributes( 'content' , 'advanced' ); #>
						<h2 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h2>
						<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
						<div {{{ view.getRenderAttributeString( 'content' ) }}}>{{{ settings.content }}}</div>
				<?php
			}
		}
