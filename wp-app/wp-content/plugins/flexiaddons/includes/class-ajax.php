<?php

defined('ABSPATH') || exit();

/**
 * Handle flexi dashboard widgets
 */
function handle_flexi_dashboard() {

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_REQUEST['nonce'] ) ) {
		return;
	}

	parse_str( wp_unslash($_REQUEST['form']), $param );

	$widgets    = ! empty( $param['widgets'] ) ? $param['widgets'] : [];
	$extensions = ! empty( $param['extensions'] ) ? $param['extensions'] : [];

	Flexi_Addons_Widgets_Manager::set_inactive_widgets( $widgets );
	Flexi_Addons_Widgets_Manager::set_inactive_extensions( $extensions );

	$inactive_widgets = Flexi_Addons_Widgets_Manager::get_inactive_widgets();

	wp_send_json_success( [
		'success'  => 1,
		'inactive' => count( $inactive_widgets ),
		'active'   => count( flexiaddons_get_active_widgets() ) - count( $inactive_widgets ),
	] );

}

add_action( 'wp_ajax_handle_flexi_dashboard', 'handle_flexi_dashboard' );
add_action( 'wp_ajax_nopriv_handle_flexi_dashboard', 'handle_flexi_dashboard' );