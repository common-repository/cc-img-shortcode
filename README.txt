=== CC-IMG-Shortcode ===
Contributors: ClearcodeHQ, PiotrPress
Tags: img, shortcode, html, tag, clearcode, piotrpress
Requires PHP: 7.2
Requires at least: 4.8.2
Tested up to: 5.9.2
Stable tag: trunk
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.txt

This plugin adds the `[img]` shortcode which replaces the `<img>` html tag.

== Description ==

This plugin adds the `[img]` shortcode which replaces the `<img>` html tag. It's also enables adding new media to post/page via the 'Add media' button by automatically inserting the formatted shortcode code to the editor.
You can simply add the `[img]` shortcode with a media ID to display:

`[img 123 /]`

or a fully formatted `[img]` shortcode:

`[img 123 align="center" size="full" caption="Sample text" title="Sample text" desc="Sample text" alt="Sample text" url="http://example.com/" /]`

It's supports `srcset` and `sizes` parameters.

= Tips & Tricks =

You can use your own html template file for displaying the `img` tag by using filter:

`add_filter( 'Clearcode\IMG_Shortcode\template', function() { return '/themes/clearcode.cc/templates/img.php'; } );`

== Installation ==

= From your WordPress Dashboard =

1. Go to 'Plugins > Add New'
2. Search for 'CC-IMG-Shortcode'
3. Activate the plugin from the Plugin section on your WordPress Dashboard.

= From WordPress.org =

1. Download 'CC-IMG-Shortcode'.
2. Upload the 'CC-IMG-Shortcode' directory to your '/wp-content/plugins/' directory using your favorite method (ftp, sftp, scp, etc...)
3. Activate the plugin from the Plugin section in your WordPress Dashboard.

= Once Activated =

1. Simply add new media to post/page via 'Add media' button in your post/page edit page.

= Multisite =

The plugin can be activated and used for just about any use case.

* Activate at the site level to load the plugin on that site only.
* Activate at the network level for full integration with all sites in your network (this is the most common type of multisite installation).

== Screenshots ==

1. **CC-IMG-Shortcode Example**

== Changelog ==

= 1.1.0 =
*Release date: 16.03.2022*

* Added `img()` & `src()` functions.
* Added `[src /]` shortcode.
* Added PHP 8.0 support.

= 1.0.0 =
*Release date: 16.10.2017*

* First stable version of the plugin.