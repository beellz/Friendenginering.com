<?php

defined( 'ABSPATH' ) || die();

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;


class Flexi_Addons_Widget_Animated_Text extends Flexi_Addons_Widget_Base {

	protected $key = 'animated-text';

	/**
	 * Add the widget controls.
	 *
	 * @return void with category names
	 **@since 1.0.0
	 * @access protected
	 *
	 */
	protected function _register_controls() {

		/** Header tab. */
		$this->start_controls_section( 'section_header', [
			'label' => esc_html__( 'Text Animation', 'flexiaddons' ),
		] );

		/** Animation. */
		$this->add_control( 'animation_header', [
			'label'     => esc_html__( 'Animation Style', 'flexiaddons' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'rise'        => __( 'Rise', 'flexiaddons' ),
				'curl'        => __( 'Curl', 'flexiaddons' ),
				'jalousie'    => __( 'Jalousie', 'flexiaddons' ),
				'drop-in'     => __( 'Drop', 'flexiaddons' ),
				'ripple'      => __( 'Ripple', 'flexiaddons' ),
				'slide-right' => __( 'Slide Right', 'flexiaddons' ),
				'slide-left'  => __( 'Slide Left', 'flexiaddons' ),
				'slide-down'  => __( 'Slide Down', 'flexiaddons' ),
				'slide-up'    => __( 'Slide Up', 'flexiaddons' ),
				'bounce'      => __( 'Bounce', 'flexiaddons' ),
				'fade'        => __( 'Fade', 'flexiaddons' ),
				'flip-x'      => __( 'Flip X', 'flexiaddons' ),
				'flip-y'      => __( 'Flip Y', 'flexiaddons' ),
				'jello'       => __( 'Jello', 'flexiaddons' ),
				'zoom'        => __( 'Zoom', 'flexiaddons' ),
				'typing'      => __( 'Typing', 'flexiaddons' ),
			],
			'default'   => 'rise',
			'separator' => 'after',
		] );

		/** Animation speed. */
		$this->add_responsive_control( 'text_speed', [
			'label'   => esc_html__( 'Word change time', 'flexiaddons' ),
			'type'    => Controls_Manager::SLIDER,
			'range'   => [
				'ms' => [
					'min'  => 100,
					'max'  => 10000,
					'step' => 100,
				],
			],
			'default' => [ 'unit' => 'ms', 'size' => 2000, ],
		] );

		/** Letter animation speed. */
		$this->add_responsive_control( 'letter_speed', [
			'label'       => esc_html__( 'Letter animation time', 'flexiaddons' ),
			'type'        => Controls_Manager::SLIDER,
			'range'       => [
				'ms' => [
					'min'  => 50,
					'max'  => 1000,
					'step' => 50,
				],
			],
			'default'     => [ 'unit' => 'ms', 'size' => 150, ],
			'condition'   => [
				'animation_header' => [ 'curl', 'jalousie', 'ripple', 'typing', ],
			],
			'render_type' => 'template',
			'selectors'   => [
				'{{WRAPPER}} .animated_text-typing-active' => 'animation-duration: {{SIZE}}{{UNIT}};',
			],

		] );

		/** Prefix text */
		$this->add_control( 'prefix', [
			'type'        => Controls_Manager::TEXT,
			'label'       => esc_html__( 'Prefix Text', 'flexiaddons' ),
			'label_block' => true,
			'description' => esc_html__( 'Enter Text, Which will be visible before the Animated Text.', 'flexiaddons' ),
			'separator'   => 'before',
			'default'     => esc_html__( 'This is ', 'flexiaddons' ),
			'dynamic'     => [
				'active' => true,
			],
		] );

		/** Animation Title */
		$this->add_control( 'ani_title', [
			'label'       => esc_html__( 'Animated Text', 'flexiaddons' ),
			'type'        => Controls_Manager::TEXTAREA,
			'description' => esc_html__( 'You need to add Multiple line by ctrl + Enter Or Shift + Enter for animated text.', 'flexiaddons' ),
			'rows'        => 5,
			'default'     => 'Unique',
			'placeholder' => esc_html__( 'Type your description here', 'flexiaddons' ),
			'dynamic'     => [
				'active' => true,
			],
		] );

		/** Postfix Text */
		$this->add_control( 'postfix', [
			'type'        => Controls_Manager::TEXT,
			'label'       => esc_html__( 'Postfix Text', 'flexiaddons' ),
			'label_block' => true,
			'description' => esc_html__( 'Enter Text, Which will be visible After the Animated Text.', 'flexiaddons' ),
			'separator'   => 'after',
			'default'     => esc_html__( 'Animation', 'flexiaddons' ),
			'dynamic'     => [
				'active' => true,
			],
		] );

		/**HTML Tag. */
		$this->add_control( 'header_tag', [
			'label'   => esc_html__( 'HTML Tag', 'flexiaddons' ),
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
			'default' => 'h2',
		] );

		/** Heading link. */
		$this->add_control( 'heading_link', [
			'label'         => esc_html__( 'Link', 'flexiaddons' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => esc_html__( 'https://flexiaddons.com', 'flexiaddons' ),
			'show_external' => true,
			'default'       => [
				'url'         => '',
				'is_external' => false,
				'nofollow'    => false,
			],
		] );

		/** Header Text Align */
		$this->add_responsive_control( 'heading_text_align', [
			'label'     => esc_html__( 'Alignment', 'flexiaddons' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => esc_html__( 'Left', 'flexiaddons' ),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'flexiaddons' ),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'flexiaddons' ),
					'icon'  => 'fa fa-align-right',
				],
			],
			'default'   => 'center',
			'selectors' => [
				'{{WRAPPER}} .flx-animated-text' => 'text-align: {{VALUE}};',
			],
		] );

		/** End section content. */
		$this->end_controls_section();

		/** Style Controls */
		$this->register_style_controls();

	}

	private function register_style_controls() {

		/** Style header tab. */
		$this->start_controls_section( 'style_header', [
			'label' => esc_html__( 'Style', 'flexiaddons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		/** prefix & postfix heading */
		$this->add_control( '_style_prefix_postfix', [
			'label'     => __( 'Prefix & Postfix', 'flexiaddons' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		] );

		/** Color. */
		$this->add_control( 'prefix_postfix_color', [
			'label'     => esc_html__( 'Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flx-animated_text-prefix, {{WRAPPER}} .flx-animated_text-postfix' => 'color: {{VALUE}}',
			],
		] );

		/** Typography. */
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'prefix_postfix_typography',
			'label'    => esc_html__( 'Typography', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flx-animated_text-prefix, {{WRAPPER}} .flx-animated_text-postfix',
		] );

		/** Shadow. */
		$this->add_group_control( Group_Control_Text_Shadow::get_type(), [
			'name'     => 'prefix_postfix_shadow',
			'label'    => esc_html__( 'Shadow', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flx-animated_text-prefix, {{WRAPPER}} .flx-animated_text-postfix',
		] );

		/** Text animation Style. */
		$this->add_control( '_style_animation', [
			'label'     => __( 'Animated text', 'flexiaddons' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		/** Text animation color. */
		$this->add_control( 'text_animation_color', [
			'label'     => esc_html__( 'Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flx-animated_text-wrapper' => '-webkit-text-fill-color: {{VALUE}}',
			],
		] );
		/** Text animation color. */
		$this->add_control( 'text_animation_bg_color', [
			'label'     => esc_html__( 'Background Color', 'flexiaddons' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .flx-animated_text-wrapper' => 'background-color: {{VALUE}}',
			],
		] );

		/** Typography. */
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text_animation_typography',
			'label'    => esc_html__( 'Typography', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flx-animated_text-wrapper',
		] );

		/** Shadow. */
		$this->add_group_control( Group_Control_Text_Shadow::get_type(), [
			'name'     => 'text_animation_shadow',
			'label'    => esc_html__( 'Shadow', 'flexiaddons' ),
			'selector' => '{{WRAPPER}} .flx-animated_text-wrapper',
		] );

		/** Custom width */
		$this->add_control( 'custom_animation_width', [
			'label'        => esc_html__( 'Custom width', 'flexiaddons' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'flexiaddons' ),
			'label_off'    => esc_html__( 'Off', 'flexiaddons' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		/** Box width. */
		$this->add_responsive_control( 'text_animation_width', [
			'label'     => esc_html__( 'Element width', 'flexiaddons' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 500,
					'step' => 1,
				],
			],
			'default'   => [ 'unit' => 'px', 'size' => 300, ],
			'selectors' => [
				'{{WRAPPER}} .flx-animated_text-wrapper' => 'width: {{SIZE}}{{UNIT}};',
			],
			'condition' => [ 'custom_animation_width' => 'yes' ],
		] );

		/** Margin. */
		$this->add_responsive_control( 'animation_margin', [
			'label'      => esc_html__( 'Margin', 'flexiaddons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .flx-animated_text-wrapper' => 'margin: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}};',
			],
		] );

		/** End section style header. */
		$this->end_controls_section();
	}

	/**
	 * Render Frontend Output. Generate the final HTML on the frontend.
	 *
	 * @since  1.0.0
	 * @access protected
	 **/
	protected function render() {

		/** We get all the values from the admin panel. */
		$settings = $this->get_settings_for_display();

		/** Heading link. */
		$url      = $settings['heading_link']['url'];
		$target   = $settings['heading_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['heading_link']['nofollow'] ? ' rel="nofollow"' : '';

		/** Use the gradient style class where necessary. */
		$this->add_render_attribute( 'header_text', 'class',
			'flx-typography-header flx-typography-default-header flx-shadow-header flx-heading-margin' );

		/** animation text lines */
		$ani_title = $settings['ani_title'];

		// Order of replacement
		$order   = array( "\r\n", "\n", "\r", "<br/>", "<br>" );
		$replace = '|';

		// Processes \r\n's first so they aren't converted twice.
		$str   = str_replace( $order, $replace, $ani_title );
		$lines = explode( "|", $str );

		$is_typing = in_array( $settings["animation_header"], [ 'curl', 'jalousie', 'ripple', 'typing' ] );

		$wrap_class = 'flx-animated-text ';
		$wrap_class .= $is_typing ? ' is_typing' : '';

		$this->add_render_attribute( 'wrap', [
			'class'             => $wrap_class,
			'data-animation'    => $settings["animation_header"],
			'data-text_speed'   => $settings["text_speed"]['size'],
			'data-letter_speed' => $settings["letter_speed"]['size'],
		] );

		?>

    <div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>


        <<?php esc_attr_e( $settings["header_tag"] ); ?> class="flx-header-text flx-header-align">

		<?php if ( ! empty( $url ) ) {
			printf( '<a href="%1$s" class="flx-color-header" %2$s %3$s>', esc_url( $url ), $target, $nofollow );
		} ?>

        <span class="flx-sub-header-box">
            <span <?php echo $this->get_render_attribute_string( 'header_text' ); ?>>
                <span class="flx-animated_text-prefix"><?php echo $settings['prefix']; ?></span>
                <span class="flx-animated_text-wrapper flx-animated_text-box-<?php echo $settings["animation_header"]; ?> flx-animated_text-wrapper-<?php echo $this->get_id(); ?>">
                    <?php

                    if ( ! $is_typing ) {
	                    foreach ( $lines as $line ) {
		                    printf( '<span class="flx-animated_text-word-animation flx-%1$s-active-header flx-%1$s-inactive">%2$s</span>',
			                    $settings["animation_header"], $line );
	                    }
                    } else {

	                    foreach ( $lines as $line ) { ?>
                            <span class="flx-animated_text-letter-animation flx-<?php echo $settings["animation_header"]; ?>-active-header flx-<?php echo $settings["animation_header"]; ?>-inactive">
                            <?php
                            $word_split = preg_split( '//', $line, - 1, PREG_SPLIT_NO_EMPTY );

                            foreach ( $word_split as $split_text ) {
	                            printf( '<span class="flx-split-word flx-%1$s-text">%2$s</span> ', $settings["animation_header"],
		                            $split_text );
                            }

                            ?>
                        </span>
	                    <?php }
                    }

                    ?>
                </span>
                <span class="flx-animated_text-postfix"><?php echo $settings['postfix']; ?></span>
            </span>
        </span>

		<?php if ( ! empty( $url ) ) {
			echo '</a>';
		} ?>

        </<?php esc_attr_e( $settings["header_tag"] ); ?>>

        </div>

		<?php

	}

}