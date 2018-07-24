# Tomodomo WP Imgix

Define image sizes and aspect ratios to generate Imgix URLs in WordPress.

## PHP Usage

WP Imgix is designed to be integrated into your theme directly, via its functions.

### Functions

The plugin introduces several functions in the `Tomodomo\Plugin\WP_Imgix\Functions` namespace:

+ `get_image_sizes()`
+ `build_image_url( $url, $imgix_query_args )`
+ `build_image_url_by_id( $attachment_id, $imgix_query_args )`
+ `get_images( $url )`
+ `get_images_by_id( $attachment_id )`
+ `get_image( $url, $size, $ratio )`
+ `get_image_by_id( $attachment_id, $size, $ratio )`

### Filters

+ `tomodomo/wp_imgix/sizes` - Array of image sizes and ratios (see example below)
+ `tomodomo/wp_imgix/default_args` - Array of default args to be added to the Imgix URL

### PHP Code Example

```php
<?php

use function Tomodomo\Plugin\WP_Imgix\Functions\get_image_sizes;
use function Tomodomo\Plugin\WP_Imgix\Functions\build_image_url;
use function Tomodomo\Plugin\WP_Imgix\Functions\get_images;
use function Tomodomo\Plugin\WP_Imgix\Functions\get_images_by_id;
use function Tomodomo\Plugin\WP_Imgix\Functions\get_image;
use function Tomodomo\Plugin\WP_Imgix\Functions\get_image_by_id;

/**
 * Register custom image sizes/ratios
 */
add_filter( 'tomodomo/wp_imgix/sizes', function( $sizes ) {
	$sizes['large'] = [
		'4:3' => [
			'w' => '800',
			'h' => '600',
		],
		'16:9' => [
			'w' => '800',
			'h' => '600',
		],
	];

	return $sizes;
} );

/**
 * Get all image URLs from a seed URL or ID
 */
$images = get_images( get_the_post_thumbnail_url() );
// Output: array( 'large' => array( '4:3' => 'https://url.for/image.jpg?params'...

$image = get_images_by_id( get_post_thumbnail_id() );
// Output: array( 'large' => array( '4:3' => 'https://url.for/image.jpg?params'...

/**
 * Get a specific image URL from a URL or ID, for a specific size
 */
$image = get_image( get_the_post_thumbnail_url(), 'large', '16:9' );
// Output: 'https://url.for/image.jpg?params...

$image = get_image_by_id( get_post_thumbnail_id(), 'large', '4:3' );
// Output: 'https://url.for/image.jpg?params...

/**
 * Build an Imgix URL with any parameters.
 * Default params can be set by using the
 * `tomodomo/wp_imgix/default_args` filter
 */
$args = [
	'w' => 300,
	'h' => 300,
];

$image = build_image_url( $url, $args );
// Output: https://url.for/image.jpg?w=300&h=300&default=param
```

## WP REST API Usage

You can also access the pre-built image URLs, for all your registered sizes and aspect ratios, via `post` objects in the REST API, for example:

```js
console.log( post.imgix['large']['16:9'] );
// Output: https://url.for/image.jpg?w=300&h=300&default=param
```

By default, the `imgix` object will only be added on the `post` post type, however you can also add it to your custom post types or other built-in post types (or remove it!) via the `tomodomo/wp_imgix/object_types` filter, e.g.:

```php
add_filter( 'tomodomo/wp_imgix/object_types', function( $types ) {
	$types[] = 'book';

	if ( ( $index = array_search( 'post', $types ) ) !== false ) {
		unset( $types[ $index ] );
	}

	return $types;
} );
```

Note that your object type must support `post-thumbnail` for this feature to work.

## About Tomodomo

Tomodomo is a creative agency for magazine publishers. We use custom design and technology to speed up your editorial workflow, engage your readers, and build sustainable subscription revenue for your business.

Learn more at [tomodomo.co](https://tomodomo.co) or email us: [hello@tomodomo.co](mailto:hello@tomodomo.co)

## License & Conduct

This project is licensed under the terms of the MIT License, included in `LICENSE.md`.

All open source Tomodomo projects follow a strict code of conduct, included in `CODEOFCONDUCT.md`. We ask that all contributors adhere to the standards and guidelines in that document.

Thank you!
