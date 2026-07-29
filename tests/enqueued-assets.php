<?php

defined( 'ABSPATH' ) || exit;

assert( function_exists( 'platejka_enqueue_assets' ), 'Theme asset loader must be registered.' );

platejka_enqueue_assets();

assert( wp_style_is( 'platejka-vendor', 'enqueued' ) );
assert( wp_style_is( 'platejka-main', 'enqueued' ) );
assert( wp_style_is( 'platejka-style', 'enqueued' ) );
assert( wp_script_is( 'platejka-main-js', 'enqueued' ) );
assert( wp_script_is( 'platejka-navigation', 'enqueued' ) );
assert( ! wp_script_is( 'leader-line', 'enqueued' ) );
assert( ! wp_script_is( 'platejka-search', 'enqueued' ) );

echo "asset enqueue contract: OK\n";
