<?php
/**
 * Class Favorites.
 *
 * @file
 * class-favorites.php
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
 * Class Favorites.
 *
 * Gets favorited/bookmarked posts.
 * Used at first on Widget and Shortcode.
 *
 * @since   1.0.0
 */
class Favorites {

	/**
	 * Get favorited posts list with html.
	 *
	 * @since 1.0.0
	 */
	public function get_favorites_list() {
		$args = array(
			'post_type'  => 'post',
			'meta_key'   => 'is_favorite',
			'meta_value' => 1,
		);

		$the_query = new \WP_Query( $args );

		$output = '';
		if ( $the_query->have_posts() ) {

			while ( $the_query->have_posts() ) :
				$the_query->the_post();

				$output .= "<p><a href='" . get_permalink() . "'>" . get_the_title() . '</a></p>';
			endwhile;
			wp_reset_postdata();
		} else {
			$output = '<p>' . __( 'No favorites found.', 'log-favorites' ) . '</p>';
		}

		return $output;
	}
}
