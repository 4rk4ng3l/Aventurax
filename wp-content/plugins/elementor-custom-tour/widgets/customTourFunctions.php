<?php

namespace ElementorCustomTour\Widgets;

/**
 * get default attributes from product
 * 
 * 
 * 
 */
function productGetDefaultAttributes()
{
    global $product;
    if ($product->is_type('variable')) {
        $default_attributes = $product->get_default_attributes();

        var_dump($default_attributes);
    }
}
