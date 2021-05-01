<?php


use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use \Elementor\Frontend;

defined('ABSPATH') || die();

class Flexi_Addons_Widget_Content_Toggle extends Flexi_Addons_Widget_Base
{

	protected $key = 'content-toggle';

	/**
	 * Get all elementor page templates
	 *
	 * @return array
	 */
	public function get_elementor_page_templates($type = null)
	{
		$args = [
			'post_type' => 'elementor_library',
			'posts_per_page' => -1,
		];

		if ($type) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'elementor_library_type',
					'field' => 'slug',
					'terms' => $type,
				],
			];
		}

		$page_templates = get_posts($args);
		$options = array();

		if (!empty($page_templates) && !is_wp_error($page_templates)) {
			foreach ($page_templates as $post) {
				$options[$post->ID] = $post->post_title;
			}
		} else {
			$options[] = __('No ' . ucfirst($type) . ' Found', 'flexiaddons');
		}
		return $options;
	}

	public function _register_controls()
	{
		/**
		 * Content Tab: Primary
		 */
		$this->start_controls_section(
			'section_primary',
			[
				'label' => __('Primary', 'flexiaddons'),
			]
		);
		// Primay Label
		$this->add_control(
			'primary_label',
			[
				'label' => __('Label', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Limited', 'flexiaddons'),
			]
		);
		// Primary Content Type
		$this->add_control(
			'primary_content_type',
			[
				'label' => __('Content Type', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'image' => __('Image', 'flexiaddons'),
					'content' => __('Content', 'flexiaddons'),
					'template' => __('Saved Templates', 'flexiaddons'),
				],
				'default' => 'content',
			]
		);
		// Primary Templates
		$this->add_control(
			'primary_templates',
			[
				'label' => __('Choose Template', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'options' => $this->get_elementor_page_templates(),
				'condition' => [
					'primary_content_type' => 'template',
				],
			]
		);
		// Primary Content
		$this->add_control(
			'primary_content',
			[
				'label' => __('Content', 'flexiaddons'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('Limited Content', 'flexiaddons'),
				'condition' => [
					'primary_content_type' => 'content',
				],
			]
		);
		// Primary Image
		$this->add_control(
			'primary_image',
			[
				'label' => __('Image', 'flexiaddons'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'primary_content_type' => 'image',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * Content Tab: Secondary
		 */
		$this->start_controls_section(
			'section_secondary',
			[
				'label' => __('Secondary', 'flexiaddons'),
			]
		);
		// Secondary Label
		$this->add_control(
			'secondary_label',
			[
				'label' => __('Label', 'flexiaddons'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Unlimited', 'flexiaddons'),
			]
		);
		// Secondary Content Type
		$this->add_control(
			'secondary_content_type',
			[
				'label' => __('Content Type', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'image' => __('Image', 'flexiaddons'),
					'content' => __('Content', 'flexiaddons'),
					'template' => __('Saved Templates', 'flexiaddons'),
				],
				'default' => 'content',
			]
		);
		// Secondary Templates
		$this->add_control(
			'secondary_templates',
			[
				'label' => __('Choose Template', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'options' => $this->get_elementor_page_templates(),
				'condition' => [
					'secondary_content_type' => 'template',
				],
			]
		);
		//Secondary Content
		$this->add_control(
			'secondary_content',
			[
				'label' => __('Content', 'flexiaddons'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('Unlimited Content', 'flexiaddons'),
				'condition' => [
					'secondary_content_type' => 'content',
				],
			]
		);
		// Secondary Image
		$this->add_control(
			'secondary_image',
			[
				'label' => __('Image', 'flexiaddons'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'secondary_content_type' => 'image',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Overlay
		 */
		$this->start_controls_section(
			'section_toggle_switch_style',
			[
				'label' => __('Switch', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Toggle Switch Alignment
		$this->add_control(
			'toggle_switch_alignment',
			[
				'label' => __('Alignment', 'flexiaddons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __('Left', 'flexiaddons'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'flexiaddons'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'flexiaddons'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'flexi-addons-toggle-',
				'frontend_available' => true,
			]
		);
		// Switch Style
		$this->add_control(
			'switch_style',
			[
				'label' => __('Switch Style', 'flexiaddons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'round' => __('Round', 'flexiaddons'),
					'rectangle' => __('Rectangle', 'flexiaddons'),
				],
				'default' => 'round',
			]
		);

		// Switch Size
		$this->add_responsive_control(
			'toggle_switch_size',
			[
				'label' => __('Switch Size', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 26,
					'unit' => 'px',
				],
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 15,
						'max' => 60,
					],
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-toggle-switch-container' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);


		// Switch Spacing
		$this->add_responsive_control(
			'toggle_switch_spacing',
			[
				'label' => __('Headings Spacing', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'max' => 80,
					],
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-toggle-switch-container' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Switch Gap
		$this->add_responsive_control(
			'toggle_switch_gap',
			[
				'label' => __('Margin Bottom', 'flexiaddons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'max' => 80,
					],
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-toggle-switch-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		/**
		 * ===============================================
		 * Tabs
		 */
		$this->start_controls_tabs('tabs_switch');
		// Switch Primay
		$this->start_controls_tab(
			'tab_switch_primary',
			[
				'label' => __('Primary', 'flexiaddons'),
			]
		);
		// Toggle Switch
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'toggle_switch_primary_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .flexi-addons-toggle-slider',
			]
		);
		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'toggle_switch_primary_border',
				'label' => __('Border', 'flexiaddons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .flexi-addons-toggle-switch-container',
			]
		);
		// Border Radius
		$this->add_control(
			'toggle_switch_primary_border_radius',
			[
				'label' => __('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-toggle-switch-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab(); // End Tab
		// Start Second Tab
		$this->start_controls_tab(
			'tab_switch_secondary',
			[
				'label' => __('Secondary', 'flexiaddons'),
			]
		);
		// Secondary Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'toggle_switch_secondary_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .flexi-addons-toggle-switch-on .flexi-addons-toggle-slider',
			]
		);
		// Secondary Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'toggle_switch_secondary_border',
				'label' => __('Border', 'flexiaddons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .flexi-addons-toggle-switch-container.flexi-addons-toggle-switch-on',
			]
		);
		// Secondary Border Radius
		$this->add_control(
			'toggle_switch_secondary_border_radius',
			[
				'label' => __('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-toggle-switch-container.flexi-addons-toggle-switch-on' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		// Controller
		$this->add_control(
			'switch_controller_heading',
			[
				'label' => __('Controller', 'flexiaddons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'toggle_controller_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .flexi-addons-toggle-slider::before',
			]
		);
		// Border Radius
		$this->add_control(
			'toggle_controller_border_radius',
			[
				'label' => __('Border Radius', 'flexiaddons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-toggle-slider::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Label
		 */
		$this->start_controls_section(
			'section_label_style',
			[
				'label' => __('Label', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Label Position
		$this->add_control(
			'label_horizontal_position',
			[
				'label' => __('Position', 'flexiaddons'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'middle',
				'options' => [
					'top' => [
						'title' => __('Top', 'flexiaddons'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', 'flexiaddons'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'flexiaddons'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-toggle-switch-inner' => 'align-items: {{VALUE}}',
				],
			]
		);
		// Start Style Tabs
		$this->start_controls_tabs('tabs_label_style');
		// Primary
		$this->start_controls_tab(
			'tab_label_primary',
			[
				'label' => __('Primary', 'flexiaddons'),
			]
		);

		// Text Color
		$this->add_control(
			'label_text_color_primary',
			[
				'label' => __('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-primary-toggle-label' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'label_active_text_color_primary',
			[
				'label' => __('Active Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-primary-toggle-label.active' => 'color: {{VALUE}}',
				],
			]
		);

		//Primary Label Typography
		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'label_typography_primary',
			'selector' => '{{WRAPPER}} .flexi-addons-primary-toggle-label',
			'separator' => 'before',
		]);

		$this->end_controls_tab(); // End 1st Tab
		/**
		 * Secondary Tab
		 */
		$this->start_controls_tab(
			'tab_label_secondary',
			[
				'label' => __('Secondary', 'flexiaddons'),
			]
		);
		// Text Color
		$this->add_control(
			'label_text_color_secondary',
			[
				'label' => __('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-secondary-toggle-label' => 'color: {{VALUE}}',
				],
			]
		);
		// Active Text
		$this->add_control(
			'label_active_text_color_secondary',
			[
				'label' => __('Active Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-secondary-toggle-label.active' => 'color: {{VALUE}}',
				],
			]
		);

		//Secondary Typography
		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'label_typography_secondary',
			'selector' => '{{WRAPPER}} .flexi-addons-secondary-toggle-label',
			'separator' => 'before',
		]);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: Content
		 */
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __('Content', 'flexiaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primary_content_type' => 'content',
				],
			]
		);
		// Content Alignment
		$this->add_control(
			'content_alignment',
			[
				'label' => __('Alignment', 'flexiaddons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __('Left', 'flexiaddons'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'flexiaddons'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'flexiaddons'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-toggle-content-wrap' => 'text-align: {{VALUE}}',
				],
			]
		);

		// Content Text Color
		$this->add_control(
			'content_text_color',
			[
				'label' => __('Text Color', 'flexiaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flexi-addons-toggle-content-wrap' => 'color: {{VALUE}}',
				],
			]
		);

		//Content Typography
		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'selector' => '{{WRAPPER}} .flexi-addons-toggle-content-wrap',
		]);

		$this->end_controls_section();
	}


	protected function render()
	{
		$settings = $this->get_settings();

		$this->add_render_attribute('toggle-container', 'class', 'flexi-addons-toggle-container');

		$this->add_render_attribute('toggle-container', 'id', 'flexi-addons-toggle-container-' . esc_attr($this->get_id()));

		$this->add_render_attribute('toggle-container', 'data-toggle-target', '#flexi-addons-toggle-container-' . esc_attr($this->get_id()));

		$this->add_render_attribute('toggle-switch-wrap', 'class', 'flexi-addons-toggle-switch-wrap');

		$this->add_render_attribute('toggle-switch-container', 'class', 'flexi-addons-toggle-switch-container');

		$this->add_render_attribute('toggle-switch-container', 'class', 'flexi-addons-toggle-switch-' . $settings['switch_style']);

		$this->add_render_attribute('toggle-content-wrap', 'class', 'flexi-addons-toggle-content-wrap primary');
?>
		<div <?php echo $this->get_render_attribute_string('toggle-container'); ?>>
			<!-- Start Switch Section -->
			<div <?php echo $this->get_render_attribute_string('toggle-switch-wrap'); ?>>
				<div class="flexi-addons-toggle-switch-inner">
					<?php if ($settings['primary_label'] != '') { ?>
						<div class="flexi-addons-primary-toggle-label">
							<?php echo esc_attr($settings['primary_label']); ?>
						</div>
					<?php } ?>
					<div <?php echo $this->get_render_attribute_string('toggle-switch-container'); ?>>
						<label class="flexi-addons-toggle-switch">
							<input type="checkbox">
							<span class="flexi-addons-toggle-slider"></span>
						</label>
					</div>
					<?php if ($settings['secondary_label'] != '') { ?>
						<div class="flexi-addons-secondary-toggle-label">
							<?php echo esc_attr($settings['secondary_label']); ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<!-- End Switch Section -->
			<div <?php echo $this->get_render_attribute_string('toggle-content-wrap'); ?>>
				<!-- Start Primary Content Section -->
				<div class="flexi-addons-toggle-primary-wrap">
					<?php
					if ($settings['primary_content_type'] == 'content') {
						echo $this->parse_text_editor($settings['primary_content']);
					} elseif ($settings['primary_content_type'] == 'image') {
						$this->add_render_attribute('primary-image', 'src', $settings['primary_image']['url']);
						$this->add_render_attribute('primary-image', 'alt', Control_Media::get_image_alt($settings['primary_image']));
						$this->add_render_attribute('primary-image', 'title', Control_Media::get_image_title($settings['primary_image']));

						printf('<img %s />', $this->get_render_attribute_string('primary-image'));
					} elseif ($settings['primary_content_type'] == 'template') {
						if (!empty($settings['primary_templates'])) {
							$sa_el_template_id = $settings['primary_templates'];
							$sa_el_frontend = new Frontend;

							echo $sa_el_frontend->get_builder_content($sa_el_template_id, true);
						}
					}
					?>
				</div>
				<!-- End Primary Content Section -->
				<!-- Start Secondary Content Section -->
				<div class="flexi-addons-toggle-secondary-wrap">
					<?php
					if ($settings['secondary_content_type'] == 'content') {
						echo $this->parse_text_editor($settings['secondary_content']);
					} elseif ($settings['secondary_content_type'] == 'image') {
						$this->add_render_attribute('secondary-image', 'src', $settings['secondary_image']['url']);
						$this->add_render_attribute('secondary-image', 'alt', Control_Media::get_image_alt($settings['secondary_image']));
						$this->add_render_attribute('secondary-image', 'title', Control_Media::get_image_title($settings['secondary_image']));

						printf('<img %s />', $this->get_render_attribute_string('secondary-image'));
					} elseif ($settings['secondary_content_type'] == 'template') {
						if (!empty($settings['secondary_templates'])) {
							$sa_el_template_id = $settings['secondary_templates'];
							$sa_el_frontend = new Frontend;

							echo $sa_el_frontend->get_builder_content($sa_el_template_id, true);
						}
					}
					?>
				</div>
				<!-- End Secondary Content Section -->
			</div>
		</div>
<?php
	}
}
