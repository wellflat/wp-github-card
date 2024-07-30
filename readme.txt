=== WP GitHub Card ===
Contributors: wellflat
Donate link:
Tags: github, shortcode
Requires at least: 4.9.6
Tested up to: 6.6.1
Requires PHP: 7.4+
Stable tag: 2.3.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin provides simple GitHub profile summary card.

== Description ==
This is a plugin which gives you a small card to show your GitHub user profile summary. You just have to put shortcode.

**Features include:**
+ GitHub account name and avatar
+ recently active repository
+ frequently used language list sorted by repository's stargazers count
+ public repositories and gists count
+ followers count
+ total stargazers count

**Notice:**
This plugin caches GitHub user profile data into the database (expires 4 hours).

== Installation ==
1. Install "WP GitHub Card" via the WordPress.org plugin directory or uploading the files to your server.
2. Activate the plugin.
2. Put shortcode '[github-card user={GitHub account name}]' in your page.

== Screenshots ==
1. GitHub profile card screenshot
2. usage

== Changelog ==
= 2.3.0 =
* migrated twig v2 to 3
= 2.2.0 =
* tested php8.0, 8.2
= 2.1.0 =
* required php7.4 or later, added typed properties
= 2.0.0 =
* required php7.3 or later, end of support php5
= 1.0.1 =
* bugfix
= 1.0.0 =
* Initial working version.
