<?php

use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Scheme_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Flexi_Addons_Widget_Icon_Box extends Flexi_Addons_Widget_Base {

	protected $key = 'icon-box';

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon Box', 'flexiaddons' )
			]
		);

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
			] );
		}

		//Position
		$this->add_control( 'position', [
			'label'        => __( 'Icon Position', 'flexiaddons' ),
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
			'prefix_class' => 'kfa-position-',
			'toggle'       => false,
		] );

		//Title
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'flexiaddons' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( 'This is the heading', 'flexiaddons' ),
				'placeholder' => __( 'Enter your title', 'flexiaddons' ),
				'label_block' => true,
				'separator'   => 'before',
			]
		);

		//Title tag
		$this->add_control(
			'title_tag',
			[
				'label'   => __( 'Title HTML Tag', 'flexiaddons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h3',
			]
		);

		//Alignment
		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment', 'flexiaddons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'flexiaddons' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'flexiaddons' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'flexiaddons' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .kfa-iconbox' => 'text-align: {{VALUE}};'
				]
			]
		);

		//Link
		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'flexiaddons' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'flexiaddons' ),
				'separator'   => 'before',
			]
		);

		//Show Badge
		$this->add_control(
			'show_badge',
			[
				'label'        => __( 'Show Badge', 'flexiaddons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'flexiaddons' ),
				'label_off'    => __( 'Hide', 'flexiaddons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		// Badge Title
		$this->add_control(
			'badge_title',
			[
				'label'       => __( 'Badge Title', 'flexiaddons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Free', 'flexiaddons' ),
				'placeholder' => __( 'Type your title here', 'flexiaddons' ),
				'condition'   => [
					'show_badge' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		//Style Controls
		$this->register_style_controls();
	}

	protected function register_style_controls() {
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Icon Size
		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => __( 'Size', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 24
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Padding
		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => __( 'Padding', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .kfa-icon-wrapper i' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Margin
		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => __( 'Margin', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'max' => 300
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-icon-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Border Section
		$this->add_control(
			'border_section',
			[
				'label'     => __( 'Border', 'flexiaddons' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		//Border Type
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'selector' => '{{WRAPPER}} .kfa-icon-wrapper'
			]
		);

		//Border Radius
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .kfa-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'icon_shadow',
				'exclude'   => [
					'box_shadow_position',
				],
				'selector'  => '{{WRAPPER}} .kfa-icon-wrapper',
				'separator' => 'before'
			]
		);

		//Icon Tabs
		$this->start_controls_tabs( 'tabs_icon' );

		//Icon Tab Normal
		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'flexiaddons' ),
			]
		);

		//Normal Color
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-icon-wrapper' => 'color: {{VALUE}};',
				],
			]
		);

		//Normal BG Color
		$this->add_control(
			'icon_bg_color',
			[
				'label'     => __( 'Icon Background Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-icon-wrapper' => 'background: {{VALUE}};',
				],
			]
		);

		//Normal Rotate
		$this->add_control(
			'icon_bg_rotate',
			[
				'label'      => __( 'Rotate Icon Box', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default'    => [
					'unit' => 'deg',
				],
				'range'      => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .kfa-icon-wrapper'     => '-webkit-transform: rotate({{SIZE}}{{UNIT}}); transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .kfa-icon-wrapper > i' => '-webkit-transform: rotate(-{{SIZE}}{{UNIT}}); transform: rotate(-{{SIZE}}{{UNIT}});',
				],
				'condition'  => [
					'icon_bg_color!' => '',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'flexiaddons' ),
			]
		);

		//Hover Color
		$this->add_control(
			'icon_hover_color',
			[
				'label'     => __( 'Icon Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .kfa-icon-wrapper' => 'color: {{VALUE}};',
				],
			]
		);

		//Hover BG Color
		$this->add_control(
			'icon_hover_bg_color',
			[
				'label'     => __( 'Icon Background Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .kfa-icon-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		//Hover Border Color
		$this->add_control(
			'icon_hover_border_color',
			[
				'label'     => __( 'Border Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .kfa-icon-wrapper' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'icon_border_border!' => '',
				]
			]
		);

		//Hover BG rotate
		$this->add_control(
			'icon_hover_bg_rotate',
			[
				'label'      => __( 'Rotate Icon Box', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default'    => [
					'unit' => 'deg',
				],
				'range'      => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}:hover .kfa-icon-wrapper'     => '-webkit-transform: rotate({{SIZE}}{{UNIT}}); transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}}:hover .kfa-icon-wrapper > i' => '-webkit-transform: rotate(-{{SIZE}}{{UNIT}}); transform: rotate(-{{SIZE}}{{UNIT}});',
				],
				'condition'  => [
					'icon_bg_color!' => '',
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ==============
		 * Title Style Tab
		 * ==============
		 */
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title',
				'selector' => '{{WRAPPER}} .kfa-iconbox-title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_2
			]
		);

		//Text Shadow
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title',
				'selector' => '{{WRAPPER}} .kfa-iconbox-title',
			]
		);

		//Title Tabs
		$this->start_controls_tabs( 'tabs_title' );

		//Normal Tab
		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'flexiaddons' ),
			]
		);

		//Text Color
		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Text Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-iconbox-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		//Hover Tab
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'flexiaddons' ),
			]
		);

		//Hover Color
		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Text Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .kfa-iconbox-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();


		/* ==============
		 * Badge Style Tab
		 * ==============
		 */
		$this->start_controls_section(
			'section_badge_style',
			[
				'label' => __( 'Badge', 'flexiaddons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Position Sec
		$this->add_control(
			'_badge_position',
			[
				'label' => __( 'Position', 'flexiaddons' ),
				'type'  => Controls_Manager::HEADING
			]
		);

		//Offset
		$this->add_control(
			'badge_offset',
			[
				'label'        => __( 'Offset', 'flexiaddons' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'None', 'flexiaddons' ),
				'label_on'     => __( 'Custom', 'flexiaddons' ),
				'return_value' => 'yes',
			]
		);

		//Offset Popover
		$this->start_popover();

		$this->add_responsive_control(
			'badge_offset_x',
			[
				'label'       => __( 'Offset Left', 'flexiaddons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'condition'   => [
					'badge_offset' => 'yes'
				],
				'default'     => [
					'size' => 1
				],
				'range'       => [
					'px' => [
						'min' => - 300,
						'max' => 300,
					],
				],
				'render_type' => 'ui'
			]
		);

		$this->add_responsive_control(
			'badge_offset_y',
			[
				'label'      => __( 'Offset Top', 'flexiaddons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'condition'  => [
					'badge_offset' => 'yes'
				],
				'default'    => [
					'size' => 1
				],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500,
					],
				],
				'selectors'  => [
					'(desktop){{WRAPPER}} .kfa-badge' =>
						'-webkit-transform: translate({{badge_offset_x.SIZE || 0}}{{UNIT}}, {{badge_offset_y.SIZE || 0}}{{UNIT}});
                        transform: translate({{badge_offset_x.SIZE || 0}}{{UNIT}}, {{badge_offset_y.SIZE || 0}}{{UNIT}});',
					'(tablet){{WRAPPER}} .kfa-badge'  =>
						'-webkit-transform: translate({{badge_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{badge_offset_y_tablet.SIZE || 0}}{{UNIT}});
                        transform: translate({{badge_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{badge_offset_y_tablet.SIZE || 0}}{{UNIT}});',
					'(mobile){{WRAPPER}} .kfa-badge'  =>
						'-webkit-transform: translate({{badge_offset_x_mobile.SIZE}}{{UNIT}}, {{badge_offset_y_mobile.SIZE || 0}}{{UNIT}});
                        transform: translate({{badge_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{badge_offset_y_mobile.SIZE || 0}}{{UNIT}});',
				],
			]
		);

		$this->end_popover();

		//Padding
		$this->add_responsive_control(
			'badge_padding',
			[
				'label'      => __( 'Padding', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .kfa-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Colors
		$this->add_control(
			'_badge_colors',
			[
				'label'     => __( 'Colors', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		//Badge Color
		$this->add_control(
			'badge_color',
			[
				'label'     => __( 'Text Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-badge' => 'color: {{VALUE}};',
				],
			]
		);

		//Background Color
		$this->add_control(
			'badge_bg_color',
			[
				'label'     => __( 'Background Color', 'flexiaddons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kfa-badge' => 'background: {{VALUE}};',
				],
			]
		);

		//Border
		$this->add_control(
			'_badge_border',
			[
				'label'     => __( 'Border', 'flexiaddons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'badge_border',
				'selector' => '{{WRAPPER}} .kfa-badge',
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label'      => __( 'Border Radius', 'flexiaddons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .kfa-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'badge_box_shadow',
				'exclude'  => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .kfa-badge',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'badge_typography',
				'label'    => __( 'Typography', 'flexiaddons' ),
				'exclude'  => [
					'font_family',
					'line_height'
				],
				'default'  => [
					'font_size' => [ '' ]
				],
				'selector' => '{{WRAPPER}} .kfa-badge',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$has_icon = ! empty( $settings['icon'] ) || ! empty( $settings['icon_new']['value'] );

		$has_link = ! empty( $settings['link']['url'] );

		if ( $has_link ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		$link_attributes = $this->get_render_attribute_string( 'link' );

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'kfa-iconbox-title' );

		$this->add_inline_editing_attributes( 'badge_title', 'basic' );
		$this->add_render_attribute( 'badge_title', 'class', 'kfa-badge-text' );

		if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
			$has_icon = true;
		}

		?>

		<?php echo $has_link ? sprintf( '<a %1$s>', $link_attributes ) : ''; ?>
        <div class="kfa-iconbox">

			<?php

			//Badge
			if ( ! empty( $settings['show_badge'] ) && $settings['show_badge'] == 'yes' ) { ?>
                <div class="kfa-badge">
					<?php
					printf(
						'<span %1$s>%2$s</span>',
						$this->get_render_attribute_string( 'badge_title' ),
						$settings['badge_title']
					);
					?>
                </div>
			<?php }

			//Icon Box Wrapper
			if ( $has_icon ) { ?>
                <div class="kfa-icon-box">
                    <div class="kfa-icon-wrapper">
						<?php flexiaddons_render_icon( $settings, 'icon', 'icon_new' ); ?>
                    </div>
                </div>
			<?php } ?>

            <div class="kfa-iconbox-content">
				<?php
				printf(
					'<%1$s %2$s>%3$s</%1$s>',
					$settings['title_tag'],
					$this->get_render_attribute_string( 'title' ),
					$settings['title']
				);
				?>
            </div>

        </div>

		<?php
		echo $has_link ? '</a>' : '';

	}

}
