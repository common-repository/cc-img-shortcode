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

namespace Clearcode;

if ( ! class_exists( __NAMESPACE__ . '\IMG_Shortcode' ) ) {
	class IMG_Shortcode extends IMG_Shortcode\Plugin {
		protected $img = 'img';
		protected $src = 'src';

		public function action_init() {
			$this->img = self::apply_filters( 'shortcode\img', $this->img );
			$this->src = self::apply_filters( 'shortcode\src', $this->src );
			add_shortcode( $this->img, array( $this, 'img' ) );
			add_shortcode( $this->src, array( $this, 'src' ) );
			add_filter( 'image_send_to_editor', array( $this, 'image_send_to_editor' ), 30, 8 );
		}

		public function img( $atts ) {
			$atts = array_merge( $basic = array(
				'ID'       => '',
				'src'      => '',
				'width'    => '',
				'height'   => '',
				'caption'  => '',
				'title'    => '',
				'align'    => '',
				'url'      => '',
				'size'     => '',
				'alt'      => '',
				'desc'     => '',
				'ver'      => '',
				'id'       => '',
				'class'    => '',
				'srcset'   => '',
				'sizes'    => '',
				'template' => '/plugins/' . self::get( 'dir' ) . '/templates/img.php'
			), $atts );

			if ( isset( $atts[0] ) ) {
				if ( ! empty( $atts[0] ) ) $atts['src'] = $atts[0];
				unset( $atts[0] );
			}

			$atts = array_map( 'trim', $atts );

			$atts['extras'] = array_diff_key( $atts, $basic ) ?: [];
			$atts = self::esc_atts( $atts );

			if ( $attachment = self::get_attachment( $atts['src'] ) ) {
				list( $src, $width, $height ) = wp_get_attachment_image_src( $attachment->ID, $atts['size'] );

				$atts['ID']     = $attachment->ID;
				$atts['src']    = $src;
				$atts['ver']    = self::get_ver( $atts['ID'] );
				$atts['width']  = $width;
				$atts['height'] = $height;
				$atts['post']   = (array)$attachment;
				$atts['meta']   = (array)wp_get_attachment_metadata( $atts['ID'] );
				$atts['srcset'] = wp_get_attachment_image_srcset( $atts['ID'], $atts['size'], $atts['meta'] );
				$atts['sizes']  = wp_get_attachment_image_sizes(  $atts['ID'], $atts['size'], $atts['meta'] );
			}

			return self::get_template( $atts['template'], $atts );
		}

		public function src( $atts ) {
			$src = reset( $atts );
			$ver = '';

			if ( $attachment = self::get_attachment( $src ) ) {
				$src = wp_get_attachment_url( $attachment->ID );
				$ver = self::get_ver( $attachment->ID );
			}

			$template = '/plugins/' . self::get( 'dir' ) . '/templates/src.php';
			return self::get_template( $template, [ 'src' => $src, 'ver' => $ver ] );
		}

		static public function esc_atts( $atts ) {
			if ( is_array( $atts['class'] ) )
				$atts['class'] = implode( ' ', $atts['class'] );

			foreach( array( 'title', 'alt', 'desc', 'ver', 'id' ) as $attr )
				if ( isset( $atts[$attr] ) )
					$atts[$attr] = esc_attr( $atts[$attr] );

			if ( isset( $atts['src'] ) and ! is_numeric( $atts['src'] ) )
				$atts['src'] = esc_url( $atts['src'] );

			if ( isset( $atts['caption'] ) )
				$atts['caption'] = esc_html( $atts['caption'] );

			if ( isset( $atts['url'] ) )
				$atts['url'] = esc_html( $atts['url'] );

			if ( isset( $atts['align'] ) )
				$atts['align'] = in_array( $atts['align'], array( 'left', 'center', 'right' ) ) ? $atts['align'] : 'none';

			if ( isset( $atts['size'] ) )
				$atts['size'] = in_array( $atts['size'], array( 'thumb', 'thumbnail', 'medium', 'large' ) ) ? $atts['size'] : 'full';

			foreach ( $atts['extras'] as $key => $value ) {
				$atts[$key] = esc_attr( $atts[$key] );
				$atts['extras'][$key] = $atts[$key];
			}

			return $atts;
		}

		static public function is_rel( $src ) {
			return 0 === strpos( $src, '/' );
		}

		static public function get_abs( $src ) {
			if ( ! self::is_rel( $src ) ) return $src;

			$upload = wp_upload_dir();
			if ( $upload['error'] ) return $src;

			return rtrim( $upload['baseurl'], '/' ) . $src;
		}

		static public function get_ver( $id ) {
			return get_the_modified_date( 'U', $id );
		}

		static public function get_attachment( $src ) {
			if ( is_numeric( $src ) ) {
				if ( ! $attachment = get_post( $src ) ) return null;
				return 'attachment' === $attachment->post_type ? $attachment : null;
			}

			if ( self::is_rel( $src ) ) $src = self::get_abs( $src );
			if ( ! $id = attachment_url_to_postid( $src ) ) return null;
			return get_post( $id ) ?: null;
		}

		public function image_send_to_editor( $html, $id, $caption, $title, $align, $url, $size, $alt = '' ) {
			if ( ! $attachment = self::get_attachment( $id ) ) return '';

			$title = $attachment->post_title;
			$desc  = $attachment->post_content;

			if ( 'none' === $align ) $align = '';

			$html = self::apply_filters( 'id', $id );
			foreach( array( 'caption', 'title', 'align', 'url', 'size', 'alt', 'desc' ) as $attr ) {
				$$attr = self::apply_filters( $attr, $$attr );
				$html .= $$attr ? sprintf( ' %s="%s"', $attr, $$attr ) : '';
			}

			return sprintf( '[%s %s]', $this->img, $html );
		}
	}
}
