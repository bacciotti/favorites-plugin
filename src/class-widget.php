<?php
/**
 * Class Widget.
 *
 * @file
 * class-widget.php
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
 * Defines Customizer's widget, that
 *          allows the user to show the favorite posts
 *          on frontend (sidebar, footer etc.)
 *
 * @since   1.0.0
 */
class Widget extends \WP_Widget {

	/**
	 * Class constructor.
	 *
	 * Registers the Widget with WP_Widget class
	 *              constructor (parent class).
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		parent::__construct(
			'Favorites_Widget',
			'Favorites',
			array( 'description' => __( 'List Favorites Posts', 'log-favorites' ) )
		);
	}

	/**
	 * Outputs the Widget's content on screen.
	 *
	 * @since 1.0.0
	 *
	 * @param string $args          The $args parameter provides the HTML you can use
	 *                                      to display the widget title class and widget
	 *                                      content class.
	 * @param string $instance      The Widget's options (title, ie).
	 */
	public function widget( $args, $instance ) {
		$title = empty( $instance['title'] ? '' : apply_filters( 'widget_title', $instance['title'] ) );

		if ( isset( $title ) ) {
			echo '<p>' . esc_html( $instance['title'] ) . '</p>';
		}
		echo esc_html( $this->format_favorites_list() );
	}

	/**
	 * Sets the Widget's form, with an input for the Widget's title.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance      The widget's title.
	 */
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = sanitize_text_field( $instance['title'] );
		} else {
			$title = __( 'Favorites', 'log-favorites' );
		}
		?>
		<p>
			<label
				for="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>"
				aria-label="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>">
				<?php esc_html_e( 'Title: ', 'log-favorites' ); ?>
			</label>
			<input
				role="textbox"
				aria-required="false"
				id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>"
				type="text"
				maxlength="32"
				value="<?php echo esc_attr( $title ); ?>"
			/>
		</p>
		<?php
	}

	/**
	 * Requests and/or saves the Widget's title.
	 *
	 * @since 1.0.0
	 *
	 * @param string $new_instance   New value for the widget's title.
	 * @param string $old_instance   Old value of the widget's title.
	 * @return array $instance      The widget's title.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';

		return $instance;
	}

	/**
	 * Prepares the HTML to shows on Widget.
	 *
	 * @since 1.0.0
	 *
	 * @return string   $html_output    The HTML output that is showed on Widget.
	 */
	public function format_favorites_list() {
		$obj_favorites = new Favorites();
		return $obj_favorites->get_favorites_list();
	}
}
