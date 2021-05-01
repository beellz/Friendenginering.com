<?php

use Elementor\Controls_Stack;
use Elementor\Utils;

/**
 * PP Magic Wand.
 *
 * @package PowerpackElements
 */
class FLX_Copy_Paste {
	/**
	 * Init hooks.
	 */
	public static function init() {

		if ( ! self::is_active() ) {
			return;
		}

		add_action( 'wp_ajax_flx_get_section_data', array( __CLASS__, 'get_section_data' ) );
		add_action( 'wp_ajax_nopriv_flx_get_section_data', array( __CLASS__, 'get_section_data' ) );
		add_action( 'wp_ajax_flx_process_import', array( __CLASS__, 'process_media_import' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( __CLASS__, 'flx_copy_paste_scripts' ) );

	}

	/**
	 * Load required js on before enqueue widget JS.
	 */
	public static function flx_copy_paste_scripts() {
		wp_enqueue_script( 'flx-x-copy-paste-helper', FLEXI_ADDONS_ASSETS . '/js/flx-x-copy-paste-helper.js', null, FLEXI_ADDONS_VERSION,
			true );

		$script_depends = [ 'jquery', 'flx-x-copy-paste-helper', 'elementor-editor' ];

		wp_enqueue_script( 'flx-x-copy-paste', FLEXI_ADDONS_ASSETS . '/js/flx-x-copy-paste.js', $script_depends, FLEXI_ADDONS_VERSION,
			true );

		wp_localize_script( 'flx-x-copy-paste', 'flx_x_copy_paste', array(
			'ajaxURL'          => admin_url( 'admin-ajax.php' ),
			'nonce'            => wp_create_nonce( 'flx_process_import' ),
			'widget_not_found' => __( 'The widget type you are trying to paste is not available on this site.', 'flexiaddons' ),
			'flx_copy'         => sprintf( __( '%1s Copy', 'flexiaddons' ), 'Flexi' ),
			'flx_paste'        => sprintf( __( '%1s Paste', 'flexiaddons' ), 'Flexi' ),
			'copy_icon'        => 'fa fa-copy',
			'paste_icon'       => 'fa fa-paste',
			'cross_domain_cdn'  => apply_filters( 'flx_copy_paste_cdn', 'https://flexiaddons.com/x-copy-paste.html' ),
		) );
	}

	public static function render_footer_script() { ?>
        <style>
            .flx-live-copy-btn {
                display: none;
                position: absolute;
                top: 20px;
                right: 20px;
                background: rgba(255, 255, 255, 0.8);
                border: 2px solid;
                padding: 8px 10px;
                cursor: pointer;
                color: #000;
                border-radius: 5px;
                transition: all 0.5s;
            }

            .flx-live-copy-btn.flx-btn-disabled {
                pointer-events: none;
            }

            .elementor-section-wrap > .elementor-section:hover .flx-live-copy-btn {
                display: block;
            }

            .elementor-section-wrap > .elementor-section:hover .flx-live-copy-btn:hover {
                background: rgba(255, 255, 255, 1);
            }
        </style>

        <script type="text/javascript">
            ;(function ($) {
                var sections = $('.elementor-section-wrap > .elementor-section'),
                    post_id = '<?php echo get_the_ID(); ?>',
                    nonce = '<?php echo wp_create_nonce( 'flx_x_copy_paste' ); ?>',
                    doc = $(document),
                    btn = $('<div />');

                btn.addClass('flx-live-copy-btn');
                btn.append('<span class="flx-live-copy-btn-text">Live Copy</span>');
                btn.append('<span class="flx-live-copy-btn-icon"></span>');

                sections.filter(function (index, section) {
                    var settings = $(section).data('settings');
                    return !(!settings || !settings.flx_magic_wand || 'yes' !== settings.flx_magic_wand);
                }).append(btn);

                sections.on('click.flxLiveCopy', '.flx-live-copy-btn', function (e) {
                    var data = $(e.delegateTarget).data();
                    if ('section' === data.element_type) {
                        doc.trigger({
                            type: 'flxLiveCopy',
                            section_id: data.id,
                        });
                    }
                });

                doc.on('flxLiveCopy', function (e) {
                    var btn = $('.elementor-section[data-id="' + e.section_id + '"] .flx-live-copy-btn'),
                        txt = btn.find('.flx-live-copy-btn-text');

                    btn.addClass('flx-btn-disabled');
                    txt.text('Copying...');

                    FLX_Copy_Paste_Handler.getSectionData(post_id, e.section_id, nonce, function (response) {
                        if (response.success) {
                            txt.text('Copied!');
                            setTimeout(function () {
                                txt.text('Live Copy');
                            }, 1000);
                        } else {
                            txt.text('Error!');
                        }
                        btn.removeClass('flx-btn-disabled');
                    });
                });
            })(jQuery);

        </script>
		<?php
	}

	public static function get_section_data() {
		check_ajax_referer( 'flx_x_copy_paste', 'nonce' );

		if ( ! isset( $_POST['post_id'] ) || ! absint( $_POST['post_id'] ) ) {
			wp_send_json_error();
		}

		$elementor = \Elementor\Plugin::instance();
		$post_id   = absint( wp_unslash( $_POST['post_id'] ) );

		if ( ! $elementor->db->is_built_with_elementor( $post_id ) ) {
			wp_send_json_error();
		}

		if ( 'publish' !== get_post_status( $post_id ) ) {
			wp_send_json_error();
		}

		$document = $elementor->documents->get( $post_id );
		$data     = $document ? $document->get_elements_data() : [];

		if ( empty( $data ) ) {
			wp_send_json_success( $data );
		}

		$processed_data = [];

		foreach ( $data as $d ) {
			$processed_data[ $d['id'] ] = $d;
		}

		if ( isset( $_POST['section_id'] ) && ! empty( $_POST['section_id'] ) ) {
			$section_id = sanitize_text_field( wp_unslash( $_POST['section_id'] ) );

			if ( isset( $processed_data[ $section_id ] ) ) {
				wp_send_json_success( $processed_data[ $section_id ] );
			}
		}

		wp_send_json_success( $processed_data );
	}

	/**
	 * Media import support
	 *
	 * @return void
	 */
	public static function process_media_import() {
		check_ajax_referer( 'flx_process_import', 'nonce' );

		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error( __( 'Not a valid user.', 'flexiaddons' ), 403 );
		}

		$content = isset( $_POST['content'] ) ? wp_unslash( $_POST['content'] ) : '';

		if ( empty( $content ) ) {
			wp_send_json_error( __( 'Empty content cannot be processed.', 'flexiaddons' ) );
		}

		$content = array( json_decode( $content, true ) );
		$content = self::replace_elements_ids( $content );
		$content = self::process_import_content( $content );

		wp_send_json_success( $content );
	}

