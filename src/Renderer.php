<?php

namespace WP\GitHub;

/**
 * Class WP\GitHub\Renderer
 * html renderer
 * @package WP_GitHub_Card 
 * @since 1.0.0
 * @link https://twig.symfony.com/
 */
final class Renderer {

	/** @var \Twig_Environment */
	private $twig;

	public function __construct() {
		$loader = new \Twig_Loader_Filesystem();
		$loader->addPath( plugin_dir_path(__FILE__) . '/../public' );
		$params = [
			'cache' => plugin_dir_path(__FILE__) . '/../public/cache',
			'debug' => true,
			'auto_reload' => true
		];
		$this->twig = new \Twig_Environment( $loader, $params );
	}

	/**
	 * render template
	 * @param string $template_file
	 * @param array $params
	 */
	public function render( $template_file, array $params ) {
		$template = $this->twig->loadTemplate( $template_file );
		return $template->render( $params );
	}
}