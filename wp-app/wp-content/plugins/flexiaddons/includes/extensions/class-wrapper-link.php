<?php

use Elementor\Controls_Manager;
use Elementor\Element_Base;

defined( 'ABSPATH' ) || die();

class FLX_Wrapper_Link {

	public function __construct() {

		if ( ! $this->is_active() ) {
			return;
		}

		add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'add_controls_section' ], 1 );
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'add_controls_section' ], 1 );
		add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'add_controls_section' ], 1 );
		add_action( 'elementor/frontend/before_render', [ $this, 'before_section_render' ], 1 );
	}

	public static function add_controls_section( Element_Base $element ) {
		$tabs = Controls_Manager::TAB_CONTENT;

		if ( 'section' === $element->get_name() || 'column' === $element->get_name() ) {
			$tabs = Controls_Manager::TAB_LAYOUT;
		}

		$element->start_controls_section( '_section_flx_wrapper_link', [
			'label' => __( 'Flexi Wrapper Link ', 'flexiaddons' )
			           . '<i style="float: right;    font-size: 30px;position: absolute;right: 10px;top: 5px;" class="eicon-editor-link"></i>',
			'tab'   => $tabs,
		] );

		$element->add_control( 'flx_element_link', [
			'label'       => __( 'Link', 'flexiaddons' ),
			'type'        => Controls_Manager::URL,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => 'https://example.com',
			'render_type' => 'ui',
			'description' => __( 'Make selected section/ column clickable.', 'flexiaddons' ),
		] );

		$element->end_controls_section();
	}

	public static function before_section_render( Element_Base $element ) {
		$settings = $element->get_settings_for_display();
		$flx_link = $settings['flx_element_link'];

		if ( ! empty( $flx_link['url'] ) ) {
			$element->add_render_attribute( '_wrapper', [
				'data-flx-element-link' => json_encode( $flx_link ),
				'style'                 => 'cursor: pointer',
			] );
		}
	}


	private static function is_active() {
		return ! in_array( 'wrapper-link', Flexi_Addons_Widgets_Manager::get_inactive_extensions() );
	}

}

new FLX_Wrapper_Link();
