<?php

defined( 'ABSPATH' ) || exit();

class Flexi_Addons_Assets_Manager {

	private static $instance = null;

	public function __construct() {
		/**  frontend scripts */
		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'frontend_scripts' ] );

		/** Editor Scripts  */
		//add_action( 'elementor/editor/before_enqueue_scripts'  , array( __CLASS__, 'editor_scripts' ) );
		add_action( 'elementor/editor/after_enqueue_styles', [ __CLASS__, 'editor_scripts' ]);

		/**  Elementor Frontend */
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'elementor_scripts' ] );


	}

	/**
	 * Frontend scripts
	 */
	public static function frontend_scripts() {

		/** load only on single page/ post */
		if ( ! is_singular() ) {
			return;
		}

		//Carousel and Slider
		wp_register_style( 'slick', FLEXI_ADDONS_ASSETS . '/vendors/slick/slick.css', null, FLEXI_ADDONS_VERSION );

		wp_register_style(
			'slick-theme',
			FLEXI_ADDONS_ASSETS . '/vendors/slick/slick-theme.css',
			null,
			FLEXI_ADDONS_VERSION
		);

		wp_register_script(
			'jquery-slick',
			FLEXI_ADDONS_ASSETS . '/vendors/slick/slick.min.js',
			[ 'jquery' ],
			FLEXI_ADDONS_VERSION,
			true
		);

		wp_register_script(
			'jquery-numerator',
			FLEXI_ADDONS_ASSETS . '/vendors/jquery-numerator/jquery-numerator.min.js',
			[ 'jquery' ],
			FLEXI_ADDONS_VERSION,
			true
		);


		//Magnific Popup
		wp_register_style(
			'magnific-popup',
			FLEXI_ADDONS_ASSETS . '/vendors/magnific-popup/magnific-popup.css',
			false,
			FLEXI_ADDONS_VERSION
		);

		//TwentyTwenty
		wp_register_style(
			'twentytwenty',
			FLEXI_ADDONS_ASSETS . '/vendors/twentytwenty/css/twentytwenty.css',
			false,
			FLEXI_ADDONS_VERSION
		);

		/**
		 * Register widgets css files
		 *
		 * register the css files fo the widget.
		 * make sure to create the css file's name same as the widget key
		 *
		 */
		$widgets = Flexi_Addons_Widgets_Manager::get_widgets_map();

		foreach ( $widgets as $key => $widget ) {

			if ( empty( $widget ) ) {
				return;
			}

			if ( $widget['is_pro'] && flexiaddons()->is_pro_active() ) {
				$file_path = FLX_PRO_PATH . "/assets/css/widgets/$key.css";
				$src       = FLX_PRO_ASSETS . "/css/widgets/$key.css";
			} else {
				$file_path = FLEXI_ADDONS_PATH . "/assets/css/widgets/$key.css";
				$src       = FLEXI_ADDONS_ASSETS . "/css/widgets/$key.css";
			}

			if ( empty( $file_path ) || empty( $src ) || ! file_exists( $file_path ) ) {
				continue;
			}

			wp_register_style( "flexi-addons-$key", $src, [ 'elementor-frontend' ], FLEXI_ADDONS_VERSION );
		}

		/** flexiaddons frontend */
		wp_register_style(
			'flexiaddons',
			FLEXI_ADDONS_ASSETS . '/css/frontend.css',
			[ 'elementor-frontend' ],
			FLEXI_ADDONS_VERSION
		);

		wp_enqueue_style( 'flexiaddons' );


		/** magnific popup */
		wp_register_script(
			'magnific-popup',
			FLEXI_ADDONS_ASSETS . '/vendors/magnific-popup/jquery.magnific-popup.min.js',
			array( 'jquery' ),
			false,
			true
		);

		//event.move
		wp_register_script(
			'event.move',
			FLEXI_ADDONS_ASSETS . '/vendors/twentytwenty/js/jquery.event.move.js',
			array( 'jquery' ),
			false,
			true
		);

		//TwentyTwenty
		wp_register_script(
			'twentytwenty',
			FLEXI_ADDONS_ASSETS . '/vendors/twentytwenty/js/jquery.twentytwenty.js',
			array(
				'jquery',
				'imagesloaded',
				'event.move'
			),
			false,
			true
		);

		/** motion effects*/
		wp_register_script( 'anime', FLEXI_ADDONS_ASSETS . '/vendors/anime/lib/anime.min.js', null, false, true );

		/** flexiaddons frontend */
		wp_register_script(
			'flexiaddons', FLEXI_ADDONS_ASSETS . '/js/frontend.js', [ 'jquery' ],
			FLEXI_ADDONS_VERSION,
			true
		);

		wp_enqueue_script( 'flexiaddons' );



	}

	/** editor scripts */
	public static function editor_scripts() {
		wp_register_style(
			'flexi-addons-editor',
			FLEXI_ADDONS_ASSETS . '/css/editor.css',
			false,
			FLEXI_ADDONS_VERSION
		);
		wp_register_script(
			'flexi-addons-editor',
			FLEXI_ADDONS_ASSETS . '/js/editor.js',
			[ 'jquery' ],
			FLEXI_ADDONS_VERSION,
			true
		);

		wp_enqueue_style( 'flexi-addons-editor' );

		wp_enqueue_script( 'flexi-addons-editor' );
	}

	public static function elementor_scripts() {
		wp_register_script(
			'flexi-addons-elementor',
			FLEXI_ADDONS_ASSETS . '/js/elementor.js',
			[ 'jquery' ],
			FLEXI_ADDONS_VERSION,
			true
		);

		wp_enqueue_script( 'flexi-addons-elementor' );
	}


	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Flexi_Addons_Assets_Manager::instance();