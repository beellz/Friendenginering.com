<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Flexi_Addons_Widget_Progress_Bar extends Flexi_Addons_Widget_Base {

	/**
	 * Widget key name
	 *
	 * @var string
	 */
	protected $key = 'progress-bar';

	protected function _register_controls() {
		/**
		 * ======================
		 * Section - Content - Progress Bar
		 * ======================
		 */
		$this->start_controls_section( '_section_progress_bar', [
			'label' => __( 'Progress Bar', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		//Layout Heading
		$this->add_control( '_style_preset_heading', [
			'label' => __( 'Layout', 'flexiaddons' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_control( 'style_preset', [
			'label'     => __( 'Layout Skin', 'flexiaddons' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'line_in',
			'separator' => 'after',
			'options'   => [
				'line_in'     => esc_html__( 'Line - Text Inside', 'flexiaddons' ),
				'line_out'    => esc_html__( 'Line - Text Outside', 'flexiaddons' ),
				'dotted'      => esc_html__( 'Dotted', 'flexiaddons' ),
				'box'         => esc_html__( 'Box', 'flexiaddons' ),
				'circle'      => esc_html__( 'Circle', 'flexiaddons' ),
				'half_circle' => esc_html__( 'Half Circle', 'flexiaddons' ),
			],
		] );

		/**
		 * === Media Type ===
		 */
		$this->add_control( '_media_type_heading', [
			'label'     => esc_html__( 'Media Type', 'flexiaddons' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'media_type', [
			'label'       => '',
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
			'toggle'      => false,
			'options'     => [
				'none'   => [
					'title' => __( 'None', 'flexiaddons' ),
					'icon'  => 'fa fa-ban',
				],
				'number' => [
					'title' => __( 'Number', 'flexiaddons' ),
					'icon'  => 'eicon-number-field',
				],
				'icon'   => [
					'title' => __( 'Icon', 'flexiaddons' ),
					'icon'  => 'fa fa-info-circle',
				],
				'img'    => [
					'title' => __( 'Image', 'flexiaddons' ),
					'icon'  => 'fa fa-picture-o',
				]
			],
			'default'     => 'none',
		] );

		//Image Type
		$this->add_control( 'image', [
			'label'     => __( 'Image', 'flexiaddons' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'media_type' => 'img'
			]
		] );

		//Image Size
		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'media_type' => 'img',
				'image!'     => '',
			],
		] );

		//Icon Type
		$this->add_control( 'icon_new', [
			'label'            => __( 'Icon', 'flexiaddons' ),
			'type'             => Controls_Manager::ICONS,
			'fa4compatibility' => 'icon',
			'default'          => [
				'value'   => 'fa fa-star',
				'library' => 'fa-solid',
			],
			'condition'        => [
				'media_type' => 'icon'
			]
		] );

		//Number Type
		$this->add_control( 'number', [
			'label'     => __( 'Number', 'flexiaddons' ),
			'type'      => Controls_Manager::TEXT,
			'condition' => [
				'media_type' => 'number'
			]
		] );

		//Title
		$this->add_control( 'title', [
			'label'       => __( 'Title', 'flexiaddons' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Design', 'flexiaddons' ),
			'placeholder' => __( 'Title', 'flexiaddons' ),
			'separator'   => 'before',
		] );

		//=== Percentage ===
		$this->add_control( '_count_heading', [
			'label'     => __( 'Percentage', 'flexiaddons' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before'
		] );

		// Show/ Hide percentage
		$this->add_control( 'show_count', [
			'label'   => esc_html__( 'Show Percentage', 'flexiaddons' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		//Count
		$this->add_control( 'count', [
			'label'      => __( 'Percentage', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
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
		] );

		//Count
		$this->add_control( 'count_style', [
			'label'      => __( 'Percentage Style', 'flexiaddons' ),
			'type'       => Controls_Manager::SELECT,
			'default'    => 'none',
			'options'    => [
				'none'         => esc_html__( 'None', 'flexiaddons' ),
				'circle'       => esc_html__( 'Circle', 'flexiaddons' ),
				'circle_point' => esc_html__( 'Circle Point', 'flexiaddons' ),
				'rounded'      => esc_html__( 'Rounded', 'flexiaddons' ),
				'square'       => esc_html__( 'Square', 'flexiaddons' ),
			],
			'conditions' => [
				'relation' => 'AND',
				'terms'    => [
					[
						'name'  => 'show_count',
						'value' => 'yes',
					],
					[
						'name'     => 'style_preset',
						'operator' => 'in',
						'value'    => [ 'line_in', 'line_out', 'dotted' ],
					],
				]

			]
		] );

		$this->end_controls_section();

		//=== Style Controls ===
		$this->_register_style_controls();

	}

	/**
	 * ===============================
	 * Register widget style controls
	 * ===============================
	 */
	public function _register_style_controls() {
		/**
		 * ===============================
		 * Section - Style - Media
		 * ===============================
		 */
		$this->start_controls_section( '_section_style_media', [
			'label'     => __( 'Media Style', 'flexiaddons' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'media_type!' => 'none' ]
		] );

		$this->start_controls_tabs( '_tab_media_colors', [] );

		//===Normal Tab===
		$this->start_controls_tab( '_tab_media_normal', [
			'label' => __( 'Normal', 'flexiaddons' ),
		] );

		//media color
		$this->add_control( 'media_color', [
			'label'          => __( 'Media Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} .flexi-progress-bar-media' => 'color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		//media background color
		$this->add_control( 'media_bg_color', [
			'label'          => __( 'Media Background Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} .flexi-progress-bar-media' => 'background-color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		$this->end_controls_tab();

		//===Normal Tab===
		$this->start_controls_tab( '_tab_media_hover', [
			'label' => __( 'Normal', 'flexiaddons' ),
		] );

		//media hover color
		$this->add_control( 'hover_media_color', [
			'label'          => __( 'Media Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}}:hover .flexi-progress-bar-media' => 'color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		//media background hover color
		$this->add_control( 'hover_media_bg_color', [
			'label'          => __( 'Media Background Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}}:hover .flexi-progress-bar-media' => 'background-color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control( 'media_width', [
			'label'      => __( 'Width', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'min' => 10,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .media--image'                            => 'width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .media--icon, {{WRAPPER}} .media--number' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .flexi-progress-bar-wrap.line>*'          => 'margin-left: calc({{SIZE}}{{UNIT}} + 15px);',
			],
		] );

		$this->add_responsive_control( 'media_height', [
			'label'      => __( 'Height', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
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
				'{{WRAPPER}} .flexi-progress-bar-wrap.line>*'          => 'margin-left: calc({{SIZE}}{{UNIT}} + 15px);',
				'{{WRAPPER}} .flexi-progress-bar-wrap.line'            => 'min-height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'media_margin', [
			'label'      => __( 'Margin', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .flexi-progress-bar-media-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'media_padding', [
			'label'      => __( 'Padding', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .flexi-progress-bar-media' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'media_border',
			'selector' => '{{WRAPPER}} .flexi-progress-bar-media'
		] );

		$this->add_responsive_control( 'media_border_radius', [
			'label'      => __( 'Border Radius', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .flexi-progress-bar-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/**
		 * ===============================
		 * Section - Style - Progress Bar
		 * ===============================
		 */
		$this->start_controls_section( '_section_style_progress_bar', [
			'label' => __( 'Progress Bar Style', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		//progress bar height
		$this->add_responsive_control( 'progress_bar_height', [
			'label'      => __( 'Height', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .line .flexi-progress-bar'                                                           => 'height: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .pie .flexi-progress-bar-content-overlay, {{WRAPPER}} .pie .flexi-progress-bar-fill' => 'border-width: {{SIZE}}{{UNIT}} !important;',
			],
		] );

		//progress bar border radius
		$this->add_responsive_control( 'progress_bar_border_radius', [
			'label'      => __( 'Border Radius', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .line .flexi-progress-bar, {{WRAPPER}} .line .flexi-progress-bar-fill' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .pie .flexi-progress-bar, {{WRAPPER}} .line .flexi-progress-bar-fill'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		//progress bar margin
		$this->add_responsive_control( 'progress_bar_margin', [
			'label'      => __( 'Margin', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .line .flexi-progress-bar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .pie'                      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		//progress bar box shadow
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'progress_bar_box_shadow',
			'selector' => '{{WRAPPER}} .line .flexi-progress-bar, {{WRAPPER}} .pie .flexi-progress-bar-content-overlay',
		] );

		//progress bar colors tabs
		$this->start_controls_tabs( '_tab_progress_bar_colors', [] );

		//===Normal Tab===
		$this->start_controls_tab( '_tab_progress_bar_normal', [
			'label' => __( 'Normal', 'flexiaddons' ),
		] );

		//progress bar fill color
		$this->add_control( 'progress_bar_fill_color', [
			'label'          => __( 'Fill Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} .pie .flexi-progress-bar-fill'         => 'border-color: {{VALUE}}',
				'{{WRAPPER}} .line .flexi-progress-bar-fill'        => 'background: {{VALUE}}',
				'{{WRAPPER}} .line.dotted .flexi-progress-bar-fill' => 'background: repeating-linear-gradient(to right, {{VALUE}}, {{VALUE}} 4px, transparent 4px, transparent 8px);',
			],
			'style_transfer' => true,
		] );

		//progress bar background color
		$this->add_control( 'progress_bar_bg_color', [
			'label'          => __( 'Background Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} .line .flexi-progress-bar'                => 'background-color: {{VALUE}}',
				'{{WRAPPER}} .pie .flexi-progress-bar-content-overlay' => 'border-color: {{VALUE}}',

			],
			'style_transfer' => true,
		] );

		$this->end_controls_tab();

		//===Hover Tab===
		$this->start_controls_tab( '_tab_progress_bar_hover', [
			'label' => __( 'Hover', 'flexiaddons' ),
		] );

		//progress bar fill hover color
		$this->add_control( 'progress_bar_hover_fill_color', [
			'label'          => __( 'Fill Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}}:hover .pie .flexi-progress-bar-fill'         => 'border-color: {{VALUE}}',
				'{{WRAPPER}}:hover .line .flexi-progress-bar-fill'        => 'background: {{VALUE}}',
				'{{WRAPPER}}:hover .line.dotted .flexi-progress-bar-fill' => 'background: repeating-linear-gradient(to right, {{VALUE}}, {{VALUE}} 4px, transparent 4px, transparent 8px);',

			],
			'style_transfer' => true,
		] );

		//progress bar background hover color
		$this->add_control( 'progress_bar_hover_bg_color', [
			'label'          => __( 'Background Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} .line:hover .flexi-progress-bar'                => 'background-color: {{VALUE}}',
				'{{WRAPPER}} .pie:hover .flexi-progress-bar-content-overlay' => 'border-color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Customize

		$this->end_controls_section();

		/**
		 * ===============================
		 * Section - Style - Content
		 * ===============================
		 */
		$this->start_controls_section( '_section_style_content', [
			'label' => __( 'Content Style', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

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
				'{{WRAPPER}} .flexi-progress-bar-content' => 'margin-top: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'style_preset' => [ 'half_circle', ],
			],
		] );

		//title color
		$this->add_control( 'title_color', [
			'label'          => __( 'Text Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} .flexi-progress-bar-content' => 'color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		//title hover color
		$this->add_control( 'hover_title_color', [
			'label'          => __( 'Hover Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}}:hover .flexi-progress-bar-content, {{WRAPPER}}:focus .flexi-progress-bar-content' => 'color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		// content typography
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'selector' => '{{WRAPPER}} .flexi-progress-bar-content',
		] );

		// content box shadow
		$this->add_group_control( Group_Control_Text_Shadow::get_type(), [
			'name'     => 'content_text_shadow',
			'selector' => '{{WRAPPER}} .flexi-progress-bar-content',
		] );

		$this->end_controls_section();

		/**
		 * ===============================
		 * Section - Style - Percentage
		 * ===============================
		 */
		$this->start_controls_section( '_section_style_count', [
			'label'     => __( 'Percentage Style', 'flexiaddons' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'show_count' => 'yes' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'count_typography',
			'selector' => '{{WRAPPER}} .flexi-progress-bar-count',
		] );

		$this->add_group_control( Group_Control_Text_Shadow::get_type(), [
			'name'     => 'count_text_shadow',
			'selector' => '{{WRAPPER}} .flexi-progress-bar-count',
		] );

		//progress bar colors tabs
		$this->start_controls_tabs( '_tab_count_colors', [] );

		//===Normal Tab===
		$this->start_controls_tab( '_tab_count_normal', [
			'label' => __( 'Normal', 'flexiaddons' ),
		] );

		$this->add_control( 'count_color', [
			'label'          => __( 'Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} .flexi-progress-bar-count' => 'color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		$this->add_control( 'count_bg_color', [
			'label'          => __( 'Background Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} .flexi-progress-bar-count'                                                       => 'background: {{VALUE}}',
				'{{WRAPPER}} .flexi-progress-bar-count::after, {{WRAPPER}} .flexi-progress-bar-count::before' => 'border-top-color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( '_tab_count_hover', [
			'label' => __( 'Hover', 'flexiaddons' ),
		] );

		$this->add_control( 'hover_count_color', [
			'label'          => __( 'Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}}:hover .flexi-progress-bar-count' => 'color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		$this->add_control( 'hover_count_bg_color', [
			'label'          => __( 'Background Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}}:hover .flexi-progress-bar-count'                                                       => 'background: {{VALUE}}',
				'{{WRAPPER}}:hover .flexi-progress-bar-count::after, {{WRAPPER}} .flexi-progress-bar-count::before' => 'border-top-color: {{VALUE}}',
			],
			'style_transfer' => true,
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

	}

	/**
	 * Render skill bar media
	 *
	 * @param $settings
	 *
	 * @return bool|string
	 */
	public function progress_bar_media( $settings ) {

		if ( ! empty( $settings['image'] ) ) {
			$image     = $settings['image'];
			$image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
			$image_url = ! empty( $image_url ) ? $image_url : $image['url'];
		}


		if ( 'none' == $settings['media_type'] ) {
			return false;
		} elseif ( 'number' == $settings['media_type'] ) {
			return sprintf( '<span class="flexi-progress-bar-media media--number">%s</span>', $settings['number'] );
		} elseif ( 'icon' == $settings['media_type'] ) {
			ob_start();
			flexiaddons_render_icon( $settings );

			return ob_get_clean();
		} elseif ( 'img' == $settings['media_type'] ) {
			return sprintf( '<img class="flexi-progress-bar-media media--image" src="%1$s" alt="%2$s">', esc_url( $image_url ), esc_attr( get_post_meta( $image['id'], '_wp_attachment_image_alt', true ) ) );
		}

	}

	/**
	 * Render View
	 */
	public function render() {

		$settings = $this->get_settings_for_display();

		$layout = $settings['style_preset'];

		//percentage count
		$count       = wp_unslash( $settings['count']['size'] );
		$count_style = $settings['count_style'];

		$has_media = ! empty( $this->progress_bar_media( $settings ) ) && in_array( $layout, [
			'line_in',
			'line_out',
			'dotted'
		] ) ? 'has_media' : '';

		//skill bar group type line/pie
		$type = in_array( $layout, [ 'line_in', 'line_out', 'dotted', 'box' ] ) ? 'line' : 'pie';

		$this->add_render_attribute( 'progress_bar', [
			'class'         => sprintf( 'flexi-progress-bar-wrap %1$s %2$s %3$s %4$s', $has_media, $layout, $type, 'count_style_' . $count_style ),
			'data-count'    => $count,
			'data-duration' => 1500,
			'data-layout'   => $layout,
		] );

		//count html

		$count_html = sprintf( '<span class="flexi-progress-bar-count %1$s %3$s">%2$s%%</span>', 'yes' != $settings['show_count'] ? 'count--hide' : '', $count, $count_style );

		//title
		$title = sprintf( '<div class="flexi-progress-bar-title">%s</div>', esc_html( $settings['title'] ) );

		?>
        <div class="flexi-progress-bar-container">
            <div <?php echo $this->get_render_attribute_string( 'progress_bar' ); ?>>

				<?php

				$media = ! empty( $this->progress_bar_media( $settings ) ) ? sprintf( '<div class="flexi-progress-bar-media-wrapper">%s</div>', $this->progress_bar_media( $settings ) ) : '';

				$output = '';

				if ( in_array( $layout, [ 'line_out', 'dotted' ] ) ) { //layout line_out/dotted

					$output .= sprintf( '%1$s <div class="flexi-progress-bar-content">%2$s</div>', $media, $title );
					if ( in_array( $settings['count_style'], [ 'circle_point' ] ) ) {
						$output .= '<div class="flexi-progress-bar-group"><div class="flexi-progress-bar"><span class="flexi-progress-bar-fill"></span></div>' . $count_html . '</div>';
					} else {
						$output .= '<div class="flexi-progress-bar"><span class="flexi-progress-bar-fill">' . $count_html . '</span></div>';
					}


				} elseif ( in_array( $layout, [ 'line_in' ] ) ) { //layout line_in
					$output .= $media;

					if ( in_array( $count_style, [ 'circle_point' ] ) ) {
						$output .= '<div class="flexi-progress-bar-group"><div class="flexi-progress-bar"><span class="flexi-progress-bar-fill"><div class="flexi-progress-bar-content">' . $title . '</div></span></div>' . $count_html . '</div>';
					} else {
						$output .= '<div class="flexi-progress-bar"><span class="flexi-progress-bar-fill"><div class="flexi-progress-bar-content">' . $title . $count_html . '</div></span></div>';
					}

				} elseif ( in_array( $layout, [ 'box' ] ) ) {
					$output .= sprintf( '<div class="flexi-progress-bar"><span class="flexi-progress-bar-fill">%1$s <div class="flexi-progress-bar-content">%2$s</div></span></div>', $media, $title . $count_html );
				} elseif ( 'circle' == $layout ) { ?>

                    <div class="flexi-progress-bar">
                        <span class="flexi-progress-bar-fill fill--half fill--left"></span>
                        <span class="flexi-progress-bar-fill fill--half fill--right"></span>
                    </div>

                    <div class="flexi-progress-bar-content-overlay"></div>

                    <div class="flexi-progress-bar-content">
						<?php echo $media . $title . $count_html; ?>
                    </div>

				<?php } elseif ( 'half_circle' == $layout ) { ?>
                    <div class="flexi-progress-bar">
                        <span class="flexi-progress-bar-fill fill--half"></span>
                        <div class="flexi-progress-bar-content-overlay"></div>
                    </div>

                    <div class="flexi-progress-bar-content">
						<?php echo $media . $title . $count_html; ?>
                    </div>
				<?php }

				echo $output;

				?>

            </div>
        </div>

		<?php
	}
}