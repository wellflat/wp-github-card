<?php
/*
Plugin Name: WP GitHub Card
Plugin URI: (プラグインの説明と更新を示すページの URI)
Description: GitHub Profile Card Plugin (プラグインの短い説明)
Version: 0.1
Author: Ryohei Tanaka (GitHub @wellflat)
Author URI: https://rest-term.com
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

// in development, see also github-profile-widget

final class GitHub_Card extends WP_Widget {
    const API_PATH = 'https://api.github.com';
    const API_VERSION = 'v3';

    protected $widget_slug = 'github-card';

    public __construct() {
        parent::__construct(
			$this->widget_slug, 'GitHub Profile', $this->widget_slug, [
				'classname'   => $this->widget_slug . '-class',
				'description' => 'A widget to show a small version of your GitHub profile',
				$this->widget_slug
			]
		);
    }

}
