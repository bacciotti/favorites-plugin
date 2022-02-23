<?php
/**
 * Class API.
 *
 * @file
 * class-api.php
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
 * Class Api.
 *
 * Defines functions that allow GET and UPDATE
 * REST API Calls to "is_favorite" Custom Field.
 *
 * @since   1.0.0
 */
class Api {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_api_is_favorite' ) );
	}

	/**
	 * Registers the api field.
	 *
	 * @since 1.0.0
	 */
	public function register_api_is_favorite() {
		register_rest_field(
			'post',
			'is_favorite',
			array(
				'get_callback'    => array( $this, 'rest_get_is_favorite' ),
				'update_callback' => array( $this, 'rest_update_is_favorite' ),
				'schema'          => null,
			)
		);
	}

	/**
	 * Defines the API GET.
	 *
	 * @param Object $post The post object.
	 * @param String $field_name The post object.
	 * @param String $request    The request type.
	 *
	 * @since 1.0.0
	 */
	public function rest_get_is_favorite( $post, $field_name, $request ) {
		return get_post_meta( $post['id'], $field_name, true );
	}

	/**
	 * Defines the API UPDATE.
	 *
	 * @param String $value    The parameter value.
	 * @param Object $post The post object.
	 * @param String $field_name The post object.
	 *
     * Note: Needs Authentication from client side.
     *
	 * @since 1.0.0
	 */
	public function rest_update_is_favorite( $value, $post, $field_name ) {
		$value = filter_var( $value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );

		if ( ! $value || ! is_bool( $value ) ) {
			return;
		}

		return update_post_meta( $post->ID, $field_name, $value );
	}
}

