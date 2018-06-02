<?php

namespace WP\GitHub;

/**
 * Class Shortcode
 * @package WP\GitHub;
 */
final class Shortcode {
	const CODE = 'github-card';
	private $renderer;
	private $service;

	public function __construct() {
		$this->renderer = new Renderer();
		$this->service = new Service();
		add_shortcode( self::CODE, [ $this, 'handler' ] );
	}

	public function handler( $atts ) {
		$defaults = [
			'user' => null,
			'token' => null,
			'cache' => 1
		];
		$params = shortcode_atts( $defaults, $atts );
		$this->service->user = $params['user'];
		$this->service->token = $params['token'];
		$user = $this->service->get_user();
		$repos = $this->service->get_repos();
		$params = array_merge( $params, (array)$user );
		$params = array_merge( $params, (array)$repos );
		return $this->renderer->load( 'card.html', $params );
	}

	public function delete_cache() {
		$this->service->delete_transients();
	}
}