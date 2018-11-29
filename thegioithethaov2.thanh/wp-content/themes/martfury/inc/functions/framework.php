<?php
// Prevent direct access to this file
defined( 'ABSPATH' ) || die( 'Direct access to this file is not allowed.' );
/**
 * Core class.
 *
 * @package  KuteTheme
 * @since    1.0
 */
if ( !class_exists( 'Kuteshop_framework' ) ) {
	class Kuteshop_framework
	{
		/**
		 * Define theme version.
		 *
		 * @var  string
		 */
		const VERSION = '1.0.0';

		public function __construct()
		{
			add_action( 'init', array( $this, 'start_session' ), 1 );
			add_filter( 'theme_resize_image', array( $this, 'theme_resize_image' ), 10, 5 );

		}

		function start_session()
		{
			if ( !session_id() ) {
				session_start();
			}
		}

		function theme_resize_image( $attach_id = null, $width, $height, $crop = false, $use_lazy = false )
		{
			$img_lazy = "data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%20" . $width . "%20" . $height . "%27%2F%3E";
			if ( is_singular() && !$attach_id ) {
				if ( has_post_thumbnail() && !post_password_required() ) {
					$attach_id = get_post_thumbnail_id();
				}
			}
			$image_src = array();
			if ( $attach_id ) {
				$image_src        = wp_get_attachment_image_src( $attach_id, 'full' );
				$actual_file_path = get_attached_file( $attach_id );
			}
			if ( !empty( $actual_file_path ) && file_exists( $actual_file_path ) ) {
				$file_info        = pathinfo( $actual_file_path );
				$extension        = '.' . $file_info['extension'];
				$no_ext_path      = $file_info['dirname'] . '/' . $file_info['filename'];
				$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;
				if ( $image_src[1] > $width || $image_src[2] > $height ) {
					if ( file_exists( $cropped_img_path ) ) {
						$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
						$vt_image        = array(
							'url'    => $cropped_img_url,
							'width'  => $width,
							'height' => $height,
							'img'    => '<img class="img-responsive" src="' . esc_url( $cropped_img_url ) . '" ' . image_hwstring( $width, $height ) . ' alt="The gioi the thao">',
						);
						if ( $use_lazy == true ) {
							$vt_image['img'] = '<img class="img-responsive lazy" src="' . esc_attr( $img_lazy ) . '" data-src="' . esc_url( $cropped_img_url ) . '" ' . image_hwstring( $width, $height ) . ' alt="The gioi the thao">';
						}

						return $vt_image;
					}
					if ( $crop == false ) {
						$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
						$resized_img_path  = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;
						if ( file_exists( $resized_img_path ) ) {
							$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
							$vt_image        = array(
								'url'    => $resized_img_url,
								'width'  => $proportional_size[0],
								'height' => $proportional_size[1],
								'img'    => '<img class="img-responsive" src="' . esc_url( $resized_img_url ) . '" ' . image_hwstring( $proportional_size[0], $proportional_size[1] ) . ' alt="The gioi the thao">',
							);
							if ( $use_lazy == true ) {
								$vt_image['img'] = '<img class="img-responsive lazy" src="' . esc_attr( $img_lazy ) . '" data-src="' . esc_url( $resized_img_url ) . '" ' . image_hwstring( $proportional_size[0], $proportional_size[1] ) . ' alt="The gioi the thao">';
							}

							return $vt_image;
						}
					}
					/*no cache files - let's finally resize it*/
					$img_editor = wp_get_image_editor( $actual_file_path );
					if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
						return array(
							'url'    => '',
							'width'  => '',
							'height' => '',
							'img'    => '',
						);
					}
					$new_img_path = $img_editor->generate_filename();
					if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
						return array(
							'url'    => '',
							'width'  => '',
							'height' => '',
							'img'    => '',
						);
					}
					if ( !is_string( $new_img_path ) ) {
						return array(
							'url'    => '',
							'width'  => '',
							'height' => '',
							'img'    => '',
						);
					}
					$new_img_size = getimagesize( $new_img_path );
					$new_img      = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
					$vt_image     = array(
						'url'    => $new_img,
						'width'  => $new_img_size[0],
						'height' => $new_img_size[1],
						'img'    => '<img class="img-responsive" src="' . esc_url( $new_img ) . '" ' . image_hwstring( $new_img_size[0], $new_img_size[1] ) . ' alt="The gioi the thao">',
					);
					if ( $use_lazy == true ) {
						$vt_image['img'] = '<img class="img-responsive lazy" src="' . esc_attr( $img_lazy ) . '" data-src="' . esc_url( $new_img ) . '" ' . image_hwstring( $new_img_size[0], $new_img_size[1] ) . ' alt="The gioi the thao">';
					}

					return $vt_image;
				}
				$vt_image = array(
					'url'    => $image_src[0],
					'width'  => $image_src[1],
					'height' => $image_src[2],
					'img'    => '<img class="img-responsive" src="' . esc_url( $image_src[0] ) . '" ' . image_hwstring( $image_src[1], $image_src[2] ) . ' alt="The gioi the thao">',
				);
				if ( $use_lazy == true ) {
					$vt_image['img'] = '<img class="img-responsive lazy" src="' . esc_attr( $img_lazy ) . '" data-src="' . esc_url( $image_src[0] ) . '" ' . image_hwstring( $image_src[1], $image_src[2] ) . ' alt="The gioi the thao">';
				}

				return $vt_image;
			} else {
				$width    = intval( $width );
				$height   = intval( $height );
				$vt_image = array(
					'url'    => 'http://via.placeholder.com/' . $width . 'x' . $height,
					'width'  => $width,
					'height' => $height,
					'img'    => '<img class="img-responsive" src="' . esc_url( 'http://via.placeholder.com/' . $width . 'x' . $height ) . '" ' . image_hwstring( $width, $height ) . ' alt="The gioi the thao">',
				);

				return $vt_image;
			}
		}

	}

	new Kuteshop_framework();
}