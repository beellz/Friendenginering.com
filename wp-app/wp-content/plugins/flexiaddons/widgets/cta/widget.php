<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Scheme_Typography;

defined('ABSPATH') || die();

class Flexi_Addons_Widget_CTA extends Flexi_Addons_Widget_Base
{

	protected $key = 'cta';

	public function _register_controls()
	{

		/*=== Section Layout ===*/
		$this->start_controls_section('_section_layout', [
			'label' => __('Layout', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);
		// Layout
		$this->add_control('layout', [
			'label'       => __('Layout', 'flexiaddons'),
			'type'        => Controls_Manager::SELECT,
			'label_block' => true,
			'options'     => [
				'style1' => __('Style 1', 'flexiaddons'),
				'style2' => __('Style 2', 'flexiaddons'),
				'style3' => __('Style 3', 'flexiaddons'),
			],
			'default'     => 'style1',
		]);
		/**
		 * Condition: 'layout' => 'style1'
		 * 
		 * Content Type
		 */
		$this->add_control(
			'content_type',
			[
				'label' => esc_html__('Content Align', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'call-to-action-left',
				'label_block' => false,
				'options' => [
					'call-to-action-left' => esc_html__('Left', 'flexiaddons'),
					'call-to-action-center' => esc_html__('Center', 'flexiaddons'),
					'call-to-action-right' => esc_html__('Right', 'flexiaddons'),
				],
				'condition' => [
					'layout' => 'style1'
				]
			]
		);
		
		/**
		 * Condition: 'layout' => 'style3'
		 * 
		 * Icon
		 */
		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'flexiaddons'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-street-view',
					'library' => 'fa-solid',
				],
				'condition' => [
					'layout' => 'style3'
				]
			]
		);
		$this->end_controls_section();

		/**
		 *  ------------------------
		 * | Section Content |
		 * -------------------------
		 */
		$this->start_controls_section( '_section_content', [
			'label' => __( 'Content', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB
		] );
		/**
		 * Call to Action Title
		 */
		$this->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'flexiaddons'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => esc_html__('The Flexi Addons For Elementor', 'flexiaddons'),
				'placeholder' => __('The Flexi Addons For Elementor', 'flexiaddons'),
				'label_block' => true,
				'separator'   => 'before',
			]
		);
		/**
		 * Description
		 */
		$this->add_control(
			'description',
			[
				'label' => esc_html__('Content', 'flexiaddons'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__('Add a strong one liner supporting the heading above and giving users a reason to click on the button below.', 'flexiaddons'),
				'separator' => 'after',

			]
		);

		$this->end_controls_section();

		/**
		 *  ------------------------
		 * | Section Button |
		 * -------------------------
		 */
		$this->start_controls_section( '_section_button', [
			'label' => __( 'Button', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB
		] );
		// Button Icon
		$this->add_control(
			'btn_icon',
			[
				'label' => esc_html__('Icon', 'flexiaddons'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-long-arrow-alt-right',
					'library' => 'fa-solid',
				],
			]
		);
		/**
		 * Call to Action Button Text
		 */
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Button Text', 'flexiaddons')
			]
		);
		/**
		 * Call to Action Button URL
		 */
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__('Button Link', 'flexiaddons'),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'url' => 'http://',
					'is_external' => '',
				],
				'show_external' => true,
				'separator' => 'after'
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (call-to-action Style Settings)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'style_settings',
			[
				'label' => esc_html__('Call to Action Style', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		// Max Width Off On Button
		$this->add_control(
			'container_max_width',
			[
				'label' => esc_html__('Container Max Width', 'flexiaddons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('yes', 'flexiaddons'),
				'label_off' => __('no', 'flexiaddons'),
				'default' => 'yes',
			]
		);
		/**
		 * Condition: 'container_max_width' => 'yes'
		 * 
		 *  Max Width Value
		 */
		$this->add_responsive_control(
			'container_max_width_value',
			[
				'label' => __('Container Max Width (% or px)', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1170,
					'unit' => 'px',
				],
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-wraper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'container_max_width' => 'yes',
				],
			]
		);
		// Background Color
		$this->add_control(
			'background_color',
			[
				'label' => esc_html__('Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#6EC1E4',
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-wraper' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'color_type' => 'call-to-action-bg-color',
				]
			]
		);
		// Container Padding
		$this->add_responsive_control(
			'container_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-wraper .flexi-cta-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Container Margin
		$this->add_responsive_control(
			'container_margin',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-wraper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Container Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'container_border',
				'label' => esc_html__('Border', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flexi-cta-wraper',
			]
		);
		// Container Border Radius
		$this->add_control(
			'container_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-wraper' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Tab Style (Color & Typography)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'title_style_settings',
			[
				'label' => esc_html__('Color &amp; Typography ', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		// Title Style Heading
		$this->add_control(
			'title_style_heading',
			[
				'label' => esc_html__('Title Style', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
			]
		);
		// Title Color
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ec5a36',
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-title h2' => 'color: {{VALUE}};',
				],
			]
		);
		// Title Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .flexi-cta-title h2',
			]
		);
		// Description Heading
		$this->add_control(
			'description_heading',
			[
				'label' => esc_html__('Description Style', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		// Description Color
		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#666',
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-description p' => 'color: {{VALUE}};',
				],
			]
		);
		// Description Typhography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .flexi-cta-description p',
			]
		);

		// Description Padding
		$this->add_responsive_control(
			'description_padding',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'button_style_settings',
			[
				'label' => esc_html__('Button Style', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		// Button Effect
		$this->add_control(
			'button_effect_type',
			[
				'label' => esc_html__('Effect', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'label_block' => false,
				'options' => [
					'default' => esc_html__('Default', 'flexiaddons'),
					'top-to-bottom' => esc_html__('Top to Bottom', 'flexiaddons'),
					'left-to-right' => esc_html__('Left to Right', 'flexiaddons'),
				],
			]
		);
		// Icon Spacing
		$this->add_responsive_control(
			'cta_icon_spacing',
			[
				'label' => __('Icon Spacing', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-wraper .cta-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Button Padding
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Button Margin
		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Button Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .flexi-cta-button',
			]
		);

		$this->start_controls_tabs('buttons_tab');

		// Normal Button Tab
		$this->start_controls_tab('button_tab_normal', ['label' => esc_html__('Normal', 'flexiaddons')]);
		// Button Text Color
		$this->add_control(
			'button_normal_text_color',
			[
				'label' => esc_html__('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-button' => 'color: {{VALUE}};',
				],
			]
		);
		// Button Background Color
		$this->add_control(
			'button_normal_bg_color',
			[
				'label' => esc_html__('Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(236,90,54,1.00)',
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-button' => 'background: {{VALUE}};',
				],
			]
		);
		// Button Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_normal_border',
				'label' => esc_html__('Border', 'flexiaddons'),
				'selector' => '{{WRAPPER}} .flexi-cta-button',
			]
		);
		// Button Border Radius
		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-button' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_tab();

		// Hover Button Tab
		$this->start_controls_tab('button_hover', ['label' => esc_html__('Hover', 'flexiaddons')]);
		// Button Hover Color
		$this->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-button:hover' => 'color: {{VALUE}};',
				],
			]
		);
		// Button Hover Background Color
		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#3F51B5',
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-button:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .flexi-cta-button:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .flexi-cta-wraper .flexi-cta-container .flexi-cta-button.effect-2::after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .flexi-cta-wraper .flexi-cta-container .flexi-cta-button.effect-1::after' => 'background: {{VALUE}};',
				],
			]
		);
		// Button Hover Border Color
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		// Button Hover Border Radius
		$this->add_control(
			'button_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-cta-button:hover' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// Button BoxShadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .flexi-cta-button',
				'separator' => 'before'
			]
		);

		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style (Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'icon_style_settings',
			[
				'label' => esc_html__('Icon Style', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'style3'
				]
			]
		);
		//Icon Size
		$this->add_control(
			'button_icon_size',
			[
				'label' => esc_html__('Font Size', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80
				],
				'range' => [
					'px' => [
						'max' => 160,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-cat-icon' => 'font-size: {{SIZE}}px;',
				],
			]
		);
		// Icon Color
		$this->add_control(
			'button_icon_color',
			[
				'label' => esc_html__('Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#666',
				'selectors' => [
					'{{WRAPPER}} .flexi-cat-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$target = $settings['button_link']['is_external'] ? 'target="_blank"' : '';
		$nofollow = $settings['button_link']['nofollow'] ? 'rel="nofollow"' : '';


		// Is Basic call-to-action Content Center or Not
		if ('call-to-action-center' === $settings['content_type']) {
			$flexi_cta_alignment = 'flexi-cat-center';
		} elseif ('call-to-action-right' === $settings['content_type']) {
			$flexi_cta_alignment = 'flexi-cat-right';
		} else {
			$flexi_cta_alignment = 'flexi-cat-left';
		}
		// Button Effect
		if ('left-to-right' == $settings['button_effect_type']) {
			$call_to_action_btn_effect = 'effect-2';
		} elseif ('top-to-bottom' == $settings['button_effect_type']) {
			$call_to_action_btn_effect = 'effect-1';
		} else {
			$call_to_action_btn_effect = '';
		}



		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'description', 'basic' );
?>
		<?php if ('style1' == $settings['layout']) : ?>
			<div class="flexi-cta-wraper">
				<div class="flexi-cta-container <?php echo esc_attr($flexi_cta_alignment); ?>">
					<div class="flexi-cta-title">
						<h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
					</div>
					<div class="flexi-cta-description">
						<p <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $settings['description']; ?></p>
					</div>

					<?php if ( ! empty( $settings['button_text'] ) ) { ?>
                        <a class="flexi-cta-button <?php echo esc_attr( $call_to_action_btn_effect ); ?>" href="<?php echo $settings['button_link']['url']; ?>" <?php echo $target;
						echo $nofollow; ?>><?php echo $settings['button_text']; ?>
						<?php if('' != $settings['btn_icon']): ?>
							<span class="cta-btn-icon"><?php Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'false']); ?></span>
						<?php endif; ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if ('style2' == $settings['layout']) : ?>
			<div class="flexi-cta-wraper">
				<div class="flexi-cta-container flexi-cta-style2 <?php echo esc_attr($flexi_cta_alignment); ?>">
					<div class="flexi-cta-display">
						<div class="flexi-cta-title">
							<h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
						</div>
						<div class="flexi-cta-description">
							<p <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $settings['description']; ?></p>
						</div>
					</div>
					<div class="flixi-cta-st2-btn">
						<?php if ( ! empty( $settings['button_text'] ) ) { ?>
                            <a class="flexi-cta-button <?php echo esc_attr( $call_to_action_btn_effect ); ?>" href="<?php echo $settings['button_link']['url']; ?>" <?php echo $target;
							echo $nofollow; ?>><?php echo $settings['button_text']; ?>
							<?php if('' != $settings['btn_icon']): ?>
								<span class="cta-btn-icon"><?php Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'false']); ?></span>
							<?php endif; ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if ('style3' == $settings['layout']) : ?>
			<div class="flexi-cta-wraper">
				<div class="flexi-cta-container flexi-cta-style3 <?php echo esc_attr($flexi_cta_alignment); ?>">
					<div class="flexi-cat-icon">
						<?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'false']); ?>
					</div>
					<div class="flexi-cta-display">
						<div class="flexi-cta-title">
							<h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
						</div>
						<div class="flexi-cta-description">
							<p <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $settings['description']; ?></p>
						</div>
					</div>
					<div class="flixi-cta-st3-btn">
						<?php if ( ! empty( $settings['button_text'] ) ) { ?>
                            <a class="flexi-cta-button <?php echo esc_attr( $call_to_action_btn_effect ); ?>" href="<?php echo $settings['button_link']['url']; ?>" <?php echo $target;
							echo $nofollow; ?>><?php echo $settings['button_text']; ?>
							<?php if('' != $settings['btn_icon']): ?>
							<span class="cta-btn-icon"><?php Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'false']); ?></span>
							<?php endif; ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
<?php
	}
}
