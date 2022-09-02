<?php

namespace wpforo\widgets;

use WP_Widget;

class Forums extends WP_Widget {
	/**
	 * @var array
	 */
	private $default_instance;

	function __construct() {
		parent::__construct( 'wpforo_forums', 'wpForo Forums', [ 'description' => 'Forum tree.' ] );
		$this->init_local_vars();
	}

	private function init_local_vars() {
		$this->default_instance = [
			'title'    => __( 'Forums', 'wpforo' ),
			'dropdown' => false,
		];
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];//This is an HTML content//
		echo '<div id="wpf-widget-forums" class="wpforo-widget-wrap">';
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];//This is an HTML content//
		}
		echo '<div class="wpforo-widget-content">';
		if ( wpfval( $instance, 'dropdown' ) ) {
			$forum_urls = [];
			$forums     = array_filter( WPF()->forum->get_forums(), function ( $forum ) {
				return WPF()->perm->forum_can( 'vf', $forum['forumid'] );
			} );
			if ( ! empty( $forums ) ) {
				foreach ( $forums as $forum ) {
					$forum_urls[ 'forum_' . $forum['forumid'] ] = wpforo_home_url( $forum['slug'] );
				}
			}
			if ( ! empty( $forum_urls ) ) {
				echo '<select onchange="window.location.href = wpf_forum_urls[\'forum_\' + this.value]">';
				WPF()->forum->tree( 'select_box', true, WPF()->current_object['forumid'], true );
				echo '</select>';
				?>
                <script>var wpf_forum_json = '<?php echo json_encode( $forum_urls ) ?>';
                    var wpf_forum_urls = JSON.parse(wpf_forum_json);</script>
				<?php
			}
		} else {
			WPF()->forum->tree( 'front_list', true, [], false );
		}
		echo '</div>';
		echo '</div>';
		echo $args['after_widget'];//This is an HTML content//
	}

	public function form( $instance ) {
		$title    = ! empty( $instance['title'] ) ? $instance['title'] : $this->default_instance['title'];
		$dropdown = isset( $instance['dropdown'] ) && $instance['dropdown'];
		?>
        <p>
            <label><?php _e( 'Title', 'wpforo' ); ?>:</label>
            <label>
                <input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $title ); ?>">
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'dropdown' ) ?>"><?php _e( 'Display as dropdown', 'wpforo' ); ?>
                &nbsp;</label>
            <input id="<?php echo $this->get_field_id( 'dropdown' ) ?>" class="wpf_wdg_dropdown"
                   name="<?php echo esc_attr( $this->get_field_name( 'dropdown' ) ); ?>" <?php checked( $dropdown ); ?>
                   type="checkbox">
        </p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance             = [];
		$instance['title']    = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['dropdown'] = isset( $new_instance['dropdown'] ) ? (bool) $new_instance['dropdown'] : $this->default_instance['dropdown'];

		return $instance;
	}
}
