<?php
/**
 * Class ServiceTest
 *
 * @package Wp_Github_Card
 */
class ServiceTest extends WP_UnitTestCase {

	function test_construct() {
		$service = new WP\GitHub\Service();
		$this->assertNull($service->user);
		$this->assertNull($service->token);
		$this->assertTrue(method_exists($service, 'get_user'));
		$this->assertTrue(method_exists($service, 'get_repos'));
		$this->assertTrue(method_exists($service, 'delete_transients'));
	}

	function test_get_user() {
		/* $service_stub = $this->createMock(WP\GitHub\Service::class); */
		/* $ret = new WP\GitHub\User(); */
		/* $service_stub->method('get_user')->willReturn($ret); */
		/* $user = $service_stub->get_user(); */
		/* $this->assertEquals('', $user->login); */
		/* $this->assertEquals('', $user->avatar); */
		/* $this->assertEquals('', $user->name); */
		/* $this->assertEquals(0, $user->public_repos); */
		/* $this->assertEquals(0, $user->public_gists); */
		/* $this->assertEquals(0, $user->followers); */
	}

	function test_get_repos() {
	}

	function test_delete_transients() {
	}
}