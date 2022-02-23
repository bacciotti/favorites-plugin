<?php
/**
 * @package Log
 * Plugin Name: Favorites Plugin
 * Description: Mark a post as a favorite and shows the favorites list on Widget or Shortcode.
 * Version: 1.0.0
 * Author: Lucas Bacciotti Moreira
 * Author URI: https://profiles.wordpress.org/baciotti/
 * Text Domain: log-favorites
 * Domain Path: /languages
 * License: GPLv2 or later
 */

namespace Log\Favorites_Plugin;

/**
 * Security purposes.
 *
 * Aborts if this file is called directly.
 *
 * @since 1.0.0
 * @package: log
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Defines Constants.
 *
 * FAVORITES_PLUGIN_DIR    Stores the plugin's main path.
 *
 * @since 1.0.0
 */
define( 'FAVORITES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Requires classes
 *
 * @since 1.0.0
 */

require_once FAVORITES_PLUGIN_DIR . '/vendor/autoload.php';
require_once FAVORITES_PLUGIN_DIR . '/src/class-api.php';
require_once FAVORITES_PLUGIN_DIR . '/src/class-button.php';
require_once FAVORITES_PLUGIN_DIR . '/src/class-favorites.php';
require_once FAVORITES_PLUGIN_DIR . '/src/class-metabox.php';
require_once FAVORITES_PLUGIN_DIR . '/src/class-shortcode.php';
require_once FAVORITES_PLUGIN_DIR . '/src/class-widget.php';

/**
 * Class Favorites_Plugin.
 *
 * This is the main plugin class which:
 *      - calls other classes;
 *      - initiates the plugin;
 *      - registers the widget;
 *
 * @since   1.0.0
 */
class Favorites_Plugin {

	/**
	 * Class constructor.
	 *
	 * Calls the init function.
	 * Registers widget.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'plugin_init' ) );
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}

	/**
	 * Plugin initialization.
	 *
	 * Instantiates new objects for Button, Shortcode and Meta Box classes.
	 *
	 * @since 1.0.0
	 */
	public function plugin_init() {
		$button    = new Button();
		$shortcode = new Shortcode();
		$metabox   = new Metabox();
		$api       = new Api();
	}

	/**
	 * Register Customizer Widget.
	 *
	 * Registers the Customizer Widget that shows all the Favorites posts.
	 *
	 * @since 1.0.0
	 */
	public function register_widgets() {
		register_widget( 'Log\Favorites_Plugin\Widget' );
	}
}

// New object's creation and plugin's start.
$favorites_plugin = new Favorites_Plugin();
