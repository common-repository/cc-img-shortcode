<?php

/*
	Plugin Name: CC-IMG-Shortcode
	Plugin URI: https://wordpress.org/plugins/cc-img-shortcode
	Description: This plugin adds the `[img]` shortcode which replaces the `<img>` html tag.
	Version: 1.1.0
	Author: Clearcode
	Author URI: https://clearcode.cc
	Text Domain: cc-img-shortcode
	Domain Path: /languages/
	License: GPLv3
	License URI: http://www.gnu.org/licenses/gpl-3.0.txt

	Copyright (C) 2022 by Clearcode <https://clearcode.cc>
	and associates (see AUTHORS.txt file).

	This file is part of CC-IMG-Shortcode.

	CC-IMG-Shortcode is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	CC-IMG-Shortcode is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with CC-IMG-Shortcode; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

namespace Clearcode\IMG_Shortcode;

use Clearcode\IMG_Shortcode;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_plugin_data' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

foreach ( array( 'singleton', 'plugin', 'img-shortcode' ) as $class ) {
	require_once( plugin_dir_path( __FILE__ ) . sprintf( 'includes/class-%s.php', $class ) );
}

require_once( plugin_dir_path( __FILE__ ) . 'includes/functions.php' );


if ( ! has_action( IMG_Shortcode::get( 'slug' ) ) ) {
	do_action( IMG_Shortcode::get( 'slug' ), IMG_Shortcode::instance() );
}
