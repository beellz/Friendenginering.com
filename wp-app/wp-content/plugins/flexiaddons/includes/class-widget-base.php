<?php

defined('ABSPATH') || exit();

/**
 * Class Flexi_Addons_Widget_Base
 *
 * Base class for all the widget of this plugin
 *
 * @since 1.0.0
 */

class Flexi_Addons_Widget_Base extends \Elementor\Widget_Base {

	/**
	 * all the widget unique prefix of this plugin
	 *
	 * @var string
	 */
	protected $prefix = 'flexi-';

	/**
	 * the main key name of the widget
	 *
	 * @var string
	 */
	protected $key = '';

	/**
	 * all the widget's categories of this plugin
	 *
	 * @var array
	 */
	protected $categories = [ 'flexiaddons_category' ];

	/**
	 * Flexi_Addons_Widget_Base constructor.
	 *
	 * @param array $data
	 * @param null $args
	 *
	 * @throws Exception
	 */
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		$this->load_depends_scripts();
	}

	private function load_depends_scripts() {


		//style dependency
		if ( ! empty( $handlers = Flexi_Addons_Widgets_Manager::get_widgets_map()[ $this->key ]['css'] ) ) {

			foreach ( $handlers as $handler ) {
				$this->add_style_depends( $handler );
			}
		}

		//script dependency
		if ( ! empty( $handlers = Flexi_Addons_Widgets_Manager::get_widgets_map()[ $this->key ]['js'] ) ) {
			foreach ( $handlers as $handler ) {
				$this->add_script_depends( $handler );
			}
		}
	}

	/**
	 * get the widget unique name
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_name() {
		return $this->prefix . $this->key;
	}

	/**
	 * Get the widget title label
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_title() {
		return Flexi_Addons_Widgets_Manager::get_label( $this->key );
	}

	/**
	 * Get the widget icon
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'flexi-widget-icon '.Flexi_Addons_Widgets_Manager::get_icon( $this->key );
	}

	/**
	 * Get the categories of the widget
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_categories() {
		return $this->categories;
	}

	/**
	 * Get the keywords of the widget
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_keywords() {
		return Flexi_Addons_Widgets_Manager::get_keywords( $this->key );
	}

}