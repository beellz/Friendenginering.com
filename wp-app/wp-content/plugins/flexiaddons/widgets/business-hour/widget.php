<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;

defined( 'ABSPATH' ) || die();

class Flexi_Addons_Widget_Business_Hour extends Flexi_Addons_Widget_Base {


	protected $key = 'business-hour';

	protected function _register_controls() {

		$this->start_controls_section( '_section_business_hour', [
			'label' => __( 'Business Hour', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'title', [
			'label'       => __( 'Title', 'flexiaddons' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __( 'Working Hour', 'flexiaddons' ),
			'dynamic'     => [ 'active' => true, ],
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'day', [
			'label'       => __( 'Day', 'flexiaddons' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __( 'Monday', 'flexiaddons' ),
			'placeholder' => __( 'Monday', 'flexiaddons' ),
			'dynamic'     => [ 'active' => true, ],
		] );

		$repeater->add_control( 'time', [
			'label'       => __( 'Time', 'flexiaddons' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __( '10:00AM - 07:00PM', 'flexiaddons' ),
			'placeholder' => __( '10:00AM - 07:00PM', 'flexiaddons' ),
			'dynamic'     => [ 'active' => true, ],
		] );

		$repeater->add_control( 'individual_style', [
			'label'          => __( 'Individual Style?', 'flexiaddons' ),
			'type'           => Controls_Manager::SWITCHER,
			'label_on'       => __( 'Yes', 'flexiaddons' ),
			'label_off'      => __( 'No', 'flexiaddons' ),
			'return_value'   => 'yes',
			'default'        => 'no',
			'style_transfer' => true,
		] );

		$repeater->add_control( 'day_time_color', [
			'label'          => __( 'Text Color', 'flexiaddons' ),
			'type'           => Controls_Manager::COLOR,
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}.flx-business-hour-item' => 'color: {{VALUE}};',
			],
			'condition'      => [
				'individual_style' => 'yes',
			],
			'separator'      => 'before',
			'style_transfer' => true,
		] );

		$repeater->add_group_control( Group_Control_Border::get_type(), [
			'name'           => 'day_time_border',
			'label'          => __( 'Border', 'flexiaddons' ),
			'selector'       => '{{WRAPPER}} {{CURRENT_ITEM}}.flx-business-hour-item',
			'style_transfer' => true,
			'condition'      => [
				'individual_style' => 'yes',
			],
		] );

		$repeater->add_group_control( Group_Control_Background::get_type(), [
			'name'           => 'day_time_background',
			'label'          => __( 'Background', 'flexiaddons' ),
			'types'          => [ 'classic', 'gradient' ],
			'selector'       => '{{WRAPPER}} {{CURRENT_ITEM}}.flx-business-hour-item',
			'condition'      => [
				'individual_style' => 'yes',
			],
			'separator'      => 'before',
			'style_transfer' => true,
		] );

		$repeater->add_control( 'day_time_border_radius', [
			'label'          => __( 'Border Radius', 'flexiaddons' ),
			'type'           => Controls_Manager::DIMENSIONS,
			'size_units'     => [ 'px', '%', 'em' ],
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}.flx-business-hour-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'      => [
				'individual_style' => 'yes',
			],
			'style_transfer' => true,
		] );

		$repeater->add_control( 'day_time_margin', [
			'label'          => __( 'Margin', 'flexiaddons' ),
			'type'           => Controls_Manager::DIMENSIONS,
			'size_units'     => [ 'px', '%', 'em' ],
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}}.flx-business-hour-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'      => [
				'individual_style' => 'yes',
			],
			'style_transfer' => true,
		] );

