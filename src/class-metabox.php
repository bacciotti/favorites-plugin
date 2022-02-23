<?php
/**
 * Class Metabox.
 *
 * @file
 * class-metabox.php
 *
 * @package Log
 */

namespace Log\Favorites_Plugin;

/*
 * Security purposes
 * Aborts if this file is called directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class Plugin Meta Box.
 *
 * Defines the meta box showed on Edit Page sidebar.
 * The purpose of this Meta Box is to set the post as favorite.
 *
 * @since 1.0.0
 */
class Metabox {

	/**
	 * Adds the action to 'add_meta_boxes_hook' hook.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_post_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_favorite' ) );

	}

	/**
	 * Registers the meta box, linking it to
	 * 'post_class_meta_box' function (callback).
	 *
	 * @since 1.0.0
	 */
	public function add_post_meta_boxes() {
		add_meta_box(
			'post-class',
			esc_html__( 'Bookmark this post!', 'log-favorites' ),
			array(
				$this,
				'post_class_meta_box',
			),
			'post',
			'side',
			'high'
		);

	}

	/**
	 * Defines the HTML output of the Meta box.
	 *
	 * @param object $post The current post being edited.
	 * @since 1.0.0
	 */
	public function post_class_meta_box( $post ) {
		$is_favorite = get_post_meta( $post->ID, 'is_favorite', true );

		?>
		<div class="meta-box-block">
			<p>
				<label for='favorites-box' aria-label='Check if this post is favorite: '>
					<?php esc_html_e( 'Check to mark this post as favorite: ', 'log-favorites' ); ?>

					<input type="checkbox" name="chk-is-favorite"
						<?php if ( $is_favorite ) { ?>
							checked="checked"<?php } ?> />
				</label>
			</p>
		</div>
		<?php

	}

	/**
	 * Save the post as favorite
	 *
	 * @param Int $post_ID The current post ID.
	 * @since 1.0.0
	 */
	public function save_favorite( $post_ID = 0 ) {
		$is_favorite = isset( $_POST['chk-is-favorite'] ) ? 1 : 0;
		update_post_meta( $post_ID, 'is_favorite', $is_favorite );
		return $post_ID;
	}

}
