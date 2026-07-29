<?php

defined( 'ABSPATH' ) || exit;

$theme_dir = get_template_directory();
$header    = file_get_contents( $theme_dir . '/header.php' );
$loader    = $theme_dir . '/js/modules/third-party-loader.js';

assert( ! str_contains( $header, '<script src="https://p.dmp.one/sync?stock_key=' ) );
assert( str_contains( $header, 'G-765QHYK81H' ) );
assert( str_contains( $header, '//cdn.callibri.ru/callibri.js' ) );
assert( str_contains( $header, 'campaign_code=af79c4ac45' ) );
assert( is_file( $loader ) );

$loader_source = file_get_contents( $loader );

assert( str_contains( $loader_source, 'window.platejkaLoadExternalScript' ) );
assert( str_contains( $loader_source, '892d597ee76ed81ab1fbfb7f2b444b43' ) );
assert( str_contains( $loader_source, 'requestIdleCallback' ) );

echo "third-party loader contract: OK\n";
