<?php

namespace WP\GitHub;

/**
 * Class Service
 * @package WP\GitHub;
 */
final class Service {
	const API_BASE_PATH = 'https://api.github.com';
	const CACHE_PREFIX = 'wp-github-card-';
	const CACHE_EXPIRED = 1*HOUR_IN_SECONDS;

	/** @var string */
	private $user;
	/** @var string */
	private $token;

	public function __construct( $user = null, $token = null ) {
		$this->user = $user;
		$this->token = $token;
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
		$cache_key = self::CACHE_PREFIX . 'user-' . $this->user;
		//delete_transient( $cache_key );
		if ( false === ( $user = get_transient( $cache_key )) ) {
			$response = $this->request( $url );
			if ( is_wp_error( $response ) ) {
				$user = new User();
				delete_transient( $cache_key );
			} else {
				$user = new User( $response );
				set_transient( $cache_key, $user, self::CACHE_EXPIRED );
			}
		}
		return $user;
	}

	/**
	 * Lists public repositories for the specified user
	 * @see https://developer.github.com/v3/repos/#list-user-repositories
	 */
	public function get_repos() {
		$url = self::API_BASE_PATH . '/users/' . $this->user . '/repos?sort=updated';
		$cache_key = self::CACHE_PREFIX . 'repos-' . $this->user;
		//delete_transient( $cache_key );
		if ( false === ( $repos = get_transient( $cache_key )) ) {
			$response = $this->request( $url );
			if ( is_wp_error( $response ) ) {
				$repos = new Repos();
				delete_transient( $cache_key );
			} else {
				$repos = new Repos( $response );
				set_transient( $cache_key, $repos, self::CACHE_EXPIRED );
			}
		}
		return $repos;
	}

	/**
	 * Lists languages for the specified repository
	 * @see https://developer.github.com/v3/repos/#list-languages
	 */
	public function get_languages( $repo ) {
		$url = self::API_BASE_PATH . '/repos/' . $this->user . '/' . $repo . '/languages';
		$cache_key = self::CACHE_PREFIX . 'languages-' . $this->user;
		return $this->request( $url );
	}

	/**
	 * Deletes all transients
	 */
	public function delete_transients() {
		global $wpdb;
		$sql = "DELETE FROM `wp_options` WHERE `option_name` LIKE '_transient_wp-github-card-%'";
		//$wpdb->query( $sql );
	}

	/**
	 * Requests GitHub API
	 * @see https://developer.github.com/v3/
	 */
	private function request( $url ) {
		$headers = [ 'Accept' => 'application/vnd.github.v3+json' ];
		if ( ! is_null( $this->token ) ) {
			$headers['Authorization'] = ' token ' . $this->token;
		}
		$args = [ 'headers' => $headers ];
		$response = wp_remote_get( $url, $args );
		if ( is_array( $response ) ) {
			if ( $response['response']['code'] === 200 ) {
				return $response['body'];
			}
		} else {
			return $response; // WP_Error
		}
	}
}