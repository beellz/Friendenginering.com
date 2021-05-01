<?php

use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Flexi_Addons_Widget_Testimonial extends Flexi_Addons_Widget_Base {

	protected $key = 'testimonial';

	public function _register_controls() {

		/*=== Section Layout ===*/
		$this->start_controls_section(
			'_section_layout',
			[
				'label' => __( 'Layout', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => __( 'Layout', 'flexiaddons' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => [
					'style1' => __( 'Style 1', 'flexiaddons' ),
					'style2' => __( 'Style 2', 'flexiaddons' ),
					'style3' => __( 'Style 3', 'flexiaddons' ),
					'style4' => __( 'Style 4', 'flexiaddons' ),
					'style5' => __( 'Style 5', 'flexiaddons' ),
					'style6' => __( 'Style 6', 'flexiaddons' ),
					'style7' => __( 'Style 7', 'flexiaddons' ),
				],
				'default'     => 'style1',
			]
		);

		$this->end_controls_section();

		/**
		 *  ------------------------
		 * | Section Testimonial |
		 * -------------------------
		 */
		$this->start_controls_section(
			'_section_testimonial',
			[
				'label' => __( 'Testimonial', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'flexiaddons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Awesome Name', 'flexiaddons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'flexiaddons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Designation', 'flexiaddons' ),
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'       => __( 'Content', 'flexiaddons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => __(
					'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.',
					'flexiaddons'
				),
			]
		);

		$repeater->add_control(
			'rating',
			[
				'label'       => __( 'Rating', 'flexiaddons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					]
				],
				'default'     => [
					'unit' => 'px',
					'size' => 5,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'       => esc_html__( 'Image', 'flexiaddons' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'testimonial',
			[
				'label'   => __( 'Testimonial', 'flexiaddons' ),
				'type'    => Controls_Manager::REPEATER,
				'default' => [
					[
						'name'  => __( 'John Doe', 'flexiaddons' ),
						'title' => __( 'CEO', 'flexiaddons' ),
					],
					[
						'name'  => __( 'Tom Edison', 'flexiaddons' ),
						'title' => __( 'Project Manager', 'flexiaddons' ),
					],
					[
						'name'  => __( 'Delly Moon', 'flexiaddons' ),
						'title' => __( 'CEO & Founder', 'flexiaddons' ),
					],
				],

				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

		/**
		 *  -------------------
		 * | Section Settings |
		 * -------------------
		 */
		$this->start_controls_section(
			'_section_settings',
			[
				'label' => __( 'Settings', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB
			]
		);

		//Animation
		$this->add_responsive_control(
			'item_animation',
			[
				'label'       => __( 'Animation', 'flexiaddons' ),
				'type'        => Controls_Manager::ANIMATION,
				'render_type' => 'template',
				'condition'   => [
					'layout' => 'style7',
				]
			]
		);

		//Animation Duration
		$this->add_control(
			'item_animation_duration',
			[
				'label'     => __( 'Animation Duration', 'flexiaddons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					'slow' => __( 'Slow', 'flexiaddons' ),
					''     => __( 'Normal', 'flexiaddons' ),
					'fast' => __( 'Fast', 'flexiaddons' ),
				],
				'condition' => [
					'item_animation!' => '',
					'layout'          => 'style7',
				]
			]
		);

		//Animation Delay
		$this->add_control(
			'item_animation_delay',
			[
				'label'     => __( 'Animation Delay', 'flexiaddons' ) . ' (ms)',
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 0,
				'step'      => 100,
				'condition' => [
					'item_animation!' => '',
					'layout'          => 'style7',
				],
			]
		);

		//Rating Heading
		$this->add_control(
			'_rating_heading',
			[
				'label' => __( 'Rating', 'flexiaddons' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		//Enable rating
		$this->add_control(
			'rating_enable',
			[
				'label'     => __( 'Enable Rating', 'flexiaddons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'flexiaddons' ),
				'label_off' => __( 'No', 'flexiaddons' ),
				'default'   => 'no',
				'separator' => 'after',
			]
		);

		//Quote Heading
		$this->add_control(
			'_quote_heading',
			[
				'label' => __( 'Quote', 'flexiaddons' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		//Enable Quote icon
		$this->add_control(
			'quote_enable',
			[
				'label'     => __( 'Enable Quote Icon', 'flexiaddons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'flexiaddons' ),
				'label_off' => __( 'No', 'flexiaddons' ),
				'default'   => 'no',
			]
		);

		//Left Arrow
		$this->add_control(
			'quote_icon_new',
			[
				'label'            => esc_html__( 'Quote Icon', 'flexiaddons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'quote_icon',
				'default'          => [
					'value'   => 'fa fa-quote-right',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'quote_enable' => 'yes',
				]
			]
		);

		// Quote position
		$this->add_control(
			'quote_position',
			[
				'label'     => esc_html__( 'Customize Quote Position', 'flexiaddons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'flexiaddons' ),
				'label_off' => __( 'No', 'flexiaddons' ),
				'default'   => 'no',
				'condition' => [
					'quote_enable' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'quote_position_x',
			[
				'label'      => __( 'Left', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-quote' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'quote_enable'   => 'yes',
					'quote_position' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'quote_position_y',
			[
				'label'      => __( 'Top', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-quote' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'quote_enable'   => 'yes',
					'quote_position' => 'yes',
				]
			]
		);

		//Slide to show
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'     => __( 'Slides To Show', 'flexiaddons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'default'   => 1,
				'separator' => 'before',
				'condition' => [
					'layout!' => 'style7',
				]
			]
		);

		//Slide to scroll
		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'     => __( 'Slides To Scroll', 'flexiaddons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'default'   => 1,
				'condition' => [
					'layout!' => 'style7',
				]
			]
		);

		//Speed
		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'flexiaddons' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 50000,
				'step'    => 1,
				'default' => 3000,
			]
		);

		//Autoplay
		$this->add_control(
			'autoplay',
			[
				'label'     => __( 'Autoplay', 'flexiaddons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'flexiaddons' ),
				'label_off' => __( 'No', 'flexiaddons' ),
				'default'   => 'yes',
			]
		);

		//Show Arrow
		$this->add_control(
			'show_arrows',
			[
				'label'     => __( 'Show arrow', 'flexiaddons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'flexiaddons' ),
				'label_off' => __( 'No', 'flexiaddons' ),
				'default'   => '',
			]
		);

		//Show Dots
		$this->add_control(
			'show_dots',
			[
				'label'     => __( 'Show dots', 'flexiaddons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'flexiaddons' ),
				'label_off' => __( 'No', 'flexiaddons' ),
				'default'   => 'yes',
			]
		);

		//Left Arrow
		$this->add_control(
			'prev_arrow_new',
			[
				'label'            => esc_html__( 'Left arrow Icon', 'flexiaddons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'prev_arrow',
				'default'          => [
					'value'   => 'fa fa-arrow-left',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'show_arrows' => 'yes',
				]
			]
		);

		//Right Arrow
		$this->add_control(
			'next_arrow_new',
			[
				'label'            => esc_html__( 'Right arrow Icon', 'flexiaddons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'next_arrow',
				'default'          => [
					'value'   => 'fa fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'show_arrows' => 'yes',
				]
			]
		);

		//Pause on Hover
		$this->add_control(
			'pause_on_hover',
			[
				'label'     => __( 'Pause on Hover', 'flexiaddons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'flexiaddons' ),
				'label_off' => __( 'No', 'flexiaddons' ),
				'default'   => 'yes',
			]
		);

		$this->end_controls_section();

		/*=== Style Controls ===*/
		$this->register_style_controls();

	}

	public function register_style_controls() {

		/**
		 *  ------------------------
		 * | Section Style Layout |
		 * -------------------------
		 */
		$this->start_controls_section(
			'_section_style_layout',
			[
				'label' => __( 'Layout', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		//Layout Spacing
		$this->add_control(
			'_layout_spacing_heading',
			[
				'label'     => __( 'Spacing', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		//column gap
		$this->add_responsive_control(
			'column_gap',
			[
				'label'      => esc_html__( 'Column Gap', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-item' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Padding
		$this->add_responsive_control(
			'layout_padding',
			[
				'label'      => esc_html__( 'Padding', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Border Heading
		$this->add_control(
			'_layout_border_heading',
			[
				'label'     => __( 'Border', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		//Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'layout_border',
				'label'    => __( 'Border', 'flexiaddons' ),
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-item',
			]
		);

		//Border radius
		$this->add_responsive_control(
			'layout_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'layout_shadow',
				'selector'  => '{{WRAPPER}} .flexiaddons-testimonial-item',
				'separator' => 'before'
			]
		);

		//Layout Height
		$this->add_control(
			'_layout_height_heading',
			[
				'label'     => __( 'Height', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'use_fixed_height',
			[
				'label'     => __( 'Use Fixed Height', 'flexiaddons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'flexiaddons' ),
				'label_off' => __( 'No', 'flexiaddons' ),
				'default'   => 'no',
			]
		);

		$this->add_responsive_control(
			'layout_height',
			[
				'label'      => esc_html__( 'Height', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 30,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 10,
						'max' => 1000,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 500,
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-item' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'use_fixed_height' => 'yes' ]
			]
		);

		// Background
		$this->add_control(
			'_layout_bg_heading',
			[
				'label'     => __( 'Background', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'layout_bg',
				'label'    => __( 'Background', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-item',
			]
		);

		$this->end_controls_section();

		/**
		 *  ------------------------
		 * | Section Style Image |
		 * -------------------------
		 */
		$this->start_controls_section(
			'_section_style_Image',
			[
				'label' => __( 'Image', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		//Image Width
		$this->add_responsive_control(
			'image_width',
			[
				'label'      => esc_html__( 'Image Width', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500
					]

				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-image>img' => 'width: {{SIZE}}{{UNIT}};',
				]

			]
		);

		//Image Height
		$this->add_responsive_control(
			'image_height',
			[
				'label'      => esc_html__( 'Image Height', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500
					]

				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-image>img' => 'height: {{SIZE}}{{UNIT}};',
				]

			]
		);

		//Image Position
		$this->add_control(
			'image_position_toggle',
			[
				'label'        => __( 'Position', 'flexiaddons' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'image_position_x',
			[
				'label'      => esc_html__( 'Horizontal Position', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500
					]

				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-image' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'image_position_toggle' => 'yes'
				]

			]
		);

		$this->add_responsive_control(
			'image_position_y',
			[
				'label'      => esc_html__( 'Vertical Position', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-image' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'image_position_toggle' => 'yes'
				]

			]
		);

		$this->end_popover();

		//Image Background
		$this->add_control(
			'_image_bg_heading',
			[
				'label' => __( 'Background', 'flexiaddons' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'image_bg',
				'label'    => __( 'Background', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-image',
			]
		);

		//Image Border Heading
		$this->add_control(
			'image_border_heading',
			[
				'label'     => __( 'Border', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		//Image Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'label'    => __( 'Border', 'flexiaddons' ),
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-image img',
			]
		);

		//Image Border radius
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'after'
			]
		);

		//Name Spacing
		$this->add_responsive_control(
			'image_padding',
			[
				'label'      => esc_html__( 'Padding', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Image Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-image>img',
			]
		);

		$this->end_controls_section();

		/**
		 *  ------------------------
		 * | Section Style Content |
		 * -------------------------
		 */
		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => __( 'Content', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		//=== Name Style ===
		$this->add_control(
			'_content_bg_heading',
			[
				'label' => __( 'Background', 'flexiaddons' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		//Content Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'content_background',
				'label'    => esc_html__( 'Background', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-content',
			]
		);

		//=== Top Border ===
		$this->add_control(
			'top_bar',
			[
				'label'     => __( 'Show Top Bar', 'flexiaddons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'flexiaddons' ),
				'label_off' => __( 'No', 'flexiaddons' ),
				'default'   => 'yes',
				'condition' => [
					'layout' => 'style4',
				],
				'separator' => 'before'
			]
		);

		//Top Bar Height
		$this->add_responsive_control(
			'top_bar_height',
			[
				'label'      => esc_html__( 'Height', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-content:before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'top_bar' => 'yes',
					'layout'  => 'style4'
				]
			]
		);

		//Top Bar Rotate
		$this->add_responsive_control(
			'top_bar_rotate',
			[
				'label'      => esc_html__( 'Rotate', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 180,
						'max' => 180,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-content:before' => ' transform: rotate({{SIZE}}deg);',
				],
				'condition'  => [
					'top_bar' => 'yes',
					'layout'  => 'style4'
				]
			]
		);

		//Top Bar Position
		$this->add_responsive_control(
			'top_bar_position',
			[
				'label'      => esc_html__( 'Vertical Position', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-content:before' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'top_bar' => 'yes',
					'layout'  => 'style4'
				]
			]
		);

		//Top Bar Position
		$this->add_responsive_control(
			'top_bar_position_y',
			[
				'label'      => esc_html__( 'Horizontal Position', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-content:before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'top_bar' => 'yes',
					'layout'  => 'style4'
				]
			]
		);

		//Top bar Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'top_bar_bg',
				'label'     => esc_html__( 'Background', 'flexiaddons' ),
				'types'     => [ 'gradient' ],
				'selector'  => '{{WRAPPER}} .flexiaddons-testimonial-content:before',
				'condition' => [
					'top_bar' => 'yes',
					'layout'  => 'style4'
				],
				'separator' => 'after'
			]
		);

		//Content Wrapper Border
		$this->add_control(
			'_content_heading',
			[
				'label'     => __( 'Border', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'content_wrapper_border',
				'label'    => __( 'Wrapper Border', 'flexiaddons' ),
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-content',
			]
		);

		//=== Name Style ===
		$this->add_control(
			'_name_heading',
			[
				'label'     => __( 'Name', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		//Name Color
		$this->add_responsive_control(
			'name_color',
			[
				'label'     => esc_html__( 'Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flexiaddons-testimonial-name' => 'color: {{VALUE}}',
				]
			]
		);

		//Name Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'    => esc_html__( 'Typography', 'flexiaddons' ),
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-name',
			]
		);

		//Name Spacing
		$this->add_responsive_control(
			'name_spacing',
			[
				'label'      => esc_html__( 'Spacing', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Title Style
		$this->add_control(
			'_title_heading',
			[
				'label'     => __( 'Title', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		//Title Color
		$this->add_responsive_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flexiaddons-testimonial-slider .flexiaddons-testimonial-item .flexiaddons-testimonial-content .flexiaddons-testimonial-title' => 'color: {{VALUE}}',
				]
			]
		);

		//Title Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'flexiaddons' ),
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-slider .flexiaddons-testimonial-item .flexiaddons-testimonial-content .flexiaddons-testimonial-title',
			]
		);

		//Title Spacing
		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => esc_html__( 'Spacing', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Description Style
		$this->add_control(
			'_description_heading',
			[
				'label'     => __( 'Description', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		//Description Color
		$this->add_responsive_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flexiaddons-testimonial-description' => 'color: {{VALUE}}',
				]
			]
		);

		//Description Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'description_background',
				'label'    => esc_html__( 'Background', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-description',

			]
		);

		//Description Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Typography', 'flexiaddons' ),
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-description',
			]
		);

		//Description Spacing
		$this->add_responsive_control(
			'description_spacing',
			[
				'label'      => esc_html__( 'Spacing', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		//Alignment
		$this->add_responsive_control(
			'content_alignment',
			[
				'label'     => __( 'Alignment', 'flexiaddons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'flexiaddons' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'flexiaddons' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'flexiaddons' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexiaddons-testimonial-content' => 'text-align: {{VALUE}};',
				],
				'default'   => 'center',
				'separator' => 'before',
			]
		);

		//Content Padding
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Padding', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 *  ------------------------
		 * | Section Style Quote  |
		 * -------------------------
		 */

		$this->start_controls_section(
			'_section_quote_style',
			[
				'label'     => esc_html__( 'Quote icon', 'flexiaddons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'quote_enable' => 'yes',
				]
			]
		);

		//Quote color tabs
		$this->start_controls_tabs( '_quote_color_tabs' );

		$this->start_controls_tab(
			'_quote_color_tab',
			[
				'label' => esc_html__( 'Normal', 'flexiaddons' ),
			]
		);

		//Quote Normal Color
		$this->add_responsive_control(
			'quote_color',
			[
				'label'     => esc_html__( 'Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flexiaddons-testimonial-quote > i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_quote_hover_color_tab',
			[
				'label' => esc_html__( 'Hover', 'flexiaddons' ),
			]
		);

		$this->add_responsive_control(
			'quote_hover_color',
			[
				'label'     => esc_html__( 'Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flexiaddons-testimonial-item:hover .flexiaddons-testimonial-quote > i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'quote_color_divider',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		//Quote Icon Font Size
		$this->add_responsive_control(
			'quote_size',
			[
				'label'      => esc_html__( 'Font Size', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 48,
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-quote > i' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);

		//Quote Padding
		$this->add_responsive_control(
			'quote_padding',
			[
				'label'      => esc_html__( 'Padding', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-quote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Quote Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'quote_background',
				'label'    => esc_html__( 'Background', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .flexiaddons-testimonial-quote',

			]
		);

		$this->add_responsive_control(
			'quote_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-quote > i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();


		/**
		 *  ------------------------
		 * | Section Style Rating  |
		 * -------------------------
		 */

		$this->start_controls_section(
			'_section_rating_style',
			[
				'label'     => esc_html__( 'Rating', 'flexiaddons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'rating_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'rating_color',
			[
				'label'     => __( 'Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fec42d',
				'selectors' => [
					'{{WRAPPER}} .flexiaddons-testimonial-rating i' => 'color: {{VALUE}};'
				],
			]
		);

		//rating font size
		$this->add_responsive_control(
			'rating_font_size',
			[
				'label'      => __( 'Font Size', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//rating right space
		$this->add_responsive_control(
			'rating_right_spacing',
			[
				'label'      => __( 'Star right space', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-rating i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//rating spacing
		$this->add_responsive_control(
			'rating_spacing',
			[
				'label'      => esc_html__( 'Rating Margin', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .flexiaddons-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		/**
		 *  ------------------------
		 * | Section Style Dots  |
		 * -------------------------
		 */
		$this->start_controls_section(
			'_section_style_dots',
			[
				'label'     => __( 'Dots', 'flexiaddons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_dots' => 'yes'
				]
			]
		);

		//dot spacing
		$this->add_responsive_control(
			'dot_spacing_wrapper',
			[
				'label'      => esc_html__( 'Spacing', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .slick-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'dots_tabs' );

		//Normal Tab
		$this->start_controls_tab(
			'dot_normal',
			[
				'label' => __( 'Normal', 'flexiaddons' )
			]
		);

		//dot width
		$this->add_responsive_control(
			'dot_width',
			[
				'label'      => esc_html__( 'Width', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_height',
			[
				'label'      => esc_html__( 'Height', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_border_radius',
			[
				'label'      => esc_html__( 'Border radius', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}}  .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_spacing',
			[
				'label'      => esc_html__( 'Margin right', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-dots li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'dot_background',
				'label'    => esc_html__( 'Background', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slick-dots li button',
			]
		);

		$this->end_controls_tab();

		//Active Tab
		$this->start_controls_tab(
			'dot_active',
			[
				'label' => __( 'Active', 'flexiaddons' )
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'dots_active_bg',
				'label'    => esc_html__( 'Background', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slick-dots li.slick-active button',
			]
		);

		$this->add_responsive_control(
			'dots_active_width',
			[
				'label'      => esc_html__( 'Width', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_active_height',
			[
				'label'      => esc_html__( 'Height', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_active_scale',
			[
				'label'      => esc_html__( 'Scale', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => .5,
						'max'  => 3,
						'step' => 0.1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1.2,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-dots li.slick-active button' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 *  ------------------------
		 * | Section Style Arrow  |
		 * -------------------------
		 */
		$this->start_controls_section(
			'_section_style_nav',
			[
				'label'     => __( 'Navs', 'flexiaddons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_arrows' => 'yes'
				]
			]
		);

		//Nav Sizing
		$this->add_responsive_control(
			'nav_sizing',
			[
				'label'      => esc_html__( 'Sizing', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default'    => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
				],

			]
		);

		//Padding
		$this->add_responsive_control(
			'arrow_padding',
			[
				'label'      => esc_html__( 'Padding', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Prev Arrow Position
		$this->add_control(
			'prev_position_toggle',
			[
				'label'        => __( 'Next Position', 'flexiaddons' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'prev_position_x',
			[
				'label'      => esc_html__( 'Horizontal Position', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500
					]

				],
				'selectors'  => [
					'{{WRAPPER}} .slick-arrow.slick-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'prev_position_toggle' => 'yes'
				]

			]
		);

		$this->add_responsive_control(
			'prev_position_y',
			[
				'label'      => esc_html__( 'Vertical Position', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500
					]

				],
				'selectors'  => [
					'{{WRAPPER}} .slick-arrow.slick-prev' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'prev_position_toggle' => 'yes'
				]

			]
		);

		$this->end_popover();

		//Next Arrow Position
		$this->add_control(
			'next_position_toggle',
			[
				'label'        => __( 'Next Position', 'flexiaddons' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'next_position_x',
			[
				'label'      => esc_html__( 'Horizontal Position', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500
					]

				],
				'selectors'  => [
					'{{WRAPPER}} .slick-arrow.slick-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'next_position_toggle' => 'yes'
				]

			]
		);

		$this->add_responsive_control(
			'next_position_y',
			[
				'label'      => esc_html__( 'Vertical Position', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500
					]

				],
				'selectors'  => [
					'{{WRAPPER}} .slick-arrow.slick-next' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'next_position_toggle' => 'yes'
				]

			]
		);

		$this->end_popover();

		//Arrow Color Tabs
		$this->start_controls_tabs( 'arrow_color_tabs' );

		//Normal Tab
		$this->start_controls_tab(
			'arrow_color_normal',
			[
				'label' => __( 'Normal', 'flexiaddons' )
			]
		);

		$this->add_responsive_control(
			'arrow_color',
			[
				'label'     => esc_html__( 'Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-arrow' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'arrow_bg',
				'label'    => __( 'Background', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slick-arrow',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'arrow_shadow',
				'selector' => '{{WRAPPER}} .slick-arrow',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border',
				'label'    => __( 'Border', 'flexiaddons' ),
				'selector' => '{{WRAPPER}} .slick-arrow',
			]
		);

		$this->end_controls_tab();

		//Hover Tab
		$this->start_controls_tab(
			'arrow_color_hover_tab',
			[
				'label' => __( 'Hover', 'flexiaddons' )
			]
		);

		$this->add_responsive_control(
			'arrow_color_hover',
			[
				'label'     => esc_html__( 'Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:hover' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'arrow_bg_hover',
				'label'    => __( 'Background', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slick-arrow:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'arrow_shadow_hover',
				'selector' => '{{WRAPPER}} .slick-arrow:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border_hover',
				'label'    => __( 'Border', 'flexiaddons' ),
				'selector' => '{{WRAPPER}} .slick-arrow:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->get_settings_for_display();

		extract( $settings );

		$this->add_render_attribute(
			'slider',
			[
				'class' => sprintf(
					'flexiaddons-testimonial-slider %s %s',
					$layout,
					'yes' == $top_bar ? 'has_top_bar' : ''
				),

				'data-slides_to_show'        => ! empty( $slides_to_show ) ? $slides_to_show : 1,
				'data-slides_to_show_mobile' => ! empty( $slides_to_show_mobile ) ? $slides_to_show_mobile : 1,
				'data-slides_to_show_tablet' => ! empty( $slides_to_show_tablet ) ? $slides_to_show_tablet : 1,

				'data-slides_to_scroll'        => ! empty( $slides_to_scroll ) ? $slides_to_scroll : 1,
				'data-slides_to_scroll_mobile' => ! empty( $slides_to_scroll_mobile ) ? $slides_to_scroll_mobile : 1,
				'data-slides_to_scroll_tablet' => ! empty( $slides_to_scroll_tablet ) ? $slides_to_scroll_tablet : 1,

				'data-speed'     => $speed,
				'data-autoplay'  => $autoplay,
				'data-show_dots' => $show_dots,

				'data-show_arrows' => $show_arrows,
				'data-prev_arrow'  => flexi_get_icon( $settings, 'prev_arrow', 'class' ),
				'data-next_arrow'  => flexi_get_icon( $settings, 'next_arrow', 'class' ),

				'data-rtl' => is_rtl() ? 'true' : '',

				'data-anim' => esc_attr( $settings['item_animation'] ),


			]
		);

		$this->add_render_attribute(
			'item',
			[
				'class'      => 'flexiaddons-testimonial-item',
				'data-delay' => $settings['item_animation_delay']
			]
		);

		?>
        <div <?php echo $this->get_render_attribute_string( 'slider' ); ?>>
			<?php

			if ( in_array( $layout, [ 'style7' ] ) ) {

				$testimonials = array_chunk( $testimonial, 3 );
				foreach ( $testimonials as $t ) { ?>
                    <div class="slider-item-wrapa">
                        <div class="slider-item-wrap">
                            <div class="slider-item">
								<?php
								$delay = $settings['item_animation_delay'];
								foreach ( $t as $item ) {


									if ( $delay == 0 ) {
										$this->add_render_attribute(
											'item',
											[
												'class' => 'flexiaddons-testimonial-item animated ' . $settings['item_animation'],
											]
										);
									}

									?>
                                    <div class="flexiaddons-testimonial-item" data-delay="<?php echo $delay; ?>">
										<?php echo $this->get_testimonial( $item ); ?>
                                    </div>
									<?php
									$delay += $settings['item_animation_delay'];
								}
								?>
                            </div>
                        </div>
                    </div>
				<?php }
			} else {
				$delay = 0;

				foreach ( $testimonial as $item ) { ?>
                    <div <?php echo $this->get_render_attribute_string( 'item' ) ?> data-delay="<?php echo $delay; ?>">
						<?php echo $this->get_testimonial( $item ); ?>
                    </div>
				<?php }
			}

			?>

        </div>
		<?php

	}

	public function get_testimonial( $item ) {
		$settings = $this->get_settings();

		extract( $item );

		ob_start();
		?>


		<?php

		if ( $settings['quote_enable'] == 'yes' ) { ?>
            <div class="flexiaddons-testimonial-quote">
				<?php echo flexi_get_icon( $settings, 'quote_icon' ); ?>
            </div>
		<?php } ?>

		<?php if ( ! empty( $image['url'] ) ) {
			$this->add_render_attribute( 'image', 'src', $image['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $image ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $image ) );

			?>
            <div class="flexiaddons-testimonial-image">
				<?php
				echo Group_Control_Image_Size::get_attachment_image_html( $item, '', 'image' );
				?>
            </div>
		<?php } ?>

        <div class="flexiaddons-testimonial-content">
            <h4 class="flexiaddons-testimonial-name"><?php echo $name; ?></h4>

            <h6 class="flexiaddons-testimonial-title"><?php echo $title; ?></h6>

			<?php if ( $settings['rating_enable'] == 'yes' ) { ?>
                <div class="flexiaddons-testimonial-rating">
					<?php

					for ( $i = 1; $i <= 5; $i ++ ) {
						printf( '<i class="fa fa-star%s"></i>', $i > $rating['size'] ? '-o' : '' );
					}

					?>
                </div>
			<?php } ?>

            <div class="flexiaddons-testimonial-description">
				<?php echo $content; ?>
            </div>
        </div>


		<?php
		return ob_get_clean();
	}

}