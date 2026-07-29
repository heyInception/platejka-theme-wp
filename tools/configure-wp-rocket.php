<?php
/**
 * Apply the approved WP Rocket settings without replacing unrelated values.
 */

defined( 'WP_CLI' ) || exit;

$settings = get_option( 'wp_rocket_settings', array() );

if ( ! is_array( $settings ) ) {
	throw new RuntimeException( 'The wp_rocket_settings option is not an array.' );
}

if ( '3.16.2.1' !== (string) ( $settings['version'] ?? '' ) ) {
	throw new RuntimeException( 'Unsupported WP Rocket version.' );
}

$settings['minify_css']               = 1;
$settings['minify_js']                = 1;
$settings['defer_all_js']             = 1;
$settings['delay_js']                 = 1;
$settings['remove_unused_css']        = 1;
$settings['async_css']                = 0;
$settings['cache_mobile']             = 1;
$settings['do_caching_mobile_files']  = 1;
$settings['delay_js_exclusions']      = array(
	'platejka-pagespeed/js/modules/third-party-loader.js',
	'cdn.callibri.ru/callibri.js',
	'artfut.com/static/tagtag.min.js',
	'platejkaMarquizOptions',
	'_tmr',
	'_top100q',
	'ym\(',
	'dataLayer',
	'platejkaYourGoodId',
);

$legacy_exclusions = $settings['delay_js_exclusions_selected_exclusions'] ?? array();

if ( ! is_array( $legacy_exclusions ) ) {
	$legacy_exclusions = array();
}

$settings['delay_js_exclusions_selected_exclusions'] = array_values(
	array_filter(
		$legacy_exclusions,
		static function ( $value ) {
			$value = (string) $value;

			return (
				false === stripos( $value, 'recaptcha' )
				&& false === stripos( $value, 'yandex.ru' )
				&& false === stripos( $value, 'window.yaContextCb' )
			);
		}
	)
);

$safelist = array(
	'*swiper-*',
	'*wpcf7-*',
	'*fancybox*',
	'*chaty*',
	'*cht-*',
	'search_open',
	'header__wrap_active',
	'burger__active',
	'calculate__button_active',
	'calculate__column_active',
	'slider-progress',
	'calc__button_active',
	'tabs__nav-btn--active',
	'tabs__panel--active',
	'request__title_show',
	'request__btn_show',
	'faq__item_active',
	'faq__text_active',
	'footer__bottom_show',
	'footer__social_show',
	'is-visible',
);

if ( ! function_exists( 'rocket_sanitize_textarea_field' ) ) {
	throw new RuntimeException( 'WP Rocket safelist sanitizer is unavailable.' );
}

$settings['remove_unused_css_safelist'] = rocket_sanitize_textarea_field(
	'remove_unused_css_safelist',
	$safelist
);

$updated = update_option( 'wp_rocket_settings', $settings );

if ( ! $updated && $settings !== get_option( 'wp_rocket_settings', array() ) ) {
	throw new RuntimeException( 'WP Rocket settings could not be saved.' );
}

if ( function_exists( 'rocket_clean_domain' ) ) {
	rocket_clean_domain();
}

WP_CLI::log(
	wp_json_encode(
		array(
			'minify_css'              => $settings['minify_css'],
			'minify_js'               => $settings['minify_js'],
			'defer_all_js'            => $settings['defer_all_js'],
			'delay_js'                => $settings['delay_js'],
			'delay_js_exclusions'     => $settings['delay_js_exclusions'],
			'remove_unused_css'       => $settings['remove_unused_css'],
			'async_css'               => $settings['async_css'],
			'remove_unused_css_safelist' => $settings['remove_unused_css_safelist'],
			'cache_mobile'            => $settings['cache_mobile'],
			'do_caching_mobile_files' => $settings['do_caching_mobile_files'],
		),
		JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
	)
);
