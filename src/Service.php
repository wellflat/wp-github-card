<?php

namespace WP\GitHub;

/**
 * Class WP\GitHub\Service
 * GitHub API client
 * @package WP_GitHub_Card 
 * @since 1.0.0
 */
final class Service {
	private const API_BASE_PATH = 'https://api.github.com';
	private const CACHE_PREFIX = 'wp-github-card-';
	private const CACHE_EXPIRED = 4*HOUR_IN_SECONDS;

	/** @var string */
	private ?string $user = null;
	/** @var string */
	private ?string $token = null;

	public function __construct( ?string $user = null, ?string $token = null ) {
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
	 * provides publicly available information about someone with a GitHub account
	 * @return WP\GitHub\User
	 * @link https://developer.github.com/v3/users/#get-a-single-user
	 */
	public function get_user(): User {
		$url = self::API_BASE_PATH . '/users/' . $this->user;
		$cache_key = self::CACHE_PREFIX . 'user-' . $this->user;
		if ( false === ( $user = get_transient( $cache_key )) ) {
			$response = $this->request( $url );
			if ( is_wp_error( $response ) ) {
				$user = new User();
			} else {
				$user = new User( $response );
				set_transient( $cache_key, $user, self::CACHE_EXPIRED );
			}
		}
		return $user;
	}

	/**
	 * lists public repositories for the specified user
	 * @return WP\GitHub\Repos
	 * @link https://developer.github.com/v3/repos/#list-user-repositories
	 */
	public function get_repos(): Repos {
		$url = self::API_BASE_PATH . '/users/' . $this->user . '/repos?sort=pushed';
		$cache_key = self::CACHE_PREFIX . 'repos-' . $this->user;
		if ( false === ( $repos = get_transient( $cache_key )) ) {
			$response = $this->request( $url );
			if ( is_wp_error( $response ) ) {
				$repos = new Repos();
			} else {
				$repos = new Repos( $response );
				set_transient( $cache_key, $repos, self::CACHE_EXPIRED );
			}
		}
		return $repos;
	}

	/**
	 * deletes all transient
	 * @global object $wpdb
	 */
	public function delete_transients(): void {
		global $wpdb;
		$sql = "DELETE FROM `{$wpdb->prefix}options` WHERE `option_name` LIKE '_transient_wp-github-card-%'";
		$wpdb->query( $sql );
	}

	/**
	 * requests GitHub API
	 * @access private
	 * @param string $url entry point
	 * @return object|WP_Error
	 * @link https://developer.github.com/v3/
	 */
	private function request( string $url ) {
		$headers = [ 'Accept' => 'application/vnd.github.v3+json' ];
		if ( ! is_null( $this->token ) ) {
			$headers['Authorization'] = ' token ' . $this->token;
		}
		$args = [
			'headers' => $headers,
			'httpversion' => '2.0'
		];
		$response = wp_remote_get( $url, $args );
		if ( is_wp_error( $response ) ) {
			return $response;
		}
		if ( $response['response']['code'] === 200 ) {
			return json_decode( $response['body'] );
		} else {
			return new \WP_Error(
				$response['response']['code'],
				$response['body']
			);
		}
	}
}