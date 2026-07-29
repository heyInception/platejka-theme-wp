<?php

defined( 'ABSPATH' ) || exit;

$theme_dir = get_template_directory();
$footer    = file_get_contents( $theme_dir . '/footer.php' );
$styles    = file_get_contents( $theme_dir . '/style.css' );

assert( ! str_contains( $footer, 'setInterval(() =>' ) );
assert( str_contains( $footer, 'clearTimeout(hoverTextTimer)' ) );
assert( str_contains( $styles, '@media (prefers-reduced-motion: reduce)' ) );
assert( str_contains( $styles, '.normal-page .table-wrapper::before' ) );
assert( str_contains( $styles, 'animation: none' ) );

echo "decorative work contract: OK\n";
