<?php
/**
 * Class RendererTest
 *
 * @package Wp_Github_Card
 */
class RendererTest extends WP_UnitTestCase {

	function test_construct() {
		$renderer = new WP\GitHub\Renderer();
		$this->assertTrue(method_exists($renderer, 'render'));
		$this->assertTrue(method_exists($renderer, 'prepare_template_cache'));
		$this->assertTrue(method_exists($renderer, 'delete_template_cache'));
	}

	function test_render() {
		$renderer = new WP\GitHub\Renderer();
		$template = $renderer->render('card.html', ['test param']);
		$this->assertEquals('string', gettype($template));
	}
}