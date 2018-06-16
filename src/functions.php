<?php

namespace Tomodomo\Plugin\WP_Imgix\Functions;

/**
 * Get the valid image sizes
 *
 * @return array
 */
function get_image_sizes() {
	return apply_filters( 'tomodomo/wp_imgix/sizes', [] );
}

/**
 * Get a formatted image URL
 *
 * @param string $url
 * @param array $args
 * @return string
 */
function build_image_url( $url, $args = [] ) {
	// Set our basic defaults
	$defaults = apply_filters( 'tomodomo/wp_imgix/default_args', [
		'q'   => '80',
		'fm'  => 'jpg',
		'fit' => 'crop',
	] );

	// Merge together the parsed defaults and any image-specific args
	$args = wp_parse_args( $args, $defaults );

	// Return the formatted version
	return add_query_arg( $args, $url );
}

/**
 * Get a formatted URL for imgix from an attachment image ID
 *
 * @param int $id
 * @param array $args
 * @return string
 */
function build_image_url_by_id( $id, $args ) {
	$image = wp_get_attachment_image_src( $id, 'full' );

	return build_image_url( $image[0], $args );
}

/**
 * Get all image size URLs from a source image URL
 *
 * @param string $url
 * @return array
 */
function get_images( $url ) {
	// Define the sizes as a hook in the theme
	$sizes = get_image_sizes();

	// Empty images
	$images = [];

	// Loop through sizes and ratios
	foreach ( $sizes as $size => $ratios ) {
		foreach ( $ratios as $ratio => $args ) {

			if ( ! isset( $images[$size] ) ) {
				$images[$size] = [];
			}

			// Set the parsed URL
			$images[$size][$ratio] = build_image_url( $url, $args );
		}
	}

	return $images;
}

/**
 * @param int $id
 * @return array
 */
function get_images_by_id( $id ) {
	$image = wp_get_attachment_image_src( $id, 'full' );

	return get_images( $image[0] );
}

/**
 * @param string $url
 * @param string $size
 * @param string $ratio
 * @return string
 */
function get_image( $url, $size, $ratio ) {
	$images = get_images( $url );

	return $images[$size][$ratio] ?? '';
}

/**
 * @param string $url
 * @param string $size
 * @param string $ratio
 * @return string
 */
function get_image_by_id( $id, $size, $ratio ) {
	$images = get_images_by_id( $id );

	return $images[$size][$ratio] ?? '';
}
