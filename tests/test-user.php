<?php
/**
 * Class UserTest
 *
 * @package Wp_Github_Card
 */
class UserTest extends WP_UnitTestCase {

	function test_construct() {
		$user = new WP\GitHub\User();
		$this->assertEquals('', $user->login);
		$this->assertEquals('', $user->avatar);
		$this->assertEquals('', $user->name);
		$this->assertEquals(0, $user->public_repos);
		$this->assertEquals(0, $user->public_gists);
		$this->assertEquals(0, $user->followers);
	}

	function test_construct2() {
		$data = new stdClass();
		$data->login = 'test login';
		$data->avatar_url = 'https://avatar';
		$data->name = 'test name';
		$data->public_repos = 10;
		$data->public_gists = 20;
		$data->followers = 30;
		$user = new WP\GitHub\User($data);
		$this->assertEquals('test login', $user->login);
		$this->assertEquals('https://avatar', $user->avatar);
		$this->assertEquals('test name', $user->name);
		$this->assertEquals(10, $user->public_repos);
		$this->assertEquals(20, $user->public_gists);
		$this->assertEquals(30, $user->followers);
	}
}
