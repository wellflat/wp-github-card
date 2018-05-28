<?php

namespace WP\GitHub;

/**
 * Class Renderer
 * @package WP\GitHub;
 */
final class Renderer {

	/** @var \Twig_Environment */
	private $twig;

	public function __construct() {
		$loader = new \Twig_Loader_Filesystem();
		$loader->addPath( plugin_dir_path(__FILE__) . '/../public' );
		$params = [
			'cache' => plugin_dir_path(__FILE__) . '/../cache/template',
			'debug' => true
		];
		$params = [
			'cache' => null,
			'debug' => true
		];
		$this->twig = new \Twig_Environment( $loader, $params );
	}

	public function render( $template_file, array $params ) {
		$template = $this->twig->loadTemplate( $template_file );
		echo $template->render( $params );
	}
}