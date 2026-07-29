<?php

/**
 * Frontend performance helpers.
 *
 * @package platejka
 */

defined( 'ABSPATH' ) || exit;

/**
 * Build a cache-safe version for a local theme asset.
 *
 * @param string $relative_path Theme-relative asset path.
 * @return string
 */
function platejka_asset_version( string $relative_path ): string {
	$absolute_path = get_template_directory() . '/' . ltrim( $relative_path, '/' );

	if ( is_file( $absolute_path ) ) {
		return (string) filemtime( $absolute_path );
	}

	return (string) wp_get_theme()->get( 'Version' );
}

/**
 * Determine whether the current request uses the front-page template.
 *
 * @return bool
 */
function platejka_is_front_template(): bool {
	return is_front_page() || is_page_template( 'page-home.php' );
}

/**
 * Render an ACF image through the WordPress responsive-image API.
 *
 * @param array<string, mixed>|int $image ACF image array or attachment ID.
 * @param string                   $size  Registered WordPress image size.
 * @param array<string, string>    $attrs Image attributes.
 * @return string
 */
function platejka_render_acf_image(
	array|int $image,
	string $size,
	array $attrs = array()
): string {
	$attachment_id = is_array( $image )
		? absint( $image['ID'] ?? $image['id'] ?? 0 )
		: absint( $image );

	if ( 0 === $attachment_id ) {
		return '';
	}

	$defaults = array(
		'loading'  => 'lazy',
		'decoding' => 'async',
	);

	return wp_get_attachment_image(
		$attachment_id,
		$size,
		false,
		array_merge( $defaults, $attrs )
	);
}
