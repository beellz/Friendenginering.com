<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined('ABSPATH') || die();

class Flexi_Addons_Widget_Pricing_Table extends Flexi_Addons_Widget_Base {

	protected $key = 'pricing-table';

	public function _register_controls() {

		/*=== Section Layout ===*/
		$this->start_controls_section('_section_layout', [
			'label' => __('Layout', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);

		//Layout
		$this->add_control('layout', [
			'label'       => __('Layout', 'flexiaddons'),
			'type'        => Controls_Manager::SELECT,
			'label_block' => true,
			'options'     => [
				'style1' => __('Style 01', 'flexiaddons'),
				'style2' => __('Style 02', 'flexiaddons'),
				'style3' => __('Style 03', 'flexiaddons'),
				'style4' => __('Style 04', 'flexiaddons'),
				'style5' => __( 'Style 05', 'flexiaddons' ),
				'style6' => __( 'Style 06', 'flexiaddons' ),
			],
			'default'     => 'style1',
		]);

		/**
		 * Condition: 'pricing_table_featured' => 'yes'
		 * 
		 * List Icon Enable Switch
		 */
		$this->add_control(
			'list_icon_enabel',
			[
				'label' => esc_html__('List Icon', 'flexiaddons'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'show',
				'default' => 'show',
			]
		);
		// Title
		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__('Basic Plan', 'flexiaddons')
			]
		);
		/**
		 * Condition: 'layout' => 'style-2'
		 * 
		 * Pricing Table Sub Title
		 */
		$this->add_control(
			'pricing_table_sub_title',
			[
				'label' => esc_html__('Sub Title', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__('A tagline here.', 'flexiaddons'),
				'condition' => [
					'layout' => ['style2', 'style3']
				]
			]
		);
		/**
		 * Condition: 'layout' => 'style-2'
		 * 
		 * Pricing Table Style 2 Icon
		 */
		$this->add_control(
			'pricing_table_style_2_icon',
			[
				'label' => esc_html__('Icon', 'flexiaddons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
                    'value' => 'fa fa-home',
                    'library' => 'fa-solid',
                ],
				'condition' => [
					'layout' => 'style2',
				]
			]
		);
		/**
		 * Condition: 'layout' => 'style-5'
		 * 
		 * Pricing Table Style 5 Image
		 */
		$this->add_control(
			'pricing_table_style_5_image',
			[
				'label' => esc_html__('Image', 'flexiaddons'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'layout' => 'style5',
				]
			]
		);
		/**
		 * Condition: 'layout' => 'style4'
		 */
		$this->add_control(
			'pricing_table_style_4_image',
			[
				'label' => esc_html__('Header Image', 'flexiaddons'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-price-image' => 'background-image: url({{URL}});',
				],
				'condition' => [
					'layout' => 'style4'
				]
			]
		);
		$this->end_controls_section();

		/**
		 * Pricing Table Price
		 */
		$this->start_controls_section(
			'pricing_table_section_price',
			[
				'label' => esc_html__('Price', 'flexiaddons')
			]
		);
		// Price
		$this->add_control(
			'pricing_table_price',
			[
				'label' => esc_html__('Price', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__('99', 'flexiaddons')
			]
		);
		// On Sele?
		$this->add_control(
			'pricing_table_onsale',
			[
				'label' => __('On Sale?', 'flexiaddons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __('Yes', 'flexiaddons'),
				'label_off' => __('No', 'flexiaddons'),
				'return_value' => 'yes',
			]
		);
		// Sale Price
		$this->add_control(
			'pricing_table_onsale_price',
			[
				'label' => esc_html__('Sale Price', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__('89', 'flexiaddons'),
				'condition' => [
					'pricing_table_onsale' => 'yes'
				]
			]
		);
		// Price Currency
		$this->add_control(
			'pricing_table_price_curr',
			[
				'label' => esc_html__('Price Currency', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__('$', 'flexiaddons'),
			]
		);
		// Currency Placement
		$this->add_control(
			'pricing_table_cur_placement',
			[
				'label' => esc_html__('Currency Placement', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'label_block' => false,
				'options' => [
					'left' => esc_html__('Left', 'flexiaddons'),
					'right' => esc_html__('Right', 'flexiaddons'),
				],
			]
		);
		/**
		 * Condition: 'layout' => 'style3'
		 */
		$this->add_control(
			'pricing_table_style_3_price_position',
			[
				'label' => esc_html__('Pricing Position', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'bottom',
				'label_block' => false,
				'options' => [
					'top' => esc_html__('On Top', 'flexiaddons'),
					'bottom' => esc_html__('At Bottom', 'flexiaddons'),
				],
				'condition' => [
					'layout' => 'style3'
				]
			]
		);
		// Price Period
		$this->add_control(
			'pricing_table_price_period',
			[
				'label' => esc_html__('Price Period (per)', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__('month', 'flexiaddons')
			]
		);
		// Period Separator
		$this->add_control(
			'pricing_table_period_separator',
			[
				'label' => esc_html__('Period Separator', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__('/', 'flexiaddons'),
				'description' => sprintf(__('Use <code>%s</code> for new line', 'flexiaddons'), esc_html('<br>'))
			]
		);
		$this->end_controls_section();
		/**
		 * Pricing Table Feature
		 */
		$this->start_controls_section(
			'pricing_table_feature',
			[
				'label' => esc_html__('Feature', 'flexiaddons')
			]
		);
		/**
		 * Pricing Table Feature Iteams
		 * 
		 * Repeater
		 */
		$this->add_control(
			'pricing_table_items',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',

				'fields' => [
					[
						'name' => 'pricing_table_item',
						'label' => esc_html__('List Item', 'flexiaddons'),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__('Pricing table list item', 'flexiaddons')
					],
					[
                        'name' => 'pricing_table_list_icon',
                        'label' => esc_html__('Icon', 'flexiaddons'),
                        'type' => Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fa fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
					[
						'name' => 'pricing_table_icon_mood',
						'label' => esc_html__('Item Active?', 'flexiaddons'),
						'type' => Controls_Manager::SWITCHER,
						'return_value' => 'yes',
						'default' => 'yes'
					],
					[
						'name' => 'pricing_table_list_icon_color',
						'label' => esc_html__('Icon Color', 'flexiaddons'),
						'type' => Controls_Manager::COLOR,
					],

				],
				'default' => [
					['pricing_table_item' => 'Unlimited calls'],
					['pricing_table_item' => 'Free hosting'],
					['pricing_table_item' => '500 MB of storage space'],
					['pricing_table_item' => '500 MB Bandwidth'],
					['pricing_table_item' => '24/7 support']
				],
				'title_field' => '{{pricing_table_item}}',
			]
		);
		$this->end_controls_section();

		/**
		 * Pricing Table Footer
		 */
		$this->start_controls_section( 'pricing_table_footerr', [
				'label' => esc_html__('Footer', 'flexiaddons')
		] );

		// Button Icon
		$this->add_control( 'pricing_table_button_icon', [
				'label' => esc_html__('Button Icon', 'flexiaddons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-angle-double-right',
					'library' => 'fa-solid',
                ],
		] );

		// Icon Position
		$this->add_control( 'pricing_table_button_icon_alignment', [
			'label'     => esc_html__( 'Icon Position', 'flexiaddons' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'right',
			'options'   => [
					'left' => esc_html__('Before', 'flexiaddons'),
					'right' => esc_html__('After', 'flexiaddons'),
				],
			'condition' => [
					'pricing_table_button_icon!' => '',
				],
		] );

		// Icon Spacing
		$this->add_control(
			'pt_button_icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'condition' => [
					'pricing_table_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-button .fa-icon-left' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .pricing-button .fa-icon-right' => 'margin-left: {{SIZE}}px;',
				],
			]
		);
		// Button Text
		$this->add_control(
			'pricing_table_btn',
			[
				'label' => esc_html__('Button Text', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Choose Plan', 'flexiaddons'),
			]
		);
		// Button Link
		$this->add_control(
			'pricing_table_btn_link',
			[
				'label' => esc_html__('Button Link', 'flexiaddons'),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'url' => '#',
					'is_external' => '',
				],
				'show_external' => true,
			]
		);
		$this->end_controls_section();

		/**
		 * Pricing Table Rebon
		 */
		$this->start_controls_section(
			'pricing_table_ribon',
			[
				'label' => esc_html__('Ribbon', 'flexiaddons')
			]
		);
		// Pricing Table Ribon Yes/No
		$this->add_control(
			'pricing_table_featured',
			[
				'label' => esc_html__('Featured?', 'flexiaddons'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		// Pricing Table Ribon Style
		$this->add_control(
			'pricing_table_ribon_styles',
			[
				'label' => esc_html__('Ribbon Style', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'ribbon-1',
				'options' => [
					'ribbon-1' => esc_html__('Style 1', 'flexiaddons'),
					'ribbon-2' => esc_html__('Style 2', 'flexiaddons'),
					'ribbon-3' => esc_html__('Style 3', 'flexiaddons'),
				],
				'condition' => [
					'pricing_table_featured' => 'yes',
				],
			]
		);

		/**
		 * Condition: 'pricing_table_ribon_styles' => [ 'ribbon-2', 'ribbon-3' ], 'pricing_table_featured' => 'yes'
		 */
		$this->add_control(
			'pricing_table_featured_tag_text',
			[
				'label' => esc_html__('Featured Tag Text', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__('Featured', 'flexiaddons'),
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-2::before' => 'content: "{{VALUE}}";',
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-3::before' => 'content: "{{VALUE}}";',
					],
				'condition' => [
					'pricing_table_ribon_styles' => ['ribbon-2', 'ribbon-3'],
					'pricing_table_featured' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pricing_table_style_settings',
			[
				'label' => esc_html__('Pricing Table Style', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		// Background Color
		$this->add_control(
			'pricing_table_bg_color',
			[
				'label' => esc_html__('Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);
		// Padding
		$this->add_responsive_control(
			'sa_el_pricing_table_container_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Margin
		$this->add_responsive_control(
			'pricing_table_container_margin',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pricing_table_border',
				'label' => esc_html__('Border Type', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flexi-pt-wrap',
			]
		);
		// Border Radius
		$this->add_responsive_control(
			'pricing_table_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pricing_table_box_shadow',
				'selector' => '{{WRAPPER}} .flexi-pt-wrap'
			]
		);
		// Content Aligment
		$this->add_responsive_control(
			'pricing_table_content_alignment',
			[
				'label' => esc_html__('Content Alignment', 'flexiaddons'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'flexiaddons'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'flexiaddons'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'flexiaddons'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'prefix_class' => 'flexi-content-align-',
			]
		);


		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Header)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pricing_table_header_style_settings',
			[
				'label' => esc_html__('Header', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		// Title Heading
		$this->add_control(
			'pricing_table_title_heading',
			[
				'label' => esc_html__('Title Style', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
			]
		);
		// Title Color
		$this->add_control(
			'pricing_table_title_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pricing.style-3 .pricing-item:hover .header:after' => 'background: {{VALUE}};',
				],
			]
		);
		// Title Background for style 2 and style 4
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'pricing_table_style_2_title_bg_color',
				'label' => __( 'Background', 'flexiaddons' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-header-area, {{WRAPPER}} .flexi-pt-wrap .style-4 .flexi-pt-header-area',
				'condition' => [
					'layout' => ['style2', 'style4']
				]
			]
		);
		// Title Background for style 2 and style 4
		$this->add_control(
			'pricing_table_style_5_title_bg_color',
			[
				'label' => esc_html__('Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#F7F0FE',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-5 .title' => 'background: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style5']
				]
			]
		);
		// Title Line Color
		$this->add_control(
			'pricing_table_style_1_title_line_color',
			[
				'label' => esc_html__('Line Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#dbdbdb',
				'selectors' => [
					'{{WRAPPER}} .style-1 .title::after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .flexi-pt-wrap .style-3 .flexi-pt-header-area::after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style1', 'style3']
				]
			]
		);
		// Title Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_table_title_typography',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		// Title background Padding
		$this->add_responsive_control(
			'pricing_table_header_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-header-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .flexi-pt-wrap .style-4 .flexi-pt-header-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .flexi-pt-wrap .style-5 .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Title background Margin
		$this->add_responsive_control(
			'pricing_table_header_margin',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-5 .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['style5']
				]
			]
		);
		// Title background Border Radius
		$this->add_responsive_control(
			'pricing_table_header_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-5 .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['style5']
				]
			]
		);
		// Subtitle Style
		$this->add_control(
			'pricing_table_subtitle_heading',
			[
				'label' => esc_html__('Subtitle Style', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout!' => ['style1', 'style5']
				]
			]
		);
		// Subtitle Color
		$this->add_control(
			'pricing_table_subtitle_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-header-area .subtitle' => 'color: {{VALUE}};',
					'{{WRAPPER}} .flexi-pt-wrap .style-3 .flexi-pt-header-area .subtitle' => 'color: {{VALUE}};',
					'{{WRAPPER}} .flexi-pt-wrap .style-4 .flexi-pt-header-area .subtitle' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layout!' => ['style1', 'style5']
				]
			]
		);
		// Subtitle Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_table_subtitle_typography',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-header-area .subtitle',
					'{{WRAPPER}} .flexi-pt-wrap .style-3 .flexi-pt-header-area .subtitle',
					'{{WRAPPER}} .flexi-pt-wrap .style-4 .flexi-pt-header-area .subtitle',
				],
				'condition' => [
					'layout!' => ['style1', 'style5']
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Pricing)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pricing_table_title_style_settings',
			[
				'label' => esc_html__('Pricing', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		// Original Price
		$this->add_control( 'pricing_table_price_tag_onsale_heading', [
				'label' => esc_html__('Original Price', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'pricing_table_onsale' => 'yes'
				],

		] );

		// Price Onsale Color
		$this->add_control( 'pricing_table_pricing_onsale_color', [
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#999',
				'condition' => [
					'pricing_table_onsale' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-1 .flexi-pt-price-area .pricing-tag .muted-price' => 'color: {{VALUE}};',
					'{{WRAPPER}} .muted-price-currency' => 'color: {{VALUE}};',
				],
		] );

		// Price Onsale Typography
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'pricing_table_price_tag_onsale_typography',
			'condition' => [
					'pricing_table_onsale' => 'yes'
				],
			'separator' => 'after',
			'selector'  => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-price-area .pricing-tag .muted-price',
		] );

		// Sale Price Heading
		$this->add_control( 'pricing_table_price_tag_heading', [
				'label' => esc_html__('Sale Price', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
		] );

		// Price Currency Margin
		$this->add_responsive_control( 'pricing_table_price_spacing', [
			'label'      => esc_html__( 'Spacing', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'separator'  => 'after',
			'selectors'  => [
				'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-price-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Sale Price Color
		$this->add_control(
			'pricing_table_pricing_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-price-area .pricing-tag' => 'color: {{VALUE}};',
				],
			]
		);

		// Sale Price Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-price-area .pricing-tag',
			]
		);

		// Price Currency Heading
		$this->add_control(
			'pricing_table_price_currency_heading',
			[
				'label' => esc_html__('Currency', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		// Price Currency Color
		$this->add_control(
			'pricing_table_pricing_curr_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-price-area .pricing-tag .price-currency' => 'color: {{VALUE}};',
				],
			]
		);

		// Price Currency Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_table_price_cur_typography',
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-price-area .pricing-tag .price-currency',
			]
		);

		// Price Currency Margin
		$this->add_responsive_control( 'pricing_table_price_cur_margin', [
			'label'          => esc_html__( 'Spacing', 'flexiaddons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-price-area .pricing-tag .price-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		] );

		// Pricing Period Heading
		$this->add_control(
			'pricing_table_pricing_period_heading',
			[
				'label' => esc_html__('Pricing Period', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		// Pricing Period Color
		$this->add_control(
			'pricing_table_pricing_period_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-price-area .price-period' => 'color: {{VALUE}};',
				],
			]
		);
		// Pricing Preiod Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-price-area .price-period',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Feature List)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pricing_table_style_featured_list_settings',
			[
				'label' => esc_html__('Feature List', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Feature List Color
		$this->add_control(
			'pricing_table_list_item_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-feature-area ul li' => 'color: {{VALUE}};',
				],
			]
		);
		// Feature List Desiable Item Color
		$this->add_control(
			'pricing_table_list_disable_item_color',
			[
				'label' => esc_html__('Disable item color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-feature-area ul li.disable-item' => 'color: {{VALUE}};',
				],
			]
		);
		// Feature List Desiable Item Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_table_list_item_typography',
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-feature-area ul li',
			]
		);
		// Feature List Border
		$this->add_control(
			'pricing_table_li_border',
			[
				'label' => esc_html__('Border', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-feature-area ul li' => 'border-bottom: {{SIZE}}px;',
					]
			]
		);
		// Feature List Border Color
		$this->add_control(
			'pricing_table_li_border_color',
			[
				'label' => esc_html__('Border Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0, 0, 0, 0.09)',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-feature-area ul li' => 'border-color: {{VALUE}};',
				],
			]
		);

		// Feature List Content Aligment
		$this->add_responsive_control(
			'pricing_table_li_content_alignment',
			[
				'label' => esc_html__('Content Alignment', 'flexiaddons'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'flexiaddons'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'flexiaddons'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'flexiaddons'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-feature-area ul' => 'text-align: {{VALUE}};'
				],
			]
		);
		// Feature List Padding
		$this->add_responsive_control(
			'pricing_table_list_item_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-feature-area ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
			]
		);
		// Feature List Margin
		$this->add_responsive_control(
			'pricing_table_list_item_margin',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-feature-area ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['style5']
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Ribbon)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pricing_table_style_3_featured_tag_settings',
			[
				'label' => esc_html__('Ribbon', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pricing_table_featured' => 'yes',
				],
			]
		);
		$this->add_control(
			'pricing_table_style_1_featured_bar_color',
			[
				'label' => esc_html__('Line Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#00C853',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-1::before' => 'background: {{VALUE}};',
				],
				'condition' => [
					'pricing_table_featured' => 'yes',
					'pricing_table_ribon_styles' => 'ribbon-1'
				],
			]
		);
		// Line Height
		$this->add_control(
			'pricing_table_style_1_featured_bar_height',
			[
				'label' => esc_html__('Line Height', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 3
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-1::before' => 'height: {{SIZE}}px;',
					],
				'condition' => [
					'pricing_table_featured' => 'yes',
					'pricing_table_ribon_styles' => 'ribbon-1'
				],
			]
		);
		// Ribon Font Size
		$this->add_control(
			'pricing_table_featured_tag_font_size',
			[
				'label' => esc_html__('Font Size', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],
				'range' => [
					'px' => [
						'max' => 18,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-2::before' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-3::before' => 'font-size: {{SIZE}}px;',
					],
				'condition' => [
					'pricing_table_featured' => 'yes',
					'pricing_table_ribon_styles' => ['ribbon-2', 'ribbon-3']
				],
			]
		);

		// Ribon Font Color
		$this->add_control(
			'pricing_table_featured_tag_text_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-2::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-3::before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'pricing_table_featured' => 'yes',
					'pricing_table_ribon_styles' => ['ribbon-2', 'ribbon-3']
				],
			]
		);

		// Ribon Background Color
		$this->add_control(
			'pricing_table_featured_tag_bg_color',
			[
				'label' => esc_html__('Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-2::before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-2 .flexi-pt-footer-area::after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .flexi-pt-wrap .ribbon-3::before' => 'background: {{VALUE}};',
					
					
				],
				'condition' => [
					'pricing_table_featured' => 'yes',
					'pricing_table_ribon_styles' => ['ribbon-2', 'ribbon-3']
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Icon Style)
		 * Condition: 'layout' => 'style2'
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pricing_table_icon_style_settings',
			[
				'label' => esc_html__('Icon Settings', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'style2'
				]
			]
		);
		/**
		 * Condition: 'pricing_table_icon_bg_show' => 'yes'
		 */
		$this->add_control(
			'pricing_table_icon_bg_color',
			[
				'label' => esc_html__('Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-top-icon i' => 'background-color: {{VALUE}};',
				],
			]
		);
		/**
		 * Condition: 'pricing_table_icon_bg_show' => 'yes'
		 */
		$this->add_control(
			'pricing_table_icon_bg_hover_color',
			[
				'label' => esc_html__('Background Hover Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap:hover .style-2 .flexi-pt-top-icon i' => 'background-color: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);
		// Icon Size
		$this->add_control(
			'pricing_table_icon_settings',
			[
				'label' => esc_html__('Icon Size', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-top-icon i' => 'font-size: {{SIZE}}px;',
				],
			]
		);
		// Icon Area Width
		$this->add_control(
			'sa_el_pricing_table_icon_area_width',
			[
				'label' => esc_html__('Icon Area Width', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80
				],
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-top-icon i' => 'width: {{SIZE}}px;',
				],
			]
		);
		// Icon Area Height
		$this->add_control(
			'pricing_table_icon_area_height',
			[
				'label' => esc_html__('Icon Area Height', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80
				],
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-top-icon i' => 'height: {{SIZE}}px;',
				],
			]
		);
		// Icon Alignment
		$this->add_control(
			'pricing_table_icon_line_height',
			[
				'label' => esc_html__('Icon Alignment', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80
				],
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-top-icon i' => 'line-height: {{SIZE}}px;',
				],
			]
		);
		// Icon Color
		$this->add_control(
			'pricing_table_icon_color',
			[
				'label' => esc_html__('Icon Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-top-icon i' => 'color: {{VALUE}};',
				],
			]
		);
		// Icon Hover Color
		$this->add_control(
			'pricing_table_icon_hover_color',
			[
				'label' => esc_html__('Icon Hover Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap:hover .style-2 .flexi-pt-top-icon i' => 'color: {{VALUE}};',
				],
				'separator' => 'after'
			]
		);
		// Icon Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pricing_table_icon_border',
				'label' => esc_html__('Border', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-top-icon i',
			]
		);
		// Icon Border Hover Color
		$this->add_control(
			'pricing_table_icon_border_hover_color',
			[
				'label' => esc_html__('Hover Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap:hover .style-2 .flexi-pt-top-icon i' => 'border-color: {{VALUE}};',
				],

			]
		);
		// Border Radius
		$this->add_control(
			'pricing_table_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .style-2 .flexi-pt-top-icon i' => 'border-radius: {{SIZE}}%;',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'pricing_table_btn_style_settings', [
				'label' => esc_html__('Footer', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE
		] );

		// Footer Heading
		$this->add_control(
			'pricing_table_footer_header',
			[
				'label' => esc_html__('Footer', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		// Footer Padding
		$this->add_responsive_control(
			'pricing_table_footer_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Footer Border Radius
		$this->add_control(
			'pricing_table_footer_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		// Footer Background Color
		$this->add_control( 'pricing_table_footer_bg_color', [
				'label' => esc_html__('Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area' => 'background: {{VALUE}};',
				],
		] );

		// Button Heading
		$this->add_control(
			'pricing_table_button_header',
			[
				'label' => esc_html__('Button', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		// Button Padding
		$this->add_responsive_control(
			'pricing_table_btn_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Button Margin
		$this->add_responsive_control(
			'pricing_table_btn_margin',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// button typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_table_btn_typography',
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button',
			]
		);

		$this->start_controls_tabs('pricing_table_button_tabs');

		// Normal State Tab
		$this->start_controls_tab('pricing_table_btn_normal', ['label' => esc_html__('Normal', 'flexiaddons')]);
		// Normal Button Text Color
		$this->add_control(
			'pricing_table_btn_normal_text_color',
			[
				'label' => esc_html__('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button' => 'color: {{VALUE}};',
				],
			]
		);
		// Background Color
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'pricing_table_btn_normal_bg_color',
				'label'    => __( 'Background Color', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button',

			]
		);
		// Button Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pricing_table_btn_border',
				'label' => esc_html__('Border', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button',
			]
		);
		// Button Border Radius
		$this->add_control(
			'pricing_table_btn_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		// Button Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pricing_table_button_shadow',
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button',
				'separator' => 'before'
			]
		);
		$this->end_controls_tab();

		// Hover State Tab
		$this->start_controls_tab('pricing_table_btn_hover', ['label' => esc_html__('Hover', 'flexiaddons')]);
		// Button Text Hover Color
		$this->add_control(
			'pricing_table_btn_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		// Button Hover Background Color
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'pricing_table_btn_hover_bg_color',
				'label'    => __( 'Background Color', 'flexiaddons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button:hover',

			]
		);
		// Button Hover Border Color
		$this->add_control(
			'pricing_table_btn_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		// Button Hover Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pricing_table_button_shadow_hover',
				'selector' => '{{WRAPPER}} .flexi-pt-wrap .flexi-pt-footer-area .pricing-button:hover',
				'separator' => 'before'
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 *  Price Table Feature Function
	 */
	protected function render_feature_list($settings, $obj)
	{
		if (empty($settings['pricing_table_items'])) {
			return;
		}
		$counter = 0;
?>
		<ul>
			<?php
			foreach ($settings['pricing_table_items'] as $item) :

				if ('yes' !== $item['pricing_table_icon_mood']) {
					$obj->add_render_attribute('pricing_table_item' . $counter, 'class', 'disable-item');
				}

			?>
				<li <?php echo $obj->get_render_attribute_string('pricing_table_item' . $counter); ?>>
					<?php if ('show' === $settings['list_icon_enabel']) : ?>
						<span class="li-icon" style="color:<?php echo esc_attr($item['pricing_table_list_icon_color']); ?>"> <?php Icons_Manager::render_icon($item['pricing_table_list_icon'], ['aria-hidden' => 'false']); ?></span>
					<?php endif; ?>
					<?php echo $item['pricing_table_item']; ?>
				</li>
			<?php
				$counter++;
			endforeach;
			?>
		</ul>
	<?php
	}


	public function render()
	{

		$settings = $this->get_settings();
		$target = $settings['pricing_table_btn_link']['is_external'] ? 'target="_blank"' : '';
		$nofollow = $settings['pricing_table_btn_link']['nofollow'] ? 'rel="nofollow"' : '';



		if ('yes' === $settings['pricing_table_featured']) : $featured_class = 'featured ' . $settings['pricing_table_ribon_styles'];
		else : $featured_class = '';
		endif;


		if ('yes' === $settings['pricing_table_onsale']) {
			if ($settings['pricing_table_cur_placement'] == 'left') {
				$pricing = '
				<del class="muted-price">
					<span class="muted-price-currency">' . $settings['pricing_table_price_curr'] . '</span>' . $settings['pricing_table_price'] . '
				</del> 
				
				<span class="price-currency">' . $settings['pricing_table_price_curr'] . '</span>' . $settings['pricing_table_onsale_price'];
			} else if ($settings['pricing_table_cur_placement'] == 'right') {
				$pricing = '
				<del class="muted-price">' . $settings['pricing_table_price'] . '
					<span class="muted-price-currency">' . $settings['pricing_table_price_curr'] . '</span>
				</del>
				 ' . $settings['pricing_table_onsale_price'] . '<span class="price-currency">' . $settings['pricing_table_price_curr'] . '</span>';
			}
		} else {
			if ($settings['pricing_table_cur_placement'] == 'left') {
				$pricing = '<span class="price-currency">' . $settings['pricing_table_price_curr'] . '</span>' . $settings['pricing_table_price'];
			} else if ($settings['pricing_table_cur_placement'] == 'right') {
				$pricing = $settings['pricing_table_price'] . '<span class="price-currency">' . $settings['pricing_table_price_curr'] . '</span>';
			}
		}
	?>
		<!-- Style One -->
		<?php if ( in_array( $settings['layout'], [ 'style1', 'style6' ] ) ) { ?>
			<div class="flexi-pt-wrap">
				<div class="flexi-pt-container <?php echo $settings['layout']; ?> <?php echo esc_attr($featured_class); ?>">
					<div class="flexi-pt-header-area">
						<div class="title">
							<?php echo $settings['title']; ?>
						</div>
					</div>
					<div class="flexi-pt-price-area">
						<span class="pricing-tag"> <?php echo $pricing; ?></span>
						<span class="price-period"><?php echo $settings['pricing_table_period_separator']; ?> <?php echo $settings['pricing_table_price_period']; ?></span>
					</div>
					<div class="flexi-pt-feature-area">
						<?php $this->render_feature_list($settings, $this); ?>
					</div>
					<div class="flexi-pt-footer-area">
						<a href="<?php echo esc_url($settings['pricing_table_btn_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="pricing-button">
							<?php if ('left' == $settings['pricing_table_button_icon_alignment']) : ?>
								<span class="fa-icon-left">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
								<?php echo $settings['pricing_table_btn']; ?>
							<?php elseif ('right' == $settings['pricing_table_button_icon_alignment']) : ?>
								<?php echo $settings['pricing_table_btn']; ?>
								<span class="fa-icon-right">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
							<?php endif; ?>
						</a>
					</div>
				</div>
			</div>

	<?php } ?>

		<!-- Style Two -->

		<?php if ('style2' === $settings['layout']) : ?>
			<div class="flexi-pt-wrap">
				<div class="flexi-pt-container style-2 <?php echo esc_attr($featured_class); ?>">
					<div class="flexi-pt-top-icon">
						<?php  Icons_Manager::render_icon($settings['pricing_table_style_2_icon'], ['aria-hidden' => 'false']);?>
					</div>
					<div class="flexi-pt-header-area">
						<div class="title">
							<?php echo $settings['title']; ?>
						</div>
						<div class="subtitle">
							<?php echo $settings['pricing_table_sub_title']; ?>
						</div>
					</div>
					<div class="flexi-pt-price-area">
						<span class="pricing-tag"> <?php echo $pricing; ?></span>
						<span class="price-period"><?php echo $settings['pricing_table_period_separator']; ?> <?php echo $settings['pricing_table_price_period']; ?></span>
					</div>
					<div class="flexi-pt-feature-area">
						<?php $this->render_feature_list($settings, $this); ?>
					</div>
					<div class="flexi-pt-footer-area">
						<a href="<?php echo esc_url($settings['pricing_table_btn_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="pricing-button">
							<?php if ('left' == $settings['pricing_table_button_icon_alignment']) : ?>
								<span class="fa-icon-left">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
								<?php echo $settings['pricing_table_btn']; ?>
							<?php elseif ('right' == $settings['pricing_table_button_icon_alignment']) : ?>
								<?php echo $settings['pricing_table_btn']; ?>
								<span class="fa-icon-right">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
							<?php endif; ?>
						</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<!-- Style Three -->

		<?php if ('style3' === $settings['layout']) : ?>
			<div class="flexi-pt-wrap">
				<div class="flexi-pt-container style-3 <?php echo esc_attr($featured_class); ?>">
					<div class="flexi-pt-header-area">
						<div class="title">
							<?php echo $settings['title']; ?>
						</div>
						<div class="subtitle">
							<?php echo $settings['pricing_table_sub_title']; ?>
						</div>
					</div>

					<div class="flexi-pt-feature-area">
						<?php $this->render_feature_list($settings, $this); ?>
					</div>
					<div class="flexi-pt-price-area">
						<span class="pricing-tag"> <?php echo $pricing; ?></span>
						<span class="price-period"><?php echo $settings['pricing_table_period_separator']; ?> <?php echo $settings['pricing_table_price_period']; ?></span>
					</div>
					<div class="flexi-pt-footer-area">
						<a href="<?php echo esc_url($settings['pricing_table_btn_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="pricing-button">
							<?php if ('left' == $settings['pricing_table_button_icon_alignment']) : ?>
								<span class="fa-icon-left">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
								<?php echo $settings['pricing_table_btn']; ?>
							<?php elseif ('right' == $settings['pricing_table_button_icon_alignment']) : ?>
								<?php echo $settings['pricing_table_btn']; ?>
								<span class="fa-icon-right">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
							<?php endif; ?>
						</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<!-- Style Four -->

		<?php if ('style4' === $settings['layout']) : ?>
			<div class="flexi-pt-wrap">
				<div class="flexi-pt-container style-4 <?php echo esc_attr($featured_class); ?>">
					<div class="flexi-pt-price-image">
						<div class="flexi-pt-price-area">
							<span class="pricing-tag"> <?php echo $pricing; ?></span>
							<span class="price-period"><?php echo $settings['pricing_table_period_separator']; ?> <?php echo $settings['pricing_table_price_period']; ?></span>
						</div>
					</div>
					
					<div class="flexi-pt-header-area">
						<div class="title">
							<?php echo $settings['title']; ?>
						</div>
						<div class="subtitle">
							<?php echo $settings['pricing_table_sub_title']; ?>
						</div>
					</div>

					<div class="flexi-pt-feature-area">
						<?php $this->render_feature_list($settings, $this); ?>
					</div>
					<div class="flexi-pt-footer-area">
						<a href="<?php echo esc_url($settings['pricing_table_btn_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="pricing-button">
							<?php if ('left' == $settings['pricing_table_button_icon_alignment']) : ?>
								<span class="fa-icon-left">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
								<?php echo $settings['pricing_table_btn']; ?>
							<?php elseif ('right' == $settings['pricing_table_button_icon_alignment']) : ?>
								<?php echo $settings['pricing_table_btn']; ?>
								<span class="fa-icon-right">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
							<?php endif; ?>
						</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<!-- Style Five -->

		<?php if ('style5' === $settings['layout']) : ?>
			<div class="flexi-pt-wrap">
				<div class="flexi-pt-container style-5 <?php echo esc_attr($featured_class); ?>">
					<div class="flexi-pt-top-image">
						<?php echo '<img src="' . $settings['pricing_table_style_5_image']['url'] . '">'; ?>
					</div>
					<div class="flexi-pt-header-area">
						<div class="title">
							<?php echo $settings['title']; ?>
						</div>
					</div>
					<div class="flexi-pt-price-area">
						<span class="pricing-tag"> <?php echo $pricing; ?></span>
						<span class="price-period"><?php echo $settings['pricing_table_period_separator']; ?> <?php echo $settings['pricing_table_price_period']; ?></span>
					</div>
					<div class="flexi-pt-feature-area">
						<?php $this->render_feature_list($settings, $this); ?>
					</div>
					<div class="flexi-pt-footer-area">
						<a href="<?php echo esc_url($settings['pricing_table_btn_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="pricing-button">
							<?php if ('left' == $settings['pricing_table_button_icon_alignment']) : ?>
								<span class="fa-icon-left">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
								<?php echo $settings['pricing_table_btn']; ?>
							<?php elseif ('right' == $settings['pricing_table_button_icon_alignment']) : ?>
								<?php echo $settings['pricing_table_btn']; ?>
								<span class="fa-icon-right">
									<?php  Icons_Manager::render_icon($settings['pricing_table_button_icon'], ['aria-hidden' => 'false']);?>
								</span>
							<?php endif; ?>
						</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

<?php

	}
}
