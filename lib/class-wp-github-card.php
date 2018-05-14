<?php

final class WP_GitHub_Card extends WP_Widget {
	const API_PATH = 'https://api.github.com';
	const API_VERSION = 'v3';

	public function __construct() {
		$widget_options = [
			'classname'   => 'github-card',
			'description' => 'A widget to show a small version of your GitHub profile card',
			'customize_selective_refresh' => true
		];
		$control_options = [ 'width' => 400, 'height' => 300 ];
		//parent::__construct( 'github-card', 'WP GitHub Card', $widget_options, $control_options );
		parent::__construct( 'github-card', 'WP GitHub Card', $widget_options );
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="github-card"><?php echo 'github card here'; ?></div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$defaults = [ 'title' => '', 'username' => '' ];
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = sanitize_text_field( $instance['title'] );
		$username = sanitize_text_field( $instance['username'] );
		$title_field_id = $this->get_field_id( 'title' );
		$title_field_name = $this->get_field_name( 'title' );
		$username_field_id = $this->get_field_id( 'username' );
		$username_field_name = $this->get_field_name( 'username' );
		?>
		<p>
		  <label for="<?php echo $title_field_id; ?>">title</label>
		  <input class="widefat" id="<?php echo $title_field_id; ?>" name="<?php echo $title_field_name; ?>" type="text" value="<?php echo esc_attr( $title ); ?>" placeholder="widget title" />
		</p>
		<p>
		  <label for="<?php echo $username_field_id; ?>">username</label>
		  <input class="widefat" id="<?php echo $username_field_id; ?>" name="<?php echo $username_field_name; ?>" type="text" value="<?php echo esc_attr( $username ); ?>" placeholder="GitHub username" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['username'] = sanitize_text_field( $new_instance['username'] );
		return $instance;
	}

	private function get_github_profile() {
		// use wp_remote_get()
		
	}
}
