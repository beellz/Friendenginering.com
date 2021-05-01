<?php

defined( 'ABSPATH' ) || exit();


class Flexi_Addons_Widgets_Manager {


	/**
	 * Initialize
	 */
	public function __construct() {
		add_action( 'elementor/init', [ __CLASS__, 'includes' ] );
		add_action( 'elementor/widgets/widgets_registered', [ __CLASS__, 'register' ] );
	}

	/**
	 * Includes all
	 */
	public static function includes() {
		include_once FLEXI_ADDONS_INCLUDES . '/class-widget-base.php';
	}

	/**
	 * @param array
	 *
	 * @return mixed|void
	 *
	 */
	public static function set_inactive_widgets( $widgets = [] ) {
		$inactive = array_diff( array_keys( flexiaddons_get_active_widgets() ), $widgets );

		update_option( 'flexiaddons_inactive_widgets', $inactive );
	}

	public static function set_inactive_extensions( $widgets = [] ) {
		$inactive = array_diff( array_keys( flexiaddons_get_active_extensions() ), $widgets );

		update_option( 'flexiaddons_inactive_extensions', $inactive );
	}

	public static function get_inactive_extensions( $key = false ) {

		$extensions = (array) get_option( 'flexiaddons_inactive_extensions' );

		if ( $key ) {
			return ! empty( $extensions[ $key ] ) ? $extensions[ $key ] : false;
		}

		return array_filter( $extensions );
	}

	/**
	 * @return mixed|void
	 */
	public static function get_inactive_widgets() {

		$widgets = (array) get_option( 'flexiaddons_inactive_widgets' );

		return array_filter( $widgets );
	}

