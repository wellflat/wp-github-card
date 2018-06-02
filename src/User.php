<?php

namespace WP\GitHub;

/**
 * Class User
 * @package WP\GitHub;
 */
final class User {
	public $login = '';
	public $avatar = '';
	public $name = '';
	public $public_repos = 0;
	public $public_gists = 0;
	public $followers = 0;

	public function __construct( $data ) {
		if ( ! is_null( $data ) ) {
			$json = json_decode( $data );
			$this->login = $json->login;
			$this->avatar = $json->avatar_url;
			$this->name = $json->name;
			$this->public_repos = $json->public_repos;
			$this->public_gists = $json->public_gists;
			$this->followers = $json->followers;
		}
	}
}