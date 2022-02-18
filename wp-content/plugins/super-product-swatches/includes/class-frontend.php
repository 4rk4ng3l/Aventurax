<?php

/**
 * Class for the Frontend
 */
class SPS_WCVariation_Swatches_Frontend {
	/**
	 * The single class instance
	 *
	 * @var SPS_WCVariation_Swatches_Frontend
	 */
	protected static $instance = null;

	/**
	 * Main instance
	 *
	 * @return SPS_WCVariation_Swatches_Frontend
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
		
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_settings' ) );


		add_filter( 'woocommerce_dropdown_variation_attribute_options_html', array( $this, 'get_swatch_html' ), 100, 2 );
		add_filter( 'sps_swatch_html', array( $this, 'swatch_html' ), 5, 4 );
		
	}

	/**
	 * Enqueue custom settings
	 */


function enqueue_settings()
{
	
   $sps_css = "";
   $sps_options = get_option('sps');
   $sps_css .= "<style id='super-products-swatches' type='text/css'>";
		if(htmlspecialchars($sps_options['clear_variation'])=="0"){
		$sps_css .= ".reset_variations {
				display: none !important;
			}";
		}
		
		if(htmlspecialchars($sps_options['image_variation'])=="full-image"){
		$sps_css .= ".textureImage {
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}";
		}
		
		if(htmlspecialchars($sps_options['swatches_style'])=="squared"){
		$sps_css .= ".sps-swatches .swatch {
			border-radius: 0% !important;
			}
			
			.sps-swatches>.swatchColor {
				border-radius: 0% !important;
			}";
		} else if(htmlspecialchars($sps_options['swatches_style'])=="rounded-square"){
		$sps_css .= ".sps-swatches .swatch {
			border-radius: 15% !important;
			}
			
			.sps-swatches>.swatchColor {
				border-radius: 15% !important;
			}";
		}
		
		
		if(htmlspecialchars($sps_options['disabled_style'])=="crossed"){
		$sps_css .= ".sps-swatches .swatch.disabled, .sps-swatches .superSwatch.disabled {
			opacity: 1 !important;		
			}";
		}
		
		
		if(htmlspecialchars($sps_options['disabled_style'])=="dimmed"){
		$sps_css .= ".sps-swatches>.superSwatch.disabled:before {
			display: none !important;
			}
			
			.sps-swatches>.superSwatch.disabled:after {
			display: none !important;
			}";
		}
		
		if(htmlspecialchars($sps_options['disabled_style'])=="none"){
		$sps_css .= ".sps-swatches>.superSwatch.disabled:before {
			display: none !important;
			}
			
			.sps-swatches>.superSwatch.disabled:after {
			display: none !important;
			}
			
			.sps-swatches .swatch.disabled, .sps-swatches .superSwatch.disabled {
			opacity: 1 !important;
			pointer-events:auto !important;			
			}";
		}
		
		if(htmlspecialchars($sps_options['cross_color'])!=""){
		$sps_css .= ".sps-swatches>.superSwatch.disabled:before {
			background-color: ".htmlspecialchars($sps_options['cross_color'])." !important;
			}
			
			.sps-swatches>.superSwatch.disabled:after {
			background-color: ".htmlspecialchars($sps_options['cross_color'])." !important;
			}";
		}
		
		if(htmlspecialchars($sps_options['swatch_size'])!=""){
		$sps_css .= ".sps-swatches>.swatchColor, .sps-swatches>.swatchColor>div {
			width: ".htmlspecialchars($sps_options['swatch_size'])."px !important;
			height: ".htmlspecialchars($sps_options['swatch_size'])."px !important;
			}
			
			.sps-swatches .swatch {
				width: ".htmlspecialchars($sps_options['swatch_size'])."px !important;
				height: ".htmlspecialchars($sps_options['swatch_size'])."px !important;
				line-height: ".htmlspecialchars($sps_options['swatch_size'])."px !important;
			}";
		}
		
		
		if(htmlspecialchars($sps_options['archive_swatch_size'])!=""){
		$sps_css .= ".products .sps-swatches>.swatchColor, .products .sps-swatches>.swatchColor>div {
	              width: ".htmlspecialchars($sps_options['archive_swatch_size'])."px !important;
			      height: ".htmlspecialchars($sps_options['archive_swatch_size'])."px !important;

            }

             .products .sps-swatches .swatch{
                  width: ".htmlspecialchars($sps_options['archive_swatch_size'])."px !important;
	              height: ".htmlspecialchars($sps_options['archive_swatch_size'])."px !important;
	              line-height: ".htmlspecialchars($sps_options['archive_swatch_size'])."px !important;
             }";
		
		}
		
		if(htmlspecialchars($sps_options['archive_first_row'])=="true"){
		$sps_css .= "
		ul.products li.product table.variations tr, .woocom-project table.variations tr { display: none !important; }

		ul.products li.product table.variations tr:first-child, .woocom-project table.variations tr:first-child { display: block !important; }";
		
		}
		
		
		if(htmlspecialchars($sps_options['border_color_selected'])!=""){
		$sps_css .= ".sps-swatches>.swatchColor.selected {
			border: 2px solid ".htmlspecialchars($sps_options['border_color_selected'])." !important;
			}
			
			.sps-swatches .swatch.selected {
				border: 2px solid ".htmlspecialchars($sps_options['border_color_selected'])." !important;
			}
			
			.sps-swatches .swatch-label-square.selected {
				border: 2px solid ".htmlspecialchars($sps_options['border_color_selected'])." !important;
			}
			
			.sps-swatches .swatch-label-circle.selected {
				border: 2px solid ".htmlspecialchars($sps_options['border_color_selected'])." !important;
			}";
		}
		
		if(htmlspecialchars($sps_options['border_color_hover'])!=""){
		$sps_css .= ".sps-swatches>.swatchColor:hover, .sps-swatches .swatch:hover, .sps-swatches .swatch-label-circle:hover, .sps-swatches .swatch-label-square:hover {
						border: 2px solid ".htmlspecialchars($sps_options['border_color_hover'])."  !important;
					}";
		}
		
		if(htmlspecialchars($sps_options['border_color'])!=""){
		$sps_css .= ".sps-swatches>.swatchColor {
			border: 2px solid ".htmlspecialchars($sps_options['border_color'])." !important;
			}
			
			.sps-swatches .swatch, .sps-swatches .swatch-label-circle, .sps-swatches .swatch-label-square {
				border: 2px solid ".htmlspecialchars($sps_options['border_color'])." !important;
			}";
		}
		
		
		if(htmlspecialchars($sps_options['show_tooltip'])=="0"){
		$sps_css .= ".spsTooltip {
						display: none !important;
			 }";
		}
		
		if(htmlspecialchars($sps_options['tooltip_bg'])!=""){
		$sps_css .= ".sps-swatches>.swatchColor>.spsTooltip>.innerText {
			background-color: ".htmlspecialchars($sps_options['tooltip_bg'])." !important;
			}
			
			.sps-swatches>.swatch>.spsTooltip>.innerText {
			background-color: ".htmlspecialchars($sps_options['tooltip_bg'])." !important;
			}
			
			.sps-swatches>.swatchColor>.spsTooltip>span {
				border-block-end-color: ".htmlspecialchars($sps_options['tooltip_bg'])." !important;
			}
			
			.sps-swatches>.swatch>.spsTooltip>span {
				border-block-end-color: ".htmlspecialchars($sps_options['tooltip_bg'])." !important;
			}
			";
		}
		
		if(htmlspecialchars($sps_options['tooltip_text'])!=""){
		$sps_css .= ".sps-swatches>.swatchColor>.spsTooltip>.innerText {
			color: ".htmlspecialchars($sps_options['tooltip_text'])." !important;
			}
			
			.sps-swatches>.swatch>.spsTooltip>.innerText {
			color: ".htmlspecialchars($sps_options['tooltip_text'])." !important;
			}";
		}
		
		if(htmlspecialchars($sps_options['label_bg'])!=""){
		$sps_css .= ".sps-swatches .swatch-label {
			background-color: ".htmlspecialchars($sps_options['label_bg'])." !important;
			}";
		}
		
		if(htmlspecialchars($sps_options['label_text'])!=""){
		$sps_css .= ".sps-swatches .swatch-label {
			color: ".htmlspecialchars($sps_options['label_text'])." !important;
			}";
		}
		
		
		
	$sps_css .= "</style>";
	echo $sps_css;

	
}


	/**
	 * Enqueue scripts and stylesheets
	 */
	public function enqueue_scripts() {
		
		
		wp_enqueue_style( 'sps-frontend', plugins_url( 'assets/css/frontend.css', dirname( __FILE__ ) ), array(), '1.0');
		wp_enqueue_script( 'sps-frontend', plugins_url( 'assets/js/frontend.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.0', true );

		
	}

	/**
	 * Filter function to add Swatches underneath the default selector
	 *
	 * @param $html
	 * @param $args
	 *
	 * @return string
	 */
	public function get_swatch_html( $html, $args ) {
		$swatch_types = S_PS()->types;
		$attr         = S_PS()->get_tax_attribute( $args['attribute'] );

		// Return if this is normal attribute
		if ( empty( $attr ) ) {
			return $html;
		}

		if ( ! array_key_exists( $attr->attribute_type, $swatch_types ) ) {
			return $html;
		}

		$options   = $args['options'];
		$product   = $args['product'];
		$attribute = $args['attribute'];
		$class     = "variation-selector variation-select-{$attr->attribute_type}";
		$swatches  = '';

		if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
			$attributes = $product->get_variation_attributes();
			$options    = $attributes[$attribute];
		}

		if ( array_key_exists( $attr->attribute_type, $swatch_types ) ) {
			if ( ! empty( $options ) && $product && taxonomy_exists( $attribute ) ) {
				// Get terms if this is a taxonomy (ordered). The names are required too.
				$terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );

				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $options ) ) {
						$swatches .= apply_filters( 'sps_swatch_html', '', $term, $attr->attribute_type, $args );
					}
				}
			}

			if ( ! empty( $swatches ) ) {
				$class .= ' hidden';
				$sps_allowed_html = array (
					'a' => array (),
					'div' => array('class' => array(),'style' => array(),'data-value' => array(),'data-attribute' => array()),
					'span' => array('class' => array(),'style' => array(),'data-value' => array(),'data-attribute' => array()),
				);
				$swatches = '<div class="sps-swatches" data-attribute="attribute_' . esc_attr( $attribute ) . '">' . $swatches . '</div>';
				$html     = '<div class="' . esc_attr( $class ) . '">' .  $html  . '</div>' .wp_kses($swatches,$sps_allowed_html) ;
			}
		}

		return $html;
	}
	

