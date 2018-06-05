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
		$user = new WP\GitHub\User();
		$service = Mockery::mock(new WP\GitHub\Service);
		$service->shouldReceive('get_user')->andReturn($user);
		$this->assertEquals($user, $service->get_user());
	}

	function test_get_repos() {
		$repos = new WP\GitHub\Repos();
		$service = Mockery::mock(new WP\GitHub\Service);
		$service->shouldReceive('get_repos')->andReturn($repos);
		$this->assertEquals($repos, $service->get_repos());
	}
}