<?php

namespace WP\GitHub;

/**
 * Class WP\GitHub\Repos
 * GitHub user repositories information
 * @package WP_GitHub_Card 
 * @since 1.0.0
 */
final class Repos {
	/** @var array */
	private array $repos = [];
	/** @var array */
	public array $languages = [];
	/** @var int */
	public int $stargazers = 0;
	/** @var string */
	public string $recently_active_repo = '';

	public function __construct( array $data = null ) {
		if (! is_null( $data ) ) {
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
			$this->recently_active_repo = $data[0]->name;
			array_multisort( $stargazers, SORT_DESC, $this->repos );
			$this->languages = array_unique( array_column( $this->repos, 'language' ) );
			$this->languages = array_slice( $this->languages, 0, 3 );
			$this->stargazers = $this->count_stargazers();
		}
	}

	/**
	 * counts total stargazers
	 * @access private
	 * @return int
	 */
	private function count_stargazers(): int {
		return array_reduce( $this->repos, function($c, $i) {
			return $c + $i['stargazers'];
		}, 0);
	}
}