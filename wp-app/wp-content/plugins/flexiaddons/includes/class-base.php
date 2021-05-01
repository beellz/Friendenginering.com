<?php

defined( 'ABSPATH' ) || exit();

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 */
final class Flexi_Addons_Base {


	/**
	 * @var string
	 */
	public $name = 'Flexi Addons';

	/**
	 * @var null
	 */
	protected static $instance = null;


	public function is_pro_active() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		return is_plugin_active( 'flexiaddons-pro/flexiaddons-pro.php' );
	}

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->includes();
		$this->init_hooks();
		$this->init_tracker();
		do_action( 'flexiaddons_loaded' );
	}

	private function includes() {
		include_once FLEXI_ADDONS_INCLUDES . '/functions.php';
		include_once FLEXI_ADDONS_INCLUDES . '/class-widgets-manager.php';
		include_once FLEXI_ADDONS_INCLUDES . '/class-assets-manager.php';
		include_once FLEXI_ADDONS_INCLUDES . '/class-ajax.php';

		/*extensions*/
		include_once FLEXI_ADDONS_INCLUDES . '/extensions/class-wrapper-link.php';
		include_once FLEXI_ADDONS_INCLUDES . '/extensions/class-duplicator.php';
		include_once FLEXI_ADDONS_INCLUDES . '/extensions/class-x-copy-paste.php';
		include_once FLEXI_ADDONS_INCLUDES . '/extensions/class-custom-css.php';
		include_once FLEXI_ADDONS_INCLUDES . '/extensions/class-motion-effects.php';

		/** modules */
		include_once FLEXI_ADDONS_PATH . '/modules/controls/init.php';


		if ( is_admin() ) {
			require_once FLEXI_ADDONS_INCLUDES . '/admin/class-admin.php';
		}
	}

	private function init_hooks() {

		// Localize our plugin
		add_action( 'init', [ $this, 'set_locale' ] );

		//action_links
		add_filter( 'plugin_action_links_' . plugin_basename( FLEXI_ADDONS_FILE ), [ $this, 'plugin_action_links' ] );

		//Register Custom Widget Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
	}


	/**
	 * add admin notice for displaying
	 *
	 * @param $class
	 * @param $message
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	function add_notice( $class, $message ) {

		$notices = get_option( 'flexiaddons_notices', [] );
		if ( is_string( $message ) && is_string( $class ) && ! wp_list_filter( $notices, array( 'message' => $message ) ) ) {

			$notices[] = [
				'message' => $message,
				'class'   => $class
			];

			update_option( 'flexiaddons_notices', $notices );
		}

	}

	/**
	 * Display admin notices
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	function admin_notices() {
		$notices = get_option( 'flexiaddons_notices', [] );
		foreach ( $notices as $notice ) { ?>
            <div class="notice is-dismissible notice-<?php echo $notice['class']; ?>">
                <p><?php echo $notice['message']; ?></p>
            </div>
			<?php
			update_option( 'flexiaddons_notices', [] );
		}
	}

	/**
	 * Initialize plugin for localization
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function set_locale() {
		load_plugin_textdomain( 'flexiaddons', false, dirname( plugin_basename( FLEXI_ADDONS_FILE ) ) . '/languages/' );
	}

	/**
	 * Plugin action links
	 *
	 * @param array $links
	 *
	 * @return array
	 */
	function plugin_action_links( $links ) {

	    $links[] = '<a href="' . admin_url( 'admin.php?page=flexiaddons' ) . '">'.__('Settings', 'flexiaddons').'</a>';

		return $links;
	}

	/**
	 * Initialize the plugin tracker
	 *
	 * @return void
	 */
	function init_tracker() {

		if ( ! class_exists( 'Appsero\Client' ) ) {
			require_once FLEXI_ADDONS_PATH . '/appsero/src/Client.php';
		}

		$client = new Appsero\Client( 'c0652bc7-659c-47d0-a740-330938a15287', 'Flexi Addons for Elementor', FLEXI_ADDONS_FILE );

		// Active insights
		$client->insights()->init();

	}

	/**
	 * Add custom category.
	 *
	 * @param $elements_manager
	 */
	public function add_category( $elements_manager ) {
		$elements_manager->add_category(
			'flexiaddons_category',
			[
				'title' => __( 'Flexi Addons', 'flexiaddons' ),
				'icon'  => 'font',
			]
		);
	}


	/**
	 * Main Flexi_Addons_Base instance
	 *
	 * @return Flexi_Addons_Base|null
	 *
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {

			self::$instance = new self();
		}

		return self::$instance;
	}

}
