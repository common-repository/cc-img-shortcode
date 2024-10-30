<?php

/*
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

use Clearcode\IMG_Shortcode;

if ( ! function_exists( 'img' ) ) {
	function img( $atts ) {
		if ( is_array( $atts ) ) return IMG_Shortcode::instance()->img( $atts );
		$img  = IMG_Shortcode::apply_filters( 'shortcode\img', 'img' );
		return do_shortcode( "[$img $atts /]" );
	}
}

if ( ! function_exists( 'src' ) ) {
	function src( $img ) {
		return IMG_Shortcode::instance()->src( [ $img ] );
	}
}
