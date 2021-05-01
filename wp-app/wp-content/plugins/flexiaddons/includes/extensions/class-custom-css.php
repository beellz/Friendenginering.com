<?php

use Elementor\Controls_Manager;
use Elementor\Core\Files\CSS\Post;
use Elementor\Element_Base;

defined( 'ABSPATH' ) || die();

class FLX_Custom_CSS {

	public function __construct() {

		if ( ! $this->is_active() ) {
			return;
		}

		/* load scss compiler */
		include_once FLEXI_ADDONS_INCLUDES . '/extensions/scss.inc.php';

		add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'add_controls_section' ], 1 );
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'add_controls_section' ], 1 );
		add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'add_controls_section' ], 1 );

		add_action( 'elementor/element/parse_css', [ $this, 'add_post_css' ], 10, 2 );

		add_filter( 'elementor/widget/render_content', [ $this, 'render_editor_custom_css' ], 10, 2 );
	}

	function render_editor_custom_css( $widget_content, $element ) {

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {

			$setting = $element->get_settings_for_display();


			if ( ! empty( $setting['flx_custom_css'] ) && ! empty( $css = trim( $setting['flx_custom_css'] ) ) ) {
				global $post;
				$replacement = ".elementor-{$post->ID} .elementor-element" . $element->get_unique_selector();
				printf( '<style>%s</style>', $this->get_compiled_scss( $setting['flx_custom_css'], $replacement ) );

			}
		}


		return $widget_content;
	}

	public function get_compiled_scss( $css, $replacement ) {
		$scss_compiler = new scssc();

		$css = str_replace( 'selector', $replacement, $css );

		$css = $scss_compiler->compile( $css );

		// Add a css comment
		$css = sprintf( '/* Start flexiaddons custom CSS for class: %s */', $replacement )
		       . $css . '/* End flexiaddons custom CSS */';

		return $css;
	}

	public static function add_controls_section( Element_Base $element ) {
		$tabs = Controls_Manager::TAB_ADVANCED;

		$element->start_controls_section( '_section_flx_custom_css', [
			'label' => __( 'Flexi Custom CSS', 'flexiaddons' ),
			'tab'   => $tabs,
		] );

		$element->add_control( 'flx_custom_css', [
			'label'       => __( 'Add Custom CSS here (SCSS Supported)', 'flexiaddons' ),
			'type'        => Controls_Manager::CODE,
			'render_type' => 'template',
			'language'    => 'scss',
			'description' => 'Use "selector" to target wrapper element.',
		] );

		$element->end_controls_section();
	}

	/**
	 * @param $post_css Post
	 * @param $element  Element_Base
	 */
	public function add_post_css( $post_css, $element ) {

		$element_settings = $element->get_settings();

		if ( empty( $element_settings['flx_custom_css'] ) ) {
			return;
		}


		if ( empty( trim( $element_settings['flx_custom_css'] ) ) ) {
			return;
		}

		$css = trim( $element_settings['flx_custom_css'] );

		$post_css->get_stylesheet()->add_raw_css( $this->get_compiled_scss( $css, $post_css->get_element_unique_selector( $element ) ) );
	}

	private static function is_active() {
		return ! in_array( 'custom-css', Flexi_Addons_Widgets_Manager::get_inactive_extensions() );
	}

}

new FLX_Custom_CSS();
