# Tomodomo WP Imgix

Define image sizes and aspect ratios to generate Imgix URLs in WordPress.

## Usage

```php
<?php

use function Tomodomo\Plugin\WP_Imgix\Functions\get_image_sizes;
use function Tomodomo\Plugin\WP_Imgix\Functions\get_image_url;
use function Tomodomo\Plugin\WP_Imgix\Functions\get_image_url_by_id;
use function Tomodomo\Plugin\WP_Imgix\Functions\get_images;
use function Tomodomo\Plugin\WP_Imgix\Functions\get_images_by_id;

add_filter( 'tomodomo/wp_imgix/sizes', function( $sizes ) {
	$size = [
		'large' => [
			'4:3' => [
				'w' => '800',
				'h' => '600',
			],
			'16:9' => [
				'w' => '800',
				'h' => '600',
			]
		],
	];
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

## About Tomodomo

Tomodomo is a creative agency for communities. We focus on unique design and technical solutions to grow community activity and increase customer retention for online networking forums and customer service communities.

Learn more at [tomodomo.co](https://tomodomo.co) or email us: [hello@tomodomo.co](mailto:hello@tomodomo.co)

## License & Conduct

This project is licensed under the terms of the MIT License, included in `LICENSE.md`.

All open source Tomodomo projects follow a strict code of conduct, included in `CODEOFCONDUCT.md`. We ask that all contributors adhere to the standards and guidelines in that document.

Thank you!
