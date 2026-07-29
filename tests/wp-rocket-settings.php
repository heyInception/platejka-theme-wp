<?php
/**
 * WP Rocket configuration contract.
 */

defined( 'WP_CLI' ) || exit;

$settings = get_option( 'wp_rocket_settings', array() );

assert( is_array( $settings ) );
assert( 1 === (int) ( $settings['remove_unused_css'] ?? 0 ) );
assert( 0 === (int) ( $settings['async_css'] ?? 0 ) );
assert( 1 === (int) ( $settings['cache_mobile'] ?? 0 ) );
assert( 1 === (int) ( $settings['do_caching_mobile_files'] ?? 0 ) );
assert(
	in_array(
		'platejka-pagespeed/js/modules/third-party-loader.js',
		$settings['delay_js_exclusions'] ?? array(),
		true
	)
);
assert(
	in_array(
		'(.*)swiper-(.*)',
		$settings['remove_unused_css_safelist'] ?? array(),
		true
	)
);
assert(
	! in_array(
		'recaptcha',
		$settings['delay_js_exclusions_selected_exclusions'] ?? array(),
		true
	)
);
assert(
	! in_array(
		'yandex.ru',
		$settings['delay_js_exclusions_selected_exclusions'] ?? array(),
		true
	)
);

WP_CLI::success( 'WP Rocket settings contract: OK' );
