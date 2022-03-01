<?php
function my_theme_enqueue_styles()
{
    $parent_style = 'parent-style'; // Estos son los estilos del tema padre recogidos por el tema hijo.
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');



add_action('rest_api_init', function(){
	register_rest_route('custom-tour/v1', '/getPriceByIdProductVariation/',
		array(
			'methods' => 'POST',
			'callback' => 'getPriceByIdProductVariation'
		)
	);

	register_rest_route('custom-tour/v1', '/addProductVariationToCart/',
		array(
			'methods' => 'POST',
			'callback' => 'addProductVariationToCart'
		)
	);
});

function addProductVariationToCart(){

	global $woocommerce;

	$fail = false;
	if(isset($_POST['IdProduct'])){
		$product_id = $_POST['IdProduct'];
	}else{
		$fail = true;
	}

	if(isset($_POST['Origen'])){
		$Origen = $_POST['Origen'];
	}else{
		$fail = true;
	}

	if(isset($_POST['Acomodacion'])){
		$Acomodacion = $_POST['Acomodacion'];
	}else{
		$fail = true;
	}

	if(isset($_POST['Fecha'])){
		$Fecha = $_POST['Fecha'];
	}else{
		$fail = true;
	}

	if(isset($_POST['Pago'])){
		$Pago = $_POST['Pago'];
	}else{
		$fail = true;
	}

	if($fail){
		return "Error parametros incompletos";
	}


	$variation = array(
		'attribute_pa_origen' => $Origen,
		'attribute_pa_acomodacion' => $Acomodacion,
		'attribute_pa_fecha' => $Fecha,
		'attribute_pa_pago' => $Pago,
	);

	$variation_id = find_matching_product_variation_id($product_id, $variation);
	$variableProduct = wc_get_product($variation_id);
	$regularPrice = $variableProduct->get_regular_price();
	$salePrice = $variableProduct->get_sale_price();
	$price = $variableProduct->get_price();

	//$woocommerce->cart->add_to_cart($product_id, 1, $variation_id, $variation);
	// WC()->cart->add_to_cart($product_id, 1, $variation_id, $variation);
	WC()->cart->add_to_cart($product_id);
	wp_safe_redirect(wc_get_checkout_url());
	exit();

}

function getPriceByIdProductVariation(){
	$fail = false;
	if(isset($_POST['IdProduct'])){
		$IdProduct = $_POST['IdProduct'];
	}else{
		$fail = true;
	}

	if(isset($_POST['Origen'])){
		$Origen = $_POST['Origen'];
	}else{
		$fail = true;
	}

	if(isset($_POST['Acomodacion'])){
		$Acomodacion = $_POST['Acomodacion'];
	}else{
		$fail = true;
	}

	if(isset($_POST['Fecha'])){
		$Fecha = $_POST['Fecha'];
	}else{
		$fail = true;
	}

	if(isset($_POST['Pago'])){
		$Pago = $_POST['Pago'];
	}else{
		$fail = true;
	}

	if($fail){
		return "Error parametros incompletos";
	}


	$attributes = array(
		'attribute_pa_origen' => $Origen,
		'attribute_pa_acomodacion' => $Acomodacion,
		'attribute_pa_fecha' => $Fecha,
		'attribute_pa_pago' => $Pago,
	);

	$variationId = find_matching_product_variation_id($IdProduct, $attributes);
	$variableProduct = wc_get_product($variationId);
	$regularPrice = $variableProduct->get_regular_price();
	$salePrice = $variableProduct->get_sale_price();
	$price = $variableProduct->get_price();

	$response = array(
		'regularPrice' 	=> $regularPrice,
		'salePrice'		=> $salePrice,
		'price'			=> $price,
		'variationId' => $variationId
	);

	return $response;
}

function find_matching_product_variation_id($product_id, $attributes)
{
    return (new \WC_Product_Data_Store_CPT())->find_matching_product_variation(
        new \WC_Product($product_id),
        $attributes
    );
}


function ql_woocommerce_ajax_add_to_cart_js()
{
    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('custom_script', get_bloginfo('stylesheet_directory') . '/js/ajax_add_to_cart.js', array('jquery'), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'ql_woocommerce_ajax_add_to_cart_js');

add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
function ql_woocommerce_ajax_add_to_cart()
{
    $product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('ql_woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX::get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );
        echo wp_send_json($data);
    }
    wp_die();
}


