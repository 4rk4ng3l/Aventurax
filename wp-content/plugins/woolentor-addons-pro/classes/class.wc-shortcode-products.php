<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if( class_exists('WC_Shortcode_Products') ){
    class WooLentor_WC_Shortcode_Products extends WC_Shortcode_Products {

        private $settings = [];

        /**
         * Initialize shortcode.
         *
         * @since 3.2.0
         * @param array  $attributes Shortcode attributes.
         * @param string $type       Shortcode type.
         */
        public function __construct( $settings = array(), $type = 'products' ) {
            $this->settings = $settings;  
            $this->type       = $type;

            $atts = [
                'limit'    => $settings['product_limit'],
                'order'    => $settings['order'],
                'columns'  => ( ( $settings['product_layout'] === "content" ) ? $settings['default_column'] : isset( $settings['column'] ) ) ? $settings['column'] : '',
            ];

            if( 'none' !== $settings['orderby'] ){
                $atts['orderby'] = $settings['orderby'];
            }

            if( 'featured' === $type ){
                $atts['visibility'] = "featured";
            }

            if( 'random' === $type ){
                $atts['orderby'] = "rand";
            }

            // Category
            if ( !empty( $settings['categories'] ) ) {
                $atts['category']     = implode( ',', $settings['categories'] );
                $atts['cat_operator'] = $settings['cat_operator'];
            }

            // Product Id wise
            if ( !empty( $settings['product_id'] ) || !empty( $settings['product_ids_manually'] ) ) {
                $atts['ids']  = ( 'show_byid' === $settings['product_type'] ) ? implode( ',', $settings['product_id'] ) : $settings['product_ids_manually'];
            }

            // Pagination
            if ( $settings['paginate'] === 'yes' ) {
                $atts['paginate'] = 'true';

                if ( 'yes' !== $settings['allow_order'] ) {
                    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
                }

                if ( 'yes' !== $settings['show_result_count'] ) {
                    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
                }
            }

            $this->attributes = $this->parse_attributes( $atts );
            $this->query_args = $this->parse_query_args();


        }

        /**
         * Get shortcode content.
         *
         * @since  3.2.0
         * @return string
         */
        public function get_content( $layout = "content" ) {  
            return $this->product_loop( $layout );
        }

        /**
         * Parse attributes.
         *
         * @since  3.2.0
         * @param  array $attributes Shortcode attributes.
         * @return array
         */
        protected function parse_attributes( $attributes ) { 
          
            $attributes = $this->parse_legacy_attributes( $attributes );

            $attributes = shortcode_atts(
                array(
                    'limit'          => '-1',      // Results limit.
                    'columns'        => '',        // Number of columns.
                    'rows'           => '',        // Number of rows. If defined, limit will be ignored.
                    'orderby'        => 'title',   // menu_order, title, date, rand, price, popularity, rating, or id.
                    'order'          => 'DESC',    // ASC or DESC.
                    'ids'            => '',        // Comma separated IDs.
                    'skus'           => '',        // Comma separated SKUs.
                    'category'       => '',        // Comma separated category slugs or ids.
                    'cat_operator'   => 'IN',      // Operator to compare categories. Possible values are 'IN', 'NOT IN', 'AND'.
                    'attribute'      => '',        // Single attribute slug.
                    'terms'          => '',        // Comma separated term slugs or ids.
                    'terms_operator' => 'IN',      // Operator to compare terms. Possible values are 'IN', 'NOT IN', 'AND'.
                    'tag'            => '',        // Comma separated tag slugs.
                    'tag_operator'   => 'IN',      // Operator to compare tags. Possible values are 'IN', 'NOT IN', 'AND'.
                    'visibility'     => 'visible', // Product visibility setting. Possible values are 'visible', 'catalog', 'search', 'hidden'.
                    'class'          => '',        // HTML class.
                    'page'           => 1,         // Page for pagination.
                    'paginate'       => false,     // Should results be paginated.
                    'cache'          => true,      // Should shortcode output be cached.
                ),
                $attributes,
                $this->type
            );

            if ( ! absint( $attributes['columns'] ) ) {
                $attributes['columns'] = wc_get_default_products_per_row();
            }



            return $attributes;
        }

        /**
         * [woocommerce_product_loop_start]
         * @param  boolean $echo
         * @return [html]
         */
        protected function woocommerce_product_loop_start( $layout, $echo = true ) {
            ob_start();

            wc_set_loop_prop( 'loop', 0 );

            $grid_col = apply_filters( 'woolentor_woocommerce_loop_product_grid', 'columns-'. esc_attr( wc_get_loop_prop( 'columns' ) ) );

            if( $layout === "content" ){
                echo '<ul class="woolentor_current_theme_layout products '.$grid_col.'">';
            }elseif( $layout === "expanding_grid" ){
                echo '<div class="woolentor-grid__area img__loading '.$grid_col.'">';
            }else{
                echo $this->grid_row_attr( $grid_col );
            }

            $loop_start = apply_filters( 'woocommerce_product_loop_start', ob_get_clean() );

            if ( $echo ) {
                echo $loop_start;
            } else {
                return $loop_start;
            }

        }

        /**
         * [grid_row_attr]
         * @param  [type] $loop_col WooCommerce Column
         * @return [HTML]
         */
        protected function grid_row_attr( $loop_col ){

            $settings = $this->settings;
            $slider = false;

            // Slider Options
            if( isset( $settings['slider_on'] ) && $settings['slider_on'] === 'yes' ){

                $slider = true;

                $is_rtl = is_rtl();
                $direction = $is_rtl ? 'rtl' : 'ltr';
                $slider_settings = [
                    'arrows' => ('yes' === $settings['slarrows']),
                    'dots' => ('yes' === $settings['sldots']),
                    'autoplay' => ('yes' === $settings['slautolay']),
                    'autoplay_speed' => absint($settings['slautoplay_speed']),
                    'animation_speed' => absint($settings['slanimation_speed']),
                    'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
                    'rtl' => $is_rtl,
                ];

                $slider_responsive_settings = [
                    'product_items' => $settings['slitems'],
                    'scroll_columns' => $settings['slscroll_columns'],
                    'tablet_width' => $settings['sltablet_width'],
                    'tablet_display_columns' => $settings['sltablet_display_columns'],
                    'tablet_scroll_columns' => $settings['sltablet_scroll_columns'],
                    'mobile_width' => $settings['slmobile_width'],
                    'mobile_display_columns' => $settings['slmobile_display_columns'],
                    'mobile_scroll_columns' => $settings['slmobile_scroll_columns'],

                ];
                $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
            }else{
                $slider_settings = '';
            }

            return '<div class="woolentor-products wl-row '.$loop_col.' '.( $settings['no_gutters'] === 'yes' ? 'wlno-gutters' : '' ).' '.( $slider === true ? 'product-slider' : '' ).' " data-settings='.wp_json_encode( $slider_settings ).'>';


        }

        /**
         * [tab_menu] Archive page tab menu
         * @param  [string] $layout
         * @return [html] 
         */
        protected function tab_menu( $layout ){
            ob_start();
            $settings = $this->settings;
            if( 'universal' === $layout ):
                if( isset( $settings['tab_menu'] ) && 'yes' === $settings['tab_menu'] ):
                    ?>
                        <ul id="wl-shop-tab-links-<?php echo $settings['tabuniqid']; ?>" class="wl-shop-tab-links">
                            <li><a href="#grid-<?php echo $settings['tabuniqid']; ?>" data-tabvalue="grid_view" class="<?php if( $settings['woolentor_product_view_mode'] == 'grid' ){ echo 'htactive'; } ?>"><i class="sli sli-grid"></i></a></li>
                            <li><a href="#list-<?php echo $settings['tabuniqid']; ?>" data-tabvalue="list_view" class="<?php if( $settings['woolentor_product_view_mode'] == 'list' ){ echo 'htactive'; } ?>"><i class="sli sli-menu"></i></a></li>
                        </ul>
                    <?php
                endif;
            endif;
            return ob_get_clean();
        }

        /**
         * [woocommerce_product_loop_end description]
         * @param  boolean $echo [description]
         * @return [type]        [description]
         */
        protected function woocommerce_product_loop_end(  $layout, $echo = true ) {
            ob_start();

            if( $layout === "content" ){
                echo '</ul>';
            }else{
                echo '</div>';
            }

            $loop_end = apply_filters( 'woocommerce_product_loop_end', ob_get_clean() );

            if ( $echo ) {
                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                echo $loop_end;
            } else {
                return $loop_end;
            }
        }

        /**
         * Loop over found products.
         *
         * @since  3.2.0
         * @return string
         */
        protected function product_loop( $layout = "content" ) {
            
            $columns  = absint( $this->attributes['columns'] );
            $classes  = $this->get_wrapper_classes( $columns );
            $products = $this->get_query_results();

            ob_start();

            if ( $products && $products->ids ) {
                // Prime caches to reduce future queries.
                if ( is_callable( '_prime_post_caches' ) ) {
                    _prime_post_caches( $products->ids );
                }

                // Setup the loop.
                wc_setup_loop(
                    array(
                        'columns'      => $columns,
                        'name'         => $this->type,
                        'is_shortcode' => true,
                        'is_search'    => false,
                        'is_paginated' => wc_string_to_bool( $this->attributes['paginate'] ),
                        'total'        => $products->total,
                        'total_pages'  => $products->total_pages,
                        'per_page'     => $products->per_page,
                        'current_page' => $products->current_page,
                    )
                );

                $original_post = $GLOBALS['post'];

                do_action( "woocommerce_shortcode_before_{$this->type}_loop", $this->attributes );

                // Fire standard shop loop hooks when paginating results so we can show result counts and so on.
                if ( wc_string_to_bool( $this->attributes['paginate'] ) ) {
                    echo '<div class="woolentor-before-shop">';
                        echo $this->tab_menu( $layout );
                        do_action( 'woocommerce_before_shop_loop' );
                    echo '</div>';
                }

                $this->woocommerce_product_loop_start( $layout );

                if ( wc_get_loop_prop( 'total' ) ) {
                    foreach ( $products->ids as $product_id ) {
                        $GLOBALS['post'] = get_post( $product_id ); // WPCS: override ok.

                    
                        setup_postdata( $GLOBALS['post'] );
                        
                        // Set custom product visibility when quering hidden products.
                        add_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );

                        // Render product template.
                        if( $layout === "content" ){
                            echo wc_get_template_part( 'content','product' );
                        }else{
                            wc_get_template( 'addons/product-'.$layout.'.php', $this->settings, '', WOOLENTOR_TEMPLATE_PRO );
                        }

                        // Restore product visibility.
                        remove_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );

                    }
                }

                $GLOBALS['post'] = $original_post; // WPCS: override ok.
                $this->woocommerce_product_loop_end( $layout );

                // Fire standard shop loop hooks when paginating results so we can show result counts and so on.
                if ( wc_string_to_bool( $this->attributes['paginate'] ) ) {
                    do_action( 'woocommerce_after_shop_loop' );
                }

                do_action( "woocommerce_shortcode_after_{$this->type}_loop", $this->attributes );

                wp_reset_postdata();
                wc_reset_loop();
            } else {
                do_action( "woocommerce_shortcode_{$this->type}_loop_no_results", $this->attributes );
            }

            return '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">' . ob_get_clean() . '</div>';
        }
    }

}