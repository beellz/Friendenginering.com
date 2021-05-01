<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Frontend;

defined('ABSPATH') || die();

class Flexi_Addons_Widget_Accordion extends Flexi_Addons_Widget_Base
{

	protected $key = 'accordion';

	public function _register_controls()
	{

		/*=== Section Layout ===*/
		$this->start_controls_section('_section_layout', [
			'label' => __('Layout', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);

		//layout
		$this->add_control('layout', [
			'label'       => __('Layout', 'flexiaddons'),
			'type'        => Controls_Manager::SELECT,
			'label_block' => true,
			'options'     => [
				'style1' => __('Default', 'flexiaddons'),
				'style2' => __('Side Curve', 'flexiaddons')
			],
			'default'     => 'style1',
		]);

		$this->end_controls_section();

		/*=== Section Accordion ===*/
		$this->start_controls_section('_section_accordion', [
			'label' => esc_html__('Accordion', 'flexiaddons'),
		]);

		$repeater = new Repeater();

		//title
		$repeater->add_control('title', [
			'label'       => esc_html__('Title', 'flexiaddons'),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		]);

		//is active
		$repeater->add_control('is_active', [
			'label'   => esc_html__('Keep this slide open? ', 'flexiaddons'),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'no'
		]);

		//Content Type
		$repeater->add_control('flx_ac_text_type', [
			'label' => __('Content Type', 'flexiaddons'),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'content' => __('Content', 'flexiaddons'),
				'template' => __('Saved Templates', 'flexiaddons'),
			],
			'default' => 'content',
		]);


		//Primay Templates
		$repeater->add_control('flx_primary_templates', [
			'label' => __('Choose Template', 'flexiaddons'),
			'type' => Controls_Manager::SELECT,
			'options' => get_elementor_page_templates(),
			'condition' => [
				'flx_ac_text_type' => 'template',
			],
		]);

		//Content
		$repeater->add_control('content', [
			'label'       => esc_html__('Description', 'flexiaddons'),
			'type'        => Controls_Manager::WYSIWYG,
			'label_block' => true,
			'condition' => [
				'flx_ac_text_type' => 'content',
			],
		]);

		//Accordions
		$this->add_control('accordions', [
			'label'       => esc_html__('Content', 'flexiaddons'),
			'type'        => Controls_Manager::REPEATER,
			'separator'   => 'before',
			'title_field' => '{{ title }}',
			'default'     => [
				[
					'title'     => 'Section 1',
					'content'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					'is_active' => 'no'
				],
				[
					'title'     => 'Section 2',
					'content'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					'is_active' => 'no'
				],
				[
					'title'     => 'Section 3',
					'content'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					'is_active' => 'no'
				],
			],
			'fields'      => $repeater->get_controls(),
		]);

		$this->end_controls_section();

		/*=== Section Icon ===*/
		$this->start_controls_section('_section_icon', [
			'label' => esc_html__('Icon', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB,
		]);

		//Icon Position
		$this->add_control('icon_position', [
			'label'     => __('Icon Position', 'flexiaddons'),
			'type'      => Controls_Manager::CHOOSE,
			'default'   => 'right',
			'options'   => [
				'left'  => [
					'title' => esc_html__('Left', 'flexiaddons'),
					'icon'  => 'fa fa-arrow-left',
				],
				'both'  => [
					'title' => esc_html__('Both', 'flexiaddons'),
					'icon'  => 'fa fa-arrows-alt-h',
				],
				'right' => [
					'title' => esc_html__('Right', 'flexiaddons'),
					'icon'  => 'fa fa-arrow-right',
				],
			],
			'separator' => 'before',

		]);

		//Left Icon
		$this->add_control('left_icon_new', [
			'label'            => esc_html__('Left Icon', 'flexiaddons'),
			'type'             => Controls_Manager::ICONS,
			'fa4compatibility' => 'left_icon',
			'default'          => [
				'value'   => 'fa fa-chevron-down',
				'library' => 'solid',
			],
			'condition'        => [
				'icon_position' => ['left', 'both']
			]
		]);

		//Left Icon - Active
		$this->add_control('left_icon_active_new', [
			'label'            => esc_html__('Left Icon Active', 'flexiaddons'),
			'type'             => Controls_Manager::ICONS,
			'fa4compatibility' => 'left_icon_active',
			'default'          => [
				'value'   => 'fa fa-chevron-up',
				'library' => 'solid',
			],
			'condition'        => [
				'icon_position' => ['left', 'both']
			]
		]);

		//Right Icon
		$this->add_control('right_icon_new', [
			'label'            => esc_html__('Right Icon', 'flexiaddons'),
			'type'             => Controls_Manager::ICONS,
			'fa4compatibility' => 'right_icon',
			'default'          => [
				'value'   => 'fa fa-chevron-down',
				'library' => 'solid',
			],
			'condition'        => [
				'icon_position' => ['right', 'both']
			]
		]);

		//Right Icon - Active
		$this->add_control('right_icon_active_new', [
			'label'            => esc_html__('Right Icon Active', 'flexiaddons'),
			'type'             => Controls_Manager::ICONS,
			'fa4compatibility' => 'right_icon_active',
			'default'          => [
				'value'   => 'fa fa-chevron-up',
				'library' => 'solid',
			],
			'condition'        => [
				'icon_position' => ['right', 'both']
			]
		]);

		$this->end_controls_section();

		/*=== Section Extras ===*/
		$this->start_controls_section('_section_extras', [
			'label' => esc_html__('Extras', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB
		]);

		//Multiple Items Open
		$this->add_control('multiple_item', [
			'label'   => __('Multiple Items Open?', 'flexiaddons'),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		]);

		//On Hover Open?
		$this->add_control('on_hover', [
			'label'   => __('On hover Open?', 'flexiaddons'),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'no'
		]);


		$this->end_controls_section();

		/* ===Style Controls=== */
		$this->register_style_controls();
	}

	public function register_style_controls()
	{

		/* ===Section Style Title=== */
		$this->start_controls_section('_section_style_accordion', [
			'label' => esc_html__('Accordion', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		//Bottom Spacing
		$this->add_control('accordion_spacing', [
			'label'      => __('Bottom Spacing', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
			]
		]);

		//Accordion border
		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'accordion_border',
			'label'    => esc_html__('Border', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .flexi-accordion-item',
		]);

		//accordion border radius
		$this->add_control('accordion_border_radius', [
			'label'      => esc_html__('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		//Accordion Box shadow
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'accordion_box_shadow',
			'label'    => esc_html__('Box Shadow', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .flexi-accordion-item',
		]);

		$this->end_controls_section();

		/* ===Section Style Title=== */
		$this->start_controls_section('_section_style_title', [
			'label' => esc_html__('Title', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		//Title Typography
		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'ekit_accordion_title_typography',
			'selector' => '{{WRAPPER}} .flexi-accordion .flexi-accordion-title',
		]);

		$this->start_controls_tabs('_title_style_tabs');

		//=== Title Normal Tab
		$this->start_controls_tab('title_normal_tab', [
			'label' => esc_html__('Normal', 'flexiaddons'),
		]);

		//Title normal color
		$this->add_control('title_normal_color', [
			'label'     => esc_html__('Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-accordion-item .flexi-accordion-title' => 'color: {{VALUE}};',
			],
		]);

		//Title normal BG
		$this->add_group_control(Group_Control_Background::get_type(), [
			'name'     => 'title_normal_bg',
			'label'    => esc_html__('Background', 'flexiaddons'),
			'types'    => ['classic', 'gradient'],
			'selector' => '{{WRAPPER}} .flexi-accordion-header',
		]);

		//Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'title_normal_shadow',
				'selector'  => '{{WRAPPER}} .flexi-accordion-header',
			]
		);

		//Title normal border radius
		$this->add_control('title_normal_border_radius', [
			'label'      => esc_html__('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->end_controls_tab();

		//==== Title Active Tab
		$this->start_controls_tab('title_active_tab', [
			'label' => esc_html__('Active', 'flexiaddons'),
		]);

		//Title active color
		$this->add_control('title_active_color', [
			'label'     => esc_html__('Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-title' => 'color: {{VALUE}};',
			],
		]);

		//Title active BG
		$this->add_group_control(Group_Control_Background::get_type(), [
			'name'     => 'title_active_bg',
			'label'    => esc_html__('Background', 'flexiaddons'),
			'types'    => ['classic', 'gradient'],
			'selector' => '{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-header',
		]);
		
		//Title active box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'title_active_shadow',
				'selector'  => '{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-header',
			]
		);

		//Title active border radius
		$this->add_control('title_active_border_radius', [
			'label'      => esc_html__('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		//Title Divider
		$this->add_control('_title_divide', [
			'type'  => Controls_Manager::DIVIDER,
			'style' => 'thick',
		]);

		//Title padding
		$this->add_responsive_control('title_left_spacing', [
			'label'      => esc_html__('Left Spacing', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px'],
			'range'      => [
				'px' => [
					'min' => -100,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-title' => 'margin-left: {{SIZE}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();


		//=== Section Style Description ===
		$this->start_controls_section('_section_content_style', [
			'label' => esc_html__('Description', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		//Content Color
		$this->add_control('content_color', [
			'label'     => esc_html__('Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-accordion-body' => 'color: {{VALUE}};',
			],
		]);

		//Content Typography
		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'selector' => '{{WRAPPER}} .flexi-accordion-body',
		]);

		//Content BG
		$this->add_group_control(Group_Control_Background::get_type(), [
			'name'     => 'content_bg',
			'label'    => esc_html__('Background', 'flexiaddons'),
			'types'    => ['classic', 'gradient'],
			'selector' => '{{WRAPPER}} .flexi-accordion-body',
		]);

		//Content Border Radius
		$this->add_control('content_border_radius', [
			'label'      => esc_html__('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		//Content Padding
		$this->add_responsive_control('content_padding', [
			'label'      => esc_html__('Padding', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();

		/*====Section Style Icon =====*/

		$this->start_controls_section('_section_style_icon', [
			'label' => __('Icon', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_STYLE
		]);






		$this->start_controls_tabs('_icon_style_tabs');

		//=== Title Normal Tab
		$this->start_controls_tab('icon_normal_tab', [
			'label' => esc_html__('Normal', 'flexiaddons'),
		]);

		//Icon Normal Color
		$this->add_control('icon_normal_color', [
			'label'     => __('Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-accordion-icon-right-group i' => 'color: {{VALUE}};',
				'{{WRAPPER}} .flexi-accordion-icon-left-group i'  => 'color: {{VALUE}};',
			]
		]);

		//Icon Normal Background
		$this->add_control('icon_normal_bg', [
			'label'     => __('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-accordion-icon-left-group'  => 'background-color: {{VALUE}}',
				'{{WRAPPER}} .flexi-accordion-icon-right-group' => 'background-color: {{VALUE}}',
			]
		]);

		//Icon Normal border
		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'icon_normal_border',
			'label'    => esc_html__('Border', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .flexi-accordion-icon-left-group,
                             {{WRAPPER}} .flexi-accordion-icon-right-group',
		]);

		//Icon Normal Border Radius
		$this->add_control('icon_normal_border_radius', [
			'label'      => esc_html__('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-icon-left-group'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .flexi-accordion-icon-right-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);



		$this->end_controls_tab();

		//==== Title Active Tab
		$this->start_controls_tab('icon_active_tab', [
			'label' => esc_html__('Active', 'flexiaddons'),
		]);


		//Icon Normal Color
		$this->add_control('icon_active_color', [
			'label'     => __('Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-icon-right-group i' => 'color: {{VALUE}};',
				'{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-icon-left-group i'  => 'color: {{VALUE}};',
			]
		]);

		//Icon Normal Background
		$this->add_control('icon_active_bg', [
			'label'     => __('Background Color', 'flexiaddons'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-icon-left-group'  => 'background-color: {{VALUE}}',
				'{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-icon-right-group' => 'background-color: {{VALUE}}',
			]
		]);

		//Icon Normal border
		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'icon_active_border',
			'label'    => esc_html__('Border', 'flexiaddons'),
			'selector' => '{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-icon-left-group,
                             {{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-icon-right-group',
		]);

		//Icon Normal Border Radius
		$this->add_control('icon_active_border_radius', [
			'label'      => esc_html__('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-icon-left-group'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .flexi-accordion-item.show .flexi-accordion-icon-right-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		

		$this->end_controls_tab();

		$this->end_controls_tabs();

		
		//Icon Size
		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => __('Icon Size', 'flexiaddons'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .flexi-accordion-icon-normal i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .flexi-accordion-icon-active i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		//Icon Normal Padding
		$this->add_control('icon_normal_padding', [
			'label'      => esc_html__('Padding', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-accordion-icon-left-group'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .flexi-accordion-icon-right-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);


		$this->end_controls_section();
	}

	public function render()
	{
		$settings = $this->get_settings_for_display();

		extract($settings);
		$unique_id = uniqid();

		$on_hover = 'yes' == $on_hover ? 'on_hover' : '';

?>

		<!-- Start flexi-accordion -->
		<div class="flexi-accordion <?php echo $layout; ?>" id="accordion-<?php echo $unique_id; ?>" data-multiple="<?php echo $multiple_item; ?>">

			<?php

			foreach ($accordions as $i => $accordion) {
				extract($accordion);

				$active = 'yes' == $is_active ? ' show' : '';


			?>
				<div class="flexi-accordion-item <?php echo $active; ?>">
					<!-- Header -->
					<div class="flexi-accordion-header flexi-accordion-header-tigger<?php echo $on_hover; ?>">

						<?php if (($icon_position == 'left' || $icon_position == 'both')) { ?>
							<div class="flexi-accordion-icon-left-group">

								<div class="flexi-accordion-icon-normal">
									<!-- Left Icon -->
									<?php echo flexi_get_icon($settings, 'left_icon'); ?>
								</div>

								<div class="flexi-accordion-icon-active">
									<!-- Active Icon -->
									<?php echo flexi_get_icon($settings, 'left_icon_active'); ?>
								</div>

							</div>

						<?php } ?>

						<span class="flexi-accordion-title"><?php echo esc_html($title); ?></span>

						<?php if (($icon_position == 'right' || $icon_position == 'both')) { ?>
							<div class="flexi-accordion-icon-right-group">

								<div class="flexi-accordion-icon-normal">
									<!-- Left Icon -->
									<?php echo flexi_get_icon($settings, 'right_icon'); ?>
								</div>

								<div class="flexi-accordion-icon-active">
									<!-- Active Icon -->
									<?php echo flexi_get_icon($settings, 'right_icon_active'); ?>
								</div>

							</div>

						<?php } ?>

						<?php if ('curve-shape' == $layout) { ?>
							<svg version="1.1" class="svg-shape" x="0px" y="0px" viewBox="0 0 541 64" height="64" preserveAspectRatio="none">

								<polygon class="path" points="85,55 81,55 51,55 42.5,64 34,55 0,55 0,0 34.4,0 42.5,9.5 50.6,0 81,0 85,0 541,0 541,55 " />
							</svg>
						<?php } ?>

					</div>

					<!-- Body -->
					<div class="flexi-accordion-body icon-position-<?php echo $icon_position; ?>">

						<div class="flx_ac_content">
							<?php 
							$flx_find_default_tab[] = $accordion['is_active']; ?>
							<div class="clearfix <?php echo esc_attr($accordion['is_active']); ?>">
								<?php if ('content' == $accordion['flx_ac_text_type']) : ?>
									<?php echo do_shortcode($accordion['content']); ?>
								<?php elseif ('template' == $accordion['flx_ac_text_type']) : ?>
									<?php
									if (!empty($accordion['flx_primary_templates'])) {
										$flx_template_id = $accordion['flx_primary_templates'];
										$flx_frontend = new Frontend;
										echo $flx_frontend->get_builder_content($flx_template_id, true);
									}
									?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

			<?php } ?>

		</div>
		<!-- End flexi-accordion -->

<?php }
}