	/**
	 * Replace media items IDs.
	 *
	 * @access protected
	 *
	 * @param   array  $content  Widgets media content.
	 *
	 * @return array content
	 */
	protected static function replace_elements_ids( $content ) {
		return \Elementor\Plugin::instance()->db->iterate_data( $content, function ( $element ) {
			$element['id'] = Utils::generate_random_string();

			return $element;
		} );
	}

	/**
	 * Media import process.
	 *
	 * @access protected
	 *
	 * @param   array  $content  Widgets media content.
	 *
	 * @return mixed
	 */
	protected static function process_import_content( $content ) {
		return \Elementor\Plugin::instance()->db->iterate_data( $content, function ( $element_data ) {
			$element = \Elementor\Plugin::instance()->elements_manager->create_element_instance( $element_data );

			// If the widget/element isn't exist, like a plugin that creates a widget but deactivated
			if ( ! $element ) {
				return null;
			}

			return self::process_element_import_content( $element );
		} );
	}

	/**
	 * Process element content for import.
	 *
	 * @access protected
	 *
	 * @param   Controls_Stack  $element  Element.
	 *
	 * @return array Processed element data.
	 */
	protected static function process_element_import_content( Controls_Stack $element ) {
		$element_data = $element->get_data();
		$method       = 'on_import';

		if ( method_exists( $element, $method ) ) {
			$element_data = $element->{$method}( $element_data );
		}

		foreach ( $element->get_controls() as $control ) {
			$control_class = \Elementor\Plugin::instance()->controls_manager->get_control( $control['type'] );
			$control_name  = $control['name'];

			// If the control isn't exist, like a plugin that creates the control but deactivated.
			if ( ! $control_class ) {
				return $element_data;
			}

			if ( method_exists( $control_class, $method ) ) {
				$element_data['settings'][ $control_name ] = $control_class->{$method}( $element->get_settings( $control_name ), $control );
			}
		}

		return $element_data;
	}

	private static function is_active() {
		return ! in_array( 'copy-paste', Flexi_Addons_Widgets_Manager::get_inactive_extensions() );
	}
}

FLX_Copy_Paste::init();
