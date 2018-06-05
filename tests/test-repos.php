<?php
/**
 * Class ReposTest
 *
 * @package Wp_Github_Card
 */
class ReposTest extends WP_UnitTestCase {

	function test_construct() {
		$repos = new WP\GitHub\Repos();
		$this->assertTrue(is_array($repos->languages));
		$this->assertCount(0, $repos->languages);
		$this->assertEquals(0, $repos->stargazers);
		$this->assertEquals('', $repos->recently_active_repo);
	}

	function test_construct2() {
		$data = [
			(object)['name' => 'repo 1', 'stargazers_count' => 10, 'language' => 'C++'],
			(object)['name' => 'repo 2', 'stargazers_count' => 20, 'language' => 'Ruby'],
			(object)['name' => 'repo 3', 'stargazers_count' => 30, 'language' => 'Python'],
			(object)['name' => 'repo 4', 'stargazers_count' => 40, 'language' => 'PHP'],
		];
		$repos = new WP\GitHub\Repos($data);
		$this->assertCount(3, $repos->languages);
		$this->assertEquals(['PHP', 'Python', 'Ruby'], $repos->languages);
		$this->assertEquals(100, $repos->stargazers);
		$this->assertEquals('repo 1', $repos->recently_active_repo);
	}
}