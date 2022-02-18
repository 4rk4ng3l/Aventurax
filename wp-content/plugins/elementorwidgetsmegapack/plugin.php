<?php
namespace ElementorWidgetsMegaPack;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_scripts() {
		
		// Load WP jQuery if not included
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-masonry');
		
		// Main
		wp_register_style( 'ewmp-style', plugins_url( '/assets/css/style.css', __FILE__ ) );
		wp_register_style( 'fonts-vc',  plugins_url( 'assets/css/fonts.css', __FILE__ ));  
		wp_enqueue_style( 'ewmp-style' );
		wp_register_script( 'fastportfoliogrid',  plugins_url( 'assets/js/fastportfoliogrid.js' , __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_script( 'fastportfoliogrid-carousel',  plugins_url( 'assets/js/fastportfoliogrid-carousel.js' , __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_script( 'mixitup',  plugins_url( 'assets/js/vendor/jquery.mixitup.js' , __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_script( 'logoshowcase',  plugins_url( 'assets/js/logoshowcase.js' , __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_script( 'countTo',  plugins_url( 'assets/js/jquery.countTo.min.js' , __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'countdown',  plugins_url( 'assets/js/jquery.countdown.min.js' , __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'easypiechart',  plugins_url( 'assets/js/jquery.easypiechart.min.js' , __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'calltoaction',  plugins_url( 'assets/js/calltoaction.js' , __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'blog-carousel',  plugins_url( 'assets/js/blog-carousel.js' , __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_style( 'jquery-ui.min', plugins_url( '/assets/css/jquery-ui.min.css', __FILE__ ) );
		wp_register_style( 'jquery-ui.theme.min', plugins_url( '/assets/css/jquery-ui.theme.min.css', __FILE__ ) );
		wp_register_script( 'fastcarousel', plugins_url( '/assets/js/fast-carousel.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'fast-gallery-frontend', plugins_url( '/assets/js/fast-gallery.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_style( 'custom-responsive-vc',  plugins_url( 'assets/css/custom_responsive.css', __FILE__ )); 
		wp_register_script('removeWhitespace', plugins_url( 'assets/js/vendor/jquery.removeWhitespace.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script('collagePlus', plugins_url( 'assets/js/vendor/jquery.collagePlus.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_style( 'fast-gallery-mosaic', plugins_url( '/assets/css/mosaic_style.css', __FILE__ ) );
		wp_register_script( 'fast-media-gallery', plugins_url( '/assets/js/fast-media-gallery.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'headerblocks', plugins_url( '/assets/js/header-blocks.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_style( 'megaposts', plugins_url( '/assets/css/megaposts.css', __FILE__ ) );
		wp_register_style( 'newslayouts', plugins_url( '/assets/css/newslayouts.css', __FILE__ ) );
		wp_register_script( 'newslayoutscarousel',  plugins_url( 'assets/js/news-carousel.js' , __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_style( 'woocommerce-ewmp', plugins_url( '/assets/css/woocommerce.css', __FILE__ ) );		
		wp_register_script( 'woocommerceaddtocartbutton',  plugins_url( 'assets/js/woocommerceaddtocartbutton.js' , __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'woocommerceheaderproducts',  plugins_url( 'assets/js/woocommerceheaderproducts.js' , __FILE__ ), [ 'jquery' ], false, true );	

		wp_register_script( 'woocommerceproductsdisplay-carousel',  plugins_url( 'assets/js/woocommerceproductsdisplay-carousel.js' , __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_script( 'woocommerceproductsdisplay',  plugins_url( 'assets/js/woocommerceproductsdisplay.js' , __FILE__ ), [ 'jquery' ], false, true );

		wp_register_style( 'wooocommerce-gallery-custom-responsive',  plugins_url( 'assets/css/wooocommerce-gallery-custom-responsive.css', __FILE__ )); 
		wp_register_script( 'woocommerceproductsgallery', plugins_url( '/assets/js/woocommerce-products-gallery.js', __FILE__ ), [ 'jquery' ], false, true );
		
		wp_register_script( 'woocommerceproductsshowcase', plugins_url( '/assets/js/woocommerce-products-showcase.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'woocommerceproductstab', plugins_url( '/assets/js/woocommerce-products-tab.js', __FILE__ ), [ 'jquery' ], false, true );

		wp_register_script( 'woocommercesaleproductsdisplay-carousel',  plugins_url( 'assets/js/woocommercesaleproductsdisplay-carousel.js' , __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_script( 'woocommercesaleproductsdisplay',  plugins_url( 'assets/js/woocommercesaleproductsdisplay.js' , __FILE__ ), [ 'jquery' ], false, true );	


		wp_register_script( 'teamvision', plugins_url( '/assets/js/team-vision.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'teamvision-carousel-style1', plugins_url( '/assets/js/team-vision-carousel-style1.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'teamvision-carousel-style2', plugins_url( '/assets/js/team-vision-carousel-style2.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'teamvision-carousel-style3', plugins_url( '/assets/js/team-vision-carousel-style3.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'teamvision-carousel-style4', plugins_url( '/assets/js/team-vision-carousel-style4.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'teamvision-carousel-style5', plugins_url( '/assets/js/team-vision-carousel-style5.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'teamvision-carousel-style6', plugins_url( '/assets/js/team-vision-carousel-style6.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'teamvision-carousel-style7', plugins_url( '/assets/js/team-vision-carousel-style7.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_style( 'teamvision', plugins_url( '/assets/css/teamvision.css', __FILE__ ) );

		wp_register_style( 'timeline', plugins_url( '/assets/css/timeline.css', __FILE__ ) );
		wp_register_script( 'timeline',  plugins_url( 'assets/js/timeline.js' , __FILE__ ), [ 'jquery' ], false, true );

		
		// Carousel
		wp_register_style( 'owlcarousel',  plugins_url( 'assets/css/owl.carousel.css', __FILE__ ) );
		wp_register_style( 'owltheme',  plugins_url( 'assets/css/owl.theme.css', __FILE__ ) );
		wp_register_script( 'owlcarousel',  plugins_url( 'assets/js/vendor/owl.carousel.js' , __FILE__ ), [ 'jquery' ], false, true );
		
		wp_register_script( 'magnific-popup',  plugins_url( 'assets/js/vendor/jquery.magnific-popup.js' , __FILE__ ), [ 'jquery' ], false, true );
		wp_register_style( 'magnific-popup',  plugins_url( 'assets/css/magnific-popup.css', __FILE__  ) );

		wp_register_script('prettyPhoto', plugins_url( 'assets/js/vendor/jquery.prettyPhoto.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_style( 'prettyPhoto',  plugins_url( 'assets/css/prettyPhoto.css', __FILE__ ) );

		wp_register_style( 'lightgallery',  plugins_url( 'assets/css/lightGallery.css', __FILE__ ) );
		wp_register_script( 'lightgallery',  plugins_url( 'assets/js/vendor/lightGallery.min.js' , __FILE__ ), [ 'jquery' ], false, true );		
		wp_register_script( 'lightgallery-vimeo', plugins_url( 'assets/js/vendor/froogaloop2.min.js' , __FILE__ ), [ 'jquery' ], false, true );

		wp_register_style( 'photoswipe',  plugins_url( 'assets/css/photoswipe.css', __FILE__ ) );
		wp_register_style( 'photoswipe-default-skin',  plugins_url( 'assets/css/default-skin.css', __FILE__ ) );
		wp_register_script( 'photoswipe',  plugins_url( 'assets/js/vendor/photoswipe.min.js' , __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'photoswipe-ui-default-js',  plugins_url( 'assets/js/vendor/photoswipe-ui-default.min.js' , __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'photoswipe-general-js',  plugins_url( 'assets/js/vendor/photoswipe-general.js' , __FILE__ ), [ 'jquery' ], false, true );

		// Ticker
		wp_register_script( 'newsTicker',  plugins_url( 'assets/js/vendor/jquery.newsTicker.min.js' , __FILE__ ), [ 'jquery' ], false, true );	

		// ANIMATE
		wp_register_style( 'animations',  plugins_url( 'assets/css/animations.min.css', __FILE__ ) );
		wp_register_script( 'appear',  plugins_url( 'assets/js/vendor/appear.min.js' , __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_script( 'animate',  plugins_url( 'assets/js/vendor/animations.min.js' , __FILE__ ), [ 'jquery' ], false, true );		

		// LAZY LOAD EFFECT
		wp_register_script( 'lazyload',  plugins_url( 'assets/js/vendor/jquery.lazyload.js' , __FILE__ ), [ 'jquery' ], false, true );				
		wp_register_script( 'imagesLoaded',  plugins_url( 'assets/js/vendor/imagesLoaded.js' , __FILE__ ), [ 'jquery' ], false, true );		

			
		if(\Elementor\Plugin::$instance->preview->is_preview_mode()) {
			wp_enqueue_style( 'fonts-vc' );
			wp_enqueue_style( 'owlcarousel' );
			wp_enqueue_style( 'owltheme' );				
			wp_enqueue_script( 'owlcarousel' );
			wp_enqueue_style( 'animations' );
			wp_enqueue_script( 'appear' );			
			wp_enqueue_script( 'animate' );	
			wp_enqueue_script( 'mixitup' );	
			wp_enqueue_script( 'fastportfoliogrid' );	
			wp_enqueue_script( 'fastportfoliogrid-carousel' );	
			wp_enqueue_style( 'elementor-icons' );
			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_script( 'magnific-popup' );
			wp_enqueue_script( 'logoshowcase' );
			wp_enqueue_script( 'countTo' );
			wp_enqueue_script( 'countdown' );
			wp_enqueue_script( 'easypiechart' );
			wp_enqueue_script( 'calltoaction' );
			wp_enqueue_script( 'blog-carousel' );
			wp_enqueue_style('jquery-ui.min');
			wp_enqueue_style('jquery-ui.theme.min');
			wp_enqueue_script( 'jquery-ui-core');
			wp_enqueue_script( 'jquery-ui-accordion' );			
			wp_enqueue_script( 'fastcarousel' );
			wp_enqueue_style( 'prettyPhoto' );
			wp_enqueue_script( 'prettyPhoto' );
			wp_enqueue_style( 'lightgallery' );
			wp_enqueue_script( 'lightgallery' );
			wp_enqueue_script( 'lightgallery-vimeo' );
			wp_enqueue_style( 'photoswipe' );
			wp_enqueue_style( 'photoswipe-default-skin' );
			wp_enqueue_script( 'photoswipe' );			
			wp_enqueue_script( 'photoswipe-ui-default-js' );			
			wp_enqueue_script( 'photoswipe-general-js' );
			wp_enqueue_script( 'lazyload' );			
			wp_enqueue_script( 'imagesLoaded' );	
			wp_enqueue_script('jquery-masonry');			
			wp_enqueue_script('fast-gallery-frontend');
			wp_enqueue_style( 'fast-gallery-mosaic' );
			wp_enqueue_script( 'removeWhitespace' );
 			wp_enqueue_script( 'collagePlus' );			
 			wp_enqueue_script( 'fast-media-gallery' );			
 			wp_enqueue_script( 'headerblocks' );
			wp_enqueue_style( 'megaposts' );			
			wp_enqueue_script( 'newsTicker' );				
			wp_enqueue_script( 'newslayoutscarousel' );	
			wp_enqueue_style( 'newslayouts' );	
			wp_enqueue_style( 'teamvision' );
			wp_enqueue_script( 'teamvision' );
			wp_enqueue_script( 'teamvision-carousel-style1' );
			wp_enqueue_script( 'teamvision-carousel-style2' );
			wp_enqueue_script( 'teamvision-carousel-style3' );
			wp_enqueue_script( 'teamvision-carousel-style4' );
			wp_enqueue_script( 'teamvision-carousel-style5' );
			wp_enqueue_script( 'teamvision-carousel-style7' );
			wp_enqueue_script( 'timeline' );
			wp_enqueue_style( 'timeline' );
			wp_enqueue_style( 'woocommerce-ewmp' );
			wp_enqueue_script( 'woocommerceaddtocartbutton' );
			wp_enqueue_script( 'woocommerceheaderproducts' );
			wp_enqueue_script( 'woocommerceproductsdisplay-carousel' );			
			wp_enqueue_script( 'woocommerceproductsdisplay' );			
			wp_enqueue_script( 'woocommerceproductsgallery' );				
			wp_enqueue_style( 'wooocommerce-gallery-custom-responsive' );	
			wp_enqueue_script( 'woocommerceproductsshowcase' );		
			wp_enqueue_script( 'woocommerceproductstab' );
			wp_enqueue_script( 'woocommercesaleproductsdisplay-carousel' );
			wp_enqueue_script( 'woocommercesaleproductsdisplay' );
		}			
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/Portfolio/portfolio.php' );
		require_once( __DIR__ . '/widgets/Grid/grid.php' );
		require_once( __DIR__ . '/widgets/Carousel/carousel.php' );
		require_once( __DIR__ . '/widgets/SocialShare/socialshare.php' );
		require_once( __DIR__ . '/widgets/widgets-help-functions.php' );
		require_once( __DIR__ . '/widgets/LogoShowcase/logo-showcase.php' );	
		require_once( __DIR__ . '/widgets/Boxmessage/boxmessage.php' );	
		require_once( __DIR__ . '/widgets/Counter/counter.php' );
		require_once( __DIR__ . '/widgets/Countdown/countdown.php' );
		require_once( __DIR__ . '/widgets/Charts/bar.php' );
		require_once( __DIR__ . '/widgets/Charts/pie.php' );
		require_once( __DIR__ . '/widgets/CallToAction/call-to-action.php' );
		require_once( __DIR__ . '/widgets/BlogCarousel/blog-carousel.php' );
		require_once( __DIR__ . '/widgets/Blog/blog.php' );
		require_once( __DIR__ . '/widgets/Faq/faq.php' );
		require_once( __DIR__ . '/widgets/FastCarousel/fast-carousel.php' );
		require_once( __DIR__ . '/widgets/FastGallery/fast-gallery.php' );	
		require_once( __DIR__ . '/widgets/FastGalleryMosaic/fast-gallery-mosaic.php' );
		require_once( __DIR__ . '/widgets/FastMediaGallery/fast-media-gallery.php' );
		require_once( __DIR__ . '/widgets/Header/header.php' );
		require_once( __DIR__ . '/widgets/MegaPostsDisplay/carousel.php' );
		require_once( __DIR__ . '/widgets/MegaPostsDisplay/posts-display.php' );
		require_once( __DIR__ . '/widgets/MegaPostsDisplay/news-ticker.php' );
		require_once( __DIR__ . '/widgets/NewsCarousel/news-carousel.php' );
		require_once( __DIR__ . '/widgets/News/news.php' );
		require_once( __DIR__ . '/widgets/News/news-v2.php' );
		require_once( __DIR__ . '/widgets/TeamVisionCarousel/team-vision-carousel-style1.php' );
		require_once( __DIR__ . '/widgets/TeamVisionCarousel/team-vision-carousel-style2.php' );
		require_once( __DIR__ . '/widgets/TeamVisionCarousel/team-vision-carousel-style3.php' );
		require_once( __DIR__ . '/widgets/TeamVisionCarousel/team-vision-carousel-style4.php' );
		require_once( __DIR__ . '/widgets/TeamVisionCarousel/team-vision-carousel-style5.php' );
		require_once( __DIR__ . '/widgets/TeamVisionCarousel/team-vision-carousel-style6.php' );
		require_once( __DIR__ . '/widgets/TeamVisionCarousel/team-vision-carousel-style7.php' );
		require_once( __DIR__ . '/widgets/TeamVision/team-vision-style1.php' );
		require_once( __DIR__ . '/widgets/TeamVision/team-vision-style2.php' );
		require_once( __DIR__ . '/widgets/TeamVision/team-vision-style3.php' );
		require_once( __DIR__ . '/widgets/TeamVision/team-vision-style4.php' );
		require_once( __DIR__ . '/widgets/TeamVision/team-vision-style5.php' );
		require_once( __DIR__ . '/widgets/TeamVision/team-vision-style6.php' );
		require_once( __DIR__ . '/widgets/TeamVision/team-vision-style7.php' );
		require_once( __DIR__ . '/widgets/Timeline/timeline.php' );
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

			require_once( __DIR__ . '/widgets/WooCommerce/add-to-cart-button.php' );
			require_once( __DIR__ . '/widgets/WooCommerce/products-header.php' );		
			require_once( __DIR__ . '/widgets/WooCommerce/products-carousel.php' );
			require_once( __DIR__ . '/widgets/WooCommerce/products.php' );
			require_once( __DIR__ . '/widgets/WooCommerce/products-gallery.php' );
			require_once( __DIR__ . '/widgets/WooCommerce/products-showcase.php' );
			require_once( __DIR__ . '/widgets/WooCommerce/products-tab.php' );
			require_once( __DIR__ . '/widgets/WooCommerce/sale-products-carousel.php' );
			require_once( __DIR__ . '/widgets/WooCommerce/sale-products.php' );
		
		}		
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FPG_Portfolio() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FPG_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FPG_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\SocialShare() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Logo_Showcase() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Boxmessage() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Countdown() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\BarCharts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PieCharts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Calltoaction() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Blog_Layouts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Blog_Carousel_Layouts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Faq() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Fast_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Fast_Gallery() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Fast_Gallery_Mosaic() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Fast_Media_Gallery() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Header_blocks() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Mega_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Mega_News_Ticker() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Mega_Posts_Display() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\News_Layouts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\News_V2_Layouts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\News_Carousel_Layouts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Carousel_Style1() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Carousel_Style2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Carousel_Style3() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Carousel_Style4() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Carousel_Style5() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Carousel_Style6() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Carousel_Style7() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Style1() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Style2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Style3() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Style4() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Style5() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Style6() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Vision_Style7() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Timeline() );	
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\WooCommerceAddToCartButton() );		
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\WooCommerce_Header_Products() );	
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Woocommerce_Products_Display() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Woocommerce_Products_Carousel_Display() );	
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\WooCommerce_Products_Gallery() );	
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\WooCommerce_Products_Showcase() );	
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\WooCommerce_Products_Tab() );	
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Woocommerce_Sale_Products_Display() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Woocommerce_Sale_Products_Carousel_Display() );	
	
		}
	
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();
