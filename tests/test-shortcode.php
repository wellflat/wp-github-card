<?php
/**
 * Class ShortcodeTest
 *
 * @package Wp_Github_Card
 */
class ShortcodeTest extends WP_UnitTestCase {

	function test_construct() {
		$code = new WP\GitHub\Shortcode();
		$this->assertTrue(method_exists($code, 'handler'));
		$this->assertTrue(method_exists($code, 'add_style'));
		$this->assertTrue(method_exists($code, 'prepare_cache'));
		$this->assertTrue(method_exists($code, 'delete_cache'));
	}

	function test_handler() {
		$code = Mockery::mock(new WP\GitHub\Shortcode);
		$renderer = new Wp\GitHub\Renderer();
		$template = $renderer->render('card.html', ['test param']);
		$params = [
			'user' => 'wellflat',
			'token' => 'token'
		];
		$code->shouldReceive('handler')->with($params)->andReturn($template);
		$this->assertEquals($template, $code->handler($params));
	}
}