		$this->add_control( 'business_hour_list', [
			'show_label'  => false,
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'title_field' => '{{{ day }}}',
			'default'     => [
				[
					'day'  => __( 'Monday', 'flexiaddons' ),
					'time' => __( '10:00AM - 07:00PM', 'flexiaddons' ),
				],
				[
					'day'  => __( 'Tuesday', 'flexiaddons' ),
					'time' => __( '10:00AM - 07:00PM', 'flexiaddons' ),
				],
				[
					'day'  => __( 'Wednesday', 'flexiaddons' ),
					'time' => __( '10:00AM - 07:00PM', 'flexiaddons' ),
				],
				[
					'day'  => __( 'Thursday', 'flexiaddons' ),
					'time' => __( '10:00AM - 07:00PM', 'flexiaddons' ),
				],
				[
					'day'  => __( 'Friday', 'flexiaddons' ),
					'time' => __( '10:00AM - 07:00PM', 'flexiaddons' ),
				],
				[
					'day'  => __( 'Saturday', 'flexiaddons' ),
					'time' => __( '10:00AM - 07:00PM', 'flexiaddons' ),
				],
				[
					'day'  => __( 'Sunday', 'flexiaddons' ),
					'time' => __( 'Closed', 'flexiaddons' ),
				],
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( '_section_business_settings', [
			'label' => __( 'Settings', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_SETTINGS,
		] );

		$this->add_control( 'title_alignment', [
			'label'       => __( 'Title Alignment', 'flexiaddons' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
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
			'toggle'      => false,
			'selectors'   => [
				'{{WRAPPER}} .flx-business-hour-title' => 'text-align: {{VALUE}}',
			],
		] );

		$this->add_control( 'day_alignment', [
			'label'       => __( 'Day Alignment', 'flexiaddons' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
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
			'toggle'      => false,
			'selectors'   => [
				'{{WRAPPER}} .flx-business-hour-item .flx-business-hour-day' => 'text-align: {{VALUE}}',
			],
		] );

		$this->add_control( 'time_alignment', [
			'label'       => __( 'Time Alignment', 'flexiaddons' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
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
			'toggle'      => false,
			'selectors'   => [
				'{{WRAPPER}} .flx-business-hour-item .flx-business-hour-time' => 'text-align: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		$this->register_style_controls();

	}

	protected function register_style_controls() {

		//Business Hour Title Style
		$this->start_controls_section( '_section_business_hour_title_style', [
			'label' => __( 'Title', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Text Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flx-business-hour-title h3' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .flx-business-hour-title h3',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'title_border',
			'label'    => __( 'Border', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flx-business-hour-title',
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => 'title_background',
			'label'     => __( 'Background', 'flexiaddons' ),
			'types'     => [ 'classic', 'gradient' ],
			'selector'  => '{{WRAPPER}} .flx-business-hour-title',
			'separator' => 'before',
		] );

		$this->add_control( 'title_border_radius', [
			'label'      => __( 'Border Radius', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .flx-business-hour-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'title_padding', [
			'label'      => __( 'Padding', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .flx-business-hour-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'title_margin', [
			'label'      => __( 'Margin', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .flx-business-hour-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		//Business Hour List Style
		$this->start_controls_section( '_section_business_hour_list_style', [
			'label' => __( 'Hour List', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'list_color', [
			'label'     => __( 'Text Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flx-business-hour-item' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'list_typography',
			'selector' => '{{WRAPPER}} .flx-business-hour-item',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'list_border',
			'label'    => __( 'Border', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flx-business-hour-item',
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => 'list_background',
			'label'     => __( 'Background', 'flexiaddons' ),
			'types'     => [ 'classic', 'gradient' ],
			'selector'  => '{{WRAPPER}} .flx-business-hour-item',
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'list_shadow',
			'label'    => __( 'Box Shadow', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flx-business-hour-item',
		] );

		$this->add_control( 'list_border_radius', [
			'label'      => __( 'Border Radius', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .flx-business-hour-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'list_padding', [
			'label'      => __( 'Padding', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .flx-business-hour-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'list_margin', [
			'label'      => __( 'Margin', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .flx-business-hour-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		//Business Hour Container Style
		$this->start_controls_section( '_section_business_hour_container_style', [
			'label' => __( 'Container', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'container_border',
			'label'    => __( 'Border', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flx-business-hour-wrapper ul',
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => 'container_background',
			'label'     => __( 'Background', 'flexiaddons' ),
			'types'     => [ 'classic', 'gradient' ],
			'selector'  => '{{WRAPPER}} .flx-business-hour-wrapper ul',
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'container_shadow',
			'label'    => __( 'Box Shadow', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flx-business-hour-wrapper ul',
		] );

		$this->add_control( 'container_border_radius', [
			'label'      => __( 'Border Radius', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .flx-business-hour-wrapper ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'container_padding', [
			'label'      => __( 'Padding', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .flx-business-hour-wrapper ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
        <div class="flx-business-hour-wrapper">
            <ul>

				<?php if ( $settings['title'] ) {
					printf( '<li class="flx-business-hour-title"><h3>%s</h3></li>', esc_html( $settings['title'] ) );
				} ?>

				<?php

				if ( is_array( $settings['business_hour_list'] ) && 0 != count( $settings['business_hour_list'] ) ) {
					foreach ( $settings['business_hour_list'] as $key => $item ) {

						// Day
						$day_key = $this->get_repeater_setting_key( 'day', 'business_hour_list', $key );
						$this->add_inline_editing_attributes( $day_key, 'basic' );
						$this->add_render_attribute( $day_key, 'class', 'flx-business-hour-day' );

						// Time
						$time_key = $this->get_repeater_setting_key( 'time', 'business_hour_list', $key );
						$this->add_inline_editing_attributes( $time_key, 'basic' );
						$this->add_render_attribute( $time_key, 'class', 'flx-business-hour-time' );

						?>
                        <li class="flx-business-hour-item elementor-repeater-item-<?php echo $item['_id']; ?>">
							<?php

							if ( $item['day'] ) {
								printf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( $day_key ),
									esc_html( $item['day'] ) );
							}

							if ( $item['time'] ) {
								printf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( $time_key ),
									esc_html( $item['time'] ) );
							}

							?>
                        </li>
						<?php
					}
				}
				?>
            </ul>
        </div>
		<?php
	}

}