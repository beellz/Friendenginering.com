<?php

defined( 'ABSPATH' ) || exit();

/**
 * @param           $settings
 * @param           $key
 * @param   string  $return  = class | element
 *
 * @return string
 */
function flexi_get_icon( $settings, $key, $return = 'element' ) {

	$key_new = $key . '_new';

	// new/ migrated icon
	$migrated = isset( $settings['__fa4_migrated'][ $key_new ] );

	// Check if its a new widget without previously selected icon using the old Icon control
	$is_new = empty( $settings[ $key ] ) && Elementor\Icons_Manager::is_migration_allowed();

	if ( $migrated || $is_new ) {
		$icon = ! empty( $settings[ $key_new ]['library'] ) && $settings[ $key_new ]['library'] != 'svg' ? $settings[ $key_new ]['value']
			: '';
	} else {
		$icon = $settings[ $key ]['value'];
	}

	if ( 'class' == $return ) {
		return $icon;
	}

	return sprintf( '<i class="fa %1$s"></i>', $icon );
}

/**
 * Render icon html with backward compatibility
 *
 * @param   array   $settings
 * @param   string  $old_icon_id
 * @param   string  $new_icon_id
 * @param   array   $attributes
 */
function flexiaddons_render_icon( $settings = [], $old_icon_id = 'icon', $new_icon_id = 'icon_new', $attributes = [] ) {
	// Check if its already migrated
	$migrated = isset( $settings['__fa4_migrated'][ $new_icon_id ] );

	// Check if its a new widget without previously selected icon using the old Icon control
	$is_new = empty( $settings[ $old_icon_id ] );

	$attributes['aria-hidden'] = 'true';

	if ( version_compare( ELEMENTOR_VERSION, '2.6.0', '>=' ) && ( $is_new || $migrated ) ) {
		\Elementor\Icons_Manager::render_icon( $settings[ $new_icon_id ], $attributes );
	} else {
		if ( empty( $attributes['class'] ) ) {
			$attributes['class'] = $settings[ $old_icon_id ];
		} else {
			if ( is_array( $attributes['class'] ) ) {
				$attributes['class'][] = $settings[ $old_icon_id ];
			} else {
				$attributes['class'] .= ' ' . $settings[ $old_icon_id ];
			}
		}
		printf( '<i %s></i>', \Elementor\Utils::render_html_attributes( $attributes ) );
	}
}

/**
 * Check elementor version
 *
 * @param   string  $version
 * @param   string  $operator
 *
 * @return bool
 */
function flexi_is_elementor_version( $operator = '<', $version = '2.6.0' ) {
	return defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator );
}

function flexiaddons_get_active_widgets() {
	$widgets = Flexi_Addons_Widgets_Manager::get_widgets_map();

	if ( ! flexiaddons()->is_pro_active() ) {
		$active_widgets = array_filter( $widgets, function ( $widget ) {
			return empty( $widget['is_pro'] ) || ! $widget['is_pro'];
		} );

		return ! empty( $active_widgets ) ? $active_widgets : [];

	}

	return $widgets;
}

function flexiaddons_get_active_extensions() {
	$extensions = Flexi_Addons_Widgets_Manager::get_extensions_map();

	if ( ! flexiaddons()->is_pro_active() ) {
		$active_extensions = array_filter( $extensions, function ( $extension ) {
			return empty( $extension['is_pro'] ) || ! $extension['is_pro'];
		} );

		return ! empty( $active_extensions ) ? $active_extensions : [];

	}

	return $extensions;
}

function flx_hex_to_rgba( $value, $opacity = 1 ) {
	list( $r, $g, $b ) = sscanf( $value, "#%02x%02x%02x" );

	return "rgba($r, $g, $b, $opacity)";
}

function flexiaddons_is_cf7_activated() {
	return class_exists( '\WPCF7' );
}

function flexiaddon_get_cf7_forms() {
	$forms = [];
	if ( flexiaddons_is_cf7_activated() ) {
		$_forms = get_posts( [
			'post_type'      => 'wpcf7_contact_form',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		] );

		if ( ! empty( $_forms ) ) {
			$forms = wp_list_pluck( $_forms, 'post_title', 'ID' );
		}
	}

	return $forms;
}

function flexiaddon_do_shortcode( $tag, array $atts = array(), $content = null ) {
	global $shortcode_tags;
	if ( ! isset( $shortcode_tags[ $tag ] ) ) {
		return false;
	}
	return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

function flexiaddon_sanitize_html_class_param( $class ) {
	$classes = ! empty( $class ) ? explode( ' ', $class ) : [];
	$sanitized = [];
	if ( ! empty( $classes ) ) {
		$sanitized = array_map( function( $cls ) {
			return sanitize_html_class( $cls );
		}, $classes );
	}
	return implode( ' ', $sanitized );
}

function flexiaddon_get_current_user_display_name() {
	$user = wp_get_current_user();
	$name = 'user';
	if ( $user->exists() && $user->display_name ) {
		$name = $user->display_name;
	}
	return $name;
}


if( !function_exists('flexiaddons_caldera_forms_options') ){
    function flexiaddons_caldera_forms_options() {
        if ( class_exists( 'Caldera_Forms' ) ) {
            $caldera_forms = Caldera_Forms_Forms::get_forms( true, true );
            $form_options  = ['0' => esc_html__( 'Select Form', 'flexiaddons' )];
            $form          = array();
            if ( ! empty( $caldera_forms ) && ! is_wp_error( $caldera_forms ) ) {
                foreach ( $caldera_forms as $form ) {
                    if ( isset($form['ID']) and isset($form['name'])) {
                        $form_options[$form['ID']] = $form['name'];
                    }   
                }
            }
        } else {
            $form_options = ['0' => esc_html__( 'Form Not Found!', 'flexiaddons' ) ];
        }
        return $form_options;
    }
}

function flexiaddons_is_ninjaforms_activated() {
	return class_exists( '\Ninja_Forms' );
}

function flexiaddons_get_ninjaform() {
	$forms = [];

	if ( flexiaddons_is_ninjaforms_activated() ) {
		$_forms = \Ninja_Forms()->form()->get_forms();

		if ( ! empty( $_forms ) && ! is_wp_error( $_forms ) ) {
			foreach ( $_forms as $form ) {
				$forms[ $form->get_id( )] = $form->get_setting('title');
			}
		}
	}

	return $forms;
}



/**
	 * Get all elementor page templates
	 *
	 * @return array
	 */
	function get_elementor_page_templates($type = null)
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
			$options[] = 'No ' . ucfirst($type) . ' Found';
		}
		return $options;
	}