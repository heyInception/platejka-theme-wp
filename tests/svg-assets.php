<?php

defined( 'ABSPATH' ) || exit;

$theme_dir = get_template_directory();
$main_css  = file_get_contents( $theme_dir . '/css/main.css' );

assert( is_file( $theme_dir . '/img/coin.svg' ) );
assert( is_file( $theme_dir . '/img/coin.webp' ) );
assert( str_contains( $main_css, 'url(../img/coin.webp)' ) );
assert( ! str_contains( $main_css, 'url(../img/coin.svg)' ) );

echo "SVG presentation contract: OK\n";
