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
	public $login = '';
	/** @var string */
	public $avatar = '';
	/** @var string */
	public $name = '';
	/** @var int */
	public $public_repos = 0;
	/** @var int */
	public $public_gists = 0;
	/** @var int */
	public $followers = 0;

	public function __construct( object $data ) {
		$this->login = $data->login;
		$this->avatar = $data->avatar_url;
		$this->name = $data->name;
		$this->public_repos = $data->public_repos;
		$this->public_gists = $data->public_gists;
		$this->followers = $data->followers;
	}
}