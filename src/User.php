<?php

namespace WP\GitHub;

/**
 * Class WP\GitHub\User
 * GitHub account information
 * @package WP_GitHub_Card 
 * @since 1.0.0
 */
final class User {
	/** @var string */
	public string $login = '';
	/** @var string */
	public string $avatar = '';
	/** @var string */
	public string $name = '';
	/** @var int */
	public int $public_repos = 0;
	/** @var int */
	public int $public_gists = 0;
	/** @var int */
	public int $followers = 0;

	public function __construct( \stdClass $data = null ) {
		if ( ! is_null( $data ) ) {
			$check = $this->check_properties( $data );
			if ( $check ) {
				$this->login = $data->login;
				$this->avatar = $data->avatar_url;
				$this->name = $data->name;
				$this->public_repos = $data->public_repos;
				$this->public_gists = $data->public_gists;
				$this->followers = $data->followers;
			}
		}
	}

	/**
	 * check API response data
	 * @access private
	 * @param stdClass $data
	 * @return bool
	 */
	private function check_properties( \stdClass $data ): bool {
		$properties = [
			'login', 'avatar_url', 'name', 'public_repos', 'public_gists', 'followers'
		];
		foreach ( $properties as $p ) {
			if ( ! property_exists( $data, $p ) ) {
				return false;
			}
		}
		return true;
	}
}