<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined('ABSPATH') || die();

class Flexi_Addons_Widget_Skill_Bars extends Flexi_Addons_Widget_Base
{

	/**
	 * Widget key name
	 *
	 * @var string
	 */
	protected $key = 'skill-bars';

	protected function _register_controls()
	{

		/**
		 * ======================
		 * Section - Content - Skills
		 * ======================
		 */
		$this->start_controls_section('_section_skills', [
			'label' => __('Skills', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);

		$skills = new Repeater();

		//Title
		$skills->add_control('title', [
			'label'       => __('Title', 'flexiaddons'),
			'type'        => Controls_Manager::TEXT,
			'default'     => __('Design', 'flexiaddons'),
			'placeholder' => __('Skill Name', 'flexiaddons')
		]);

		//Percentage
		$skills->add_control('percentage', [
			'label'      => __('Percentage', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['%'],
			'range'      => [
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default'    => [
				'unit' => '%',
				'size' => 85
			],
		]);

		//=== Show/ Hide percentage ===
		$skills->add_control('show_percentage', [
			'label'   => esc_html__('Show Percentage', 'flexiaddons'),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		]);

		/**
		 * ===============================
		 * Customize
		 * ===============================
		 */
		$skills->add_control('_media_type_heading', [
			'label'     => esc_html__('Media Type', 'flexiaddons'),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		]);

		$skills->add_control('media_type', [
			'label'       => '',
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
			'toggle'      => false,
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
			'default'     => 'none',
		]);

		//Image Type
		$skills->add_control('image', [
			'label'     => __('Image', 'flexiaddons'),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'media_type' => 'img'
			]
		]);

		//Image Size
		$skills->add_group_control(Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'media_type' => 'img',
				'image!'     => '',
			],
		]);

		//Icon Type
		$skills->add_control('icon_new', [
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
		$skills->add_control('number', [
			'label'     => __('Number', 'flexiaddons'),
			'type'      => Controls_Manager::TEXT,
			'condition' => [
				'media_type' => 'number'
			]
		]);

		/**
		 * ===============================
		 * Customize
		 * ===============================
		 */
		$skills->add_control('_customize_heading', [
			'label'     => esc_html__('Customization', 'flexiaddons'),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		]);

		$skills->add_control('customize', [
			'label'          => __('Want to Customize?', 'flexiaddons'),
			'type'           => Controls_Manager::SWITCHER,
			'label_on'       => __('Yes', 'flexiaddons'),
			'label_off'      => __('No', 'flexiaddons'),
			'return_value'   => 'yes',
			'style_transfer' => true,
		]);

		$skills->start_controls_tabs('_tab_skill_colors', [
			'condition' => ['customize' => 'yes']
		]);

		//===Normal Tab===
		$skills->start_controls_tab('_tab_skill_normal', [
			'label'     => __('Normal', 'flexiaddons'),
			'condition' => ['customize' => 'yes'],
		]);

		//title color
		$skills->add_control('title_color', [
			'label'          => __('Text Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .flexi-skill-bar-content' => 'color: {{VALUE}}',
			],
			'style_transfer' => true,
		]);

		//fill color
		$skills->add_control('fill_color', [
			'label'          => __('Fill Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}.pie .flexi-skill-bar-fill'  => 'border-color: {{VALUE}}',
				'{{WRAPPER}} {{CURRENT_ITEM}}.line .flexi-skill-bar-fill' => 'background: {{VALUE}}',
			],
			'style_transfer' => true,
		]);

		//background color
		$skills->add_control('bg_color', [
			'label'          => __('Background Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}.line .flexi-skill-bar'                => 'background-color: {{VALUE}}',
				'{{WRAPPER}} {{CURRENT_ITEM}}.pie .flexi-skill-bar-content-overlay' => 'border-color: {{VALUE}}',
			],
			'style_transfer' => true,
		]);

		//media color
		$skills->add_control('media_color', [
			'label'          => __('Media Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .flexi-skill-bar-media' => 'color: {{VALUE}}',
			],
			'conditions'     => [
				'terms' => [
					[
						'name'     => 'media_type',
						'operator' => '!=',
						'value'    => 'none',
					]
				],
			],
			'style_transfer' => true,
		]);

		//media background color
		$skills->add_control('media_bg_color', [
			'label'          => __('Media Background Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .flexi-skill-bar-media' => 'background-color: {{VALUE}}',
			],
			'conditions'     => [
				'terms' => [
					[
						'name'     => 'media_type',
						'operator' => '!=',
						'value'    => 'none',
					]
				],
			],
			'style_transfer' => true,
		]);

		$skills->end_controls_tab();

		//===Hover Tab===
		$skills->start_controls_tab('_tab_skill_hover', [
			'label' => __('Hover', 'flexiaddons'),
		]);

		//title hover color
		$skills->add_control('hover_title_color', [
			'label'          => __('Text Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}:hover .flexi-skill-bar-content, {{WRAPPER}} {{CURRENT_ITEM}}:focus .flexi-skill-bar-content' => 'color: {{VALUE}}',
			],
			'condition'      => ['customize' => 'yes'],
			'style_transfer' => true,
		]);

		//fill hover color
		$skills->add_control('hover_fill_color', [
			'label'          => __('Fill Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}.pie:hover .flexi-skill-bar-fill'  => 'border-color: {{VALUE}}',
				'{{WRAPPER}} {{CURRENT_ITEM}}.line:hover .flexi-skill-bar-fill' => 'background: {{VALUE}}',
			],
			'condition'      => ['customize' => 'yes'],
			'style_transfer' => true,
		]);

		//background hover color
		$skills->add_control('hover_bg_color', [
			'label'          => __('Background Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}.line:hover .flexi-skill-bar'                => 'background-color: {{VALUE}}',
				'{{WRAPPER}} {{CURRENT_ITEM}}.pie:hover .flexi-skill-bar-content-overlay' => 'border-color: {{VALUE}}',
			],
			'style_transfer' => true,
		]);

		//media hover color
		$skills->add_control('hover_media_color', [
			'label'          => __('Media Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}:hover .flexi-skill-bar-media' => 'color: {{VALUE}}',
			],
			'conditions'     => [
				'terms' => [
					[
						'name'     => 'media_type',
						'operator' => '!=',
						'value'    => 'none',
					]
				],
			],
			'style_transfer' => true,
		]);

		//media background hover color
		$skills->add_control('hover_media_bg_color', [
			'label'          => __('Media Background Color', 'flexiaddons'),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}:hover .flexi-skill-bar-media' => 'background-color: {{VALUE}}',
			],
			'conditions'     => [
				'terms' => [
					[
						'name'     => 'media_type',
						'operator' => '!=',
						'value'    => 'none',
					]
				],
			],
			'style_transfer' => true,
		]);

		$skills->end_controls_tab();

		$skills->end_controls_tabs();
		//End Customize

		$this->add_control('skills', [
			'show_label'  => false,
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $skills->get_controls(),
			'title_field' => '{{{title}}} - {{percentage.size}}%',
			'default'     => [
				[
					'title'      => __('UI/UX', 'flexiaddons'),
					'percentage' => ['size' => 88, 'unit' => '%'],
				],
				[
					'title'      => __('PHP', 'flexiaddons'),
					'percentage' => ['size' => 90, 'unit' => '%'],
				],
				[
					'title'      => __('WordPress', 'flexiaddons'),
					'percentage' => ['size' => 96, 'unit' => '%'],
				],
				[
					'title'      => __('JavaScript', 'flexiaddons'),
					'percentage' => ['size' => 90, 'unit' => '%'],
				],
			],
		]);

		/**
		 * ===============================
		 * Style Preset Layout
		 * ===============================
		 */
		$this->add_control('style_preset', [
			'label'     => __('Layout Skin', 'flexiaddons'),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'line_in',
			'separator' => 'before',
			'options'   => [
				'line_in'     => esc_html__('Line - Text Inside', 'flexiaddons'),
				'line_out'    => esc_html__('Line - Text Outside', 'flexiaddons'),
				'circle'      => esc_html__('Circle', 'flexiaddons'),
				'half_circle' => esc_html__('Half Circle', 'flexiaddons'),
			],
		]);

		$this->end_controls_section();

		//=== Style Controls ===
		$this->_register_style_controls();
	}