	/**
	 * @param bool $key
	 *
	 * @return array|bool|mixed
	 */
	public static function get_widgets_map( $key = false ) {

		$widgets = [

			//=== WIDGETS==
			'icon-box' => [
				'title'    => __( 'Icon Box', 'flexiaddons' ),
				'icon'     => 'eicon-icon-box',
				'keywords' => [ 'info', 'icon', 'box' ],
				'is_pro'   => false,
				'css'      => [ 'flexi-addons-icon-box' ],
				'js'       => [],
			],

			'info-box' => [
				'title'    => __( 'Info Box', 'flexiaddons' ),
				'icon'     => 'eicon-info-box',
				'keywords' => [ 'info', 'icon', 'box' ],
				'is_pro'   => false,
				'css'      => [ 'flexi-addons-info-box' ],
				'js'       => [],
			],

			'team' => [
				'title'    => __( 'Team Member', 'flexiaddons' ),
				'icon'     => 'eicon-person',
				'keywords' => [ 'team', 'member', 'person' ],
				'is_pro'   => false,
				'css'      => [ 'flexi-addons-team', 'magnific-popup' ],
				'js'       => [ 'magnific-popup' ],
			],

			'skill-bars' => [
				'title'    => __( 'Skill Bars', 'flexiaddons' ),
				'icon'     => 'eicon-skill-bar',
				'is_pro'   => false,
				'keywords' => [ 'progress', 'skill', 'bar', 'chart' ],
				'css'      => [ 'flexi-addons-skill-bars' ],
				'js'       => [],
			],


			'progress-bar' => [
				'title'    => __( 'Progress Bar', 'flexiaddons' ),
				'icon'     => 'eicon-counter-circle',
				'is_pro'   => false,
				'keywords' => [ 'progress', 'skill', 'bar', 'chart' ],
				'css'      => [ 'flexi-addons-progress-bar' ],
				'js'       => [],
			],

			'image-compare' => [
				'title'    => __( 'Image Compare', 'flexiaddons' ),
				'icon'     => 'eicon-image-before-after',
				'is_pro'   => false,
				'keywords' => [ 'compare', 'image', 'before', 'after' ],
				'css'      => [ 'twentytwenty' ],
				'js'       => [ 'twentytwenty' ],
			],

			'testimonial' => [
				'title'    => __( 'Testimonial', 'flexiaddons' ),
				'icon'     => 'eicon-testimonial-carousel',
				'is_pro'   => false,
				'keywords' => [ 'testimonial', 'carousel', 'image' ],
				'css'      => [ 'flexi-addons-testimonial', 'slick', 'slick-theme', ],
				'js'       => [ 'jquery-slick' ],
			],

			'cta' => [
				'title'    => __( 'Call To Action', 'flexiaddons' ),
				'icon'     => 'eicon-call-to-action',
				'is_pro'   => false,
				'keywords' => [ 'Call To Action', 'cta' ],
				'css'      => [ 'flexi-addons-cta' ],
				'js'       => [],
			],

			'accordion' => [
				'title'    => __( 'Accordion', 'flexiaddons' ),
				'icon'     => 'eicon-accordion',
				'is_pro'   => false,
				'keywords' => [ 'accordion', 'tabs', 'toggle' ],
				'css'      => [ 'flexi-addons-accordion' ],
				'js'       => [],
			],

			'tabs' => [
				'title'    => __( 'Tabs', 'flexiaddons' ),
				'icon'     => 'eicon-tabs',
				'is_pro'   => false,
				'keywords' => [ 'tabs', 'tab', 'flexiaddons' ],
				'css'      => [ 'flexi-addons-tabs' ],
				'js'       => [],
			],

			'pricing-table' => [
				'title'    => __( 'Pricing Table', 'flexiaddons' ),
				'icon'     => 'eicon-price-table',
				'is_pro'   => false,
				'keywords' => [ 'Pricing Table', 'Price' ],
				'css'      => [ 'flexi-addons-pricing-table' ],
				'js'       => [],
			],

			'content-toggle' => [
				'title'    => __( 'Content Toggle', 'flexiaddons' ),
				'icon'     => 'eicon-toggle',
				'is_pro'   => false,
				'keywords' => [ 'Content Toggle', 'Toggle' ],
				'css'      => [ 'flexi-addons-content-toggle' ],
				'js'       => [ 'content-toggle' ],
			],

			'fun-factor' => [
				'title'    => __( 'Fun Factor', 'flexiaddons' ),
				'icon'     => 'eicon-archive-title',
				'is_pro'   => false,
				'keywords' => [ 'counter', 'fun', 'factor', 'animation', 'info', 'box', 'number', 'animated' ],
				'css'      => [ 'flexi-addons-fun-factor' ],
				'js'       => [ 'jquery-numerator' ],
			],

			'animated-text' => [
				'title'    => __( 'Animated Text', 'flexiaddons' ),
				'icon'     => 'eicon-animated-headline',
				'is_pro'   => false,
				'keywords' => [ 'text', 'heading', 'animation' ],
				'css'      => [ 'flexi-addons-animated-text' ],
				'js'       => [],
			],

			'cf7' => [
				'title'    => __( 'Contact Form 7', 'flexiaddons' ),
				'icon'     => 'eicon-archive-title',
				'is_pro'   => false,
				'keywords' => [ 'conact', 'form', 'builder', 'conatct form', 'contact form 7', 'box' ],
				'css'      => [ 'flexi-addons-cf7' ],
				'js'       => [ 'jquery-numerator' ],
			],

			'business-hour'  => [
				'title'    => __( 'Business Hours', 'flexiaddons' ),
				'icon'     => 'eicon-clock-o',
				'is_pro'   => false,
				'keywords' => [ 'list', 'watch', 'business', 'hour', 'time', 'business-hour', 'time-list' ],
				'css'      => [ 'flexi-addons-business-hour' ],
				'js'       => [],
			],

			'caldera-form'  => [
				'title'    => __( 'Caldera Form', 'flexiaddons' ),
				'icon'     => 'eicon-clock-o',
				'is_pro'   => false,
				'keywords' => [ 'caldera', 'form', 'new form', 'forms' ],
				'css'      => [ 'flexi-addons-business-hour' ],
				'js'       => [],
			],

			'ninja-form'  => [
				'title'    => __( 'Ninja Form', 'flexiaddons' ),
				'icon'     => 'eicon-clock-o',
				'is_pro'   => false,
				'keywords' => [ 'ninja', 'form', 'new form', 'forms' ],
				'css'      => [ 'flexi-addons-business-hour' ],
				'js'       => [],
			],

			'wp-form'  => [
				'title'    => __( 'WpForm', 'flexiaddons' ),
				'icon'     => 'eicon-clock-o',
				'is_pro'   => false,
				'keywords' => [ 'ninja', 'form', 'new form', 'forms' ],
				'css'      => [ 'flexi-addons-business-hour' ],
				'js'       => [],
			],

			'gravity-form'  => [
				'title'    => __( 'Gravity Form', 'flexiaddons' ),
				'icon'     => 'eicon-clock-o',
				'is_pro'   => false,
				'keywords' => [ 'Gravity', 'form', 'new form', 'forms' ],
				'css'      => [ 'flexi-addons-business-hour' ],
				'js'       => [],
			],


			//=== PRO Widgets ===
			'instagram-feed' => [
				'title'    => __( 'Instagram Feed', 'flexiaddons' ),
				'icon'     => 'eicon-instagram-post',
				'is_pro'   => true,
				'keywords' => [ 'Instagram Feed', 'Instagram' ],
				'css'      => [ 'flexi-addons-instagram-feed' ],
				'js'       => [],
			],

			'comparison-table' => [
				'title'    => __( 'Comparison Table', 'flexiaddons' ),
				'icon'     => 'eicon-table',
				'is_pro'   => true,
				'keywords' => [ 'Comparison Table', 'Comparison', 'Table' ],
				'css'      => [ 'flexi-addons-comparison-table' ],
				'js'       => [],
			],

			'post-carousel' => [
				'title'    => __( 'Post Carousel', 'flexiaddons' ),
				'icon'     => 'eicon-post-slider',
				'is_pro'   => true,
				'keywords' => [ 'Post Carousel', 'Carousel', 'Post' ],
				'css'      => [ 'flexi-addons-post-carousel', 'slick-theme' ],
				'js'       => ['jquery-slick'],
			],
			'post-grid' => [
				'title'    => __( 'Post Grid', 'flexiaddons' ),
				'icon'     => 'eicon-post-slider',
				'is_pro'   => true,
				'keywords' => [ 'Post Grid', 'grid', 'Post' ],
				'css'      => [ 'flexi-addons-post-grid' ],
				'js'       => [],
			],

			'timeline' => [
				'title'    => __( 'Timeline', 'flexiaddons' ),
				'icon'     => 'eicon-time-line',
				'is_pro'   => true,
				'keywords' => [ 'timeline' ],
				'css'      => [ 'flexi-addons-timeline' ],
				'js'       => [],
			],

			'lottie' => [
				'title'    => __( 'Lottie', 'flexiaddons' ),
				'icon'     => 'eicon-lottie',
				'is_pro'   => true,
				'keywords' => [ 'Lottie', 'Player', 'Animation', 'Image' ],
				'css'      => [ 'flexi-addons-lottie' ],
				'js'       => [ 'lottie-player' ],
			],

			'image-distortion' => [
				'title'    => __( 'Image Distortion', 'flexiaddons' ),
				'icon'     => 'eicon-image-rollover',
				'is_pro'   => true,
				'keywords' => [ 'image-distortion' ],
				'css'      => [ 'flexi-addons-image-distortion' ],
				'js'       => [ 'flx-threejs', 'flx-tween-max', 'flx-data-gui', 'flx-sketch', 'flx-distortion', ],
			],

			//			'woo-product-slider' => [
			//				'title'    => __( 'Woo Product Slider', 'flexiaddons' ),
			//				'icon'     => 'eicon-post-slider',
			//				'is_pro'   => true,
			//				'keywords' => [ 'Woo Product Slider', 'Product', 'Slider', 'Woocommerce','slick-theme' ],
			//				'css'      => [ 'woo-product-slider', 'slick-theme' ],
			//				'js'       => ['jquery-slick'],
			//			],

		];

		ksort( $widgets );

		if ( $key ) {
			return isset( $widgets[ $key ] ) ? $widgets[ $key ] : false;
		}

		return $widgets;
	}

