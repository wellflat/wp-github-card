<?php

namespace WP\GitHub;

/**
 * Class User
 * @package WP\GitHub;
 */
final class User {
	public $login;
	public $avatar;
	public $name;
	public $public_repos;
	public $public_gists;
	public $followers;

	public function __construct( $data ) {
		$json = json_decode( $data );
		$this->login = $json->login;
		$this->avatar = $json->avatar_url;
		$this->name = $json->name;
		$this->public_repos = $json->public_repos;
		$this->public_gists = $json->public_gists;
		$this->followers = $json->followers;
	}
}