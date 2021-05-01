<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;

defined( 'ABSPATH' ) || die();

class Flexi_Addons_Widget_Ninja_Form extends Flexi_Addons_Widget_Base {


	protected $key = 'ninja-form';

	protected function _register_controls() {
        $this->start_controls_section(
			'_section_ninjaforms',
			[
				'label' => flexiaddons_is_ninjaforms_activated() ? __( 'Ninja Forms', 'flexiaddons' ) : __( 'Plugin Notice', 'flexiaddons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        if ( ! flexiaddons_is_ninjaforms_activated() ) {
            $this->add_control(
                '_ninjaforms_missing_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        __( 'Please click on the link below and install/activate %1$s', 'flexiaddons' ),
                        '<a href="'.esc_url( admin_url( 'plugin-install.php?s=Ninja+Forms&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Ninja Forms</a>',
                        flexiaddon_get_current_user_display_name()
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
                ]
            );

            $this->add_control(
                '_ninjaforms_install',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<a href="'.esc_url( admin_url( 'plugin-install.php?s=Ninja+Forms&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Click to install or activate Ninja Forms</a>',
                ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_control(
            'form_id',
            [
                'label' => __( 'Select Your Form', 'flexiaddons' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
				'options' => ['' => __( '', 'flexiaddons' ) ] + \flexiaddons_get_ninjaform(),
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
						'{{WRAPPER}} .nf-error-wrap .nf-error-required-error' => 'display: {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'validation_errors',
				[
					'label'                 => __( 'Validation Errors', 'flexiaddons' ),
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
						'{{WRAPPER}} .nf-form-errors .nf-error-field-errors' => 'display: {{VALUE}} !important;',
					],
				]
			);

			$this->end_controls_section();

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
						'{{WRAPPER}} .wpforms-head-container, {{WRAPPER}} .fl-el-wpforms-heading' => 'text-align: {{VALUE}};',
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
						'{{WRAPPER}} .fl-el-contact-form-title, {{WRAPPER}} .wpforms-title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'form_title_typography',
					'label'                 => __( 'Typography', 'flexiaddons' ),
					'selector'              => '{{WRAPPER}} .fl-el-contact-form-title, {{WRAPPER}} .wpforms-title',
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
						'{{WRAPPER}} .fl-el-contact-form-title, {{WRAPPER}} .wpforms-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .fl-el-contact-form-description, {{WRAPPER}} .wpforms-description' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'form_description_typography',
					'label'                 => __( 'Typography', 'flexiaddons' ),
					'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
					'selector'              => '{{WRAPPER}} .fl-el-contact-form-description, {{WRAPPER}} .wpforms-description',
				]
			);

			$this->add_responsive_control(
				'form_description_margin',
				[
					'label'                 => __( 'Margin', 'flexiaddons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => [ 'px', 'em', '%' ],'flexiaddons',
					'allowed_dimensions'    => 'vertical',
					'placeholder'           => [
						'top'      => '',
						'right'    => 'auto',
						'bottom'   => '',
						'left'     => 'auto',
					],
					'selectors'             => [
						'{{WRAPPER}} .fl-el-contact-form-description, {{WRAPPER}} .wpforms-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();
			

			$this->start_controls_section(
				'_section_fields_style',
				[
					'label' => __( 'Form Fields Section', 'flexiaddons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
	
	
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'field_typography',
					'label' => __( 'Typography', 'flexiaddons' ),
					'selector' => '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea',
					'scheme' => Scheme_Typography::TYPOGRAPHY_3
				]
			);
	
			$this->add_control(
				'field_textcolor',
				[
					'label' => __( 'Field Text Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'field_margin',
				[
					'label' => __( 'Spacing', 'flexiaddons' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .nf-field-container:not(.submit-container)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
			$this->add_responsive_control(
				'field_padding',
				[
					'label' => __( 'Padding', 'flexiaddons' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
			$this->add_responsive_control(
				'field_border_radius',
				[
					'label' => __( 'Border Radius', 'flexiaddons' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
			$this->add_control(
				'field_placeholder_color',
				[
					'label' => __( 'Field Placeholder Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ::-webkit-input-placeholder'	=> 'color: {{VALUE}};',
						'{{WRAPPER}} ::-moz-placeholder'			=> 'color: {{VALUE}};',
						'{{WRAPPER}} ::-ms-input-placeholder'		=> 'color: {{VALUE}};',
					],
				]
			);
	
			$this->start_controls_tabs( 'tabs_field_state' );
	
			$this->start_controls_tab(
				'tab_field_normal',
				[
					'label' => __( 'Normal', 'flexiaddons' ),
				]
			);
	
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'field_border',
					'selector' => '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea',
				]
			);
	
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'field_box_shadow',
					'selector' => '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea',
				]
			);
	
			$this->add_control(
				'field_bg_color',
				[
					'label' => __( 'Background Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'background-color: {{VALUE}}',
					],
				]
			);
	
			$this->end_controls_tab();
	
			$this->start_controls_tab(
				'tab_field_focus',
				[
					'label' => __( 'Focus', 'flexiaddons' ),
				]
			);
	
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'field_focus_border',
					'selector' => '{{WRAPPER}} .textbox-wrap input[type=text]:focus, {{WRAPPER}} .email-wrap input:focus, {{WRAPPER}} .textarea-wrap textarea:focus',
				]
			);
	
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'field_focus_box_shadow',
					'exclude' => [
						'box_shadow_position',
					],
					'selector' => '{{WRAPPER}} .textbox-wrap input[type=text]:focus, {{WRAPPER}} .email-wrap input:focus, {{WRAPPER}} .textarea-wrap textarea:focus',
				]
			);
	
			$this->add_control(
				'field_focus_bg_color',
				[
					'label' => __( 'Background Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .textbox-wrap input[type=text]:focus, {{WRAPPER}} .email-wrap input:focus, {{WRAPPER}} .textarea-wrap textarea:focus' => 'background-color: {{VALUE}}',
					],
				]
			);
	
			$this->end_controls_tab();
			$this->end_controls_tabs();
	
	
			$this->end_controls_section();
	
			$this->start_controls_section(
				'ninjaf-form-label',
				[
					'label' => __( 'Label Fields Section', 'flexiaddons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
	
			
	
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'label_typography',
					'label' => __( 'Label Typography', 'flexiaddons' ),
					'selector' => '{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label',
					'scheme' => Scheme_Typography::TYPOGRAPHY_3
				]
			);
	
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'label' => __( 'Description Typography', 'flexiaddons' ),
					'selector' => '{{WRAPPER}} .nf-field-description p',
					'scheme' => Scheme_Typography::TYPOGRAPHY_3
				]
			);
	
			$this->add_control(
				'label_color',
				[
					'label' => __( 'Label Text Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label' => 'color: {{VALUE}}',
					],
				]
			);
	
			$this->add_control(
				'requered_label',
				[
					'label' => __( 'Required Label Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ninja-forms-req-symbol' => 'color: {{VALUE}}',
					],
				]
			);
	
			$this->add_control(
				'desc_color',
				[
					'label' => __( 'Description Text Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .nf-field-description p' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'hr3',
				[
					'type' => Controls_Manager::DIVIDER,
					'style' => 'thick',
				]
			);

			$this->add_responsive_control(
				'label_margin',
				[
					'label' => __( 'Margin', 'flexiaddons' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
			$this->add_responsive_control(
				'label_padding',
				[
					'label' => __( 'Padding', 'flexiaddons' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
	
			$this->end_controls_section();
	
			$this->start_controls_section(
				'submit',
				[
					'label' => __( 'Submit Button Section', 'flexiaddons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
	
			$this->add_responsive_control(
				'submit_btn_position',
				[
					'label' => __( 'Button Position', 'flexiaddons' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'flexiaddons' ),
							'icon' => 'eicon-h-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'flexiaddons' ),
							'icon' => 'eicon-h-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'flexiaddons' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'desktop_default' => 'left',
					'toggle' => false,
					'prefix_class' => 'ha-form-btn--%s',
					'selectors' => [
						'{{WRAPPER}} .field-wrap.submit-wrap' => 'text-align: {{Value}};',
					],
				]
			);
	
			
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'submit_typography',
					'selector' => '{{WRAPPER}} .submit-container input',
					'scheme' => Scheme_Typography::TYPOGRAPHY_4
				]
			);
	
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'submit_border',
					'selector' => '{{WRAPPER}} .submit-container input',
				]
			);
	
			
	
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'submit_box_shadow',
					'selector' => '{{WRAPPER}} .submit-container input',
				]
			);

			$this->add_responsive_control(
				'submit_margin',
				[
					'label' => __( 'Margin', 'flexiaddons' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .submit-container input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
			$this->add_responsive_control(
				'submit_padding',
				[
					'label' => __( 'Padding', 'flexiaddons' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .submit-container input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'submit_border_radius',
				[
					'label' => __( 'Border Radius', 'flexiaddons' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .submit-container input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
	
			$this->add_control(
				'hr4',
				[
					'type' => Controls_Manager::DIVIDER,
					'style' => 'thick',
				]
			);
	
			$this->start_controls_tabs( 'tabs_button_style' );
	
			$this->start_controls_tab(
				'tab_button_normal',
				[
					'label' => __( 'Normal', 'flexiaddons' ),
				]
			);
	
			$this->add_control(
				'submit_color',
				[
					'label' => __( 'Text Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .submit-container input' => 'color: {{VALUE}};',
					],
				]
			);
	
			$this->add_control(
				'submit_bg_color',
				[
					'label' => __( 'Background Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .submit-container input' => 'background-color: {{VALUE}};',
					],
				]
			);
	
			$this->end_controls_tab();
	
			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label' => __( 'Hover', 'flexiaddons' ),
				]
			);
	
			$this->add_control(
				'submit_hover_color',
				[
					'label' => __( 'Text Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .submit-container input:hover, {{WRAPPER}} .submit-container input:focus' => 'color: {{VALUE}};',
					],
				]
			);
	
			$this->add_control(
				'submit_hover_bg_color',
				[
					'label' => __( 'Background Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .submit-container input:hover, {{WRAPPER}} .submit-container input:focus' => 'background-color: {{VALUE}};',
					],
				]
			);
	
			$this->add_control(
				'submit_hover_border_color',
				[
					'label' => __( 'Border Color', 'flexiaddons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .submit-container input:hover, {{WRAPPER}} .submit-container input:focus' => 'border-color: {{VALUE}};',
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
				]
			);

			$this->add_control(
				'error_messages_heading',
				[
					'label'                 => __( 'Error Messages', 'flexiaddons' ),
					'type'                  => Controls_Manager::HEADING,
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
						'{{WRAPPER}} .nf-error-wrap .nf-error-required-error' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'error_messages' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_errors_heading',
				[
					'label'                 => __( 'Validation Errors', 'flexiaddons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_error_description_color',
				[
					'label'                 => __( 'Error Description Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .nf-form-errors .nf-error-field-errors' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_error_field_input_border_color',
				[
					'label'                 => __( 'Error Field Input Border Color', 'flexiaddons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .nf-error .ninja-forms-field' => 'border-color: {{VALUE}}',
					],
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->end_controls_section();
            

            
	}

	

	protected function render() {
		if ( ! flexiaddons_is_ninjaforms_activated() ) {
            return;
        }

		$settings = $this->get_settings_for_display();
		if ( $settings['placeholder_switch'] != 'yes' ) {
			$this->add_render_attribute( 'contact-form', 'class', 'placeholder-hide' );
		}

		if ( $settings['custom_title_description'] == 'yes' ) {
			$this->add_render_attribute( 'contact-form', 'class', 'title-description-hide' );
		}

		if ( $settings['custom_radio_checkbox'] == 'yes' ) {
			$this->add_render_attribute( 'contact-form', 'class', 'fl-el-custom-radio-checkbox' );
		}
        ?>
			<div <?php echo $this->get_render_attribute_string( 'contact-form' ); ?>>
					<?php if ( $settings['custom_title_description'] == 'yes' ) { ?>
							<div class="fl-el-wpforms-heading">
								<?php if ( $settings['form_title_custom'] != '' ) { ?>
									<h3 class="fl-el-contact-form-title fl-el-wpforms-title">
										<?php echo esc_attr( $settings['form_title_custom'] ); ?>
									</h3>
								<?php } ?>
								<?php if ( $settings['form_description_custom'] != '' ) { ?>
									<div class="fl-el-contact-form-description fl-el-wpforms-description">
										<?php echo $this->parse_text_editor( $settings['form_description_custom'] ); ?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					<?php
					if ( ! empty( $settings['form_id'] ) ) {
						echo flexiaddon_do_shortcode( 'ninja_form', [
							'id' => $settings['form_id'],
						] );
					}
					?>
			</div>
        <?php
	}

}