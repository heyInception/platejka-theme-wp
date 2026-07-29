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

/**
 * Preload the primary body-font file used above the fold.
 *
 * @return void
 */
function platejka_preload_primary_font(): void {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( get_template_directory_uri() . '/fonts/Inter-Regular.woff2' )
	);
}
add_action( 'wp_head', 'platejka_preload_primary_font', 2 );

/**
 * Enqueue only the assets needed by the current template.
 *
 * @return void
 */
function platejka_enqueue_assets(): void {
	$theme_uri = get_template_directory_uri();

	wp_enqueue_style(
		'platejka-vendor',
		$theme_uri . '/css/vendor.css',
		array(),
		platejka_asset_version( 'css/vendor.css' )
	);
	wp_enqueue_style(
		'platejka-main',
		$theme_uri . '/css/main.css',
		array( 'platejka-vendor' ),
		platejka_asset_version( 'css/main.css' )
	);

	if ( platejka_is_front_template() || is_page_template( 'page-company.php' ) ) {
		wp_enqueue_style(
			'platejka-about',
			$theme_uri . '/css/about.css',
			array( 'platejka-main' ),
			platejka_asset_version( 'css/about.css' )
		);
	}

	wp_enqueue_style(
		'platejka-style',
		get_stylesheet_uri(),
		array( 'platejka-main' ),
		platejka_asset_version( 'style.css' )
	);
	wp_style_add_data( 'platejka-style', 'rtl', 'replace' );

	$main_dependencies = array( 'jquery' );
	if ( is_page_template( 'page-company.php' ) ) {
		wp_enqueue_script(
			'leader-line',
			$theme_uri . '/js/leader-line.min.js',
			array(),
			platejka_asset_version( 'js/leader-line.min.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
		$main_dependencies[] = 'leader-line';
	}

	wp_enqueue_script(
		'platejka-main-js',
		$theme_uri . '/js/main.js',
		$main_dependencies,
		platejka_asset_version( 'js/main.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
	wp_enqueue_script(
		'platejka-navigation',
		$theme_uri . '/js/navigation.js',
		array( 'jquery' ),
		platejka_asset_version( 'js/navigation.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	if ( is_search() ) {
		wp_enqueue_script(
			'platejka-search',
			$theme_uri . '/js/search.js',
			array( 'jquery' ),
			platejka_asset_version( 'js/search.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}

	if ( is_home() || is_single() ) {
		wp_enqueue_script(
			'wazzup-js-blog-TweenMax',
			'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js',
			array(),
			null,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'platejka_enqueue_assets' );