	public static function get_extensions_map( $key = false ) {
		$extensions = [

			'wrapper-link' => [
				'title'  => __( 'Wrapper Link', 'flexiaddons' ),
				'icon'   => 'eicon-editor-link',
				'is_pro' => false,
			],

			'duplicator' => [
				'title'  => __( 'Duplicator', 'flexiaddons' ),
				'icon'   => 'eicon-parallax',
				'is_pro' => false,
			],

			'copy-paste' => [
				'title'  => __( 'Cross Site Copy Paste', 'flexiaddons' ),
				'icon'   => 'eicon-copy',
				'is_pro' => false,
			],

			'custom-css' => [
				'title'  => __( 'Custom CSS <br> (SCSS Supports)', 'flexiaddons' ),
				'icon'   => 'eicon-code',
				'is_pro' => false,
			],

			'motion-effects' => [
				'title'  => __( 'Motion Effects', 'flexiaddons' ),
				'icon'   => 'eicon-animation',
				'is_pro' => false,
			],

		];

		if ( $key ) {
			return $extensions[ $key ];
		}

		return $extensions;
	}

	/**
	 * Get widget Label
	 *
	 * @param $key
	 *
	 * @return string
	 */
	public static function get_label( $key ) {
		return ! empty( $title = self::get_widgets_map( $key )['title'] ) ? $title : '';
	}

	/**
	 * Get widget Icon
	 *
	 * @param $key
	 *
	 * @return string
	 */
	public static function get_icon( $key ) {
		return ! empty( $icon = self::get_widgets_map( $key )['icon'] ) ? $icon : 'eicon-star';
	}

	/**
	 * Get widget Keywords
	 *
	 * @param $key
	 *
	 * @return array
	 */
	public static function get_keywords( $key ) {
		return ! empty( $keywords = self::get_widgets_map( $key )['keywords'] ) ? $keywords : [];
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public static function register() {

		$inactive_widgets = self::get_inactive_widgets();

		foreach ( self::get_widgets_map() as $widget_key => $widget ) {

			if ( $widget['is_pro'] && ! flexiaddons()->is_pro_active() ) {
				continue;
			}

			if ( ! in_array( $widget_key, $inactive_widgets ) ) {
				self::register_widget( $widget_key, $widget['is_pro'] );
			}
		}
	}

	/**
	 * Register Widget
	 *
	 * @param $widget
	 *
	 * @since 1.0.0
	 *
	 */
	protected static function register_widget( $widget, $is_pro = false ) {

		if ( ! $is_pro ) {
			$widget_file = FLEXI_ADDONS_WIDGETS . '/' . $widget . '/widget.php';
		} else {
			if ( defined( 'FLX_PRO_WIDGETS' ) ) {
				$widget_file = FLX_PRO_WIDGETS . '/' . $widget . '/widget.php';
			}
		}


		if ( is_readable( $widget_file ) ) {
			include_once $widget_file;

			$widget_class = 'Flexi_Addons_Widget_' . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $widget ) ) );

			if ( class_exists( $widget_class ) ) {
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget_class );
			}
		}
	}
}

new Flexi_Addons_Widgets_Manager();
