<?php


use Elementor\Controls_Manager;
use Elementor\Frontend;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined('ABSPATH') || die();

class Flexi_Addons_Widget_Tabs extends Flexi_Addons_Widget_Base
{

	protected $key = 'tabs';

	protected function _register_controls()
	{

		/**
		 * Tabs Settings
		 */
		$this->start_controls_section(
			'flx_section_tabs_settings',
			[
				'label' => esc_html__('General Settings', 'flexiaddons'),
			]
		);
		// Layout
		$this->add_control(
			'flx_tab_layout',
			[
				'label' => esc_html__('Layout', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'flx_tabs_horizontal',
				'label_block' => false,
				'options' => [
					'flx_tabs_horizontal' => esc_html__('Horizontal', 'flexiaddons'),
					'flx_tabs_vertical' => esc_html__('Vertical', 'flexiaddons'),
				],
			]
		);
		// Enable Icon
		$this->add_control(
			'flx_tabs_icon_show',
			[
				'label' => esc_html__('Enable Icon', 'flexiaddons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);
		// Icon Position
		$this->add_control(
			'flx_tab_icon_position',
			[
				'label' => esc_html__('Icon Position', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'flx_tab_inline_icon',
				'label_block' => false,
				'options' => [
					'flx_tab_top_icon' => esc_html__('Stacked', 'flexiaddons'),
					'flx_tab_inline_icon' => esc_html__('Inline', 'flexiaddons'),
				],
				'condition' => [
					'flx_tabs_icon_show' => 'yes',
				],
			]
		);
		$this->end_controls_section(); // End Controls Section

		/**
		 * Tabs Content Settings
		 */
		$this->start_controls_section(
			'flx_section_tabs_content_settings',
			[
				'label' => esc_html__('Content', 'flexiaddons'),
			]
		);
		// Repeater
		$this->add_control(
			'flx_tabs_tab',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					['flx_tabs_tab_title' => esc_html__('Your Title #', 'flexiaddons')],
					['flx_tabs_tab_title' => esc_html__('Your Title #', 'flexiaddons')],
					['flx_tabs_tab_title' => esc_html__('Your Title #', 'flexiaddons')],
				],
				'fields' => [
					[
						'name' => 'flx_tabs_tab_show_as_default',
						'label' => __('Set as Default', 'flexiaddons'),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'inactive',
						'return_value' => 'active-default',
					],
					[
						'name' => 'flx_tabs_icon_type',
						'label' => esc_html__('Icon Type', 'flexiaddons'),
						'type' => Controls_Manager::CHOOSE,
						'label_block' => false,
						'options' => [
							'none' => [
								'title' => esc_html__('None', 'flexiaddons'),
								'icon' => 'fa fa-ban',
							],
							'icon' => [
								'title' => esc_html__('Icon', 'flexiaddons'),
								'icon' => 'fa fa-gear',
							],
							'image' => [
								'title' => esc_html__('Image', 'flexiaddons'),
								'icon' => 'fa fa-picture-o',
							],
						],
						'default' => 'icon',
					],
					[
						'name' => 'flx_tabs_tab_title_icon',
						'label' => esc_html__('Icon', 'flexiaddons'),
						'type' => Controls_Manager::ICON,
						'default' => 'fa fa-home',
						'condition' => [
							'flx_tabs_icon_type' => 'icon',
						],
					],
					[
						'name' => 'flx_tabs_tab_title_image',
						'label' => esc_html__('Image', 'flexiaddons'),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'flx_tabs_icon_type' => 'image',
						],
					],
					[
						'name' => 'flx_tabs_tab_title',
						'label' => esc_html__('Tab Title', 'flexiaddons'),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__('Tab Title', 'flexiaddons'),
						'dynamic' => ['active' => true],
					],
					[
						'name' => 'flx_tabs_text_type',
						'label' => __('Content Type', 'flexiaddons'),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'content' => __('Content', 'flexiaddons'),
							'template' => __('Saved Templates', 'flexiaddons'),
						],
						'default' => 'content',
					],
					[
						'name' => 'flx_primary_templates',
						'label' => __('Choose Template', 'flexiaddons'),
						'type' => Controls_Manager::SELECT,
						'options' => get_elementor_page_templates(),
						'condition' => [
							'flx_tabs_text_type' => 'template',
						],
					],
					[
						'name' => 'flx_tabs_tab_content',
						'label' => esc_html__('Tab Content', 'flexiaddons'),
						'type' => Controls_Manager::WYSIWYG,
						'default' => esc_html__('consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'flexiaddons'),
						'dynamic' => ['active' => true],
						'condition' => [
							'flx_tabs_text_type' => 'content',
						],
					],
				],
				'title_field' => '{{flx_tabs_tab_title}}',
			]
		);
		$this->end_controls_section(); // End Controls Section

		/**
		 * -------------------------------------------
		 * Tab Style Tabs Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'flx_section_tabs_style_settings',
			[
				'label' => esc_html__('General', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Tabs Padding
		$this->add_responsive_control(
			'flx_tabs_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Tabs Margin
		$this->add_responsive_control(
			'flx_tabs_margin',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Tabs Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'flx_tabs_border',
				'label' => esc_html__('Border', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flx_tabs',
			]
		);
		// Tabs Border Radius
		$this->add_responsive_control(
			'flx_tabs_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Tabs Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'flx_tabs_box_shadow',
				'selector' => '{{WRAPPER}} .flx_tabs',
			]
		);
		$this->end_controls_section(); // End Controls Section

		/**
		 * -------------------------------------------
		 * Tab Styl Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'flx_section_tabs_tab_style_settings',
			[
				'label' => esc_html__('Tab Title', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Title Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'flx_tabs_tab_title_typography',
				'selector' => '{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li',
			]
		);
		// Title Width
		$this->add_responsive_control(
			'flx_tabs_title_width',
			[
				'label' => __('Title Min Width', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs.flx_tabs_vertical .flx_tabs_nav > ul' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'flx_tab_layout' => 'flx_tabs_vertical',
				],
			]
		);
		// Title Icon Size
		$this->add_responsive_control(
			'flx_tabs_tab_icon_size',
			[
				'label' => __('Icon Size', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 16,
					'unit' => 'px',
				],
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Title Icon Gap
		$this->add_responsive_control(
			'flx_tabs_tab_icon_gap',
			[
				'label' => __('Icon Gap', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flx_tab_inline_icon li i, {{WRAPPER}} .flx_tab_inline_icon li img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .flx_tab_top_icon li i, {{WRAPPER}} .flx_tab_top_icon li img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Title Padding
		$this->add_responsive_control(
			'flx_tabs_tab_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Title Margin
		$this->add_responsive_control(
			'flx_tabs_tab_margin',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('flx_tabs_header_tabs');
		// Normal State Tab
		$this->start_controls_tab(
			'flx_tabs_header_normal',
			[
				'label' => esc_html__('Normal', 'flexiaddons')
			]
		);
		// Tab Background Color
		$this->add_control(
			'flx_tabs_tab_color',
			[
				'label' => esc_html__('Tab Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#f1f1f1',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li' => 'background-color: {{VALUE}};',
				],
			]
		);
		// Text Color
		$this->add_control(
			'flx_tabs_tab_text_color',
			[
				'label' => esc_html__('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li' => 'color: {{VALUE}};',
				],
			]
		);
		// Icon Color
		$this->add_control(
			'flx_tabs_tab_icon_color',
			[
				'label' => esc_html__('Icon Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'flx_tabs_icon_show' => 'yes',
				],
			]
		);
		// Tabs Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'flx_tabs_tab_border',
				'label' => esc_html__('Border', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li',
			]
		);
		// Border Radius
		$this->add_responsive_control(
			'flx_tabs_tab_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab(); // End Controls Tab
		// Hover State Tab
		$this->start_controls_tab(
			'flx_tabs_header_hover',
			[
				'label' => esc_html__('Hover', 'flexiaddons')
			]
		);
		// Hover Background Color
		$this->add_control(
			'flx_tabs_tab_color_hover',
			[
				'label' => esc_html__('Tab Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#f1f1f1',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		// Hover Text Color
		$this->add_control(
			'flx_tabs_tab_text_color_hover',
			[
				'label' => esc_html__('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li:hover' => 'color: {{VALUE}};',
				],
			]
		);
		// Hover Icon Color
		$this->add_control(
			'flx_tabs_tab_icon_color_hover',
			[
				'label' => esc_html__('Icon Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li:hover .fa' => 'color: {{VALUE}};',
				],
				'condition' => [
					'flx_tabs_icon_show' => 'yes',
				],
			]
		);
		// Hover Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'flx_tabs_tab_border_hover',
				'label' => esc_html__('Border', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li:hover',
			]
		);
		// Hover Border Radius
		$this->add_responsive_control(
			'flx_tabs_tab_border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab(); // End Control tab
		// Active State Tab
		$this->start_controls_tab(
			'flx_tabs_header_active',
			[
				'label' => esc_html__('Active', 'flexiaddons')
			]
		);
		// Active Tab Background Color
		$this->add_control(
			'flx_tabs_tab_color_active',
			[
				'label' => esc_html__('Tab Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#212121',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active-default' => 'background-color: {{VALUE}};',
				],
			]
		);
		// Active Text Color
		$this->add_control(
			'flx_tabs_tab_text_color_active',
			[
				'label' => esc_html__('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active-deafult' => 'color: {{VALUE}};',
				],
			]
		);
		// Active Icon Color
		$this->add_control(
			'flx_tabs_tab_icon_color_active',
			[
				'label' => esc_html__('Icon Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active .fa' => 'color: {{VALUE}};',
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active-default .fa' => 'color: {{VALUE}};',
				],
				'condition' => [
					'flx_tabs_icon_show' => 'yes',
				],
			]
		);
		// Active Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'flx_tabs_tab_border_active',
				'label' => esc_html__('Border', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active, {{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active-default',
			]
		);
		// Active Border Radius
		$this->add_responsive_control(
			'flx_tabs_tab_border_radius_active',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li.active-default' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'flx_section_tabs_tab_content_style_settings',
			[
				'label' => esc_html__('Content', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Content Background Color
		$this->add_control(
			'flx_tabs_content_bg_color',
			[
				'label' => esc_html__('Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_content > div' => 'background-color: {{VALUE}};',
				],
			]
		);
		// Content Text Color
		$this->add_control(
			'flx_tabs_content_text_color',
			[
				'label' => esc_html__('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_content > div' => 'color: {{VALUE}};',
				],
			]
		);
		// Content Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'flx_tabs_content_typography',
				'selector' => '{{WRAPPER}} .flx_tabs .flx_tabs_content > div',
			]
		);
		// Content Padding
		$this->add_responsive_control(
			'flx_tabs_content_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Content Margin
		$this->add_responsive_control(
			'flx_tabs_content_margin',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_content > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Content Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'flx_tabs_content_border',
				'label' => esc_html__('Border', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flx_tabs .flx_tabs_content > div',
			]
		);

		//Content Border Radius
		$this->add_control( 'flx_tabs_content_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .flx_tabs .flx_tabs_content > div' => 'border-radius: {{SIZE}}{{UNIT}}',
			],
		] );

		// Content Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'flx_tabs_content_shadow',
				'selector' => '{{WRAPPER}} .flx_tabs .flx_tabs_content > div',
				'separator' => 'before',
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Tabs Caret Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'flx_section_tabs_tab_caret_style_settings',
			[
				'label' => esc_html__('Caret', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Show Caret on Active Tab
		$this->add_control(
			'flx_tabs_tab_caret_show',
			[
				'label' => esc_html__('Show Caret on Active Tab', 'flexiaddons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);
		// Caret Size
		$this->add_control(
			'flx_tabs_tab_caret_size',
			[
				'label' => esc_html__('Caret Size', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li:after' => 'border-width: {{SIZE}}px; bottom: -{{SIZE}}px',
					'{{WRAPPER}} .flx_tabs.flx_tabs_vertical .flx_tabs_nav > ul li:after' => 'right: -{{SIZE}}px; top: calc(50% - {{SIZE}}px) !important;',
				],
				'condition' => [
					'flx_tabs_tab_caret_show' => 'yes',
				],
			]
		);
		// Caret Color
		$this->add_control(
			'flx_tabs_tab_caret_color',
			[
				'label' => esc_html__('Caret Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#212121',
				'selectors' => [
					'{{WRAPPER}} .flx_tabs .flx_tabs_nav > ul li:after' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .flx_tabs.flx_tabs_vertical .flx_tabs_nav > ul li:after' => 'border-top-color: transparent; border-left-color: {{VALUE}};',
				],
				'condition' => [
					'flx_tabs_tab_caret_show' => 'yes',
				],
			]
		);
		$this->end_controls_section();
	}

	

	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$flx_find_default_tab = array();
		$flx_adv_tab_id = 1;
		$flx_tab_content_id = 1;

		$this->add_render_attribute(
			'flx_tab_wrapper',
			[
				'id' => "flx_tabs-{$this->get_id()}",
				'class' => ['flx_tabs', $settings['flx_tab_layout']],
				'data-tabid' => $this->get_id(),
			]
		);
		if ($settings['flx_tabs_tab_caret_show'] != 'yes') {
			$this->add_render_attribute('flx_tab_wrapper', 'class', 'active-caret-on');
		}

		$this->add_render_attribute('flx_tab_icon_position', 'class', esc_attr($settings['flx_tab_icon_position']));
?>
		<div <?php echo $this->get_render_attribute_string('flx_tab_wrapper'); ?>>
			<div class="flx_tabs_nav">
				<ul <?php echo $this->get_render_attribute_string('flx_tab_icon_position'); ?>>
					<?php foreach ($settings['flx_tabs_tab'] as $tab) : ?>
						<li class="<?php echo esc_attr($tab['flx_tabs_tab_show_as_default']); ?>">
							<?php if ($settings['flx_tabs_icon_show'] === 'yes') :
								if ($tab['flx_tabs_icon_type'] === 'icon') :
							?>
									<i class="<?php echo esc_attr($tab['flx_tabs_tab_title_icon']); ?>"></i>
								<?php elseif ($tab['flx_tabs_icon_type'] === 'image') : ?>
									<img src="<?php echo esc_attr($tab['flx_tabs_tab_title_image']['url']); ?>" alt="<?php echo esc_attr(get_post_meta($tab['flx_tabs_tab_title_image']['id'], '_wp_attachment_image_alt', true)); ?>">
								<?php endif; ?>
							<?php endif; ?> <span class="flx_tab_title"><?php echo $tab['flx_tabs_tab_title']; ?></span></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="flx_tabs_content">
				<?php foreach ($settings['flx_tabs_tab'] as $tab) : $flx_find_default_tab[] = $tab['flx_tabs_tab_show_as_default']; ?>
					<div class="clearfix <?php echo esc_attr($tab['flx_tabs_tab_show_as_default']); ?>">
						<?php if ('content' == $tab['flx_tabs_text_type']) : ?>
							<?php echo do_shortcode($tab['flx_tabs_tab_content']); ?>
						<?php elseif ('template' == $tab['flx_tabs_text_type']) : ?>
							<?php
							if (!empty($tab['flx_primary_templates'])) {
								$flx_template_id = $tab['flx_primary_templates'];
								$flx_frontend = new Frontend;
								echo $flx_frontend->get_builder_content($flx_template_id, true);
							}
							?>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
<?php
	}
}
