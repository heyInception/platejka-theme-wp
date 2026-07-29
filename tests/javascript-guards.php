<?php

defined( 'ABSPATH' ) || exit;

$theme_dir  = get_template_directory();
$main       = file_get_contents( $theme_dir . '/js/main.js' );
$navigation = file_get_contents( $theme_dir . '/js/navigation.js' );

assert( ! str_contains( $main, '$(window).on(\'resize\', wrapLastSlides);' ) );
assert( str_contains( $main, 'jQuery(window).on(\'resize\', wrapLastSlides);' ) );
assert( str_contains( $navigation, 'if(btnToTop)' ) );

echo "JavaScript guards contract: OK\n";
