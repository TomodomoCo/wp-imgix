<?php

namespace Tomodomo\Plugin\WP_Imgix\Integration\WP_API;

use function Tomodomo\Plugin\WP_Imgix\Functions\get_images;

/**
 * Add the parameters to the REST API
 *
 * @return void
 */
function add_parameter() {
	add_action( 'rest_api_init', __NAMESPACE__ . '\\register_parameters' );

	return;
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\add_parameter' );

/**
 * Register the parameter(s)
 *
 * @return void
 */
function register_parameters() {
	$object_types = apply_filters( 'tomodomo\wp_imgix\object_types', [ 'post' ] );

	register_rest_field( $object_types, 'imgix', [
		'get_callback'    => __NAMESPACE__ . '\\get_parameter_imgix',
		'update_callback' => null,
		'schema'          => null,
	] );

	return;
}

/**
 * Get our custom parameter
 *
 * @param array $post
 * @param string $field_name
 * @param WP_REST_Request $request
 * @return array
 */
function get_parameter_mindful( $post, $field_name, \WP_REST_Request $request ) {
	$url = get_the_post_thumbnail_url( $post['id'], 'full' );

	return get_images( $url );
}
