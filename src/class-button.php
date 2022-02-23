<?php
/**
 * Class Button.
 *
 * @file
 * class-button.php
 *
 * @package Log
 */

namespace Log\Favorites_Plugin;

/**
 * Security purposes
 * Aborts if this file is called directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class Button.
 *
 * Defines the button that appears on posts footer, as an icon.
 *
 * @since   1.0.0
 */
class Button {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'the_content', array( $this, 'filter_the_content_in_the_main_loop' ), 1 );
	}

	/**
	 * Show icon with the information if it is favorite or not.
	 *
	 * @param string $content The current post content.
	 *
	 * @return string           The HTML output that is showed after the post.
	 *
	 * @since 1.0.0
	 */
	public function filter_the_content_in_the_main_loop( $content ) {
		// Only shows on single posts.
		if ( is_single() ) {
			$is_favorite = get_post_meta( get_the_id(), 'is_favorite', true );
			$button_html = "<div class='div-button'>";
			$button_html .= 1 === $is_favorite ? "<span class='dashicons dashicons-star-filled'></span>Favorited"
				: "<span class='dashicons dashicons-star-empty'></span>Not favorited";

			$button_html .= '</div>';
			return $content . $button_html;
		}
	}
}
