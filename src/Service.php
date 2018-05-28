<?php

namespace WP\GitHub;

/**
 * Class Service
 * @package WP\GitHub;
 */
final class Service {
	const API_BASE_PATH = 'https://api.github.com';
	//const CACHE_DIR = plugin_dir_path(__FILE__) . '/../cache/github';

	private $user;
	private $token;

	public function __construct( $user = null, $token = null ) {
		$this->user = $user;
		//$this->token = $token;
		$this->token = '373f993a7f21031ff5dacbbd8f1162316c6d7200';
	}

	public function __get( $name ) {
		return $this->$name;
	}

	public function __set( $name, $value) {
		$this->$name = $value;
	}

	/**
	 * Provides publicly available information about someone with a GitHub account
	 * @see https://developer.github.com/v3/users/#get-a-single-user
	 */
	public function get_user() {
		$url = self::API_BASE_PATH . '/users/' . $this->user;
		return $this->request( $url );
	}

	/**
	 * Lists public repositories for the specified user
	 * @see https://developer.github.com/v3/repos/#list-user-repositories
	 */
	public function get_repos() {
		$url = self::API_BASE_PATH . '/users/' . $this->user . '/repos';
		return $this->request( $url );
	}

	/**
	 * Lists languages for the specified repository
	 * @see https://developer.github.com/v3/repos/#list-languages
	 */
	public function get_language( $repo ) {
		$url = self::API_BASE_PATH . '/repos/' . $this->user . '/' . $repo . '/languages';
		return $this->request( $url );
	}

	/**
	 * Requests GitHub API
	 */
	private function request( $url ) {
		$headers = [
			'Accept' => 'application/vnd.github.v3+json'
		];
		if ( !is_null( $this->token ) ) {
			$headers['Authorization'] = ' token ' . $this->token;
		}
		$args = [
			'method' => 'GET',
			'headers' => $headers,
		];
		try {
			$response = wp_remote_get( $url, $args );
			return $response;
		} catch ( \WP_Error $e ) {
		}
	}
}