<?php
$options = get_option('sps');

if (isset($_POST['save'])) {
    
    $options = stripslashes_deep($_POST['options']);
    update_option('sps', $options);
}
?>
<div class="wrap">

    <h2><?php esc_attr_e( 'Super Product Variation Swatches for WooCommerce Settings', 'sps' ); ?></h2>
    <p>
      <?php esc_attr_e( 'Thanks for using Super Product Variation Swatches Plugin! You can change settings for your Variation Swatches at this page. Documentation and support links are available below.', 'sps' ); ?>
    </p>
	
	<a href="https://superstorefinder.net/superproductswatches/user-guide/" target="new"><img src="<?php echo plugin_dir_url(__FILE__); ?>/assets/img/button3.jpg" class="sps-option-button"  /></a> <a href="http://superstorefinder.net/support/knowledgebase/" target="new"><img src="<?php echo plugin_dir_url(__FILE__); ?>/assets/img/button4.jpg" class="sps-option-button"  /></a>
	<a href="http://superstorefinder.net/support/" target="new"><img src="<?php echo plugin_dir_url(__FILE__); ?>/assets/img/button1.jpg" class="sps-option-button"  /></a> <a href="https://superstorefinder.net/superproductswatches/product/iphone-xr/" target="new"><img src="<?php echo plugin_dir_url(__FILE__); ?>/assets/img/button2.jpg" class="sps-option-button" /></a>
   


    <form method="post">
        <?php wp_nonce_field(); ?>


        <table class="sps-form-table">
		<tr>
		<th id="tooltip-wrapper"><?php esc_attr_e( 'Border Color', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="20" name="options[border_color]" value="<?php echo htmlspecialchars($options['border_color']); ?>" class="sps-input sps-input-color" />
					<label><?php esc_attr_e( 'Choose your Border Colors', 'sps' ); ?> </label>
					<img src='<?php echo plugin_dir_url(__FILE__); ?>/assets/img/border.jpg' >
                </td>
            </tr>
			<tr>
          <th><?php esc_attr_e( 'Border Color Selected', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="20" name="options[border_color_selected]" value="<?php echo htmlspecialchars($options['border_color_selected']); ?>" class="sps-input sps-input-color" /> 
                </td>
            </tr>
			
			<tr>
          <th><?php esc_attr_e( 'Border Color Hover', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="20" name="options[border_color_hover]" value="<?php echo htmlspecialchars($options['border_color_hover']); ?>" class="sps-input sps-input-color" /> 
                </td>
            </tr>
			
			<tr>
			<th><?php esc_attr_e( 'Swatches Style', 'sps' ); ?></th>
			
                <td>
                    <select name="options[swatches_style]">
					<option value="circled" <?php if(htmlspecialchars($options['swatches_style'])=="circled"){ echo "selected"; } ?>><?php esc_attr_e( 'Circle', 'sps' ); ?></option>
					<option value="squared" <?php if(htmlspecialchars($options['swatches_style'])=="squared"){ echo "selected"; } ?>><?php esc_attr_e( 'Square', 'sps' ); ?></option>
					<option value="rounded-square" <?php if(htmlspecialchars($options['swatches_style'])=="rounded-square"){ echo "selected"; } ?>><?php esc_attr_e( 'Rounded Square', 'sps' ); ?></option>
					</select>
					<label><?php esc_attr_e( 'Choose between Circle or Square Swatches', 'sps' ); ?></label>
					<img src='<?php echo plugin_dir_url(__FILE__); ?>/assets/img/swatch-style.jpg' >
                </td>
            </tr>
			<th><?php esc_attr_e( 'Swatches Size', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="3" name="options[swatch_size]" value="<?php if($options['swatch_size']=="") { echo "26"; } else { echo htmlspecialchars($options['swatch_size']); } ?>" /> px
                </td>
            </tr>
			<tr>
			<th><?php esc_attr_e( 'Show Tooltip', 'sps' ); ?></th>
			
                <td>
                    <select name="options[show_tooltip]">
					<option value="1" <?php if(htmlspecialchars($options['show_tooltip'])=="1"){ echo "selected"; } ?>><?php esc_attr_e( 'Yes', 'sps' ); ?></option>
					<option value="0" <?php if(htmlspecialchars($options['show_tooltip'])=="0"){ echo "selected"; } ?>><?php esc_attr_e( 'No', 'sps' ); ?></option>
					</select>
                </td>
            </tr>
			<tr>
			<th><?php esc_attr_e( 'Tooltip Background', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="20" name="options[tooltip_bg]" value="<?php echo htmlspecialchars($options['tooltip_bg']); ?>" class="sps-input sps-input-color" />
					<label><?php esc_attr_e( 'Style the way how your Tooltip look', 'sps' ); ?></label>
					<img src='<?php echo plugin_dir_url(__FILE__); ?>/assets/img/tooltip.jpg' >
                </td>
            </tr>
			<tr>
			<th><?php esc_attr_e( 'Tooltip Text', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="20" name="options[tooltip_text]" value="<?php echo htmlspecialchars($options['tooltip_text']); ?>" class="sps-input sps-input-color" />
                </td>
            </tr>
			<tr>
			
			<th><?php esc_attr_e( 'Image Variation Type', 'sps' ); ?></th>
			
                <td>
                    <select name="options[image_variation]">
					<option value="zoomed-in" <?php if(htmlspecialchars($options['image_variation'])=="zoomed-in"){ echo "selected"; } ?>><?php esc_attr_e( 'Zoomed-In', 'sps' ); ?></option>
					<option value="full-image" <?php if(htmlspecialchars($options['image_variation'])=="full-image"){ echo "selected"; } ?>><?php esc_attr_e( 'Full Image', 'sps' ); ?></option>
					</select>
					<label><?php esc_attr_e( 'Choose to show zoomed-in design or full image for your Image Swatch', 'sps' ); ?></label>
					<img src='<?php echo plugin_dir_url(__FILE__); ?>/assets/img/imagev.jpg' >
                </td>
            </tr>
			<tr>
			<th><?php esc_attr_e( 'Label Background', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="20" name="options[label_bg]" value="<?php echo htmlspecialchars($options['label_bg']); ?>" class="sps-input sps-input-color" />
					<label><?php esc_attr_e( 'Style your Label Variation look', 'sps' ); ?></label>
					<img src='<?php echo plugin_dir_url(__FILE__); ?>/assets/img/labels.jpg' >
                </td>
            </tr>
			<tr>
			<th><?php esc_attr_e( 'Label Text', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="20" name="options[label_text]" value="<?php echo htmlspecialchars($options['label_text']); ?>" class="sps-input sps-input-color" />
                </td>
            </tr>
			
			<tr>
			<th><?php esc_attr_e( 'Disabled Style', 'sps' ); ?></th>
			
               <td>
                    <select name="options[disabled_style]">
					<option value="crossed-dimmed" <?php if(htmlspecialchars($options['disabled_style'])=="crossed-dimmed"){ echo "selected"; } ?>><?php esc_attr_e( 'Crossed & Dimmed', 'sps' ); ?></option>
					<option value="crossed" <?php if(htmlspecialchars($options['disabled_style'])=="crossed"){ echo "selected"; } ?>><?php esc_attr_e( 'Crossed', 'sps' ); ?></option>
					<option value="dimmed" <?php if(htmlspecialchars($options['disabled_style'])=="dimmed"){ echo "selected"; } ?>><?php esc_attr_e( 'Dimmed', 'sps' ); ?></option>
					<option value="none" <?php if(htmlspecialchars($options['disabled_style'])=="none"){ echo "selected"; } ?>><?php esc_attr_e( 'None', 'sps' ); ?></option>
					</select>
					<label><?php esc_attr_e( 'Select your disabled variation option', 'sps' ); ?></label>
					<img src='<?php echo plugin_dir_url(__FILE__); ?>/assets/img/disabled-style.jpg' >
                </td>
            </tr>
			<tr>
			<th><?php esc_attr_e( 'Cross Color', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="20" name="options[cross_color]" value="<?php echo htmlspecialchars($options['cross_color']); ?>" class="sps-input sps-input-color" />
                </td>
            </tr>
			
            <tr>
                <th><?php esc_attr_e( 'Clear Variation Button', 'sps' ); ?></th>
				
                <td>
                    <select name="options[clear_variation]">
					<option value="1" <?php if(htmlspecialchars($options['clear_variation'])=="1"){ echo "selected"; } ?>><?php esc_attr_e( 'Yes', 'sps' ); ?></option>
					<option value="0" <?php if(htmlspecialchars($options['clear_variation'])=="0"){ echo "selected"; } ?>><?php esc_attr_e( 'No', 'sps' ); ?></option>
					</select>
					
					<label><?php esc_attr_e( 'Toggle to show or hide default WooCommerce Clear button', 'sps' ); ?></label>
					<img src='<?php echo plugin_dir_url(__FILE__); ?>/assets/img/clear-variation.JPG' >
					
                </td>
            </tr>
			
			
			<tr>
                <th><?php esc_attr_e( 'Show on Archive / Products page', 'sps' ); ?></th>
				
                <td>
                    <select name="options[archive]">
					<option value="false" <?php if(htmlspecialchars($options['archive'])=="false"){ echo "selected"; } ?>><?php esc_attr_e( 'No', 'sps' ); ?></option>
					<option value="true" <?php if(htmlspecialchars($options['archive'])=="true"){ echo "selected"; } ?>><?php esc_attr_e( 'Yes', 'sps' ); ?></option>
					</select>
					
					<label><?php esc_attr_e( 'Show Variation Swatches on Archive and Products page', 'sps' ); ?></label>
					
					
                </td>
            </tr>
			<tr>
                <th><?php esc_attr_e( 'Show First Row of Swatch Only on Archive  / Products page', 'sps' ); ?></th>
				
                <td>
                    <select name="options[archive_first_row]">
					<option value="false" <?php if(htmlspecialchars($options['archive_first_row'])=="false"){ echo "selected"; } ?>><?php esc_attr_e( 'No', 'sps' ); ?></option>
					<option value="true" <?php if(htmlspecialchars($options['archive_first_row'])=="true"){ echo "selected"; } ?>><?php esc_attr_e( 'Yes', 'sps' ); ?></option>
					</select>
					
					<label><?php esc_attr_e( 'Show First Row of Variation Swatches on Archive and Products page', 'sps' ); ?></label>
					
					
                </td>
            </tr>
			<tr>
			<th><?php esc_attr_e( 'Archive Swatches Size', 'sps' ); ?></th>
			
                <td>
                    <input type="text" size="3" name="options[archive_swatch_size]" value="<?php if($options['archive_swatch_size']=="") { echo "26"; } else { echo htmlspecialchars($options['archive_swatch_size']); } ?>" /> px
                </td>
            </tr>

        </table>

        <?php if (defined('SPS_EXTRAS')) sps_extra_options(); ?>

        <p class="submit"><input type="submit" name="save" value="<?php esc_attr_e( 'Save Changes', 'sps' ); ?>" class="button button-primary"></p>

    </form>
</div>

<script>
jQuery(document).ready(function($){
    $('.sps-input-color').wpColorPicker();
});
</script>