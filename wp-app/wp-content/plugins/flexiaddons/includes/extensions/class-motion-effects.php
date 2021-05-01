<?php

use Elementor\Controls_Manager;
use Elementor\Element_Base;

defined( 'ABSPATH' ) || die();

class FLX_Motion_Effects {

	private static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		if ( ! $this->is_active() ) {
			return;
		}

		add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'add_controls_section' ], 1 );
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'anime' );
	}

	public function add_controls_section( Element_Base $element ) {
		$element->start_controls_section( '_section_flexi_effects', [
			'label' => __( 'Flexi Effects', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_ADVANCED,
		] );

		self::render_motion_effects( $element );
		self::render_css_effects( $element );

		$element->end_controls_section();
	}

	public static function render_motion_effects( Element_Base $element ) {
		/** motion effects switcher */
		$element->add_control( 'flx_motion_fx', [
			'label'              => __( 'Motion Effects', 'flexiaddons' ),
			'type'               => Controls_Manager::SWITCHER,
			'return_value'       => 'yes',
			'frontend_available' => true,
		] );

		$element->start_controls_tabs( 'flx_motion_tabs' );

		/** start motion effects normal tab */
		$element->start_controls_tab( 'flx_motion_tab_normal', [
			'label'     => __( 'Normal', 'flexiaddons' ),
			'condition' => [
				'flx_motion_fx' => 'yes',
			],
		] );

		/** translate toggle */
		$element->add_control( 'flx_motion_fx_translate_toggle', [
			'label'              => __( 'Translate', 'flexiaddons' ),
			'type'               => Controls_Manager::POPOVER_TOGGLE,
			'return_value'       => 'yes',
			'frontend_available' => true,
			'condition'          => [
				'flx_motion_fx' => 'yes',
			],
		] );

		/** translate toggle popover */
		$element->start_popover();

		/** translate X */
		$element->add_control( 'flx_motion_fx_translate_x', [
			'label'              => __( 'Translate X (Horizontal)', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 5,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 100,
					'max' => 100,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_translate_toggle' => 'yes',
				'flx_motion_fx'                  => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** translate Y */
		$element->add_control( 'flx_motion_fx_translate_y', [
			'label'              => __( 'Translate Y (Vertical)', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 5,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 100,
					'max' => 100,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_translate_toggle' => 'yes',
				'flx_motion_fx'                  => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** translate duration */
		$element->add_control( 'flx_motion_fx_translate_duration', [
			'label'              => __( 'Duration', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 10000,
					'step' => 100,
				],
			],
			'default'            => [
				'size' => 1000,
			],
			'condition'          => [
				'flx_motion_fx_translate_toggle' => 'yes',
				'flx_motion_fx'                  => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** translate delay */
		$element->add_control( 'flx_motion_fx_translate_delay', [
			'label'              => __( 'Delay', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5000,
					'step' => 100,
				],
			],
			'condition'          => [
				'flx_motion_fx_translate_toggle' => 'yes',
				'flx_motion_fx'                  => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		$element->end_popover();
		/** end translate popover */

		/** rotate toggle */
		$element->add_control( 'flx_motion_fx_rotate_toggle', [
			'label'              => __( 'Rotate', 'flexiaddons' ),
			'type'               => Controls_Manager::POPOVER_TOGGLE,
			'return_value'       => 'yes',
			'frontend_available' => true,
			'condition'          => [
				'flx_motion_fx' => 'yes',
			],
		] );

		/** start rotate toggle popover */
		$element->start_popover();

		/** rotate x */
		$element->add_control( 'flx_motion_fx_rotate_x', [
			'label'              => __( 'Rotate X (Horizontal)', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 45,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_rotate_toggle' => 'yes',
				'flx_motion_fx'               => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** rotate y */
		$element->add_control( 'flx_motion_fx_rotate_y', [
			'label'              => __( 'Rotate Y (Vertical)', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 45,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_rotate_toggle' => 'yes',
				'flx_motion_fx'               => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** rotate z */
		$element->add_control( 'flx_motion_fx_rotate_z', [
			'label'              => __( 'Rotate Z', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 45,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_rotate_toggle' => 'yes',
				'flx_motion_fx'               => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** rotate duration */
		$element->add_control( 'flx_motion_fx_rotate_duration', [
			'label'              => __( 'Duration', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 10000,
					'step' => 100,
				],
			],
			'default'            => [
				'size' => 1000,
			],
			'condition'          => [
				'flx_motion_fx_rotate_toggle' => 'yes',
				'flx_motion_fx'               => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** rotate delay */
		$element->add_control( 'flx_motion_fx_rotate_delay', [
			'label'              => __( 'Delay', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5000,
					'step' => 100,
				],
			],
			'condition'          => [
				'flx_motion_fx_rotate_toggle' => 'yes',
				'flx_motion_fx'               => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		$element->end_popover();
		/** end rotate toggle popover */

		/** scale toggle */
		$element->add_control( 'flx_motion_fx_scale_toggle', [
			'label'              => __( 'Scale', 'flexiaddons' ),
			'type'               => Controls_Manager::POPOVER_TOGGLE,
			'return_value'       => 'yes',
			'frontend_available' => true,
			'condition'          => [
				'flx_motion_fx' => 'yes',
			],
		] );

		/** start scale popover */
		$element->start_popover();

		/** scale X */
		$element->add_control( 'flx_motion_fx_scale_x', [
			'label'              => __( 'Scale X', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 1,
					'to'   => 1.2,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5,
					'step' => .1,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_scale_toggle' => 'yes',
				'flx_motion_fx'              => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** scale Y */
		$element->add_control( 'flx_motion_fx_scale_y', [
			'label'              => __( 'Scale Y', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 1,
					'to'   => 1.2,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5,
					'step' => .1,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_scale_toggle' => 'yes',
				'flx_motion_fx'              => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** scale duration */
		$element->add_control( 'flx_motion_fx_scale_duration', [
			'label'              => __( 'Duration', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 10000,
					'step' => 100,
				],
			],
			'default'            => [
				'size' => 1000,
			],
			'condition'          => [
				'flx_motion_fx_scale_toggle' => 'yes',
				'flx_motion_fx'              => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** scale duration */
		$element->add_control( 'flx_motion_fx_scale_delay', [
			'label'              => __( 'Delay', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5000,
					'step' => 100,
				],
			],
			'condition'          => [
				'flx_motion_fx_scale_toggle' => 'yes',
				'flx_motion_fx'              => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		$element->end_popover();

		$element->end_controls_tab();


		/** start motion effects hover animation  */
		$element->start_controls_tab( 'flx_motion_tab_hover', [
			'label'     => __( 'Hover', 'flexiaddons' ),
			'condition' => [
				'flx_motion_fx' => 'yes',
			],
		] );

		/** hover translate toggle */
		$element->add_control( 'flx_motion_fx_hover_translate_toggle', [
			'label'              => __( 'Translate', 'flexiaddons' ),
			'type'               => Controls_Manager::POPOVER_TOGGLE,
			'return_value'       => 'yes',
			'frontend_available' => true,
			'condition'          => [
				'flx_motion_fx' => 'yes',
			],
		] );

		/** hover translate toggle popover */
		$element->start_popover();

		/** hover translate X */
		$element->add_control( 'flx_motion_fx_hover_translate_x', [
			'label'              => __( 'Translate X (Horizontal)', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 5,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 100,
					'max' => 100,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_hover_translate_toggle' => 'yes',
				'flx_motion_fx'                        => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover translate Y */
		$element->add_control( 'flx_motion_fx_hover_translate_y', [
			'label'              => __( 'Translate Y (Vertical)', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 5,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 100,
					'max' => 100,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_hover_translate_toggle' => 'yes',
				'flx_motion_fx'                        => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover translate duration */
		$element->add_control( 'flx_motion_fx_hover_translate_duration', [
			'label'              => __( 'Duration', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 10000,
					'step' => 100,
				],
			],
			'default'            => [
				'size' => 1000,
			],
			'condition'          => [
				'flx_motion_fx_hover_translate_toggle' => 'yes',
				'flx_motion_fx'                        => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover translate delay */
		$element->add_control( 'flx_motion_fx_hover_translate_delay', [
			'label'              => __( 'Delay', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5000,
					'step' => 100,
				],
			],
			'condition'          => [
				'flx_motion_fx_hover_translate_toggle' => 'yes',
				'flx_motion_fx'                        => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		$element->end_popover();
		/** hover end translate popover */

		/** hover rotate toggle */
		$element->add_control( 'flx_motion_fx_hover_rotate_toggle', [
			'label'              => __( 'Rotate', 'flexiaddons' ),
			'type'               => Controls_Manager::POPOVER_TOGGLE,
			'return_value'       => 'yes',
			'frontend_available' => true,
			'condition'          => [
				'flx_motion_fx' => 'yes',
			],
		] );

		/** hover start rotate toggle popover */
		$element->start_popover();

		/** hover rotate x */
		$element->add_control( 'flx_motion_fx_hover_rotate_x', [
			'label'              => __( 'Rotate X (Horizontal)', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 45,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_hover_rotate_toggle' => 'yes',
				'flx_motion_fx'                     => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover rotate y */
		$element->add_control( 'flx_motion_fx_hover_rotate_y', [
			'label'              => __( 'Rotate Y (Vertical)', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 45,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_hover_rotate_toggle' => 'yes',
				'flx_motion_fx'                     => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover rotate z */
		$element->add_control( 'flx_motion_fx_hover_rotate_z', [
			'label'              => __( 'Rotate Z', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 0,
					'to'   => 45,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_hover_rotate_toggle' => 'yes',
				'flx_motion_fx'                     => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover rotate duration */
		$element->add_control( 'flx_motion_fx_hover_rotate_duration', [
			'label'              => __( 'Duration', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 10000,
					'step' => 100,
				],
			],
			'default'            => [
				'size' => 1000,
			],
			'condition'          => [
				'flx_motion_fx_hover_rotate_toggle' => 'yes',
				'flx_motion_fx'                     => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover rotate delay */
		$element->add_control( 'flx_motion_fx_hover_rotate_delay', [
			'label'              => __( 'Delay', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5000,
					'step' => 100,
				],
			],
			'condition'          => [
				'flx_motion_fx_hover_rotate_toggle' => 'yes',
				'flx_motion_fx'                     => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		$element->end_popover();
		/** hover end rotate toggle popover */

		/** hover scale toggle */
		$element->add_control( 'flx_motion_fx_hover_scale_toggle', [
			'label'              => __( 'Scale', 'flexiaddons' ),
			'type'               => Controls_Manager::POPOVER_TOGGLE,
			'return_value'       => 'yes',
			'frontend_available' => true,
			'condition'          => [
				'flx_motion_fx' => 'yes',
			],
		] );

		/** hover start scale popover */
		$element->start_popover();

		/** hover scale X */
		$element->add_control( 'flx_motion_fx_hover_scale_x', [
			'label'              => __( 'Scale X', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 1,
					'to'   => 1.2,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5,
					'step' => .1,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_hover_scale_toggle' => 'yes',
				'flx_motion_fx'                    => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover scale Y */
		$element->add_control( 'flx_motion_fx_hover_scale_y', [
			'label'              => __( 'Scale Y', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'default'            => [
				'sizes' => [
					'from' => 1,
					'to'   => 1.2,
				],
				'unit'  => 'px',
			],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5,
					'step' => .1,
				],
			],
			'labels'             => [
				__( 'From', 'flexiaddons' ),
				__( 'To', 'flexiaddons' ),
			],
			'scales'             => 1,
			'handles'            => 'range',
			'condition'          => [
				'flx_motion_fx_hover_scale_toggle' => 'yes',
				'flx_motion_fx'                    => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover scale duration */
		$element->add_control( 'flx_motion_fx_hover_scale_duration', [
			'label'              => __( 'Duration', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 10000,
					'step' => 100,
				],
			],
			'default'            => [
				'size' => 1000,
			],
			'condition'          => [
				'flx_motion_fx_hover_scale_toggle' => 'yes',
				'flx_motion_fx'                    => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		/** hover scale duration */
		$element->add_control( 'flx_motion_fx_hover_scale_delay', [
			'label'              => __( 'Delay', 'flexiaddons' ),
			'type'               => Controls_Manager::SLIDER,
			'size_units'         => [ 'px' ],
			'range'              => [
				'px' => [
					'min'  => 0,
					'max'  => 5000,
					'step' => 100,
				],
			],
			'condition'          => [
				'flx_motion_fx_hover_scale_toggle' => 'yes',
				'flx_motion_fx'                    => 'yes',
			],
			'render_type'        => 'none',
			'frontend_available' => true,
		] );

		$element->end_popover();


		$element->end_controls_tab();

		$element->end_controls_tabs();


		/** divider */
		$element->add_control( 'flx_motion_hr', [
			'type' => Controls_Manager::DIVIDER,
		] );
	}

	/**
	 * render css effects controls
	 *
	 * @param   Element_Base  $element
	 */
	public static function render_css_effects( Element_Base $element ) {
		/** css effects switcher */
		$element->add_control( 'flx_transform_fx', [
			'label'        => __( 'CSS Transform', 'flexiaddons' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
		] );


		$element->start_controls_tabs( 'flx_transform_tabs' );

		/** start css effects normal tab */
		$element->start_controls_tab( 'flx_transform_tab_normal', [
			'label'     => __( 'Normal', 'flexiaddons' ),
			'condition' => [
				'flx_transform_fx' => 'yes',
			],
		] );

		/** css translate toggle */
		$element->add_control( 'flx_transform_fx_translate_toggle', [
			'label'        => __( 'Translate', 'flexiaddons' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'return_value' => 'yes',
			'condition'    => [
				'flx_transform_fx' => 'yes',
			],
		] );

		$element->start_popover();

		/** css translate X */
		$element->add_responsive_control( 'flx_transform_fx_translate_x', [
			'label'      => __( 'Translate X', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 1000,
					'max' => 1000,
				],
			],
			'condition'  => [
				'flx_transform_fx_translate_toggle' => 'yes',
				'flx_transform_fx'                  => 'yes',
			],
		] );

		/** css translate Y */
		$element->add_responsive_control( 'flx_transform_fx_translate_y', [
			'label'      => __( 'Translate Y', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 1000,
					'max' => 1000,
				],
			],
			'condition'  => [
				'flx_transform_fx_translate_toggle' => 'yes',
				'flx_transform_fx'                  => 'yes',
			],
			'selectors'  => [
				'(desktop){{WRAPPER}}' => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px);'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px);'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px);',
				'(tablet){{WRAPPER}}'  => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px);'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px);'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px);',
				'(mobile){{WRAPPER}}'  => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px);'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px);'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px);',
			],
		] );

		$element->end_popover();

		/** css rotate toggle */
		$element->add_control( 'flx_transform_fx_rotate_toggle', [
			'label'     => __( 'Rotate', 'flexiaddons' ),
			'type'      => Controls_Manager::POPOVER_TOGGLE,
			'condition' => [
				'flx_transform_fx' => 'yes',
			],
		] );

		$element->start_popover();

		/** css rotate X */
		$element->add_responsive_control( 'flx_transform_fx_rotate_x', [
			'label'      => __( 'Rotate X', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_rotate_toggle' => 'yes',
				'flx_transform_fx'               => 'yes',
			],
		] );

		/** css rotate Y */
		$element->add_responsive_control( 'flx_transform_fx_rotate_y', [
			'label'      => __( 'Rotate Y', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_rotate_toggle' => 'yes',
				'flx_transform_fx'               => 'yes',
			],
		] );

		/** css rotate Z */
		$element->add_responsive_control( 'flx_transform_fx_rotate_z', [
			'label'      => __( 'Rotate Z', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_rotate_toggle' => 'yes',
				'flx_transform_fx'               => 'yes',
			],
			'selectors'  => [
				'(desktop){{WRAPPER}}' => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z.SIZE || 0}}deg);'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z.SIZE || 0}}deg);'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z.SIZE || 0}}deg);',
				'(tablet){{WRAPPER}}'  => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_tablet.SIZE || 0}}deg);'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_tablet.SIZE || 0}}deg);'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_tablet.SIZE || 0}}deg);',
				'(mobile){{WRAPPER}}'  => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_mobile.SIZE || 0}}deg);'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_mobile.SIZE || 0}}deg);'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_mobile.SIZE || 0}}deg);',
			],
		] );

		$element->end_popover();

		/** css scale toggle */
		$element->add_control( 'flx_transform_fx_scale_toggle', [
			'label'        => __( 'Scale', 'flexiaddons' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'return_value' => 'yes',
			'condition'    => [
				'flx_transform_fx' => 'yes',
			],
		] );

		$element->start_popover();

		/** css scale X */
		$element->add_responsive_control( 'flx_transform_fx_scale_x', [
			'label'      => __( 'Scale X', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'default'    => [
				'size' => 1,
			],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 5,
					'step' => .1,
				],
			],
			'condition'  => [
				'flx_transform_fx_scale_toggle' => 'yes',
				'flx_transform_fx'              => 'yes',
			],
		] );

		/** css scale Y */
		$element->add_responsive_control( 'flx_transform_fx_scale_y', [
			'label'      => __( 'Scale Y', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'default'    => [
				'size' => 1,
			],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 5,
					'step' => .1,
				],
			],
			'condition'  => [
				'flx_transform_fx_scale_toggle' => 'yes',
				'flx_transform_fx'              => 'yes',
			],
			'selectors'  => [
				'(desktop){{WRAPPER}}' => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y.SIZE || 1}});'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y.SIZE || 1}});'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y.SIZE || 1}});',
				'(tablet){{WRAPPER}}'  => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_tablet.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_tablet.SIZE || 1}});'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_tablet.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_tablet.SIZE || 1}});'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_tablet.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_tablet.SIZE || 1}});',
				'(mobile){{WRAPPER}}'  => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_mobile.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_mobile.SIZE || 1}});'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_mobile.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_mobile.SIZE || 1}});'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_mobile.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_mobile.SIZE || 1}});',
			],
		] );

		$element->end_popover();

		/** css skew toggle  */
		$element->add_control( 'flx_transform_fx_skew_toggle', [
			'label'        => __( 'Skew', 'flexiaddons' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'return_value' => 'yes',
			'condition'    => [
				'flx_transform_fx' => 'yes',
			],
		] );

		$element->start_popover();

		/** css skew X */
		$element->add_responsive_control( 'flx_transform_fx_skew_x', [
			'label'      => __( 'Skew X', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'deg' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_skew_toggle' => 'yes',
				'flx_transform_fx'             => 'yes',
			],
		] );

		/** css kew Y */
		$element->add_responsive_control( 'flx_transform_fx_skew_y', [
			'label'      => __( 'Skew Y', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'deg' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_skew_toggle' => 'yes',
				'flx_transform_fx'             => 'yes',
			],
			'selectors'  => [
				'(desktop){{WRAPPER}}' => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y.SIZE || 1}}) '
				                          . 'skew({{flx_transform_fx_skew_x.SIZE || 0}}deg, {{flx_transform_fx_skew_y.SIZE || 0}}deg);'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y.SIZE || 1}}) '
				                          . 'skew({{flx_transform_fx_skew_x.SIZE || 0}}deg, {{flx_transform_fx_skew_y.SIZE || 0}}deg);'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x.SIZE || 0}}px, {{flx_transform_fx_translate_y.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y.SIZE || 1}}) '
				                          . 'skew({{flx_transform_fx_skew_x.SIZE || 0}}deg, {{flx_transform_fx_skew_y.SIZE || 0}}deg);',
				'(tablet){{WRAPPER}}'  => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_tablet.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_tablet.SIZE || 1}}) '
				                          . 'skew({{flx_transform_fx_skew_x_tablet.SIZE || 0}}deg, {{flx_transform_fx_skew_y_tablet.SIZE || 0}}deg);'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_tablet.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_tablet.SIZE || 1}}) '
				                          . 'skew({{flx_transform_fx_skew_x_tablet.SIZE || 0}}deg, {{flx_transform_fx_skew_y_tablet.SIZE || 0}}deg);'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_translate_y_tablet.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_tablet.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_tablet.SIZE || 1}}) '
				                          . 'skew({{flx_transform_fx_skew_x_tablet.SIZE || 0}}deg, {{flx_transform_fx_skew_y_tablet.SIZE || 0}}deg);',
				'(mobile){{WRAPPER}}'  => '-ms-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_mobile.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_mobile.SIZE || 1}}) '
				                          . 'skew({{flx_transform_fx_skew_x_mobile.SIZE || 0}}deg, {{flx_transform_fx_skew_y_mobile.SIZE || 0}}deg);'
				                          . '-webkit-transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_mobile.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_mobile.SIZE || 1}}) '
				                          . 'skew({{flx_transform_fx_skew_x_mobile.SIZE || 0}}deg, {{flx_transform_fx_skew_y_mobile.SIZE || 0}}deg);'
				                          . 'transform:'
				                          . 'translate({{flx_transform_fx_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_translate_y_mobile.SIZE || 0}}px) '
				                          . 'rotateX({{flx_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_rotate_z_mobile.SIZE || 0}}deg) '
				                          . 'scaleX({{flx_transform_fx_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_scale_y_mobile.SIZE || 1}}) '
				                          . 'skew({{flx_transform_fx_skew_x_mobile.SIZE || 0}}deg, {{flx_transform_fx_skew_y_mobile.SIZE || 0}}deg);',
			],
		] );

		$element->end_popover();

		$element->end_controls_tab();


		/** === start css effects hover tab === */
		$element->start_controls_tab( 'flx_transform_tab_hover', [
			'label'     => __( 'Hover', 'flexiaddons' ),
			'condition' => [
				'flx_transform_fx' => 'yes',
			],
		] );

		/** css translate toggle */
		$element->add_control( 'flx_transform_fx_hover_translate_toggle', [
			'label'        => __( 'Translate', 'flexiaddons' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'return_value' => 'yes',
			'condition'    => [
				'flx_transform_fx' => 'yes',
			],
		] );

		$element->start_popover();

		/** css translate X */
		$element->add_responsive_control( 'flx_transform_fx_hover_translate_x', [
			'label'      => __( 'Translate X', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 1000,
					'max' => 1000,
				],
			],
			'condition'  => [
				'flx_transform_fx_hover_translate_toggle' => 'yes',
				'flx_transform_fx'                        => 'yes',
			],
		] );

		/** css translate Y */
		$element->add_responsive_control( 'flx_transform_fx_hover_translate_y', [
			'label'      => __( 'Translate Y', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 1000,
					'max' => 1000,
				],
			],
			'condition'  => [
				'flx_transform_fx_hover_translate_toggle' => 'yes',
				'flx_transform_fx'                        => 'yes',
			],
			'selectors'  => [
				'(desktop){{WRAPPER}}:hover' => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px);'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px);'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px);',
				'(tablet){{WRAPPER}}:hover'  => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px);'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px);'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px);',
				'(mobile){{WRAPPER}}:hover'  => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px);'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px);'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px);',
			],
		] );

		$element->end_popover();

		/** css rotate toggle */
		$element->add_control( 'flx_transform_fx_hover_rotate_toggle', [
			'label'     => __( 'Rotate', 'flexiaddons' ),
			'type'      => Controls_Manager::POPOVER_TOGGLE,
			'condition' => [
				'flx_transform_fx' => 'yes',
			],
		] );

		$element->start_popover();

		/** css rotate X */
		$element->add_responsive_control( 'flx_transform_fx_hover_rotate_x', [
			'label'      => __( 'Rotate X', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_hover_rotate_toggle' => 'yes',
				'flx_transform_fx'                     => 'yes',
			],
		] );

		/** css rotate Y */
		$element->add_responsive_control( 'flx_transform_fx_hover_rotate_y', [
			'label'      => __( 'Rotate Y', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_hover_rotate_toggle' => 'yes',
				'flx_transform_fx'                     => 'yes',
			],
		] );

		/** css rotate Z */
		$element->add_responsive_control( 'flx_transform_fx_hover_rotate_z', [
			'label'      => __( 'Rotate Z', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_hover_rotate_toggle' => 'yes',
				'flx_transform_fx'                     => 'yes',
			],
			'selectors'  => [
				'(desktop){{WRAPPER}}:hover' => 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z.SIZE || 0}}deg);',
				'(tablet){{WRAPPER}}:hover'  => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_tablet.SIZE || 0}}deg);'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_tablet.SIZE || 0}}deg);'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_tablet.SIZE || 0}}deg);',
				'(mobile){{WRAPPER}}:hover'  => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_mobile.SIZE || 0}}deg);'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_mobile.SIZE || 0}}deg);'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_mobile.SIZE || 0}}deg);',
			],
		] );

		$element->end_popover();

		/** css scale toggle */
		$element->add_control( 'flx_transform_fx_hover_scale_toggle', [
			'label'        => __( 'Scale', 'flexiaddons' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'return_value' => 'yes',
			'condition'    => [
				'flx_transform_fx' => 'yes',
			],
		] );

		$element->start_popover();

		/** css scale X */
		$element->add_responsive_control( 'flx_transform_fx_hover_scale_x', [
			'label'      => __( 'Scale X', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'default'    => [
				'size' => 1,
			],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 5,
					'step' => .1,
				],
			],
			'condition'  => [
				'flx_transform_fx_hover_scale_toggle' => 'yes',
				'flx_transform_fx'                    => 'yes',
			],
		] );

		/** css scale Y */
		$element->add_responsive_control( 'flx_transform_fx_hover_scale_y', [
			'label'      => __( 'Scale Y', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'default'    => [
				'size' => 1,
			],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 5,
					'step' => .1,
				],
			],
			'condition'  => [
				'flx_transform_fx_hover_scale_toggle' => 'yes',
				'flx_transform_fx'                    => 'yes',
			],
			'selectors'  => [
				'(desktop){{WRAPPER}}:hover' => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y.SIZE || 1}});'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y.SIZE || 1}});'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y.SIZE || 1}});',
				'(tablet){{WRAPPER}}:hover'  => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_tablet.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_tablet.SIZE || 1}});'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_tablet.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_tablet.SIZE || 1}});'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_tablet.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_tablet.SIZE || 1}});',
				'(mobile){{WRAPPER}}:hover'  => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_mobile.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_mobile.SIZE || 1}});'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_mobile.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_mobile.SIZE || 1}});'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_mobile.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_mobile.SIZE || 1}});',
			],
		] );

		$element->end_popover();

		/** css skew toggle  */
		$element->add_control( 'flx_transform_fx_hover_skew_toggle', [
			'label'        => __( 'Skew', 'flexiaddons' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'return_value' => 'yes',
			'condition'    => [
				'flx_transform_fx' => 'yes',
			],
		] );

		$element->start_popover();

		/** css skew X */
		$element->add_responsive_control( 'flx_transform_fx_hover_skew_x', [
			'label'      => __( 'Skew X', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'deg' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_hover_skew_toggle' => 'yes',
				'flx_transform_fx'                   => 'yes',
			],
		] );

		/** css kew Y */
		$element->add_responsive_control( 'flx_transform_fx_hover_skew_y', [
			'label'      => __( 'Skew Y', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'deg' ],
			'range'      => [
				'px' => [
					'min' => - 180,
					'max' => 180,
				],
			],
			'condition'  => [
				'flx_transform_fx_hover_skew_toggle' => 'yes',
				'flx_transform_fx'                   => 'yes',
			],
			'selectors'  => [
				'(desktop){{WRAPPER}}:hover' => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y.SIZE || 1}}) '
				                                . 'skew({{flx_transform_fx_hover_skew_x.SIZE || 0}}deg, {{flx_transform_fx_hover_skew_y.SIZE || 0}}deg);'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y.SIZE || 1}}) '
				                                . 'skew({{flx_transform_fx_hover_skew_x.SIZE || 0}}deg, {{flx_transform_fx_hover_skew_y.SIZE || 0}}deg);'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y.SIZE || 1}}) '
				                                . 'skew({{flx_transform_fx_hover_skew_x.SIZE || 0}}deg, {{flx_transform_fx_hover_skew_y.SIZE || 0}}deg);',
				'(tablet){{WRAPPER}}:hover'  => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_tablet.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_tablet.SIZE || 1}}) '
				                                . 'skew({{flx_transform_fx_hover_skew_x_tablet.SIZE || 0}}deg, {{flx_transform_fx_hover_skew_y_tablet.SIZE || 0}}deg);'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_tablet.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_tablet.SIZE || 1}}) '
				                                . 'skew({{flx_transform_fx_hover_skew_x_tablet.SIZE || 0}}deg, {{flx_transform_fx_hover_skew_y_tablet.SIZE || 0}}deg);'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_tablet.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_tablet.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_tablet.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_tablet.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_tablet.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_tablet.SIZE || 1}}) '
				                                . 'skew({{flx_transform_fx_hover_skew_x_tablet.SIZE || 0}}deg, {{flx_transform_fx_hover_skew_y_tablet.SIZE || 0}}deg);',
				'(mobile){{WRAPPER}}:hover'  => '-ms-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_mobile.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_mobile.SIZE || 1}}) '
				                                . 'skew({{flx_transform_fx_hover_skew_x_mobile.SIZE || 0}}deg, {{flx_transform_fx_hover_skew_y_mobile.SIZE || 0}}deg);'
				                                . '-webkit-transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_mobile.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_mobile.SIZE || 1}}) '
				                                . 'skew({{flx_transform_fx_hover_skew_x_mobile.SIZE || 0}}deg, {{flx_transform_fx_hover_skew_y_mobile.SIZE || 0}}deg);'
				                                . 'transform:'
				                                . 'translate({{flx_transform_fx_hover_translate_x_mobile.SIZE || 0}}px, {{flx_transform_fx_hover_translate_y_mobile.SIZE || 0}}px) '
				                                . 'rotateX({{flx_transform_fx_hover_rotate_x_mobile.SIZE || 0}}deg) rotateY({{flx_transform_fx_hover_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{flx_transform_fx_hover_rotate_z_mobile.SIZE || 0}}deg) '
				                                . 'scaleX({{flx_transform_fx_hover_scale_x_mobile.SIZE || 1}}) scaleY({{flx_transform_fx_hover_scale_y_mobile.SIZE || 1}}) '
				                                . 'skew({{flx_transform_fx_hover_skew_x_mobile.SIZE || 0}}deg, {{flx_transform_fx_hover_skew_y_mobile.SIZE || 0}}deg);',
			],
		] );

		$element->end_popover();


		$element->end_controls_tab();

		$element->end_controls_tabs();
	}

	private static function is_active() {

		return ! in_array( 'motion-effects', Flexi_Addons_Widgets_Manager::get_inactive_extensions() );
	}

}

FLX_Motion_Effects::instance();