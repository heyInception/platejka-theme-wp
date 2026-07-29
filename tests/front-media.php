<?php

defined( 'ABSPATH' ) || exit;

$theme_dir = get_template_directory();
$hero      = file_get_contents( $theme_dir . '/template-parts/pages/hero.php' );
$loader    = $theme_dir . '/js/modules/hero-media.js';

assert( str_contains( $hero, 'class="hero__video js-hero-video"' ) );
assert( str_contains( $hero, 'preload="none"' ) );
assert( str_contains( $hero, 'data-src=' ) );
assert( ! str_contains( $hero, ' autoplay' ) );
assert( is_file( $loader ) );

$loader_source = file_get_contents( $loader );

assert( str_contains( $loader_source, 'prefers-reduced-motion: reduce' ) );
assert( str_contains( $loader_source, 'IntersectionObserver' ) );

echo "front media contract: OK\n";
