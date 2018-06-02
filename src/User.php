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
	public $cache_ready = false;

	public function __construct( object $data ) {
		$this->login = $data->login;
		$this->avatar = $data->avatar_url;
		$this->name = $data->name;
		$this->public_repos = $data->public_repos;
		$this->public_gists = $data->public_gists;
		$this->followers = $data->followers;
		$this->cache_ready = true;
	}
}