<?php


use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined('ABSPATH') || die();

class Flexi_Addons_Widget_Team extends Flexi_Addons_Widget_Base
{

	protected $key = 'team';


	/**
	 * Register content related controls
	 */
	protected function _register_controls()
	{

		/**
		 * ======================
		 * Section - Content - Style Presets
		 * ======================
		 */
		$this->start_controls_section(
			'_section_style_preset',
			[
				'label' => __('Style Preset', 'flexiaddons'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style_preset',
			[
				'label'   => __('Style Skin', 'flexiaddons'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'        => esc_html__('Style One', 'flexiaddons'),
					'overlay'        => esc_html__('Style Two', 'flexiaddons'),
					'overlay_circle' => esc_html__('Style Three', 'flexiaddons'),
					'style4' => esc_html__('Style Four', 'flexiaddons'),
					'style5' => esc_html__('Style Five', 'flexiaddons'),
					'style6' => esc_html__('Style Six', 'flexiaddons'),
					'style7' => esc_html__('Style Seven', 'flexiaddons'),
					'style8' => esc_html__('Style Eight', 'flexiaddons'),
					'style9' => esc_html__('Style Nine', 'flexiaddons'),
				],
			]
		);

		$this->end_controls_section();

		/**
		 * ======================
		 * Section - Content - Member image
		 * ======================
		 */
		$this->start_controls_section(
			'_section_member_image',
			[
				'label' => __('Member Image', 'flexiaddons'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __('Image', 'flexiaddons'),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'large',
				'separator' => 'none',
			]
		);

		$this->end_controls_section();

		/**
		 * ======================
		 * Section - Content - Member Content
		 * ======================
		 */
		$this->start_controls_section(
			'_section_member_content',
			[
				'label' => __('Member Content', 'flexiaddons'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'name',
			[
				'label'       => __('Name', 'flexiaddons'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => 'John Doe',
				'placeholder' => __('Type Member Name', 'flexiaddons'),
				'separator'   => 'before',
				'dynamic'     => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __('Job Title', 'flexiaddons'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __('Software Engineer', 'flexiaddons'),
				'placeholder' => __('Type Member Job Title', 'flexiaddons'),
				'dynamic'     => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'show_member_bio',
			[
				'label'   => __('Show Member Bio', 'flexiaddons'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->add_control(
			'bio',
			[
				'label'       => __('Short Bio', 'flexiaddons'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __('Add team member description here. Remove the text if not necessary.', 'flexiaddons'),
				'placeholder' => __('Add team member description here.', 'flexiaddons'),
				'rows'        => 5,
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'show_member_bio' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'     => __('Title HTML Tag', 'flexiaddons'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
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
				'default'   => 'h3',
				'toggle'    => false,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __('Alignment', 'flexiaddons'),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
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
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * ======================
		 * Section - Content - Social Profiles
		 * ======================
		 */

		$this->start_controls_section(
			'_section_socials',
			[
				'label' => __('Social Profiles', 'flexiaddons'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_socials',
			[
				'label'   => __('Show Social Profiles?', 'flexiaddons'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'socials_position',
			[
				'label'        => __('Social Profiles Position', 'flexiaddons'),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'   => [
						'title' => 'Left',
						'icon'  => 'eicon-h-align-left',
					],
					'bottom' => [
						'title' => 'Bottom',
						'icon'  => 'eicon-v-align-bottom',
					],
					'right'  => [
						'title' => 'Right',
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'      => 'bottom',
				'prefix_class' => 'kfa-position-',
				'condition'    => [
					'style_preset' => 'default'
				],
			]
		);

		$social = new Repeater();

		$social->add_control(
			'social_new',
			[
				'label'            => esc_html__('Icon', 'flexiaddons'),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default'          => [
					'value'   => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
			]
		);

		$social->add_control(
			'link',
			[
				'label'       => esc_html__('Link', 'flexiaddons'),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
				'placeholder' => esc_html__('Enter URL here', 'flexiaddons'),
			]
		);

		$social->add_control(
			'customize',
			[
				'label'          => __('Want To Customize?', 'flexiaddons'),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __('Yes', 'flexiaddons'),
				'label_off'      => __('No', 'flexiaddons'),
				'return_value'   => 'yes',
				'style_transfer' => true,
			]
		);

		$social->start_controls_tabs(
			'_tab_icon_colors',
			[
				'condition' => ['customize' => 'yes']
			]
		);

		$social->start_controls_tab(
			'_tab_icon_normal',
			[
				'label'     => __('Normal', 'flexiaddons'),
				'condition' => ['customize' => 'yes'],
			]
		);

		$social->add_control(
			'color',
			[
				'label'          => __('Text Color', 'flexiaddons'),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .kfa-team-socials > {{CURRENT_ITEM}} > i' => 'color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$social->add_control(
			'bg_color',
			[
				'label'          => __('Background Color', 'flexiaddons'),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .kfa-team-socials > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$social->end_controls_tab();

		$social->start_controls_tab(
			'_tab_icon_hover',
			[
				'label' => __('Hover', 'flexiaddons'),
			]
		);

		$social->add_control(
			'hover_color',
			[
				'label'          => __('Text Color', 'flexiaddons'),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .kfa-team-socials > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .kfa-team-socials > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$social->add_control(
			'hover_bg_color',
			[
				'label'          => __('Background Color', 'flexiaddons'),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .kfa-team-socials > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .kfa-team-socials > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$social->add_control(
			'hover_border_color',
			[
				'label'          => __('Border Color', 'flexiaddons'),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .kfa-team-socials > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .kfa-team-socials > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$social->end_controls_tab();

		$social->end_controls_tabs();

		$this->add_control(
			'socials',
			[
				'show_label'  => false,
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $social->get_controls(),
				'title_field' => '{{{ social_new.value.replace(/(far )?(fab )?(fa )?(fa\-)/gi, \'\').replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}} <i class="{{ social_new.value }}" style="float: right;"></i>',
				'default'     => [
					[
						'social_new' => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands'
						],
						'link'       => [
							'url'         => 'http://facebook.com',
							'is_external' => true
						]
					],
					[
						'social_new' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands'
						],
						'link'       => [
							'url'         => 'http://twitter.com',
							'is_external' => true
						]
					],
					[
						'social_new' => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'fa-brands'
						],
						'link'       => [
							'url'         => 'http://linkedin.com',
							'is_external' => true
						]
					],
					[
						'social_new' => [
							'value'   => 'fab fa-pinterest-p',
							'library' => 'fa-brands'
						],
						'link'       => [
							'url'         => 'http://pinterest.com',
							'is_external' => true
						]
					],
				],
			]
		);

		$this->end_controls_section();

		/**
		 * ======================
		 * Section - Content - Popup
		 * ======================
		 */

		$this->start_controls_section(
			'_section_popup',
			[
				'label' => __('Popup Details', 'flexiaddons'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_popup',
			[
				'label'   => esc_html__('Show Popup', 'flexiaddons'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'about_member',
			[
				'label'       => esc_html__('About Member', 'flexiaddons'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__('Add team member description here. Remove the text if not necessary.​', 'flexiaddons'),
				'placeholder' => esc_html__('About Member', 'flexiaddons'),
				'condition'   => [
					'show_popup' => 'yes'
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'popup_phone',
			[
				'label'       => esc_html__('Phone', 'flexiaddons'),
				'type'        => Controls_Manager::TEXT,
				'default'     => '+1 (859) 234-5678',
				'placeholder' => esc_html__('Phone Number', 'flexiaddons'),
				'condition'   => [
					'show_popup' => 'yes'
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'popup_email',
			[
				'label'       => esc_html__('Email', 'flexiaddons'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'hello@johndoe.com',
				'placeholder' => esc_html__('Email Address', 'flexiaddons'),
				'condition'   => [
					'show_popup' => 'yes'
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();

		// Style Controls
		$this->register_style_controls();
	}

	/**
	 * Register styles related controls
	 */
	protected function register_style_controls()
	{

		/**
		 * ======================
		 * Section - Style - Image
		 * ======================
		 */
		$this->start_controls_section(
			'_section_style_image',
			[
				'label' => __('Image', 'flexiaddons'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'      => __('Width', 'flexiaddons'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'%'  => [
						'min' => 20,
						'max' => 100,
					],
					'px' => [
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => __('Height', 'flexiaddons'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'%'  => [
						'min' => 20,
						'max' => 100,
					],
					'px' => [
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label'      => __('Margin', 'flexiaddons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => 20,
					'right'    => '',
					'bottom'   => 20,
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label'      => __('Padding', 'flexiaddons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .kfa-team-image img'
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => __('Border Radius', 'flexiaddons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .kfa-team.flexi-style-style8 .kfa-team-hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .kfa-team.flexi-style-style9 .kfa-team-hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .kfa-team.flexi-style-style8 .image-social' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .kfa-team.flexi-style-style9 .image-social' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_bg_color',
			[
				'label'     => __('Background Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-team-image img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'image_overlay_color',
			[
				'label'     => __('Overlay Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-team.flexi-style-overlay .kfa-team-hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .kfa-team.flexi-style-overlay_circle .kfa-team-image:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .kfa-team.flexi-style-style8 .kfa-team-hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .kfa-team.flexi-style-style9 .kfa-team-hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'style_preset' => [
						'overlay', 'overlay_circle', 'style8', 'style9'
					]
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .flexi-style-overlay .kfa-team-image, {{WRAPPER}} .kfa-team.flexi-style-default .kfa-team-image img',
			]
		);

		$this->end_controls_section();

		/**
		 * ======================
		 * Section - Style - Content
		 * ======================
		 */

		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => esc_html__('Content', 'flexiaddons'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'content_hover_color',
			[
				'label'     => esc_html__('Hover Background Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				//'default'   => '#9B9CAD',
				'selectors' => [
					'{{WRAPPER}} .flexi-style-style5:hover .kfa-team-content'  => 'background: {{VALUE}};',
					'{{WRAPPER}} .flexi-style-style6:hover .kfa-team-content'  => 'background: {{VALUE}};'
				],
				'condition' => [
					'style_preset' => ['style5', 'style6']
				]
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label'      => __('Border Radius', 'flexiaddons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'separator' => 'after',
				'selectors'  => [
					'{{WRAPPER}} .flexi-style-style5 .kfa-team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .flexi-style-style6 .kfa-team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style_preset' => ['style5', 'style6']
				]
			]
		);

		$this->add_control(
			'_name_heading',
			[
				'label' => __('Member Name', 'flexiaddons'),
				'type'  => Controls_Manager::HEADING,
				
			]
		);

		$this->add_control(
			'name_margin',
			[
				'label'      => __('Margin', 'flexiaddons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__('Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				//'default'   => '#9B9CAD',
				'selectors' => [
					'{{WRAPPER}} .kfa-team-member-name'  => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'name_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				//'default'   => '#9B9CAD',
				'selectors' => [
					'{{WRAPPER}} .flexi-style-style5:hover .kfa-team-content .kfa-team-member-name'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .flexi-style-style6:hover .kfa-team-content .kfa-team-member-name'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .kfa-team-member-name:hover'  => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .kfa-team-member-name',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'name_text_shadow',
				'selector' => '{{WRAPPER}} .kfa-team-member-name',
			]
		);

		//Job Title Style
		$this->add_control(
			'_title_heading',
			[
				'label'     => __('Member Job Title', 'flexiaddons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'title_margin',
			[
				'label'      => __('Margin', 'flexiaddons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 15,
					'left'     => 0,
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-member-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-team-member-title'  => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				//'default'   => '#9B9CAD',
				'selectors' => [
					'{{WRAPPER}} .flexi-style-style5:hover .kfa-team-content .kfa-team-member-title'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .flexi-style-style6:hover .kfa-team-content .kfa-team-member-title'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .kfa-team-member-name:hover'  => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .kfa-team-member-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .kfa-team-member-title',
			]
		);

		//Bio Style
		$this->add_control(
			'_bio_heading',
			[
				'label'     => __('Member Bio', 'flexiaddons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'bio_color',
			[
				'label'     => esc_html__('Description Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-team-member-bio' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'bio_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				//'default'   => '#9B9CAD',
				'selectors' => [
					'{{WRAPPER}} .flexi-style-style5:hover .kfa-team-content .kfa-team-member-bio'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .flexi-style-style6:hover .kfa-team-content .kfa-team-member-bio'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .kfa-team-member-name:hover'  => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'bio_typography',
				'selector' => '{{WRAPPER}} .kfa-team-member-bio',
			]
		);

		$this->end_controls_section();

		/**
		 * ======================
		 * Section - Style - Socials
		 * ======================
		 */
		$this->start_controls_section(
			'_section_style_socials',
			[
				'label' => __('Social Profiles', 'flexiaddons'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'socials_bg_color',
			[
				'label'     => __('Background Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .kfa-team .kfa-team-socials' => 'background: {{VALUE}} !important;',
				],
			]
		);

		// Socials - Divider - Style
		$this->add_control(
			'_socials_divider_heading',
			[
				'label'     => __('Divider', 'flexiaddons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after'
			]
		);

		$this->add_control(
			'socials_divider',
			[
				'label'     => __('Show Divider', 'flexiaddons'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'selectors' => [
					'{{WRAPPER}} .kfa-team-socials' => 'border-width: 1px;',
				],
			]
		);

		$this->add_control(
			'socials_divider_color',
			[
				'label'     => __('Divider Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ddd',
				'selectors' => [
					'{{WRAPPER}} .kfa-team-socials' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'socials_divider' => 'yes'
				]
			]
		);
		// Socials - Width and Height
		$this->add_control(
			'_socials_width_height',
			[
				'label'     => __('Width & Height', 'flexiaddons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		// Socials Width
		$this->add_responsive_control(
			'social_icon_width',
			[
				'label'      => __('Icon Width', 'flexiaddons'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-socials > a > i' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Socials Height
		$this->add_responsive_control(
			'social_icon_height',
			[
				'label'      => __('Icon Height', 'flexiaddons'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-socials > a > i' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Social Icon Alignment
		$this->add_responsive_control(
			'social_icon_align',
			[
				'label'     => __('Social Icon Alignment', 'flexiaddons'),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'options'   => [
					'flex-start'   => [
						'title' => __('Left', 'flexiaddons'),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'flexiaddons'),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end'  => [
						'title' => __('Right', 'flexiaddons'),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .kfa-team .kfa-team-socials' => 'justify-content: {{VALUE}};'
				]
			]
		);
		// Socials - Spacing - Style
		$this->add_control(
			'_socials_spacing_heading',
			[
				'label'     => __('Spacing', 'flexiaddons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);


		$this->add_responsive_control(
			'social_spacing',
			[
				'label'      => __('Social Profiles Spacing', 'flexiaddons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-socials' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_icon_spacing',
			[
				'label'      => __('Social Icon Spacing', 'flexiaddons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => 10,
					'right'    => 10,
					'bottom'   => 10,
					'left'     => 10,
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-socials > a > i ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_icon_size',
			[
				'label'      => __('Icon Size', 'flexiaddons'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-socials > a > i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'social_border',
				'selector' => '{{WRAPPER}} .kfa-team-socials > a > i'
			]
		);

		$this->add_responsive_control(
			'social_border_radius',
			[
				'label'      => __('Border Radius', 'flexiaddons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .kfa-team-socials > a > i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('_tab_social_colors');
		$this->start_controls_tab(
			'_tab_social_normal',
			[
				'label' => __('Normal', 'flexiaddons'),
			]
		);

		$this->add_control(
			'social_color',
			[
				'label'     => __('Text Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-team-socials > a > i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'social_bg_color',
			[
				'label'     => __('Background Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-team-socials > a > i' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_social_hover',
			[
				'label' => __('Hover', 'flexiaddons'),
			]
		);

		$this->add_control(
			'social_hover_color',
			[
				'label'     => __('Text Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-team-socials > a > i:hover, {{WRAPPER}} .kfa-team-socials > a > i:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_hover_bg_color',
			[
				'label'     => __('Background Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-team-socials > a > i:hover, {{WRAPPER}} .kfa-team-socials > a > i:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_hover_border_color',
			[
				'label'     => __('Border Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-team-socials > a > i:hover, {{WRAPPER}} .kfa-team-socials > a > i:focus' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'links_border_border!' => '',
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_popup',
			[
				'label' => __('Popup', 'flexiaddons'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		// Popup Memebr Name
		$this->add_control(
			'popup_name_heading',
			[
				'label' => __('Member Name', 'flexiaddons'),
				'type'  => Controls_Manager::HEADING,
			]
		);
		// Popup Member Name Color
		$this->add_control(
			'popup_name_color',
			[
				'label'     => esc_html__('Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				//'default'   => '#9B9CAD',
				'selectors' => [
					'{{WRAPPER}} .xs-modal-header .name' => 'color: {{VALUE}};',
				],
			]
		);
		// Popup Member Name Typo
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'popup_name_typography',
				'selector' => '{{WRAPPER}} .xs-modal-header .name',
			]
		);

		//Job Title Style
		$this->add_control(
			'popup_title_heading',
			[
				'label'     => __('Member Job Title', 'flexiaddons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		// Popup Title Color
		$this->add_control(
			'popup_title_color',
			[
				'label'     => esc_html__('Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-modal-header .title' => 'color: {{VALUE}};'
				],
			]
		);
		// Popup Title Typo
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'popup_title_typography',
				'selector' => '{{WRAPPER}} .xs-modal-header .title',
			]
		);

		//Popup Bio Style
		$this->add_control(
			'popup_bio_heading',
			[
				'label'     => __('Member Bio', 'flexiaddons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		//Popup Bio Color
		$this->add_control(
			'popup_bio_color',
			[
				'label'     => esc_html__('Description Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-modal-body'       => 'color: {{VALUE}};',
				],
			]
		);
		//Popup Bio Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'popup_bio_typography',
				'selector' => '{{WRAPPER}} .xs-modal-body',
			]
		);


		//Popup Phone Style
		$this->add_control(
			'popup_phone_number',
			[
				'label'     => __('Phone Number & Email', 'flexiaddons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		//Popup Phone Color
		$this->add_control(
			'popup_phone_email_color',
			[
				'label'     => esc_html__('Phone & Email Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-modal-footer .border-lists strong'       => 'color: {{VALUE}};',
				],
			]
		);

		//Popup Phone Number Color
		$this->add_control(
			'popup_phone_number_color',
			[
				'label'     => esc_html__('Number & Mail Color', 'flexiaddons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-modal-footer .border-lists a'       => 'color: {{VALUE}};',
				],
			]
		);
		//Popup Phone Number Typo
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'popup_phone_email_typo',
				'selector' => '{{WRAPPER}} .xs-modal-footer .border-lists',
			]
		);

		//Popup Social Icon Style
		$this->add_control(
			'popup_social_icon_style',
			[
				'label'     => __('Social Icon', 'flexiaddons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		//Popup Social Icon Alignment
		$this->add_responsive_control(
			'popup_social_icon_align',
			[
				'label'     => __('Social Icon Alignment', 'flexiaddons'),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'options'   => [
					'flex-start'   => [
						'title' => __('Left', 'flexiaddons'),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'flexiaddons'),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end'  => [
						'title' => __('Right', 'flexiaddons'),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .flexi-team-popup-modal .modal-content .modal-body .modal_content_wraper .kfa-team-socials' => 'justify-content: {{VALUE}};'
				]
			]
		);





		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$image   = '';
		$name    = '';
		$title   = '';
		$bio     = '';
		$socials = '';

		//Name Attributes
		$this->add_inline_editing_attributes('name', 'basic');
		$this->add_render_attribute('name', 'class', 'kfa-team-member-name');

		//Title Attributes
		$this->add_inline_editing_attributes('title', 'basic');
		$this->add_render_attribute('title', 'class', 'kfa-team-member-title');

		//Bio Attributes
		$this->add_inline_editing_attributes('bio', 'basic');
		$this->add_render_attribute('bio', 'class', 'kfa-team-member-bio');

?>

		<div class="kfa-team flexi-style-<?php echo $settings['style_preset']; ?>">

			<?php

			//Image
			if (!empty($settings['image']['url'])) {
				$this->add_render_attribute('image', 'src', esc_url($settings['image']['url']));
				$this->add_render_attribute('image', 'alt', esc_attr(get_post_meta($settings['image']['id'], '_wp_attachment_image_alt', true)));

				$image = sprintf('<div class="kfa-team-image"><img %1$s /></div>', $this->get_render_attribute_string('image'));

				if ('yes' == $settings['show_popup']) {
					$image = sprintf('<a href="#flexi_team_modal_%1$s" class="flexi-team-popup">%2$s</a>', $this->get_id(), $image);
				}
			}

			//Member Name
			if (!empty($settings['name'])) {
				$name = sprintf(' <%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string('name'), esc_html($settings['name']));

				if ('yes' == $settings['show_popup']) {
					$name = sprintf('<a href="#flexi_team_modal_%1$s" class="flexi-team-popup">%2$s</a>', $this->get_id(), $name);
				}
			}

			//Member Title
			if (!empty($settings['title'])) {
				$title = sprintf('<div %1$s>%2$s</div>', $this->get_render_attribute_string('title'), $settings['title']);
			}

			//Bio
			if ('yes' == $settings['show_member_bio'] && !empty($settings['bio'])) {
				$bio = sprintf('<p %1$s>%2$s</p>', $this->get_render_attribute_string('bio'), $settings['bio']);
			}

			$content = sprintf('<div class="kfa-team-content">%1$s</div>', $name . $title . $bio);

			//Social Profiles
			if ('yes' == $settings['show_socials'] && !empty($settings['socials'])) {
				$social_list = '';
				foreach ($settings['socials'] as $item) {

					$social_list .= sprintf(
						'<a href="%1$s" class="kfa-team-link elementor-repeater-item-%4$s" %2$s><i class="%3$s"></i></a>',
						esc_url($item['link']['url']),
						$item['link']['is_external'] ? ' target="_blank"' : '',
						esc_attr($item['social_new']['value']),
						esc_attr($item['_id'])
					);
				}

				$socials = sprintf('<div class="kfa-team-socials">%1$s</div>', $social_list);
			}
			


			$s5_content = sprintf('<div class="kfa-team-content">%1$s</div>', $name . $title . $bio . $socials);




			if (in_array($settings['style_preset'], ['overlay', 'overlay_circle'])) {
				echo $image;
				printf('<div class="kfa-team-hover">%1$s</div>', $content . $socials);
			}elseif(in_array($settings['style_preset'], ['style5'])){
				printf(' <div class="kfa-team-content-wrapper">%1$s</div>', $image . $s5_content);
			}elseif(in_array($settings['style_preset'], ['style6'])){
				printf(' <div class="kfa-team-content-wrapper">%1$s</div> %2$s', $image , $socials. $content);
			}elseif(in_array($settings['style_preset'], ['style8', 'style9'])){
				printf('<div class="image-social">%2$s<div class="kfa-team-hover">%1$s</div></div>', $socials, $image);
				printf(' <div class="kfa-team-content-wrapper">%1$s</div>', $content );
			}else {
				printf(' <div class="kfa-team-content-wrapper">%1$s</div> %2$s', $image . $content, $socials);
			}

			?>

			<?php $this->render_popup($socials); ?>

		</div>
	<?php }

	public function render_popup($socials)
	{
		$settings = $this->get_settings();

		$contacts = [
			'phone' => !empty($phone = $settings['popup_phone']) ? esc_attr($phone) : '',
			'email' => !empty($email = $settings['popup_email']) ? esc_attr($email) : ''
		];

	?>
		<div class="mfp-hide flexi-team-popup-modal" id="flexi_team_modal_<?php echo esc_attr($this->get_id()); ?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<i class="fas fa-times-circle flexi-modal-close" aria-hidden="true"></i>
					</div>

					<div class="modal-body">
						<div class="modal_image_wraper">
							<div class="modal-img">
								<?php echo !empty($url = $settings['image']['url']) ? '<img src="' . $url . '">' : ''; ?>
							</div>
						</div>
						<div class="modal_content_wraper">
							<div class="xs-modal-content">
								<div class="xs-modal-header">
									<h3 class="name"><?php echo esc_html($settings['name']); ?></h3>
									<h5 class="title"><?php echo esc_html($settings['title']); ?></h5>
								</div><!-- .xs-modal-header END -->
								<div class="xs-modal-body">
									<?php echo $settings['about_member']; ?>
								</div><!-- .xs-modal-body END -->
								<div class="xs-modal-footer">

									<?php

									if (!empty($contacts)) {
										echo '<div class="border-lists contacts">';
										foreach ($contacts as $key => $contact) {
											if ('phone' == $key) {
												printf('<div><strong>%1$s: </strong><a href="%2$s">%3$s</a></div>', __('Phone', 'flexiaddons'), 'tel:' . $contact, $contact);
											} elseif ('email' == $key) {
												printf('<div><strong>%1$s: </strong><a href="%2$s">%3$s</a></div>', __('Email', 'flexiaddons'), 'mailto:' . $contact, $contact);
											}
										}
										echo '</div>';
									}

									?>

									<?php echo $socials; ?>
								</div><!-- .xs-modal-footer END -->
							</div><!-- .xs-modal-content END -->
						</div>
					</div>
				</div>
			</div>
		</div>
<?php }
}
