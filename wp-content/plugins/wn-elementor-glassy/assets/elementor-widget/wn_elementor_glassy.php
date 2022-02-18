<?php

namespace Elementor;

class Wn_Elementor_Glassy extends Widget_Base
{	
	public function get_name()
	{
		return 'wn-elementor-glassy-widget';
	}

	public function get_title()
	{
		return 'WN Glassy Columns';
	}

	public function get_icon()
	{
		return 'wn_elementor_glassy_widget_icon_three';
	}

	public function get_categories()
	{
		return ['basic'];
	}

	protected function _register_controls($options = [])
	{	
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Elemento Glassy Columns', 'elementor-glassy-columns' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'important_note',
			[
				'label' => __( '', 'elementor-glassy-columns' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div style="background-color:#5c6069; padding: 15px 10px; border-left: solid 2px orange;">Important Note: Elementor Glassy Effect uses a css property called "backdrop-filter", which is not supported yet by firefox and IE.<br><a href="wirenomads.com">Read more</a></div>', 'elementor-glassy-columns' ),
				
			]
		);

		$this->add_control(
			'show_glassy',
			[
				'label' => __( 'Activate', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementor-glassy-columns' ),
				'label_off' => __( 'Hide', 'elementor-glassy-columns' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'blur',
			[
				'label' => __( 'Blur', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 0.1,
					]					
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				]				
			]
		);

		
		$this->end_controls_section();
	}

	protected function render()	{

		$settings = $this->get_settings_for_display();

		$id = $this->get_id();
		
		?>
			<style>

				.wn_eglassy_wrapper {
					display: none;
				}

				.wn_glassy_style {
					background: rgba( 255, 255, 255, 0.25 );
					/* box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);	 */
					border-radius: 10px;
					border: 1px solid rgba( 255, 255, 255, 0.18 );
				}

			</style>
			
				<div id="<?php echo esc_attr($id); ?>" class="wn_eglassy_wrapper"></div>

				<script>
					var wn_elementor_element = jQuery('#<?php echo esc_attr($id); ?>').parent().parent();
					var wn_column = jQuery('#<?php echo esc_attr($id); ?>').parent().parent().parent().parent();
					if ('<?php echo esc_attr($settings['show_glassy']); ?>' == 'yes') {						
						jQuery(wn_column).addClass('wn_glassy_style');					
						jQuery(wn_column).css('backdrop-filter', 'blur(<?php echo esc_attr($settings['blur']['size'] . 'px'); ?>)');
						jQuery(wn_column).css('-webkit-backdrop-filter', 'blur(<?php echo esc_attr($settings['blur']['size'] . 'px'); ?>)');
						
					}
					else {
						jQuery(wn_column).removeClass('wn_glassy_style');
						jQuery(wn_column).css('backdrop-filter', '');
						jQuery(wn_column).css('-webkit-backdrop-filter', '');						
					}
					jQuery(wn_elementor_element).css('margin-bottom', '0px');

				</script>
			
		

		<?php
	}
	protected function _content_template()
	{
		
	}
}



