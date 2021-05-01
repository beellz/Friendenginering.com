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

class Flexi_Addons_Widget_Fun_Factor extends Flexi_Addons_Widget_Base {


	protected $key = 'fun-factor';

	/**
	 * Register content related controls
	 */
	protected function _register_controls() {

		/**
		 * ======================
		 * | Content Section |
		 * ======================
		 */
		$this->start_controls_section( '_content', [
			'label' => __( 'Image/ Icon', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		//Media Heading
		$this->add_control( '_media_heading', [
			'label' => __( 'Media', 'flexiaddons' ),
			'type'  => Controls_Manager::HEADING,
		] );

		//Media Type
		$this->add_control( 'media_type', [
			'label'   => __( 'Media Type', 'flexiaddons' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'none' => [
					'title' => __( 'None', 'flexiaddons' ),
					'icon'  => 'fa fa-ban',
				],
				'icon' => [
					'title' => __( 'Icon', 'flexiaddons' ),
					'icon'  => 'fa fa-info-circle',
				],
				'img'  => [
					'title' => __( 'Image', 'flexiaddons' ),
					'icon'  => 'fa fa-picture-o',
				]
			],
			'default' => 'icon',
		] );

		//Image Type
		$this->add_control( 'image', [
			'label'     => __( 'Choose Image', 'flexiaddons' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'media_type' => 'img'
			]
		] );

		//Icon
		if ( flexi_is_elementor_version( '<', '2.6.0' ) ) {

			$this->add_control( 'icon', [
				'show_label'  => false,
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition'   => [
					'media_type' => 'icon'
				]

			] );
		} else {

			$this->add_control( 'icon_new', [
				'show_label'       => false,
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'label_block'      => true,
				'default'          => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'media_type' => 'icon'
				]

			] );
		}

		//Media Position
		$this->add_control( 'media_position', [
			'label'        => __( 'Media Position', 'flexiaddons' ),
			'type'         => Controls_Manager::CHOOSE,
			'default'      => 'top',
			'options'      => [
				'left'  => [
					'title' => __( 'Left', 'flexiaddons' ),
					'icon'  => 'eicon-h-align-left',
				],
				'top'   => [
					'title' => __( 'Top', 'flexiaddons' ),
					'icon'  => 'eicon-v-align-top',
				],
				'right' => [
					'title' => __( 'Right', 'flexiaddons' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'prefix_class' => 'flexi-position-',
			'toggle'       => false,
		] );

		//Content Heading
		$this->add_control( '_content_heading', [
			'label'     => __( 'Content', 'flexiaddons' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		// Title
		$this->add_control( 'title', [
			'label'   => __( 'Title', 'flexiaddons' ),
			'type'    => Controls_Manager::TEXT,
			'dynamic' => [
				'active' => true,
			],
			'default' => __( 'Happy Clients', 'flexiaddons' ),
		] );

		// Number
		$this->add_control( 'number', [
			'label'   => __( 'Number', 'flexiaddons' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '999',
			'dynamic' => [
				'active' => true,
			],
		] );

		// Number Prefix
		$this->add_control( 'number_prefix', [
			'label' => __( 'Number Prefix', 'flexiaddons' ),
			'type'  => Controls_Manager::TEXT,
		] );

		// Number Suffix
		$this->add_control( 'number_suffix', [
			'label' => __( 'Number Suffix', 'flexiaddons' ),
			'type'  => Controls_Manager::TEXT,
		] );

		//Animation Heading
		$this->add_control( '_animation_heading', [
			'label'     => __( 'Animation', 'flexiaddons' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		//Animate
		$this->add_control( 'animate_number', [
			'label'       => __( 'Show Animation?', 'flexiaddons' ),
			'description' => __( 'Only number is animatable.', 'flexiaddons' ),
			'type'        => Controls_Manager::SWITCHER,
			'default'     => 'yes'
		] );

		//Animation Duration
		$this->add_control( 'animate_duration', [
			'label'     => __( 'Duration', 'flexiaddons' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 100,
			'max'       => 10000,
			'step'      => 10,
			'default'   => 500,
			'condition' => [
				'animate_number' => 'yes'
			],
			'dynamic'   => [
				'active' => true,
			],
		] );

		$this->end_controls_section();

		/**
		 * ======================
		 * | Settings Section |
		 * ======================
		 */
		$this->start_controls_section( '_section_settings', [
			'label' => __( 'Settings', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_CONTENT
		] );

		$this->add_control( 'title_tag', [
			'label'   => __( 'Title HTML Tag', 'flexiaddons' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'h1' => [
					'title' => __( 'H1', 'flexiaddons' ),
					'icon'  => 'eicon-editor-h1'
				],
				'h2' => [
					'title' => __( 'H2', 'flexiaddons' ),
					'icon'  => 'eicon-editor-h2'
				],
				'h3' => [
					'title' => __( 'H3', 'flexiaddons' ),
					'icon'  => 'eicon-editor-h3'
				],
				'h4' => [
					'title' => __( 'H4', 'flexiaddons' ),
					'icon'  => 'eicon-editor-h4'
				],
				'h5' => [
					'title' => __( 'H5', 'flexiaddons' ),
					'icon'  => 'eicon-editor-h5'
				],
				'h6' => [
					'title' => __( 'H6', 'flexiaddons' ),
					'icon'  => 'eicon-editor-h6'
				]
			],
			'default' => 'h2',
			'toggle'  => false,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'       => __( 'Text Alignment', 'flexiaddons' ),
			'type'        => Controls_Manager::CHOOSE,
			'options'     => [
				'left'   => [
					'title' => __( 'Left', 'flexiaddons' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'flexiaddons' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'flexiaddons' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'toggle'      => true,
			'selectors'   => [
				'{{WRAPPER}} .flexi-ff-content' => 'text-align: {{VALUE}};',
			],
			'default'     => 'center',
			'render_type' => 'template',
		] );

		$this->add_control( 'show_divider', [
			'label'        => __( 'Show Divider', 'flexiaddons' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Show', 'flexiaddons' ),
			'label_off'    => __( 'Hide', 'flexiaddons' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->end_controls_section();

		//Style Controls
		$this->register_style_controls();

	}

	protected function register_style_controls() {

		/**
		 * ======================
		 * | Style  Media
		 * ======================
		 */
		$this->start_controls_section( '_section_style_media', [
			'label' => __( 'Media', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		//Image Width
		$this->add_responsive_control( 'image_width', [
			'label'      => __( 'Width', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'min' => 150,
					'max' => 1024,
				],
				'%'  => [
					'min' => 30,
					'max' => 100,
				],
			],
			'default'    => [
				'unit' => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .media-image img' => 'width: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [
				'media_type' => 'img',
			]
		] );

		//Image Height
		$this->add_responsive_control( 'image_height', [
			'label'      => __( 'Height', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'min' => 150,
					'max' => 1024,
				],
				'%'  => [
					'min' => 30,
					'max' => 100,
				],
			],
			'default'    => [
				'unit' => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .media-image img' => 'height: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [
				'media_type' => 'img',
			]
		] );

		//Icon Size
		$this->add_responsive_control( 'icon_size', [
			'label'       => __( 'Icon Size', 'flexiaddons' ),
			'type'        => Controls_Manager::SLIDER,
			'size_units'  => [ 'px' ],
			'selectors'   => [
				'{{WRAPPER}} .flexi-fun-factor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
			'condition'   => [
				'media_type' => 'icon',
			],
			'render_type' => 'template',
		] );

		//Icon Color
		$this->add_control( 'icon_color', [
			'label'     => __( 'Icon Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-fun-factor-icon' => 'color: {{VALUE}};',
			],
			'condition' => [
				'media_type' => 'icon',
			],
		] );

		//Media Padding
		$this->add_responsive_control( 'media_padding', [
			'label'      => __( 'Padding', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .flexi-fun-factor-icon, {{WRAPPER}} .media-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		//Media Border
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'media_border',
			'selector'  => '{{WRAPPER}} .media-image img, {{WRAPPER}} .flexi-fun-factor-icon',
			'separator' => 'before'
		] );

		//Media Border Radius
		$this->add_responsive_control( 'media_border_radius', [
			'label'      => __( 'Border Radius', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .media-image img, {{WRAPPER}} .flexi-fun-factor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		//Media Box Shadow
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'media_box_shadow',
			'selector' => '{{WRAPPER}} .media-image img, {{WRAPPER}} .flexi-fun-factor-icon',
		] );

		//Media Spacing
		$this->add_responsive_control( 'media_spacing', [
			'label'     => __( 'Margin', 'flexiaddons' ),
			'type'      => Controls_Manager::DIMENSIONS,
			'selectors' => [
				'{{WRAPPER}} .flexi-ff-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'icon_bg_color', [
			'label'     => __( 'Background Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-fun-factor-icon' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'media_type' => 'icon'
			]
		] );

		$this->add_control( 'offset_toggle', [
			'label'        => __( 'Offset', 'flexiaddons' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => __( 'No', 'flexiaddons' ),
			'label_on'     => __( 'Yes', 'flexiaddons' ),
			'return_value' => 'yes',
		] );

		$this->start_popover();

		$this->add_responsive_control( 'media_offset_x', [
			'label'       => __( 'Offset Left', 'flexiaddons' ),
			'type'        => Controls_Manager::SLIDER,
			'size_units'  => [ 'px', '%' ],
			'condition'   => [
				'offset_toggle' => 'yes'
			],
			'range'       => [
				'px' => [
					'min' => - 300,
					'max' => 300,
				],
			],
			'render_type' => 'ui',
		] );

		$this->add_responsive_control( 'media_offset_y', [
			'label'      => __( 'Offset Top', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'condition'  => [
				'offset_toggle' => 'yes'
			],
			'range'      => [
				'px' => [
					'min' => - 300,
					'max' => 300,
				],
			],

			'selectors' => [
				'{{WRAPPER}} .flexi-ff-media' => 'transform: translate({{media_offset_x.SIZE}}{{UNIT}}, {{media_offset_y.SIZE}}{{UNIT}});',
			],
		] );
		$this->end_popover();

		$this->end_controls_section();


		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => __( 'Content', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control( 'content_padding', [
			'label'     => __( 'Padding', 'flexiaddons' ),
			'type'      => Controls_Manager::DIMENSIONS,
			'selectors' => [
				'{{WRAPPER}} .flexi-ff-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			]
		] );

		$this->add_control( '_number_heading', [
			'label' => __( 'Number', 'flexiaddons' ),
			'type'  => Controls_Manager::HEADING
		] );

		$this->add_control( 'number_spacing', [
			'label'      => __( 'Spacing', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .flexi-fun-factor-number-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			]
		] );

		$this->add_control( 'number_color', [
			'label'     => __( 'Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-fun-factor-number-wrap>span' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'number_typography',
			'label'    => __( 'Typography', 'flexiaddons' ),
			'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .flexi-fun-factor-number-wrap>span',
		] );

		$this->add_group_control( Group_Control_Text_Shadow::get_type(), [
			'name'     => 'fun_factor_number_shadow',
			'label'    => __( 'Text Shadow', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flexi-fun-factor-number-wrap',
		] );

		/*
		 * Title section
		 */

		$this->add_control( '_title_style_heading', [
			'label'     => __( 'Title', 'flexiaddons' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before'
		] );

		$this->add_control( 'title_spacing', [
			'label'      => __( 'Title Spacing', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .flexi-fun-factor-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			]
		] );

		$this->add_control( 'content_color', [
			'label'     => __( 'Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-fun-factor-text' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'label'    => __( 'Typography', 'flexiaddons' ),
			'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .flexi-fun-factor-text',
		] );

		$this->add_group_control( Group_Control_Text_Shadow::get_type(), [
			'name'     => 'fun_factor_content_shadow',
			'label'    => __( 'Text Shadow', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flexi-fun-factor-text',
		] );

		$this->end_controls_section();

		/*
		 * Divider style section
		 */
		$this->start_controls_section( '_section_divider', [
			'label'     => __( 'Divider', 'flexiaddons' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'show_divider' => 'yes'
			]
		] );

		$this->add_responsive_control( 'divider_width', [
			'label'      => __( 'Width', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range'      => [
				'%' => [
					'min' => 10,
					'max' => 100
				],
			],
			'default'    => [
				'unit' => '%'
			],
			'selectors'  => [
				'{{WRAPPER}} .flexi-fun-factor-divider' => 'width: {{SIZE}}{{UNIT}} !important;',
			],
		] );

		$this->add_responsive_control( 'divider_height', [
			'label'      => __( 'Height', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'default'    => [
				'px' => 1
			],
			'selectors'  => [
				'{{WRAPPER}} .flexi-fun-factor-divider' => 'height: {{SIZE}}{{UNIT}} !important;',
			],
		] );

		$this->add_responsive_control( 'divider_border_radius', [
			'label'     => __( 'Border Radius', 'flexiaddons' ),
			'type'      => Controls_Manager::DIMENSIONS,
			'selectors' => [
				'{{WRAPPER}} .flexi-fun-factor-divider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'divider_color', [
			'label'     => __( 'Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flexi-fun-factor-divider' => 'background-color: {{VALUE}} !important;',
			],
		] );

		$this->add_control( 'divider_spacing', [
			'label'      => __( 'Margin', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .flexi-fun-factor-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'number', 'class', 'flexi-fun-factor-number' );

		$number           = $settings['number'];
		$fun_factor_title = $settings['title'];

		if ( $settings['animate_number'] ) {
			$data = [
				'toValue'  => intval( $settings['number'] ),
				'duration' => intval( $settings['animate_duration'] ),
			];
			$this->add_render_attribute( 'number', 'data-animation', wp_json_encode( $data ) );
			$number = 0;
		}

		?>

        <div class="flexi-fun-factor">

			<?php if ( ! empty( $settings['icon']['value'] ) || ! empty( $settings['icon_new']['value'] ) ) { ?>
                <div class="flexi-ff-media media-icon media-align-<?php echo esc_attr( $settings['text_align'] ); ?>">
					<?php flexiaddons_render_icon( $settings, 'icon', 'icon_new', [
						'class' => 'flexi-fun-factor-icon'
					] ); ?>
                </div>
			<?php } elseif ( ! empty( $settings['image']['url'] ) || ! empty( $settings['image']['id'] ) ) { ?>
                <div class="flexi-ff-media media-image media-align-<?php echo esc_attr( $settings['text_align'] ); ?>">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                </div>
			<?php } ?>

            <div class="flexi-ff-content">

                <div class="flexi-fun-factor-number-wrap">
                    <span class="flexi-number-prefix"><?php echo esc_html( $settings['number_prefix'] ); ?></span>
                    <span <?php $this->print_render_attribute_string( 'number' ); ?> ><?php echo esc_html( $number ); ?></span>
                    <span class="flexi-number-suffix"><?php echo esc_html( $settings['number_suffix'] ); ?></span>
                </div>

				<?php if ( 'yes' === $settings['show_divider'] ) : ?>
                    <span class="flexi-fun-factor-divider flexi-fun-factor-divider-align-<?php echo esc_attr( $settings['text_align'] ); ?>"></span>
				<?php endif; ?>
				<?php printf( '<%1$s class="flexi-fun-factor-text">%2$s</%1$s>',
					tag_escape( $settings['title_tag'] ),
					esc_html( $fun_factor_title )
				); ?>
            </div>

        </div>
		<?php
	}

}