	/**
	 * ===============================
	 * Register widget style controls
	 * ===============================
	 */
	public function _register_style_controls()
	{

		/**
		 * ===============================
		 * Section - Style - Media
		 * ===============================
		 */
		$this->start_controls_section('_section_style_media', [
			'label' => __('Media Style', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->add_responsive_control('media_width', [
			'label'      => __('Width', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px', '%'],
			'range'      => [
				'px' => [
					'min' => 10,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .media--image'                            => 'width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .media--icon, {{WRAPPER}} .media--number' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .flexi-skill-bar-wrap.line>*'             => 'margin-left: calc({{SIZE}}{{UNIT}} + 20px);',
			],
		]);

		$this->add_responsive_control('media_height', [
			'label'      => __('Height', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px', '%'],
			'range'      => [
				'%'  => [
					'min' => 20,
					'max' => 100,
				],
				'px' => [
					'min' => 10,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .media--image'                            => 'height: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .media--icon, {{WRAPPER}} .media--number' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .flexi-skill-bar-wrap.line>*'             => 'margin-left: calc({{SIZE}}{{UNIT}} + 15px);',
				'{{WRAPPER}} .flexi-skill-bar-wrap.line'               => 'min-height: {{SIZE}}{{UNIT}};',
			],
		]);

		$this->add_responsive_control('media_margin', [
			'label'      => __('Margin', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-skill-bar-media-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_responsive_control('media_padding', [
			'label'      => __('Padding', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', 'em', '%'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-skill-bar-media' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'media_border',
			'selector' => '{{WRAPPER}} .flexi-skill-bar-media'
		]);

		$this->add_responsive_control('media_border_radius', [
			'label'      => __('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%'],
			'selectors'  => [
				'{{WRAPPER}} .flexi-skill-bar-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();

		/**
		 * ===============================
		 * Section - Style - Skills
		 * ===============================
		 */
		$this->start_controls_section('_section_style_skills', [
			'label' => __('Skill Style', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->add_responsive_control('skill_height', [
			'label'      => __('Height', 'flexiaddons'),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => ['px', '%'],
			'selectors'  => [
				'{{WRAPPER}} .line .flexi-skill-bar'                                                        => 'height: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .pie .flexi-skill-bar-content-overlay, {{WRAPPER}} .pie .flexi-skill-bar-fill' => 'border-width: {{SIZE}}{{UNIT}};',
			],
		]);

		$this->add_responsive_control('skill_border_radius', [
			'label'      => __('Border Radius', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%'],
			'selectors'  => [
				'{{WRAPPER}} .line .flexi-skill-bar, {{WRAPPER}} .line .flexi-skill-bar-fill' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .pie .flexi-skill-bar, {{WRAPPER}} .line .flexi-skill-bar-fill'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'  => [
				'style_preset' => [ 'line_in', 'line_out', ],
			],
		]);

		$this->add_responsive_control('skill_margin', [
			'label'      => __('Margin', 'flexiaddons'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px'],
			'selectors'  => [
				'{{WRAPPER}} .line .flexi-skill-bar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .pie'                   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'skill_box_shadow',
			'selector' => '{{WRAPPER}} .line .flexi-skill-bar, {{WRAPPER}} .pie .flexi-skill-bar-content-overlay',
		]);

		$this->end_controls_section();

		/**
		 * ===============================
		 * Section - Style - Content
		 * ===============================
		 */
		$this->start_controls_section('_section_style_content', [
			'label' => __('Content Style', 'flexiaddons'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		//Content Top Spacing
		$this->add_control( 'content_top_spacing', [
			'label'      => __( 'Top Spacing', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'min' => - 100,
					'max' => 300,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .flexi-skill-bar-content' => 'margin-top: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'style_preset' => [ 'half_circle', ],
			],
		] );

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'selector' => '{{WRAPPER}} .flexi-skill-bar-content',
		]);

		$this->add_group_control(Group_Control_Text_Shadow::get_type(), [
			'name'     => 'content_text_shadow',
			'selector' => '{{WRAPPER}} .flexi-skill-bar-content',
		]);

		$this->end_controls_section();
	}

	/**
	 * Render skill bar media
	 *
	 * @param $skill
	 *
	 * @return bool|string
	 */
	public function skill_bar_media($skill)
	{

		if (!empty($skill['image'])) {
			$image     = $skill['image'];
			$image_url = Group_Control_Image_Size::get_attachment_image_src($image['id'], 'thumbnail', $skill);
			$image_url = !empty($image_url) ? $image_url : $image['url'];
		}

		$icon_migrated = isset($skill['__fa4_migrated']['icon_new']);
		$icon_is_new   = empty($skill['icon']);

		if ($icon_is_new || $icon_migrated) {


			if (!empty($skill['icon_new']['value'])) {

				$icon = $skill['icon_new']['value'];
				if (isset($icon['url'])) {
					$icon_tag = sprintf('<img class="flexi-skill-bar-media media--icon" src="%1$s" alt="%2$s">', $icon['url'], esc_attr(get_post_meta($icon['id'], '_wp_attachment_image_alt', true)));
				} else {
					$icon_tag = '<i class="flexi-skill-bar-media media--icon ' . esc_attr($icon) . '"></i>';
				}
			}
		} else {
			$icon_tag = '<i class="flexi-skill-bar-media media--icon ' . esc_attr($skill['icon']) . '"></i>';
		}

		if ('none' == $skill['media_type']) {
			return false;
		} elseif ('number' == $skill['media_type']) {
			return sprintf('<span class="flexi-skill-bar-media media--number">%s</span>', $skill['number']);
		} elseif ('icon' == $skill['media_type']) {
			return $icon_tag;
		} elseif ('img' == $skill['media_type']) {
			return sprintf('<img class="flexi-skill-bar-media media--image" src="%1$s" alt="%2$s">', esc_url($image_url), esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true)));
		}
	}

	/**
	 * Render View
	 */
	public function render()
	{
		$settings = $this->get_settings_for_display();

		$layout = $settings['style_preset'];

		if (!empty($skills = $settings['skills'])) { ?>
			<div class="flexi-skill-bars">

				<?php foreach ($skills as $skill) {

					//percentage count
					$percentage = wp_unslash($skill['percentage']['size']);
					$has_media  = !empty($this->skill_bar_media($skill)) && in_array($layout, [
						'line_in',
						'line_out'
					]) ? 'has_media' : '';

					//skill bar group type line/pie
					$type = in_array($layout, ['line_in', 'line_out']) ? 'line' : 'pie';

					//item wrapper attributes
					$wrapper_attrs = [
						'class'           => sprintf('flexi-skill-bar-wrap elementor-repeater-item-%1$s %2$s %3$s %4$s', $skill['_id'], $has_media, $layout, $type),
						'data-percentage' => $percentage,
						'data-duration'   => 1500,
						'data-layout'     => $layout,
					];

					//percentage html
					$percentage_html = sprintf('<span class="flexi-skill-bar-percentage %1$s">%2$s%%</span>', 'yes' != $skill['show_percentage'] ? 'percentage--hide' : '', $percentage);

					//title
					$title = sprintf('<div class="flexi-skill-bar-title">%s</div>', esc_html($skill['title']));

				?>

					<div <?php foreach ($wrapper_attrs as $key => $value) {
								printf('%1$s="%2$s"', $key, $value);
							} ?>>

						<?php

						$media = !empty($this->skill_bar_media($skill)) ? sprintf('<div class="flexi-skill-bar-media-wrapper">%s</div>', $this->skill_bar_media($skill)) : '';

						$output = '';

						if ('line_out' == $layout) {
							$output .= sprintf('%1$s <div class="flexi-skill-bar-content">%2$s</div>', $media, $title . $percentage_html);
							$output .= '<div class="flexi-skill-bar"><span class="flexi-skill-bar-fill"></span></div>';
						} elseif ('line_in' == $layout) {
							$output .= sprintf('%1$s <div class="flexi-skill-bar"><span class="flexi-skill-bar-fill"><div class="flexi-skill-bar-content">%2$s</div></span></div>', $media, $title . $percentage_html);
						} elseif ('circle' == $layout) { ?>

							<div class="flexi-skill-bar">
								<span class="flexi-skill-bar-fill fill--half fill--left"></span>
								<span class="flexi-skill-bar-fill fill--half fill--right"></span>
							</div>

							<div class="flexi-skill-bar-content-overlay"></div>

							<div class="flexi-skill-bar-content">
								<?php echo $media . $title . $percentage_html; ?>
							</div>

						<?php } elseif ('half_circle' == $layout) { ?>
							<div class="flexi-skill-bar">
								<span class="flexi-skill-bar-fill fill--half"></span>
								<div class="flexi-skill-bar-content-overlay"></div>
							</div>

							<div class="flexi-skill-bar-content">
								<?php echo $media . $title . $percentage_html; ?>
							</div>
						<?php }

						echo $output;

						?>

					</div>

				<?php
				} ?>

			</div>
<?php
		}
	}
}
