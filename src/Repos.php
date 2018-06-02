<?php

namespace WP\GitHub;

/**
 * Class Repos
 * @package WP\GitHub;
 */
final class Repos {
	private $repos = [];
	public $languages = [];
	public $stargazers = 0;
	public $recently_acitive_repo = '';

	public function __construct( array $data ) {
		$this->repos = [];
		foreach ( $data as $repo ) {
			$this->repos[] = [
				'name' => $repo->name,
				'stargazers' => $repo->stargazers_count,
				'language' => $repo->language
			];
		}
		foreach ( $this->repos as $repo ) {
			$stargazers[] = $repo['stargazers'];
		}
		array_multisort( $stargazers, SORT_DESC, $this->repos );
		$this->languages = array_unique( array_column( $this->repos, 'language' ) );
		$this->languages = array_slice( $this->languages, 0, 3 );
		$this->stargazers = $this->sum_stargazers();
		$this->recently_active_repo = $this->repos[0]['name'];
	}

	private function sum_stargazers() {
		return array_reduce( $this->repos, function($c, $i) {
			return $c + $i['stargazers'];
		}, 0);
	}
}