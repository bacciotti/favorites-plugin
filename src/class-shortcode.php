<?php
/**
 * Class Shortcode.
 *
 * @file
 * class-shortcode.php
 *
 * @package Log
 */

namespace Log\Favorites_Plugin;

use Log\Favorites_Plugin;

/**
 * Security purposes
 * Aborts if this file is called directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class Plugin Widget.
 *
 * Defines Shortcode, that
 * allows the user to show the favorited posts
 * as Shortcode.
 *
 * @since   1.0.0
 */
class Shortcode {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_shortcode( 'favorites_plugin', array( $this, 'favorites_shortcode' ) );
	}

	/**
	 * Gets the data from Favorites Class.
	 *
	 * @since 1.0.0
	 */
	public function favorites_shortcode() {
		$obj_favorites = new Favorites();
		$title = '<h4>Favorites</h4>';
		return $title . $obj_favorites->get_favorites_list();
	}
}
