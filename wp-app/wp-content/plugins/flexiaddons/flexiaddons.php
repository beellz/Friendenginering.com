<?php

/**
 * Plugin Name:       FlexiAddons
 * Plugin URI:        https://flexiaddons.com/
 * Description:       A collection of premium quality & highly customizable addons or modules for use in Elementor page builder.
 * Version:           1.0.2
 * Author:            WPPOOL
 * Author URI:        https://wppool.dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       flexiaddons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) || exit();

define( 'FLEXI_ADDONS_VERSION', '1.0.2' );
define( 'FLEXI_ADDONS_FILE', __FILE__ );
define( 'FLEXI_ADDONS_PATH', dirname( FLEXI_ADDONS_FILE ) );
define( 'FLEXI_ADDONS_INCLUDES', FLEXI_ADDONS_PATH . '/includes' );
define( 'FLEXI_ADDONS_WIDGETS', FLEXI_ADDONS_PATH . '/widgets' );
define( 'FLEXI_ADDONS_URL', plugins_url( '', FLEXI_ADDONS_FILE ) );
define( 'FLEXI_ADDONS_ASSETS', FLEXI_ADDONS_URL . '/assets' );
define( 'FLEXI_ADDONS_TEMPLATES', FLEXI_ADDONS_PATH . '/templates' );

define( 'FLEXI_ADDONS_MINIMUM_ELEMENTOR_VERSION', '2.5.0' );
define( 'FLEXI_ADDONS_MINIMUM_PHP_VERSION', '5.4' );

//activation stuffs
register_activation_hook( FLEXI_ADDONS_FILE, 'flexiaddons_activate' );


/**
 * The journey of flexi_addons of a thousand miles starts here.
 *
 * @return void Some voids are not really void, you have to explore to figure out why not!
 */
function flexi_let_the_journey_begin() {

	// Check for required PHP version
	if ( version_compare( PHP_VERSION, FLEXI_ADDONS_MINIMUM_PHP_VERSION, '<' ) ) {
		add_action( 'admin_notices', 'flexi_required_php_version_missing_notice' );

		return;
	}

	// Check if Elementor installed and activated
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'flexi_elementor_missing_notice' );

		return;
	}

	// Check for required Elementor version
	if ( ! version_compare( ELEMENTOR_VERSION, FLEXI_ADDONS_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
		add_action( 'admin_notices', 'flexi_required_elementor_version_missing_notice' );

		return;
	}

	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 */
	require FLEXI_ADDONS_INCLUDES . '/class-base.php';

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function flexiaddons() {

		return Flexi_Addons_Base::instance();

	}

	flexiaddons();
}

add_action( 'plugins_loaded', 'flexi_let_the_journey_begin' );

/**
 * Admin notice for required php version
 *
 * @return void
 */
function flexi_required_php_version_missing_notice() {
	$notice = sprintf(
	/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
		esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'flexiaddons' ),
		'<strong>' . esc_html__( 'Flexi Addons', 'flexiaddons' ) . '</strong>',
		'<strong>' . esc_html__( 'PHP', 'flexiaddons' ) . '</strong>',
		FLEXI_ADDONS_MINIMUM_PHP_VERSION
	);

	printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
}

/**
 * Admin notice for elementor if missing
 *
 * @return void
 */
function flexi_elementor_missing_notice() {
	$notice = sprintf(
	/* translators: 1: Plugin name 2: Elementor 3: Elementor installation link */
		__( '%1$s requires %2$s to be installed and activated to function properly. %3$s', 'flexiaddons' ),
		'<strong>' . __( 'Flexi Addons', 'flexiaddons' ) . '</strong>',
		'<strong>' . __( 'Elementor', 'flexiaddons' ) . '</strong>',
		'<a href="' . esc_url( admin_url( 'plugin-install.php?s=Elementor&tab=search&type=term' ) ) . '">' . __( 'Please click on this link and install Elementor', 'flexiaddons' ) . '</a>'
	);

	printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
}

/**
 * Admin notice for required elementor version
 *
 * @return void
 */
function flexi_required_elementor_version_missing_notice() {
	$notice = sprintf(
	/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
		esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'flexiaddons' ),
		'<strong>' . esc_html__( 'Flexi Addons', 'flexiaddons' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'flexiaddons' ) . '</strong>',
		FLEXI_ADDONS_MINIMUM_ELEMENTOR_VERSION
	);

	printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
}

function flexiaddons_activate() {
	update_option( 'flexiaddons_version', FLEXI_ADDONS_VERSION );

	if ( empty( get_option( 'flexiaddons_install_date' ) ) ) {
		update_option( 'flexiaddons_install_date', date('Y-m-d') );
	}
}


