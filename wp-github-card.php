<?php
/*
Plugin Name: WP GitHub Card
Plugin URI: https://github.com/wellflat/wp-github-card
Description: GitHub simple profile card plugin
Version: 2.4.0
Author: Ryohei Tanaka
Author URI: https://github.com/wellflat
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/
/*
Copyright 2018 Ryohei Tanaka

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once( plugin_dir_path( __FILE__ ) . '/vendor/autoload.php' );

$code = new WP\GitHub\Shortcode();
$code->prepare_cache();

register_deactivation_hook( __FILE__, function() use ( $code ) {
	$code->delete_cache();
});
