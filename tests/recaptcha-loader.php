<?php

defined( 'ABSPATH' ) || exit;

$theme_dir   = get_template_directory();
$performance = file_get_contents( $theme_dir . '/inc/performance.php' );
$loader      = file_get_contents( $theme_dir . '/js/modules/third-party-loader.js' );

assert( str_contains( $performance, "'google-recaptcha'" ) );
assert( str_contains( $performance, "'wpcf7-recaptcha'" ) );
assert( str_contains( $performance, 'data-platejka-recaptcha-src' ) );
assert( str_contains( $performance, 'script_loader_tag' ) );

assert( str_contains( $loader, "querySelectorAll('script[data-platejka-recaptcha-src]')" ) );
assert( str_contains( $loader, "querySelectorAll('.wpcf7 form')" ) );
assert( str_contains( $loader, "rootMargin: '1200px 0px'" ) );
assert( str_contains( $loader, 'requestSubmit' ) );

echo "reCAPTCHA loader contract: OK\n";
