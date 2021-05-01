<?php


use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined('ABSPATH') || die();

class Flexi_Addons_Widget_Info_Box extends Flexi_Addons_Widget_Base
{


	protected $key = 'info-box';

	/**
	 * Register content related controls
	 */
	protected function _register_controls()
	{

		/**
		 * ======================
		 * | Layout |
		 * ======================
		 */
		$this->start_controls_section('info_box_layout_settings', [
			'label' => __('Layout', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);

		//Button Icon Position
		$this->add_control('info_box_layout', [
			'label'     => __('Style', 'flexiaddons'),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'flx-i-vertical',
			'options'   => [
				'flx-i-vertical'  => __('Vertical', 'flexiaddons'),
				'flx-i-horizontal' => __('Horizontal', 'flexiaddons'),
			],
		]);

		$this->end_controls_section();
		/**
		 * ======================
		 * | Image/ Icon Section |
		 * ======================
		 */
		$this->start_controls_section('_image_icon', [
			'label' => __('Image/ Icon', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);

		//Media Type
		$this->add_control('media_type', [
			'label'       => __('Media Type', 'flexiaddons'),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
			'options'     => [
				'none'   => [
					'title' => __('None', 'flexiaddons'),
					'icon'  => 'fa fa-ban',
				],
				'number' => [
					'title' => __('Number', 'flexiaddons'),
					'icon'  => 'eicon-number-field',
				],
				'icon'   => [
					'title' => __('Icon', 'flexiaddons'),
					'icon'  => 'fa fa-info-circle',
				],
				'img'    => [
					'title' => __('Image', 'flexiaddons'),
					'icon'  => 'fa fa-picture-o',
				]
			],
			'default'     => 'icon',
		]);

		//Image Type
		$this->add_control('image', [
			'label'     => __('Infobox Image', 'flexiaddons'),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'media_type' => 'img'
			]
		]);

		//Image Size
		$this->add_group_control(Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'media_type' => 'img',
				'image!'     => '',
			],
		]);

		//Icon Type
		$this->add_control('icon_new', [
			'label'            => __('Icon', 'flexiaddons'),
			'type'             => Controls_Manager::ICONS,
			'fa4compatibility' => 'icon',
			'default'          => [
				'value'   => 'fa fa-star',
				'library' => 'fa-solid',
			],
			'condition'        => [
				'media_type' => 'icon'
			]
		]);

		//Number Type
		$this->add_control('number', [
			'label'     => __('Number', 'flexiaddons'),
			'type'      => Controls_Manager::TEXT,
			'condition' => [
				'media_type' => 'number'
			]
		]);

		//Media Position Vertical
		$this->add_control('position', [
			'label'        => __('Media Position', 'flexiaddons'),
			'type'         => Controls_Manager::CHOOSE,
			'default'      => 'top',
			'options'      => [
				'left'  => [
					'title' => __('Left', 'flexiaddons'),
					'icon'  => 'eicon-h-align-left',
				],
				'top'   => [
					'title' => __('Top', 'flexiaddons'),
					'icon'  => 'eicon-v-align-top',
				],
				'right' => [
					'title' => __('Right', 'flexiaddons'),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'prefix_class' => 'kfa-position-',
			'toggle'       => false,
			'condition'        => [
				'info_box_layout' => 'flx-i-vertical'
			]
		]);

		//Media Position Horizontal
		$this->add_control('horizontal_position', [
			'label'        => __('Media Position', 'flexiaddons'),
			'type'         => Controls_Manager::CHOOSE,
			'default'      => 'top',
			'options'      => [
				'left'  => [
					'title' => __('Left', 'flexiaddons'),
					'icon'  => 'eicon-h-align-left',
				],
				'right' => [
					'title' => __('Right', 'flexiaddons'),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'prefix_class' => 'kfa-position-',
			'toggle'       => false,
			'condition'        => [
				'info_box_layout' => 'flx-i-horizontal'
			]
		]);

		$this->end_controls_section();

		/**
		 * ======================
		 * | Title & Desc Section |
		 * ======================
		 */
		$this->start_controls_section('_title_description', [
			'label' => __('Title & Description', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);

		//Title
		$this->add_control('title', [
			'label'       => __('Title', 'flexiaddons'),
			'label_block' => true,
			'type'        => Controls_Manager::TEXT,
			'default'     => __('This is the heading', 'flexiaddons'),
			'placeholder' => __('Enter your title', 'flexiaddons'),
			'dynamic'     => [
				'active' => true,
			]
		]);

		//Description
		$this->add_control('description', [
			'label'       => __('Description', 'flexiaddons'),
			'type'        => Controls_Manager::WYSIWYG,
			'default'     => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'flexiaddons'),
			'placeholder' => __('Enter your description', 'flexiaddons'),
			'rows'        => 5,
			'dynamic'     => [
				'active' => true,
			]
		]);

		//Title tag
		$this->add_control('title_tag', [
			'label'   => __('Title HTML Tag', 'flexiaddons'),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'h1' => [
					'title' => __('H1', 'flexiaddons'),
					'icon'  => 'eicon-editor-h1'
				],
				'h2' => [
					'title' => __('H2', 'flexiaddons'),
					'icon'  => 'eicon-editor-h2'
				],
				'h3' => [
					'title' => __('H3', 'flexiaddons'),
					'icon'  => 'eicon-editor-h3'
				],
				'h4' => [
					'title' => __('H4', 'flexiaddons'),
					'icon'  => 'eicon-editor-h4'
				],
				'h5' => [
					'title' => __('H5', 'flexiaddons'),
					'icon'  => 'eicon-editor-h5'
				],
				'h6' => [
					'title' => __('H6', 'flexiaddons'),
					'icon'  => 'eicon-editor-h6'
				]
			],
			'default' => 'h2',
			'toggle'  => false,
		]);

		//Align
		$this->add_responsive_control('align', [
			'label'     => __('Alignment', 'flexiaddons'),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __('Left', 'flexiaddons'),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => __('Center', 'flexiaddons'),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => __('Right', 'flexiaddons'),
					'icon'  => 'fa fa-align-right',
				],
			],
			'default'   => 'center',
			'toggle'    => true,
			'selectors' => [
				'{{WRAPPER}}' => 'text-align: {{VALUE}};'
			]
		]);

		$this->end_controls_section();

		/**
		 * ======================
		 * | Button Section |
		 * ======================
		 */
		$this->start_controls_section('_button', [
			'label' => __('Button', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);

		//Show/ Hide Button
		$this->add_control('show_btn', [
			'label'     => __('Show Button', 'flexiaddons'),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => __('Yes', 'flexiaddons'),
			'label_off' => __('No', 'flexiaddons'),
			'default'   => 'yes',
			'condition' => [
				'_clickable!' => 'yes'
			]
		]);

		//Button Text
		$this->add_control('btn_text', [
			'label'       => __('Button Text', 'flexiaddons'),
			'type'        => Controls_Manager::TEXT,
			'default'     => __('Button Text', 'flexiaddons'),
			'placeholder' => __('Enter The Button Text', 'flexiaddons'),
			'condition'   => [
				'show_btn' => 'yes'
			]
		]);

		//Button Link
		$this->add_control('btn_link', [
			'label'       => __('Button Link', 'flexiaddons'),
			'type'        => Controls_Manager::URL,
			'default'     => [
				'url' => '#'
			],
			'placeholder' => __('Enter The Button URL', 'flexiaddons'),
			'condition'   => [
				'show_btn' => 'yes'
			]
		]);

		//Btn Icon
		$this->add_control('btn_icon_new', [
			'label'            => __('Button Icon', 'flexiaddons'),
			'type'             => Controls_Manager::ICONS,
			'fa4compatibility' => 'btn_icon',
			'default'          => [
				'value'   => 'fas fa-arrow-alt-circle-right',
				'library' => 'fa-solid',
			],
			'condition'        => [
				'show_btn' => 'yes'
			]
		]);

		//Button Icon Position
		$this->add_control('btn_icon_position', [
			'label'     => __('Icon Position', 'flexiaddons'),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'right',
			'options'   => [
				'left'  => __('Before', 'flexiaddons'),
				'right' => __('After', 'flexiaddons'),
			],
			'condition' => [
				'btn_icon_new!' => '',
				'show_btn'      => 'yes'
			],
		]);

		//Button Icon Spacing
		$this->add_control('btn_icon_spacing', [
			'label'     => esc_html__('Icon Spacing', 'flexiaddons'),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 300,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 8,
			],
			'condition' => [
				'btn_icon_new!' => '',
				'show_btn'      => 'yes'
			],
			'selectors' => [
				'{{WRAPPER}} .kfa__btn-icon--right' => 'margin-left: {{SIZE}}px;',
				'{{WRAPPER}} .kfa__btn-icon--left'  => 'margin-right: {{SIZE}}px;',
			],
		]);

		//Clickable Infobox
		$this->add_control('_clickable', [
			'label'     => __('Clickable Box', 'flexiaddons'),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => __('Yes', 'flexiaddons'),
			'label_off' => __('No', 'flexiaddons'),
			'condition' => [
				'show_btn!' => 'yes'
			]
		]);

		//Info box Link
		$this->add_control('infobox_link', [
			'label'       => __('Infobox Link', 'flexiaddons'),
			'type'        => Controls_Manager::URL,
			'default'     => [
				'url' => '#'
			],
			'placeholder' => __('Enter The Infobox URL', 'flexiaddons'),
			'condition'   => [
				'_clickable' => 'yes'
			]
		]);

		$this->end_controls_section();

		//=== Style Controls ===
		$this->register_style_controls();
	}

	/**
	 * Register styles related controls
	 */
	protected function register_style_controls()
	{

		/**
		 * ======================
		 * | Icon Style |
		 * ======================
		 */

		$this->start_controls_section('style_media_icon', [
			'label'     => __('Icon', 'flexiaddons'),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'media_type' => 'icon',
			]
		]);

		// Icon Size
		$this->add_responsive_control('icon_size', [
			'label'     => __('Icon Size', 'flexiaddons'),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 40,
			],
			'range'     => [
				'px' => [
					'min'  => 20,
					'max'  => 100,
					'step' => 1,
				]
			],
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-infobox-icon i'   => 'font-size: {{SIZE}}px;',
				'{{WRAPPER}} .kfa-infobox .kfa-icon-wrapper>img' => 'width: {{SIZE}}px;',
			]
		]);
		// Icon Width
		$this->add_responsive_control('icon_width', [
			'label'      => __('Width', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px', '%'],
			'range'      => [
				'px' => [
					'min' => 1,
					'max' => 400,
				],
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox .kfa-infobox-icon i' => 'width: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [
				'media_type' => 'icon'
			]
		]);
		// Icon Height
		$this->add_responsive_control('icon_height', [
			'label'      => __('Height', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px'],
			'range'      => [
				'px' => [
					'min' => 1,
					'max' => 400,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox .kfa-infobox-icon i' => 'height: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [
				'media_type' => 'icon'
			]
		]);

		//Icon offset
		$this->add_control('icon_offset_toggle', [
			'label'        => __('Offset', 'flexiaddons'),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => __('None', 'flexiaddons'),
			'label_on'     => __('Custom', 'flexiaddons'),
			'return_value' => 'yes',
		]);

		$this->start_popover();

		$this->add_responsive_control('icon_offset_x', [
			'label'       => __('Offset X', 'flexiaddons'),
			'type'        => Controls_Manager::SLIDER,
			'size_units'  => ['px'],
			'range'       => [
				'px' => [
					'min' => -1000,
					'max' => 1000,
				]
			],
			'render_type' => 'ui',
			'condition'   => [
				'icon_offset_toggle' => 'yes'
			]
		]);

		$this->add_responsive_control('icon_offset_y', [
			'label'       => __('Offset Y', 'flexiaddons'),
			'type'        => Controls_Manager::SLIDER,
			'size_units'  => ['px'],
			'range'       => [
				'px' => [
					'min' => -1000,
					'max' => 1000,
				]
			],
			'render_type' => 'ui',
			'condition'   => [
				'icon_offset_toggle' => 'yes'
			],
			'selectors'   => [
				// Media translate styles
				'(desktop){{WRAPPER}} .kfa-icon-wrapper' => '-ms-transform: translate({{icon_offset_x.SIZE || 0}}{{UNIT}}, {{icon_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{icon_offset_x.SIZE || 0}}{{UNIT}}, {{icon_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{icon_offset_x.SIZE || 0}}{{UNIT}}, {{icon_offset_y.SIZE || 0}}{{UNIT}});',
				'(tablet){{WRAPPER}} .kfa-icon-wrapper'  => '-ms-transform: translate({{icon_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{icon_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{icon_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{icon_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{icon_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{icon_offset_y_tablet.SIZE || 0}}{{UNIT}});',
				'(mobile){{WRAPPER}} .kfa-icon-wrapper'  => '-ms-transform: translate({{icon_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{icon_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{icon_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{icon_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{icon_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{icon_offset_y_mobile.SIZE || 0}}{{UNIT}});',
			],
		]);

		$this->end_popover();

		//Icon Border radius
		$this->add_responsive_control('icon_border_radius', [
			'label'      => __('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px'],
			'default'    => [
				'unit' => 'px',
				'size' => 20,
			],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-icon .kfa-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_responsive_control('icon_margin', [
			'label'      => esc_html__('Margin', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', 'em', '%'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox .kfa-infobox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->start_controls_tabs('icon_style_tabs');

		$this->start_controls_tab('icon_normal', [
			'label' => esc_html__('Normal', 'flexiaddons'),
		]);

		$this->add_control('icon_color', [
			'label'     => esc_html__('Icon Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#4d4d4d',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-infobox-icon i' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('icon_bg_color', [
			'label'     => esc_html__('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-infobox-icon .kfa-icon-wrapper' => 'background: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'icon_border',
			'label'    => esc_html__('Border', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .kfa-infobox .kfa-icon-wrapper'
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'icon_shadow',
			'selector' => '{{WRAPPER}} .kfa-infobox .kfa-icon-wrapper',
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('icon_hover', [
			'label' => esc_html__('Hover', 'flexiaddons'),
		]);

		$this->add_control('icon_hover_animation', [
			'label' => esc_html__('Animation', 'flexiaddons'),
			'type'  => Controls_Manager::HOVER_ANIMATION,
		]);

		$this->add_control('icon_hover_color', [
			'label'     => esc_html__('Icon Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#4d4d4d',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox:hover .kfa-icon-wrapper i' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('icon_hover_bg_color', [
			'label'     => esc_html__('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox:hover .kfa-icon-wrapper' => 'background: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'icon_hover_border',
			'label'    => esc_html__('Border', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .kfa-infobox:hover .kfa-icon-wrapper'
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'icon_hover_shadow',
			'selector' => '{{WRAPPER}} .kfa-infobox:hover .kfa-icon-wrapper',
		]);

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * ======================
		 * | Image Style |
		 * ======================
		 */

		$this->start_controls_section('style_media_image', [
			'label'     => __('Image', 'flexiaddons'),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'media_type' => 'img',
			]
		]);

		$this->add_responsive_control('image_width', [
			'label'      => __('Width', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px', '%'],
			'range'      => [
				'px' => [
					'min' => 1,
					'max' => 400,
				],
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-icon .kfa-img-wrapper' => 'width: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [
				'media_type' => 'img'
			]
		]);

		$this->add_responsive_control('image_height', [
			'label'      => __('Height', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px'],
			'range'      => [
				'px' => [
					'min' => 1,
					'max' => 400,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-icon .kfa-img-wrapper' => 'height: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [
				'media_type' => 'img'
			]
		]);

		$this->add_control('image_offset_toggle', [
			'label'        => __('Offset', 'flexiaddons'),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => __('None', 'flexiaddons'),
			'label_on'     => __('Custom', 'flexiaddons'),
			'return_value' => 'yes',
		]);

		$this->start_popover();

		$this->add_responsive_control('image_offset_x', [
			'label'       => __('Offset X', 'flexiaddons'),
			'type'        => Controls_Manager::SLIDER,
			'size_units'  => ['px'],
			'range'       => [
				'px' => [
					'min' => -1000,
					'max' => 1000,
				]
			],
			'render_type' => 'ui',
			'condition'   => [
				'image_offset_toggle' => 'yes'
			]
		]);

		$this->add_responsive_control('image_offset_y', [
			'label'       => __('Offset Y', 'flexiaddons'),
			'type'        => Controls_Manager::SLIDER,
			'size_units'  => ['px'],
			'range'       => [
				'px' => [
					'min' => -1000,
					'max' => 1000,
				]
			],
			'render_type' => 'ui',
			'condition'   => [
				'image_offset_toggle' => 'yes'
			],
			'selectors'   => [
				// Media translate styles
				'(desktop){{WRAPPER}} .kfa-img-wrapper' => '-ms-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}});',
				'(tablet){{WRAPPER}} .kfa-img-wrapper'  => '-ms-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}});',
				'(mobile){{WRAPPER}} .kfa-img-wrapper'  => '-ms-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}});',
			],
		]);

		$this->end_popover();
		// img background
		$this->add_control('img_bg_color', [
			'label'     => esc_html__('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox-icon .kfa-img-wrapper' => 'background: {{VALUE}};',
			],
		]);

		// Image Spacing
		$this->add_responsive_control('img_spacing', [
			'label'      => __('Bottom Spacing', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-icon .kfa-img-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
			],
		]);

		// Image Padding
		$this->add_responsive_control('img_padding', [
			'label'      => __('Padding', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-icon .kfa-img-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
			],
		]);

		// Image Border
		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'img_border',
			'selector' => '{{WRAPPER}} .kfa-infobox-icon .kfa-img-wrapper',
		]);

		// Image Border Radius
		$this->add_responsive_control('img_border_radius', [
			'label'      => __('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-icon .kfa-img-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		//Image Box Shadow
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'img_box_shadow',
			'exclude'  => [
				'box_shadow_position',
			],
			'selector' => '{{WRAPPER}} .kfa-infobox-icon .kfa-img-wrapper'
		]);

		$this->end_controls_section();


		/**
		 * ======================
		 * | Number Style |
		 * ======================
		 */

		$this->start_controls_section('style_media_number', [
			'label'     => __('Number', 'flexiaddons'),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'media_type' => 'number',
			]
		]);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => __('number_typography', 'flexiaddons'),
				'label'    => __('Typography', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .kfa-infobox .kfa-number-wrapper'
			]
		);

		$this->start_controls_tabs('number_style_tabs');

		$this->start_controls_tab('number_normal', [
			'label' => esc_html__('Normal', 'flexiaddons'),
		]);

		$this->add_control('number_color', [
			'label'     => esc_html__('Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#4d4d4d',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-number-wrapper span' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('number_bg_color', [
			'label'     => esc_html__('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-number-wrapper span' => 'background: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'number_border',
			'label'    => esc_html__('Border', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .kfa-infobox .kfa-number-wrapper span'
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'number_shadow',
			'selector' => '{{WRAPPER}} .kfa-infobox .kfa-number-wrapper span',
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('number_hover', [
			'label' => esc_html__('Hover', 'flexiaddons'),
		]);


		$this->add_control('number_hover_animation', [
			'label' => esc_html__('Animation', 'flexiaddons'),
			'type'  => Controls_Manager::HOVER_ANIMATION
		]);

		//Number Hover Color
		$this->add_control('number_hover_color', [
			'label'     => esc_html__('Icon Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#4d4d4d',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox:hover .kfa-number-wrapper span' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('number_hover_bg_color', [
			'label'     => esc_html__('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox:hover .kfa-number-wrapper span' => 'background: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'number_hover_border',
			'label'    => esc_html__('Border', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .kfa-infobox:hover .kfa-number-wrapper span'
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'number_hover_shadow',
			'selector' => '{{WRAPPER}} .kfa-infobox:hover .kfa-number-wrapper span',
		]);

		$this->end_controls_tabs();

		$this->add_responsive_control('number_margin', [
			'label'      => esc_html__('Margin', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', 'em', '%'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox .kfa-infobox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_responsive_control('number_padding', [
			'label'      => esc_html__('Padding', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', 'em', '%'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox .kfa-number-wrapper span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_responsive_control('number_border_radius', [
			'label'      => __('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px'],
			'default'    => [
				'unit' => 'px',
				'size' => 20,
			],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-icon .kfa-number-wrapper span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();


		/**
		 * ======================
		 * | Title & Description |
		 * ======================
		 */

		$this->start_controls_section('title_description_style', [
			'label' => esc_html__('Title &amp; Description', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_STYLE
		]);

		$this->add_responsive_control('box_padding', [
			'label'      => __('Content Box Padding', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', 'em', '%'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_control('content_bg_color', [
			'label'     => esc_html__('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .flx-i-horizontal .kfa-infobox-content' => 'background: {{VALUE}};',
			],
			'condition' => [
				'info_box_layout' => 'flx-i-horizontal'
			]
		]);

		$this->add_control('content_bg_h_color', [
			'label'     => esc_html__('Background Hover Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .flx-i-horizontal:hover .kfa-infobox-content' => 'background: {{VALUE}};',
			],
			'condition' => [
				'info_box_layout' => 'flx-i-horizontal'
			]
		]);

		$this->add_control('title_heading', [
			'type'      => Controls_Manager::HEADING,
			'label'     => __('Title', 'flexiaddons'),
			'separator' => 'before'
		]);

		$this->add_responsive_control('title_margin', [
			'label'      => __('Margin', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		// Title Color
		$this->add_control('title_color', [
			'label'     => __('Text Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox-title' => 'color: {{VALUE}};',
			],
		]);

		// Title Hover Color
		$this->add_control('title_hover_color', [
			'label'     => __('Title Hover Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox:hover .kfa-infobox-title' => 'color: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __('Typography', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .kfa-infobox-title'
		]);

		$this->add_control('description_heading', [
			'type'      => Controls_Manager::HEADING,
			'label'     => __('Description', 'flexiaddons'),
			'separator' => 'before'
		]);

		//Desc Margin
		$this->add_responsive_control('description_margin', [
			'label'      => __('Margin', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', 'em', '%'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		//Desc Color
		$this->add_control('description_color', [
			'label'     => __('Text Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox-desc' => 'color: {{VALUE}};',
			],
		]);

		// Desc Hover Color
		$this->add_control('desc_hover_color', [
			'label'     => __('Text Hover Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox:hover .kfa-infobox-desc' => 'color: {{VALUE}};',
			],
		]);

		// Typography
		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'description_typography',
			'label'    => __('Typography', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .kfa-infobox-desc'
		]);

		$this->end_controls_section();

		/**
		 * ======================
		 * | Button |
		 * ======================
		 */

		$this->start_controls_section('button_style', [
			'label'     => esc_html__('Button', 'flexiaddons'),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'show_btn' => 'yes'
			]
		]);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .kfa-infobox .kfa-btn',
			]
		);

		$this->add_responsive_control('button_icon_size', [
			'label'      => __('Icon Size', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 16,
				'unit' => 'px',
			],
			'size_units' => ['px'],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox .kfa-btn i'   => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .kfa-infobox .kfa-btn img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
			],
		]);

		// Button Padding
		$this->add_responsive_control('button_padding', [
			'label'      => esc_html__('Button Padding', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox .kfa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		// Button Margin
		$this->add_responsive_control('button_margin', [
			'label'      => esc_html__('Button Margin', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .kfa-infobox .kfa-infobox-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		// Button Border Radius
		$this->add_control('button_border_radius', [
			'label'     => esc_html__('Border Radius', 'flexiaddons'),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => '5',
			],
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-btn' => 'border-radius: {{SIZE}}px;'
			],
		]);

		$this->start_controls_tabs('button_style_tabs');

		$this->start_controls_tab('button_normal', [
			'label' => esc_html__('Normal', 'flexiaddons')
		]);

		$this->add_control('button_text_color', [
			'label'     => esc_html__('Text Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-btn' => 'color: {{VALUE}};'
			]
		]);

		$this->add_control('button_bg_color', [
			'label'     => esc_html__('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333333',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-btn' => 'background: {{VALUE}};'
			]
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'button_border',
			'selector' => '{{WRAPPER}} .kfa-infobox .kfa-btn',
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'selector' => '{{WRAPPER}} .kfa-infobox .kfa-btn',
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('button_hover', [
			'label' => esc_html__('Hover', 'flexiaddons')
		]);

		$this->add_control('button_hover_text_color', [
			'label'     => esc_html__('Text Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-btn:hover' => 'color: {{VALUE}};'
			]
		]);

		$this->add_control('button_hover_bg_color', [
			'label'     => esc_html__('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333333',
			'selectors' => [
				'{{WRAPPER}} .kfa-infobox .kfa-btn:hover' => 'background: {{VALUE}};'
			]
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'button_hover_border',
			'selector' => '{{WRAPPER}} .kfa-infobox .kfa-btn:hover',
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_hover_box_shadow',
			'selector' => '{{WRAPPER}} .kfa-infobox .kfa-btn:hover',
		]);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	// Content - Icon/ Media
	protected function render_infobox_icon()
	{
		$settings = $this->get_settings();

		if ('none' == $settings['media_type']) {
			return;
		};

		$image     = $this->get_settings('image');
		$image_url = Group_Control_Image_Size::get_attachment_image_src($image['id'], 'thumbnail', $settings);
		$image_url = !empty($image_url) ? $image_url : $image['url'];

		$icon_migrated = isset($settings['__fa4_migrated']['icon_new']);
		$icon_is_new   = empty($settings['icon']);

		$this->add_render_attribute('icon', ['class' => ['kfa-infobox-icon']]);

		if ($icon_is_new || $icon_migrated) {
			$icon = $settings['icon_new']['value'];

			if (isset($icon['url'])) {

				$this->add_render_attribute('media', [
					'src' => $icon['url'],
					'alt' => esc_attr(get_post_meta($icon['id'], '_wp_attachment_image_alt', true))
				]);

				$icon_tag = '<img ' . $this->get_render_attribute_string('media') . '/>';
			} else {
				$this->add_render_attribute('media', 'class', $icon);
				$icon_tag = '<i ' . $this->get_render_attribute_string('media') . '></i>';
			}
		} else {
			$icon_tag = '<i class="' . esc_attr($settings['icon']) . '"></i>';
		}

		$icon_animation_class   = !empty($settings['icon_hover_animation']) ? 'elementor-animation-' . esc_attr($settings['icon_hover_animation']) : '';
		$number_animation_class = !empty($settings['number_hover_animation']) ? 'elementor-animation-' . esc_attr($settings['number_hover_animation']) : '';

?>

		<div <?php echo $this->get_render_attribute_string('icon'); ?>>
			<?php

			if ('img' == $settings['media_type']) {
				printf(
					' <div class="kfa-img-wrapper"><img src="%1$s" alt="%2$s"></div>',
					esc_url($image_url),
					esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true))
				);
			} elseif ('icon' == $settings['media_type']) {
				printf(' <div class="kfa-icon-wrapper %2$s">%1$s</div>', $icon_tag, $icon_animation_class);
			} elseif ('number' == $settings['media_type']) {
				printf(' <div class="kfa-number-wrapper %2$s"><span>%1$s</span></div>', $settings['number'], $number_animation_class);
			}

			?>
		</div>

	<?php

	}

	/**
	 * Render Infobox Content - Title
	 *
	 */

	protected function render_infobox_title()
	{
		$settings = $this->get_settings();

		$title_tag = $settings['title_tag'];

		$this->add_inline_editing_attributes('title', 'basic');
		$this->add_render_attribute('title', 'class', 'kfa-infobox-title');

		printf(
			'<%1$s %2$s>%3$s</%1$s>',
			$title_tag,
			$this->get_render_attribute_string('title'),
			$settings['title']
		);

	}


	/**
	 * Render Infobox Content - Description
	 *
	 */
	protected function render_infobox_content()
	{
		$settings = $this->get_settings();

		$this->add_inline_editing_attributes('description', 'basic');
		$this->add_render_attribute('description', 'class', 'kfa-infobox-desc');

		printf(
			'<div %1$s>%2$s</div>',
			$this->get_render_attribute_string('description'),
			$settings['description']
		);
	}

	/**
	 * Render Button
	 */
	protected function render_infobox_button()
	{
		$settings = $this->get_settings();

		if ('yes' == $settings['_clickable'] || 'yes' != $settings['show_btn']) {
			return;
		}

		$button_icon_migrated = isset($settings['__fa4_migrated']['btn_icon_new']);
		$button_icon_is_new   = empty($settings['btn_icon']);

		$has_link = !empty($settings['btn_link']['url']);

		$this->add_render_attribute('btn_link', 'class', 'kfa-btn');

		if ($has_link) {
			$this->add_render_attribute('btn_link', 'href', $settings['btn_link']['url']);
			if ($settings['btn_link']['is_external']) {
				$this->add_render_attribute('btn_link', 'target', '_blank');
			}

			if ($settings['btn_link']['nofollow']) {
				$this->add_render_attribute('btn_link', 'rel', 'nofollow');
			}
		}

		$this->add_render_attribute('btn_icon', 'class', 'kfa__btn-icon');
		$this->add_render_attribute('btn_icon', 'class', 'kfa__btn-icon--' . $settings['btn_icon_position']);

		if ($button_icon_is_new || $button_icon_migrated) {

			$icon = $settings['btn_icon_new']['value'];

			if (isset($icon['url'])) {
				$this->add_render_attribute('btn_icon', [
					'src' => esc_url($icon['url']),
					'alt' => esc_attr(get_post_meta($icon['id'], '_wp_attachment_image_alt', true)),
				]);

				$icon_tag = sprintf('<img %1$s />', $this->get_render_attribute_string('btn_icon'));
			} else {
				$this->add_render_attribute('btn_icon', 'class', $icon);
				$icon_tag = sprintf('<i %1$s></i>', $this->get_render_attribute_string('btn_icon'));
			}
		} else {
			$this->add_render_attribute('btn_icon', 'class', esc_attr($settings['btn_icon']));
			$icon_tag = sprintf('<i class="%1$s"></i>', $this->get_render_attribute_string('btn_icon'));
		}

		$this->add_inline_editing_attributes('btn_text', 'basic');
		$this->add_render_attribute('btn_text', 'class', 'kfa-btn-text');

		printf(
			'<a %1$s>%2$s</a>',
			$this->get_render_attribute_string('btn_link'),
			'right' == $settings['btn_icon_position'] ?
				sprintf('<span %1$s>%2$s</span> %3$s', $this->get_render_attribute_string('btn_text'), esc_attr($settings['btn_text']), $icon_tag) :
				sprintf('%3$s <span %1$s>%2$s</span>', $this->get_render_attribute_string('btn_text'), esc_attr($settings['btn_text']), $icon_tag)
		);
	}

	protected function render()
	{

		$settings = $this->get_settings_for_display();

		ob_start();
	?>
		<?php if ('flx-i-vertical' == $settings['info_box_layout']) { ?>
			<div class="kfa-infobox">
				<?php $this->render_infobox_icon(); ?>

				<div class="kfa-infobox-content">
					<?php $this->render_infobox_title(); ?>
					<?php $this->render_infobox_content(); ?>

					<?php if ('yes' == $settings['show_btn']) { ?>
						<div class="kfa-infobox-btn">
							<?php $this->render_infobox_button(); ?>
						</div>
					<?php } ?>
				</div>

			</div>
		<?php } else { ?>
			<div class="kfa-infobox <?php echo $settings['info_box_layout']; ?>">
				<div class="kfa-infobox-horizontal">
					<?php $this->render_infobox_icon(); ?>
				</div>
				<div class="kfa-infobox-content">
					<?php $this->render_infobox_title(); ?>
					<?php $this->render_infobox_content(); ?>
					<?php if ('yes' == $settings['show_btn']) { ?>
						<div class="kfa-infobox-btn">
							<?php $this->render_infobox_button(); ?>
						</div>
					<?php } ?>
				</div>

			</div>
		<?php } ?>
<?php
		$html = ob_get_clean();

		if (!empty($settings['_clickable']) && 'yes' == $settings['_clickable']) {
			$this->add_render_attribute('infobox_link', 'href', $settings['infobox_link']['url']);

			if (!empty($settings['infobox_link']['is_external'])) {
				$this->add_render_attribute('infobox_link', 'target', '_blank');
			}

			if (!empty($settings['infobox_link']['nofollow'])) {
				$this->add_render_attribute('infobox_link', 'rel', 'nofollow');
			}

			printf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('infobox_link'), $html);
		} else {
			echo $html;
		}
	}
}
