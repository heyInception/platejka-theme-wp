<?php

defined( 'ABSPATH' ) || exit;

assert( function_exists( 'platejka_asset_version' ), 'Asset version helper must be registered.' );
assert( function_exists( 'platejka_render_acf_image' ), 'ACF image helper must be registered.' );
assert( function_exists( 'platejka_is_front_template' ), 'Front-template helper must be registered.' );

$theme_dir = get_template_directory();

assert( platejka_asset_version( 'css/main.css' ) === (string) filemtime( $theme_dir . '/css/main.css' ) );
assert( platejka_asset_version( 'missing.css' ) === (string) wp_get_theme()->get( 'Version' ) );
assert( '' === platejka_render_acf_image( 0, 'large' ) );
assert( is_bool( platejka_is_front_template() ) );

echo "performance helpers: OK\n";
