<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;

defined( 'ABSPATH' ) || die();

class Flexi_Addons_Widget_Wp_Form extends Flexi_Addons_Widget_Base {


	protected $key = 'wp-form';

	public function flexiaddon_wpforms_forms(){
        $formlist = array();
        $forms_args = array( 'posts_per_page' => -1, 'post_type'=> 'wpforms' );
        $forms = get_posts( $forms_args );
        if( $forms ){
            foreach ( $forms as $form ){
                $formlist[$form->ID] = $form->post_title;
            }
        }else{
            $formlist['0'] = __('Form not found','flexiaddons');
        }
        return $formlist;
    }

	protected function _register_controls() {

		$this->start_controls_section(
			'_section_wp_form',
				[
					'label' => __('WpForm', 'flexiaddons'),
					'tab'   => Controls_Manager::TAB_CONTENT,
				]
		);

		$this->add_control(
			'contact_form_list',
			[
				'label'             => __( 'Select Form', 'flexiaddons'),
				'type'              => Controls_Manager::SELECT,
				'label_block'       => true,
				'options'           => $this->flexiaddon_wpforms_forms(),
				'default'           => '0',
			]
		);

		$this->add_control(
			'custom_title_description',
			[
				'label'                 => __( 'Custom Title & Description', 'flexiaddons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'label_on'              => __( 'Yes', 'flexiaddons' ),
				'label_off'             => __( 'No', 'flexiaddons' ),
				'return_value'          => 'yes',
				'default'               => 'no',
			]
		);

		$this->add_control(
			'form_title',
			[
				'label'                 => __( 'Title', 'flexiaddons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'label_on'              => __( 'Show', 'flexiaddons' ),
				'label_off'             => __( 'Hide', 'flexiaddons' ),
				'return_value'          => 'yes',
				'condition'             => [
					'custom_title_description!'   => 'yes',
				],
				'default'               => 'no',
			]
		);

		$this->add_control(
			'form_description',
			[
				'label'                 => __( 'Description', 'flexiaddons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'label_on'              => __( 'Show', 'flexiaddons' ),
				'label_off'             => __( 'Hide', 'flexiaddons' ),
				'return_value'          => 'yes',
				'condition'             => [
					'custom_title_description!'   => 'yes',
				],
				'default'               => 'no',
			]
		);

		$this->add_control(
			'form_title_custom',
			[
				'label'                 => esc_html__( 'Title', 'flexiaddons' ),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
				'default'               => '',
				'condition'             => [
					'custom_title_description'   => 'yes',
				],
			]
		);

		$this->add_control(
			'form_description_custom',
			[
				'label'                 => esc_html__( 'Description', 'flexiaddons' ),
				'type'                  => Controls_Manager::TEXTAREA,
				'default'               => '',
				'condition'             => [
					'custom_title_description'   => 'yes',
				],
			]
		);

		$this->add_control(
			'labels_switch',
			[
				'label'                 => __( 'Labels', 'flexiaddons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Show', 'flexiaddons' ),
				'label_off'             => __( 'Hide', 'flexiaddons' ),
				'return_value'          => 'yes',
				'prefix_class'          => 'fe-el-wpforms-labels-',
			]
		);

		$this->add_control(
			'placeholder_switch',
			[
				'label'                 => __( 'Placeholder', 'flexiaddons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Show', 'flexiaddons' ),
				'label_off'             => __( 'Hide', 'flexiaddons' ),
				'return_value'          => 'yes',
			]
		);

		$this->end_controls_section();

		/**
			 * Content Tab: Errors
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_errors',
				[
					'label'                 => __( 'Errors', 'flexiaddons' ),
				]
			);

			$this->add_control(
				'error_messages',
				[
					'label'                 => __( 'Error Messages', 'flexiaddons' ),
					'type'                  => Controls_Manager::SELECT,
					'default'               => 'show',
					'options'               => [
						'show'          => __( 'Show', 'flexiaddons' ),
						'hide'          => __( 'Hide', 'flexiaddons' ),
					],
					'selectors_dictionary'  => [
						'show'          => 'block',
						'hide'          => 'none',
					],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms label.wpforms-error' => 'display: {{VALUE}} !important;',
					],
				]
			);

			$this->end_controls_section();

			/*-----------------------------------------------------------------------------------*/
			/*	STYLE TAB
			/*-----------------------------------------------------------------------------------*/

			$this->start_controls_section(
				'section_form_title_style',
				[
					'label'                 => __( 'Title & Description', 'flexiaddons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'heading_alignment',
				[
					'label'                 => __( 'Alignment', 'flexiaddons' ),
					'type'                  => Controls_Manager::CHOOSE,
					'options'               => [
						'left'      => [
							'title' => __( 'Left', 'flexiaddons' ),
							'icon'  => 'fa fa-align-left',
						],
						'center'    => [
							'title' => __( 'Center', 'flexiaddons' ),
							'icon'  => 'fa fa-align-center',
						],
						'right'     => [
							'title' => __( 'Right', 'flexiaddons' ),
							'icon'  => 'fa fa-align-right',
						],
					],
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .wpforms-head-container, {{WRAPPER}} .fe-el-wpforms-heading' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_heading',
				[
					'label'                 => __( 'Title', 'flexiaddons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
				]
			);

			$this->add_control(
				'form_title_text_color',
				[
					'label'                 => __( 'Text Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .fe-el-contact-form-title, {{WRAPPER}} .wpforms-title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'form_title_typography',
					'label'                 => __( 'Typography', 'flexiaddons' ),
					'selector'              => '{{WRAPPER}} .fe-el-contact-form-title, {{WRAPPER}} .wpforms-title',
				]
			);

			$this->add_responsive_control(
				'form_title_margin',
				[
					'label'                 => __( 'Margin', 'flexiaddons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => [ 'px', 'em', '%' ],
					'allowed_dimensions'    => 'vertical',
					'placeholder'           => [
						'top'      => '',
						'right'    => 'auto',
						'bottom'   => '',
						'left'     => 'auto',
					],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-contact-form-title, {{WRAPPER}} .wpforms-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'description_heading',
				[
					'label'                 => __( 'Description', 'flexiaddons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
				]
			);

			$this->add_control(
				'form_description_text_color',
				[
					'label'                 => __( 'Text Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .fe-el-contact-form-description, {{WRAPPER}} .wpforms-description' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'form_description_typography',
					'label'                 => __( 'Typography', 'flexiaddons' ),
					'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
					'selector'              => '{{WRAPPER}} .fe-el-contact-form-description, {{WRAPPER}} .wpforms-description',
				]
			);

			$this->add_responsive_control(
				'form_description_margin',
				[
					'label'                 => __( 'Margin', 'flexiaddons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => [ 'px', 'em', '%' ],
					'allowed_dimensions'    => 'vertical',
					'placeholder'           => [
						'top'      => '',
						'right'    => 'auto',
						'bottom'   => '',
						'left'     => 'auto',
					],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-contact-form-description, {{WRAPPER}} .wpforms-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			/**
			 * Style Tab: Labels
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_label_style',
				[
					'label'             => __( 'Labels', 'flexiaddons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'text_color_label',
				[
					'label'             => __( 'Text Color', 'flexiaddons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field label' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'typography_label',
					'label'             => __( 'Typography', 'flexiaddons' ),
					'scheme'            => Scheme_Typography::TYPOGRAPHY_4,
					'selector'          => '{{WRAPPER}} .fe-el-wpforms .wpforms-field label',
				]
			);

			$this->end_controls_section();

				/**
			 * Style Tab: Input & Textarea
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_fields_style',
				[
					'label'             => __( 'Input & Textarea', 'flexiaddons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'input_alignment',
				[
					'label'                 => __( 'Alignment', 'flexiaddons' ),
					'type'                  => Controls_Manager::CHOOSE,
					'options'               => [
						'left'      => [
							'title' => __( 'Left', 'flexiaddons' ),
							'icon'  => 'fa fa-align-left',
						],
						'center'    => [
							'title' => __( 'Center', 'flexiaddons' ),
							'icon'  => 'fa fa-align-center',
						],
						'right'     => [
							'title' => __( 'Right', 'flexiaddons' ),
							'icon'  => 'fa fa-align-right',
						],
					],
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea, {{WRAPPER}} .fe-el-wpforms .wpforms-field select' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_fields_style' );

			$this->start_controls_tab(
				'tab_fields_normal',
				[
					'label'                 => __( 'Normal', 'flexiaddons' ),
				]
			);

			$this->add_control(
				'field_bg_color',
				[
					'label'             => __( 'Background Color', 'flexiaddons' ),
					'type'              => Controls_Manager::COLOR,
					'default'           => '',
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea, {{WRAPPER}} .fe-el-wpforms .wpforms-field select' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'field_text_color',
				[
					'label'             => __( 'Text Color', 'flexiaddons' ),
					'type'              => Controls_Manager::COLOR,
					'default'           => '',
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea, {{WRAPPER}} .fe-el-wpforms .wpforms-field select' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'              => 'field_border',
					'label'             => __( 'Border', 'flexiaddons' ),
					'placeholder'       => '1px',
					'default'           => '1px',
					'selector'          => '{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea, {{WRAPPER}} .fe-el-wpforms .wpforms-field select',
					'separator'         => 'before',
				]
			);

			$this->add_control(
				'field_radius',
				[
					'label'             => __( 'Border Radius', 'flexiaddons' ),
					'type'              => Controls_Manager::DIMENSIONS,
					'size_units'        => [ 'px', 'em', '%' ],
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea, {{WRAPPER}} .fe-el-wpforms .wpforms-field select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_indent',
				[
					'label'                 => __( 'Text Indent', 'flexiaddons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 60,
							'step'  => 1,
						],
						'%'         => [
							'min'   => 0,
							'max'   => 30,
							'step'  => 1,
						],
					],
					'size_units'            => [ 'px', 'em', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea, {{WRAPPER}} .fe-el-wpforms .wpforms-field select' => 'text-indent: {{SIZE}}{{UNIT}}',
					],
					'separator'         => 'before',
				]
			);

			$this->add_responsive_control(
				'input_width',
				[
					'label'             => __( 'Input Width', 'flexiaddons' ),
					'type'              => Controls_Manager::SLIDER,
					'range'             => [
						'px' => [
							'min'   => 0,
							'max'   => 1200,
							'step'  => 1,
						],
					],
					'size_units'        => [ 'px', 'em', '%' ],
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field select' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'input_height',
				[
					'label'             => __( 'Input Height', 'flexiaddons' ),
					'type'              => Controls_Manager::SLIDER,
					'range'             => [
						'px' => [
							'min'   => 0,
							'max'   => 80,
							'step'  => 1,
						],
					],
					'size_units'        => [ 'px', 'em', '%' ],
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field select' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'textarea_width',
				[
					'label'             => __( 'Textarea Width', 'flexiaddons' ),
					'type'              => Controls_Manager::SLIDER,
					'range'             => [
						'px' => [
							'min'   => 0,
							'max'   => 1200,
							'step'  => 1,
						],
					],
					'size_units'        => [ 'px', 'em', '%' ],
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field textarea' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'textarea_height',
				[
					'label'             => __( 'Textarea Height', 'flexiaddons' ),
					'type'              => Controls_Manager::SLIDER,
					'range'             => [
						'px' => [
							'min'   => 0,
							'max'   => 400,
							'step'  => 1,
						],
					],
					'size_units'        => [ 'px', 'em', '%' ],
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field textarea' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'field_padding',
				[
					'label'             => __( 'Padding', 'flexiaddons' ),
					'type'              => Controls_Manager::DIMENSIONS,
					'size_units'        => [ 'px', 'em', '%' ],
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea, {{WRAPPER}} .fe-el-wpforms .wpforms-field select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'         => 'before',
				]
			);

			$this->add_responsive_control(
				'field_spacing',
				[
					'label'                 => __( 'Spacing', 'flexiaddons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 100,
							'step'  => 1,
						],
					],
					'size_units'            => [ 'px', 'em', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'field_typography',
					'label'             => __( 'Typography', 'flexiaddons' ),
					'scheme'            => Scheme_Typography::TYPOGRAPHY_4,
					'selector'          => '{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea, {{WRAPPER}} .fe-el-wpforms .wpforms-field select',
					'separator'         => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'              => 'field_box_shadow',
					'selector'          => '{{WRAPPER}} .fe-el-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea, {{WRAPPER}} .fe-el-wpforms .wpforms-field select',
					'separator'         => 'before',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_fields_focus',
				[
					'label'                 => __( 'Focus', 'flexiaddons' ),
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'              => 'focus_input_border',
					'label'             => __( 'Border', 'flexiaddons' ),
					'placeholder'       => '1px',
					'default'           => '1px',
					'selector'          => '{{WRAPPER}} .fe-el-wpforms .wpforms-field input:focus, {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea:focus',
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'              => 'focus_box_shadow',
					'selector'          => '{{WRAPPER}} .fe-el-wpforms .wpforms-field input:focus, {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea:focus',
					'separator'         => 'before',
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();

			/**
			 * Style Tab: Field Description
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_field_description_style',
				[
					'label'                 => __( 'Field Description', 'flexiaddons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'field_description_text_color',
				[
					'label'                 => __( 'Text Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field .wpforms-field-description, {{WRAPPER}} .fe-el-wpforms .wpforms-field .wpforms-field-sublabel' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'field_description_typography',
					'label'                 => __( 'Typography', 'flexiaddons' ),
					'selector'              => '{{WRAPPER}} .fe-el-wpforms .wpforms-field .wpforms-field-description, {{WRAPPER}} .fe-el-wpforms .wpforms-field .wpforms-field-sublabel',
				]
			);

			$this->add_responsive_control(
				'field_description_spacing',
				[
					'label'                 => __( 'Spacing', 'flexiaddons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 100,
							'step'  => 1,
						],
					],
					'size_units'            => [ 'px', 'em', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field .wpforms-field-description, {{WRAPPER}} .fe-el-wpforms .wpforms-field .wpforms-field-sublabel' => 'padding-top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->end_controls_section();

			/**
			 * Style Tab: Placeholder
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_placeholder_style',
				[
					'label'             => __( 'Placeholder', 'flexiaddons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
					'condition'             => [
						'placeholder_switch'   => 'yes',
					],
				]
			);

			$this->add_control(
				'text_color_placeholder',
				[
					'label'             => __( 'Text Color', 'flexiaddons' ),
					'type'              => Controls_Manager::COLOR,
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-field input::-webkit-input-placeholder, {{WRAPPER}} .fe-el-wpforms .wpforms-field textarea::-webkit-input-placeholder' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'placeholder_switch'   => 'yes',
					],
				]
			);

			$this->end_controls_section();

				/**
			 * Style Tab: Radio & Checkbox
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_radio_checkbox_style',
				[
					'label'                 => __( 'Radio & Checkbox', 'flexiaddons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'custom_radio_checkbox',
				[
					'label'                 => __( 'Custom Styles', 'flexiaddons' ),
					'type'                  => Controls_Manager::SWITCHER,
					'label_on'              => __( 'Yes', 'flexiaddons' ),
					'label_off'             => __( 'No', 'flexiaddons' ),
					'return_value'          => 'yes',
				]
			);

			$this->add_responsive_control(
				'radio_checkbox_size',
				[
					'label'                 => __( 'Size', 'flexiaddons' ),
					'type'                  => Controls_Manager::SLIDER,
					'default'               => [
						'size'      => '15',
						'unit'      => 'px'
					],
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 80,
							'step'  => 1,
						],
					],
					'size_units'            => [ 'px', 'em', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .fe-el-custom-radio-checkbox input[type="radio"]' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}}',
					],
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_radio_checkbox_style' );

			$this->start_controls_tab(
				'radio_checkbox_normal',
				[
					'label'                 => __( 'Normal', 'flexiaddons' ),
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'radio_checkbox_color',
				[
					'label'                 => __( 'Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .fe-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .fe-el-custom-radio-checkbox input[type="radio"]' => 'background: {{VALUE}}',
					],
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'radio_checkbox_border_width',
				[
					'label'                 => __( 'Border Width', 'flexiaddons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 15,
							'step'  => 1,
						],
					],
					'size_units'            => [ 'px' ],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .fe-el-custom-radio-checkbox input[type="radio"]' => 'border-width: {{SIZE}}{{UNIT}}',
					],
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'radio_checkbox_border_color',
				[
					'label'                 => __( 'Border Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .fe-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .fe-el-custom-radio-checkbox input[type="radio"]' => 'border-color: {{VALUE}}',
					],
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'checkbox_heading',
				[
					'label'                 => __( 'Checkbox', 'flexiaddons' ),
					'type'                  => Controls_Manager::HEADING,
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'checkbox_border_radius',
				[
					'label'                 => __( 'Border Radius', 'flexiaddons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => [ 'px', 'em', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .fe-el-custom-radio-checkbox input[type="checkbox"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'radio_heading',
				[
					'label'                 => __( 'Radio Buttons', 'flexiaddons' ),
					'type'                  => Controls_Manager::HEADING,
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'radio_border_radius',
				[
					'label'                 => __( 'Border Radius', 'flexiaddons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => [ 'px', 'em', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-custom-radio-checkbox input[type="radio"], {{WRAPPER}} .fe-el-custom-radio-checkbox input[type="radio"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'radio_checkbox_checked',
				[
					'label'                 => __( 'Checked', 'flexiaddons' ),
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'radio_checkbox_color_checked',
				[
					'label'                 => __( 'Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .fe-el-custom-radio-checkbox input[type="checkbox"]:checked:before, {{WRAPPER}} .fe-el-custom-radio-checkbox input[type="radio"]:checked:before' => 'background: {{VALUE}}',
					],
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();

				/**
			 * Style Tab: Submit Button
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_submit_button_style',
				[
					'label'             => __( 'Submit Button', 'flexiaddons' ),
					'tab'               => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'button_align',
				[
					'label'             => __( 'Alignment', 'flexiaddons' ),
					'type'              => Controls_Manager::CHOOSE,
					'options'           => [
						'left'        => [
							'title'   => __( 'Left', 'flexiaddons' ),
							'icon'    => 'eicon-h-align-left',
						],
						'center'      => [
							'title'   => __( 'Center', 'flexiaddons' ),
							'icon'    => 'eicon-h-align-center',
						],
						'right'       => [
							'title'   => __( 'Right', 'flexiaddons' ),
							'icon'    => 'eicon-h-align-right',
						],
					],
					'default'           => '',
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container'   => 'text-align: {{VALUE}};',
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit' => 'display:inline-block;'
					],
					'condition'             => [
						'button_width_type' => 'custom',
					],
				]
			);

			$this->add_control(
				'button_width_type',
				[
					'label'                 => __( 'Width', 'flexiaddons' ),
					'type'                  => Controls_Manager::SELECT,
					'default'               => 'custom',
					'options'               => [
						'full-width'    => __( 'Full Width', 'flexiaddons' ),
						'custom'        => __( 'Custom', 'flexiaddons' ),
					],
					'prefix_class'          => 'fe-el-wpforms-form-button-',
				]
			);

			$this->add_responsive_control(
				'button_width',
				[
					'label'                 => __( 'Width', 'flexiaddons' ),
					'type'                  => Controls_Manager::SLIDER,
					'default'               => [
						'size'      => '100',
						'unit'      => 'px'
					],
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 1200,
							'step'  => 1,
						],
					],
					'size_units'            => [ 'px', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition'             => [
						'button_width_type' => 'custom',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );

			$this->start_controls_tab(
				'tab_button_normal',
				[
					'label'             => __( 'Normal', 'flexiaddons' ),
				]
			);

			$this->add_control(
				'button_bg_color_normal',
				[
					'label'             => __( 'Background Color', 'flexiaddons' ),
					'type'              => Controls_Manager::COLOR,
					'default'           => '',
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_text_color_normal',
				[
					'label'             => __( 'Text Color', 'flexiaddons' ),
					'type'              => Controls_Manager::COLOR,
					'default'           => '',
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'              => 'button_border_normal',
					'label'             => __( 'Border', 'flexiaddons' ),
					'placeholder'       => '1px',
					'default'           => '1px',
					'selector'          => '{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit',
				]
			);

			$this->add_control(
				'button_border_radius',
				[
					'label'             => __( 'Border Radius', 'flexiaddons' ),
					'type'              => Controls_Manager::DIMENSIONS,
					'size_units'        => [ 'px', 'em', '%' ],
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_padding',
				[
					'label'             => __( 'Padding', 'flexiaddons' ),
					'type'              => Controls_Manager::DIMENSIONS,
					'size_units'        => [ 'px', 'em', '%' ],
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_margin',
				[
					'label'                 => __( 'Margin Top', 'flexiaddons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 100,
							'step'  => 1,
						],
					],
					'size_units'            => [ 'px', 'em', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container' => 'margin-top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'              => 'button_typography',
					'label'             => __( 'Typography', 'flexiaddons' ),
					'scheme'            => Scheme_Typography::TYPOGRAPHY_4,
					'selector'          => '{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit',
					'separator'         => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'              => 'button_box_shadow',
					'selector'          => '{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit',
					'separator'         => 'before',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label'             => __( 'Hover', 'flexiaddons' ),
				]
			);

			$this->add_control(
				'button_bg_color_hover',
				[
					'label'             => __( 'Background Color', 'flexiaddons' ),
					'type'              => Controls_Manager::COLOR,
					'default'           => '',
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit:hover' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_text_color_hover',
				[
					'label'             => __( 'Text Color', 'flexiaddons' ),
					'type'              => Controls_Manager::COLOR,
					'default'           => '',
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_border_color_hover',
				[
					'label'             => __( 'Border Color', 'flexiaddons' ),
					'type'              => Controls_Manager::COLOR,
					'default'           => '',
					'selectors'         => [
						'{{WRAPPER}} .fe-el-wpforms .wpforms-submit-container .wpforms-submit:hover' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();


/**
			 * Style Tab: Errors
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_error_style',
				[
					'label'                 => __( 'Errors', 'flexiaddons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
					'condition'             => [
						'error_messages' => 'show',
					],
				]
			);

			$this->add_control(
				'error_message_text_color',
				[
					'label'                 => __( 'Text Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms label.wpforms-error' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'error_messages' => 'show',
					],
				]
			);

			$this->add_control(
				'error_field_input_border_color',
				[
					'label'                 => __( 'Error Field Input Border Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms input.wpforms-error, {{WRAPPER}} .fe-el-wpforms textarea.wpforms-error'
						=> 'border-color: {{VALUE}}',
					],
					'condition'             => [
						'error_messages' => 'show',
					],
				]
			);

			$this->add_control(
				'error_field_input_border_width',
				[
					'label'                 => __( 'Error Field Input Border Width', 'flexiaddons' ),
					'type'                  => Controls_Manager::NUMBER,
					'default'               => 1,
					'min'                   => 1,
					'max'                   => 10,
					'step'                  => 1,
					'selectors'             => [
						'{{WRAPPER}} .fe-el-wpforms input.wpforms-error, {{WRAPPER}} .fe-el-wpforms textarea.wpforms-error'
						=> 'border-width: {{VALUE}}px',
					],
					'condition'             => [
						'error_messages' => 'show',
					],
				]
			);

			$this->end_controls_section();



		

     
	}

	

	protected function render() {

		$settings = $this->get_settings();

		$this->add_render_attribute( 'contact-form', 'class', [
			'fe-el-contact-form',
			'fe-el-wpforms',
			'fe-cf',
			'fe-cf-' . $settings['fe_wpform_layout_style'],
		]
	);

	if ( $settings['placeholder_switch'] != 'yes' ) {
		$this->add_render_attribute( 'contact-form', 'class', 'placeholder-hide' );
	}

	if ( $settings['custom_title_description'] == 'yes' ) {
		$this->add_render_attribute( 'contact-form', 'class', 'title-description-hide' );
	}

	if ( $settings['custom_radio_checkbox'] == 'yes' ) {
		$this->add_render_attribute( 'contact-form', 'class', 'fe-el-custom-radio-checkbox' );
	}

	if ( class_exists( 'WPForms' ) ) {
		if ( ! empty( $settings['contact_form_list'] ) ) { ?>
			<div <?php echo $this->get_render_attribute_string( 'contact-form' ); ?>>
				<?php if ( $settings['custom_title_description'] == 'yes' ) { ?>
					<div class="fe-el-wpforms-heading">
						<?php if ( $settings['form_title_custom'] != '' ) { ?>
							<h3 class="fe-el-contact-form-title fe-el-wpforms-title">
								<?php echo esc_attr( $settings['form_title_custom'] ); ?>
							</h3>
						<?php } ?>
						<?php if ( $settings['form_description_custom'] != '' ) { ?>
							<div class="fe-el-contact-form-description fe-el-wpforms-description">
								<?php echo $this->parse_text_editor( $settings['form_description_custom'] ); ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<?php
					$fe_el_form_title = $settings['form_title'];
					$fe_el_form_description = $settings['form_description'];

					if ( $settings['custom_title_description'] == 'yes' ) {
						$fe_el_form_title = false;
						$fe_el_form_description = false;
					}

					echo wpforms_display( $settings['contact_form_list'], $fe_el_form_title,
						$fe_el_form_description );
				?>
			</div>
			<?php
		}
	}
	
		
	}

}