//

	/**
	 * Print HTML content for a single swatch Color, Image and Label
	 *
	 * @param $html
	 * @param $term
	 * @param $type
	 * @param $args
	 *
	 * @return string
	 */
	public function swatch_html( $html, $term, $type, $args ) {
		$selected = sanitize_title( $args['selected'] ) == $term->slug ? 'selected' : '';
		$name     = esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) );
		$labelClass = "";


		switch ( $type ) {
			case 'color':
				$color = get_term_meta( $term->term_id, 'color', true );
				list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
				$html = sprintf(
					'<span class="swatch-%s superSwatch swatchColor swatchType_one_color %s" data-value="%s"><div style="background:%s;"></div><span class="spsTooltip"><span></span><span class="innerText">%s</span><span></span></span></span>',
					esc_attr( $term->slug ),
					$selected,
					esc_attr( $term->slug ),
					esc_attr( $color ),
					esc_attr( $name )
				);
				break;

			case 'image':
				$image = get_term_meta( $term->term_id, 'image', true );
				$image = $image ? wp_get_attachment_image_src( $image ) : '';
				$image = $image ? $image[0] : WC()->plugin_url() . '/assets/images/placeholder.png';
				$html  = sprintf(
					'<span class="superSwatch swatchColor swatch-image swatch-%s %s" data-value="%s"><div style="background-image: url(%s);" class="textureImage"></div><span class="spsTooltip"><span></span><span class="innerText">%s</span><span></span></span></span>',
					esc_attr( $term->slug ),
					$selected,
					esc_attr( $term->slug ),
					esc_url( $image ),
					esc_attr( $name )
				);
				break;

			case 'label':
				$label = get_term_meta( $term->term_id, 'label', true );
				$label = $label ? $label : $name;
				
				$labelLength = strlen($label);
				$sps_options = get_option('sps');
				if($labelLength>3){
					if(htmlspecialchars($sps_options['swatches_style'])=="squared"){
						$labelClass = "-label-square";
					} else {
						$labelClass = "-label-circle";
					}
				}
				
				$html  = sprintf(
					'<span class="superSwatch swatch%s swatch-label swatch-%s %s" data-value="%s">%s<span class="spsTooltip"><span></span><span class="innerText">%s</span><span></span></span></span>',
					esc_attr( $labelClass ),
					esc_attr( $term->slug ),
					$selected,
					esc_attr( $term->slug ),
					esc_html( $label ),
					esc_attr( $name )
				);
				break;
		}

		return $html;
	}
}


