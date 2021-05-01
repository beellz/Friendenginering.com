<?php

defined( 'ABSPATH' ) || exit();

class Flexi_Addons_Admin {

	const PAGE_SLUG = 'flexiaddons';

	private $menu_slug = '';

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_menu' ], 21 );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
	}

	public function add_menu() {

		$this->menu_slug = add_menu_page(
			__( 'Flexi Addons Dashboard', 'flexiaddons' ),
			__( 'Flexi Addons', 'flexiaddons' ),
			'manage_options',
			self::PAGE_SLUG,
			[ $this, 'render_dashboard' ],
			FLEXI_ADDONS_ASSETS . '/images/flexi-addons.svg',
			58.5
		);

	}

	public function render_dashboard() {
		include FLEXI_ADDONS_TEMPLATES . '/admin/dashboard.php';
	}

	public function admin_scripts() {

		wp_register_style( 'flexi-addons-admin', FLEXI_ADDONS_ASSETS . '/css/admin.css', [], FLEXI_ADDONS_VERSION );
		wp_register_style( 'sweetalert2', FLEXI_ADDONS_ASSETS . '/vendors/sweetalert2/css/sweetalert2.min.css', [], FLEXI_ADDONS_VERSION );

		wp_register_script( 'sweetalert2', FLEXI_ADDONS_ASSETS . '/vendors/sweetalert2/js/sweetalert2.min.js', ['jquery'], FLEXI_ADDONS_VERSION, true );

		wp_register_script( 'flexi-addons-admin', FLEXI_ADDONS_ASSETS . '/js/admin.js', [
			'jquery',
			'wp-util'
		], FLEXI_ADDONS_VERSION, true );

		wp_enqueue_style( 'flexi-addons-admin' );
		wp_enqueue_style( 'sweetalert2' );

		wp_enqueue_script( 'sweetalert2' );
		wp_enqueue_script( 'flexi-addons-admin' );

		$localize_arr = [
			'_nonce' => wp_create_nonce(),
			'i18n' => [
				'settingsConfirm' => __('Setting Saved successfully', 'flexiaddons'),
				'saveSettings' => __('Save Settings', 'flexiaddons'),
				'goPro' => __('Go PRO!', 'flexiaddons'),
				'proMsg' => __('Purchase our pro version to unlock this premium features!', 'flexiaddons'),
			]
		];

		wp_localize_script( 'flexi-addons-admin', 'flexi', $localize_arr );

	}

}

new Flexi_Addons_Admin();