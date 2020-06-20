<?php

namespace WP\GitHub;

/**
 * Class WP\GitHub\Shortcode
 * @package WP_GitHub_Card
 * @since 1.0.0
 */
final class Shortcode {
	const CODE = 'github-card';

	/** @var WP\GitHub\Renderer */
	private Renderer $renderer;
	/** @var WP\GitHub\Service */
	private Service $service;

	public function __construct() {
		$this->renderer = new Renderer();
		$this->service = new Service();
		add_shortcode( self::CODE, [ $this, 'handler' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_style' ] );
	}

	/**
	 * shortcode main handler
	 * @param array $atts attributes in shortcode tag
	 * @return string
	 */
	public function handler( array $atts ): string {
		$defaults = [
			'user' => null,
			'token' => null
		];
		$params = shortcode_atts( $defaults, $atts );
		$this->service->user = $params['user'];
		$this->service->token = $params['token'];
		$user = $this->service->get_user();
		$repos = $this->service->get_repos();
		$params = array_merge( $params, (array)$user );
		$params = array_merge( $params, (array)$repos );
		return $this->renderer->render( 'card.html', $params );
	}

	/**
	 * enqueues style sheet
	 */
	public function add_style(): void {
		wp_register_style(
			'github-card-style',
			plugin_dir_url(__FILE__) . '../public/style.css'
		);
		wp_enqueue_style( 'github-card-style' );
	}

	/**
	 * prepares template cache
	 */
	public function prepare_cache(): void {
		$this->renderer->prepare_template_cache();
	}

	/**
	 * deletes transients and template cache
	 */
	public function delete_cache(): void {
		$this->service->delete_transients();
		$this->renderer->delete_template_cache();
	}
}