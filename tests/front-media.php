<?php

defined( 'ABSPATH' ) || exit;

$theme_dir = get_template_directory();
$hero      = file_get_contents( $theme_dir . '/template-parts/pages/hero.php' );
$loader    = $theme_dir . '/js/modules/hero-media.js';
$main_css  = file_get_contents( $theme_dir . '/css/main.css' );
$about_css = file_get_contents( $theme_dir . '/css/about.css' );

assert( str_contains( $hero, 'class="hero__video js-hero-video"' ) );
assert( str_contains( $hero, 'preload="none"' ) );
assert( str_contains( $hero, 'data-src=' ) );
assert( ! str_contains( $hero, ' autoplay' ) );
assert( is_file( $loader ) );

$loader_source = file_get_contents( $loader );

assert( str_contains( $loader_source, 'prefers-reduced-motion: reduce' ) );
assert( str_contains( $loader_source, 'IntersectionObserver' ) );
assert( str_contains( $main_css, 'url(../img/international.webp)' ) );
assert( ! str_contains( $main_css, 'url(../img/international.jpg)' ) );
assert( str_contains( $main_css, 'url(../img/hero-mob.webp)' ) );
assert( ! str_contains( $main_css, 'url(../img/hero-mob.png)' ) );
assert( str_contains( $main_css, 'url(../img/notice.webp)' ) );
assert( ! str_contains( $main_css, 'url(../img/notice.jpg)' ) );
assert( str_contains( $about_css, 'url(../img/teams/before.webp)' ) );
assert( ! str_contains( $about_css, 'url(../img/teams/before.png)' ) );

echo "front media contract: OK\n";
