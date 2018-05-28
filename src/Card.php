<?php

namespace WP\GitHub;

/**
 * Class Card
 * @package WP\GitHub;
 */
final class Card extends \WP_Widget {

	private $renderer;
	private $service;

	public function __construct() {
		$widget_options = [
			'classname'   => 'github-card',
			'description' => 'A widget to show a small version of your GitHub profile card',
			'customize_selective_refresh' => true
		];
		$control_options = [ 'width' => 400, 'height' => 300 ];
		//parent::__construct( 'github-card', 'WP GitHub Card', $widget_options, $control_options );
		parent::__construct( 'github-card', 'WP GitHub Card', $widget_options );
		$this->renderer = new Renderer();
		$this->service = new Service('wellflat');
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$params = [
			'title' => $title,
			'before_widget' => $args['before_widget'],
			'before_title' => $args['before_title'],
			'after_title' => $args['after_title'],
			'after_widget' => $args['after_widget']
		];
		$user = $this->service->get_user();
		print_r($user);
		$this->renderer->render('card.html', $params );
	}

	public function form( $instance ) {
		$defaults = [ 'title' => '', 'username' => '' ];
		$instance = wp_parse_args( (array) $instance, $defaults );
		$username = sanitize_text_field( $instance['username'] );
		$params = [
			'title' => sanitize_text_field( $instance['title'] ),
			'username' => $username,
			'title_field_id' => $this->get_field_id( 'title' ),
			'title_field_name' => $this->get_field_name( 'title' ),
			'username_field_id' => $this->get_field_id( 'username' ),
			'username_field_name' => $this->get_field_name( 'username' )
		];
		$this->renderer->render( 'admin.html', $params );
		$this->service->user = $username;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['username'] = sanitize_text_field( $new_instance['username'] );
		$this->service->user = $instance['username'];
		return $instance;
	}
}
