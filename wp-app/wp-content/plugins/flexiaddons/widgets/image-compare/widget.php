<?php


use Elementor\Control_Media;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Flexi_Addons_Widget_Image_Compare extends Flexi_Addons_Widget_Base {

	protected $key = 'image-compare';

	/**
	 * Register content related controls
	 */
	protected function _register_controls() {

		/*=== Section Images ===*/
		$this->start_controls_section( '_section_images', [
			'label' => __( 'Images', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->start_controls_tabs( '_tab_images' );

		//Before Image
		$this->start_controls_tab( '_tab_before_image', [
			'label' => __( 'Before', 'flexiaddons' ),
		] );

		$this->add_control( 'before_image', [
			'label'   => __( 'Image', 'flexiaddons' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'dynamic' => [
				'active' => true,
			]
		] );

		$this->add_control( 'before_label', [
			'label'       => __( 'Label', 'flexiaddons' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Before', 'flexiaddons' ),
			'placeholder' => __( 'Type before image label', 'flexiaddons' ),
			'description' => __( 'Label will not be shown if Hide Overlay is enabled in Settings', 'flexiaddons' ),
			'dynamic'     => [
				'active' => true,
			]
		] );

		$this->end_controls_tab();

		//After image
		$this->start_controls_tab( '_tab_after_image', [
			'label' => __( 'After', 'flexiaddons' ),
		] );

		$this->add_control( 'after_image', [
			'label'   => __( 'Image', 'flexiaddons' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'dynamic' => [
				'active' => true,
			]
		] );

		$this->add_control( 'after_label', [
			'label'       => __( 'Label', 'flexiaddons' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'After', 'flexiaddons' ),
			'placeholder' => __( 'Type after image label', 'flexiaddons' ),
			'description' => __( 'Label will not be shown if Hide Overlay is enabled in Settings', 'flexiaddons' ),
			'dynamic'     => [
				'active' => true,
			]
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'separator' => 'before',
		] );

		$this->end_controls_section();

		/*=== Section Settings ===*/
		$this->start_controls_section( '_section_settings', [
			'label' => __( 'Settings', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'offset', [
			'label'          => __( 'Visibility Ratio', 'flexiaddons' ),
			'type'           => Controls_Manager::SLIDER,
			'size_units'     => [ 'px' ],
			'range'          => [
				'px' => [
					'min'  => 0,
					'max'  => 1,
					'step' => .1,
				],
			],
			'default'        => [
				'size' => .5,
			],
			'style_transfer' => true,
		] );

		$this->add_control( 'orientation', [
			'label'          => __( 'Orientation', 'flexiaddons' ),
			'type'           => Controls_Manager::CHOOSE,
			'label_block'    => false,
			'options'        => [
				'horizontal' => [
					'title' => __( 'Horizontal', 'flexiaddons' ),
					'icon'  => 'fa fa-arrows-h',
				],
				'vertical'   => [
					'title' => __( 'Vertical', 'flexiaddons' ),
					'icon'  => 'fa fa-arrows-v',
				],
			],
			'default'        => 'horizontal',
			'style_transfer' => true,
		] );

		$this->add_control( 'overlay', [
			'label'          => __( 'Show Overlay', 'flexiaddons' ),
			'type'           => Controls_Manager::SWITCHER,
			'label_on'       => __( 'Yes', 'flexiaddons' ),
			'label_off'      => __( 'No', 'flexiaddons' ),
			'default'        => 'yes',
			'description'    => __( 'Show overlay with before and after label', 'flexiaddons' ),
			'style_transfer' => true,
		] );

		$this->add_control( 'on_hover', [
			'label'          => __( 'Move Slider on Hover?', 'flexiaddons' ),
			'type'           => Controls_Manager::SWITCHER,
			'default'        => 'no',
			'description'    => __( 'Move slider on mouse hover? Note: overlay does not work with On Hover.', 'flexiaddons' ),
			'style_transfer' => true,
		] );

		$this->add_control( 'click_to_move', [
			'label'          => __( 'Click to move?', 'flexiaddons' ),
			'type'           => Controls_Manager::SWITCHER,
			'default'        => 'no',
			'description'    => __( 'Allow a user to swipe anywhere on the image to control slider movement.', 'flexiaddons' ),
			'style_transfer' => true,
		] );

		$this->end_controls_section();

		/* Style Controls */
		$this->register_style_controls();

	}


	/**
	 * Register style related controls
	 */
	protected function register_style_controls() {

		/*=== Section Style Handle ===*/
		$this->start_controls_section( '_section_style_handle', [
			'label' => __( 'Handle', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'handle_color', [
				'label'     => __( 'Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-handle:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-handle'                                                => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-left-arrow'                                            => 'border-right-color: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-right-arrow'                                           => 'border-left-color: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-handle:before'                                         =>
						'-webkit-box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);'
						. '-moz-box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);'
						. 'box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .twentytwenty-handle:after'                                          =>
						'-webkit-box-shadow: 0 -3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);'
						. '-moz-box-shadow: 0 -3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);'
						. 'box-shadow: 0 -3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
				],
			]
		);

		//Bar
		$this->add_control( '_heading_bar', [
			'label'     => __( 'Handle Bar', 'flexiaddons' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'bar_size', [
			'label'      => __( 'Size', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 50,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}}; margin-left: calc(-0px - {{SIZE}}{{UNIT}} / 2);',
				'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after'     => 'height: {{SIZE}}{{UNIT}}; margin-top: calc(-0px - {{SIZE}}{{UNIT}} / 2);',
			],
		] );

		//Arrow
		$this->add_control( '_heading_arrow', [
			'label'     => __( 'Handle Arrow', 'flexiaddons' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'arrow_box_width', [
			'label'      => __( 'Box Width', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => 20,
					'max' => 250,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .twentytwenty-handle'                               => 'width: {{SIZE}}{{UNIT}}; margin-left: calc(-1 * ({{SIZE}}{{UNIT}} / 2));',
				'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before' => 'margin-left: calc(({{SIZE}}{{UNIT}} / 2) - 1px);',
				'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after'  => 'margin-right: calc(({{SIZE}}{{UNIT}} / 2) - 1px);',
			],
		] );

		$this->add_responsive_control( 'arrow_box_height', [
			'label'      => __( 'Box Height', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => 20,
					'max' => 250,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .twentytwenty-handle'                                 => 'height: {{SIZE}}{{UNIT}}; margin-top: calc(-1 * ({{SIZE}}{{UNIT}} / 2));',
				'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before' => 'margin-bottom: calc(({{SIZE}}{{UNIT}} / 2) + 2px);',
				'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after'  => 'margin-top: calc(({{SIZE}}{{UNIT}} / 2) + 2px);',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'box_border',
			'selector' => '{{WRAPPER}} .twentytwenty-handle',
			'exclude'  => [
				'color'
			]
		] );

		$this->add_responsive_control( 'box_border_radius', [
			'label'      => __( 'Border Radius', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .twentytwenty-handle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/*=== Section Style Label ===*/
		$this->start_controls_section( '_section_style_label', [
			'label' => __( 'Label', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'label_padding', [
			'label'      => __( 'Padding', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'position_toggle', [
			'label'        => __( 'Position', 'flexiaddons' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => __( 'None', 'flexiaddons' ),
			'label_on'     => __( 'Custom', 'flexiaddons' ),
			'return_value' => 'yes',
		] );

		//Label Offset
		$this->start_popover();

		$this->add_responsive_control( 'label_offset_y', [
			'label'      => __( 'Vertical', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 10,
					'max' => 1000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-after-label:before'                                                                           => 'bottom: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before'                                                                          => 'top: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-after-label:before' => 'top: {{SIZE}}{{UNIT}};'
			],
			'condition'  => [
				'position_toggle' => 'yes',
			]
		] );

		$this->add_responsive_control( 'label_offset_x', [
			'label'      => __( 'Horizontal', 'flexiaddons' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => - 10,
					'max' => 1000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-after-label:before'                                                                     => 'right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-before-label:before'                                                                    => 'left: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-after-label:before' => 'left: {{SIZE}}{{UNIT}};'
			],
			'condition'  => [
				'position_toggle' => 'yes',
			]
		] );

		$this->end_popover();

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'label_border',
			'selector' => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before',
		] );

		$this->add_responsive_control( 'label_border_radius', [
			'label'      => __( 'Border Radius', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'label_color', [
			'label'     => __( 'Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'label_bg_color', [
			'label'     => __( 'Background Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'label_box_shadow',
			'selector' => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before'
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'label_typography',
			'selector' => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
		] );

		$this->end_controls_section();
	}

	/**
	 * render the view
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'container', 'class', [ 'twentytwenty-container', 'flexi-image-comparison', ] );

		$this->add_render_attribute( 'container', [
			'data-orientation'   => $settings['orientation'],
			'data-before_label'  => $settings['before_label'],
			'data-after_label'   => $settings['after_label'],
			'data-offset'        => $settings['offset']['size'],
			'data-overlay'       => 'yes' == $settings['overlay'] ? 0 : 1,
			'data-on_hover'      => 'yes' == $settings['on_hover'] ? 1 : 0,
			'data-click_to_move' => 'yes' == $settings['click_to_move'] ? 1 : 0,
		] );

		?>

        <div <?php echo $this->get_render_attribute_string( 'container' ); ?>>

            <?php

            foreach ( [ 'before_image', 'after_image' ] as $item ) {
	            if ( $settings[ $item ]['url'] || $settings[ $item ]['id'] ) {
		            $this->add_render_attribute( $item, 'src', $settings[ $item ]['url'] );
		            $this->add_render_attribute( $item, 'alt', Control_Media::get_image_alt( $settings[ $item ] ) );
		            $this->add_render_attribute( $item, 'title', Control_Media::get_image_title( $settings[ $item ] ) );
		            $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
		            echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', $item );
	            }
            }

            ?>

        </div>
		<?php
	}

}