$sps_options = get_option('sps');


if(htmlspecialchars($sps_options['archive'])=="true"){

/**
 * Replace add to cart button in the loop.
 */
function spvs_change_loop_add_to_cart() {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	
	add_action( 'woocommerce_after_shop_loop_item', 'spvs_template_loop_add_to_cart', 10 );
}

add_action( 'init', 'spvs_change_loop_add_to_cart', 10 );

/**
 * Use single add to cart button for variable products.
 */
function spvs_template_loop_add_to_cart() {
	global $product;

	if ( ! $product->is_type( 'variable' ) ) {
		woocommerce_template_loop_add_to_cart();
		return;
	}

	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
	add_action( 'woocommerce_single_variation', 'spvs_func_option_valgt' );
	add_action( 'woocommerce_single_variation', 'spvs_loop_variation_add_to_cart_button', 20 );

	woocommerce_template_single_add_to_cart();
}

/**
 * Customise variable add to cart button for loop.
 *
 * Remove qty selector and simplify.
 */
function spvs_loop_variation_add_to_cart_button() {
    global $product;
 
    ?>
    <div class="woocommerce-variation-add-to-cart variations_button">
        <button type="submit" class="single_add_to_cart_button button"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
        <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
        <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
        <input type="hidden" name="variation_id" class="variation_id" value="0" />
    </div>
    <?php
}



function spvs_func_option_valgt() {
    global $product;

    if ( $product->is_type('variable') ) {
        $variations_data =[]; // Initializing

        // Loop through variations data
        foreach($product->get_available_variations() as $variation ) {
			//print_r($variation);
            // Set for each variation ID the corresponding price in the data array (to be used in jQuery)
           //$variations_data[$variation['variation_id']] = $variation['display_price'];
		   $variations_data[$variation['variation_id']] = $variation;
        }
		//print_r($variations_data);
        ?>
        <script>
        jQuery(function($) {
            var jsonData = <?php echo json_encode($variations_data); ?>,
                inputVID = 'input.variation_id';
				
				
				//console.log(jsonData);
            $('input[name="variation_id"]').change( function(){
                //if( '' != $(inputVID).val() ) {
                    var vid      = $(this).val(), // VARIATION ID
						// Initilizing
                        vprice   = ''; 
						vprodcutimage = '';
						//console.log('ID'+vid);

                    // Loop through variation IDs / Prices pairs
                    $.each( jsonData, function( index, data ) {
                        if( index == vid  ) {
                            vprice = data.display_price; // The right variation price
							vprodcutimage = data.image.url;
							//console.log('variation Id: '+vid+' | Image: '+vprodcutimage+' | Price: '+vprice);
							if ($(".attachment-woocommerce_thumbnail:first")){
								$('input[value='+vid+']').parents('li').find("img.attachment-woocommerce_thumbnail").attr("src", vprodcutimage);
								$('input[value='+vid+']').parents('li').find("img.attachment-woocommerce_thumbnail").attr("srcset", vprodcutimage);
							}
							
							// Avada Theme
							if ($(".attachment-shop_catalog:first")){
								$('input[value='+vid+']').parents('li').find("img.attachment-shop_catalog").attr("src", vprodcutimage);
								$('input[value='+vid+']').parents('li').find("img.attachment-shop_catalog").attr("srcset", vprodcutimage);
							} 
							
							
                        }
                    });

                    
                //}
            });
        });
		 </script>
        <?php
    }
}

}