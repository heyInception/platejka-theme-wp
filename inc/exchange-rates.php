<?php

/**
 * Non-blocking exchange-rate storage for the calculators.
 *
 * @package platejka
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the last stored exchange rates without making an HTTP request.
 *
 * @return array{eur_usd: float, usdt_rub: float, cny_usd: float}
 */
function platejka_get_exchange_rates(): array {
	$defaults = array(
		'eur_usd'  => 1.19309596,
		'usdt_rub' => 81.0929,
		'cny_usd'  => 0.149924,
	);
	$stored   = get_option( 'platejka_exchange_rates', array() );
	$values   = is_array( $stored ) && isset( $stored['values'] ) && is_array( $stored['values'] )
		? $stored['values']
		: array();

	foreach ( $defaults as $key => $fallback ) {
		$value = $values[ $key ] ?? null;

		if ( ! is_numeric( $value ) || (float) $value <= 0 ) {
			$values[ $key ] = $fallback;
			continue;
		}

		$values[ $key ] = (float) $value;
	}

	return array(
		'eur_usd'  => (float) $values['eur_usd'],
		'usdt_rub' => (float) $values['usdt_rub'],
		'cny_usd'  => (float) $values['cny_usd'],
	);
}

/**
 * Refresh calculator rates outside the frontend render path.
 *
 * @return void
 */
function platejka_refresh_exchange_rates(): void {
	$rates     = platejka_get_exchange_rates();
	$endpoints = array(
		'eur_usd'  => 'http://80.90.188.45/euro_to_usd.txt',
		'usdt_rub' => 'http://80.90.188.45/usdt_to_rub.txt',
		'cny_usd'  => 'http://80.90.188.45/cny_to_usd.txt',
	);

	foreach ( $endpoints as $key => $endpoint ) {
		$response = wp_remote_get(
			$endpoint,
			array(
				'timeout'     => 3,
				'redirection' => 0,
			)
		);

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			continue;
		}

		$value = trim( wp_remote_retrieve_body( $response ) );

		if ( is_numeric( $value ) && (float) $value > 0 ) {
			$rates[ $key ] = (float) $value;
		}
	}

	update_option(
		'platejka_exchange_rates',
		array(
			'values'     => $rates,
			'updated_at' => time(),
		),
		false
	);
}
add_action( 'platejka_refresh_exchange_rates', 'platejka_refresh_exchange_rates' );

/**
 * Ensure WordPress Cron refreshes calculator rates hourly.
 *
 * @return void
 */
function platejka_schedule_exchange_rate_refresh(): void {
	if ( wp_next_scheduled( 'platejka_refresh_exchange_rates' ) ) {
		return;
	}

	wp_schedule_event( time() + MINUTE_IN_SECONDS, 'hourly', 'platejka_refresh_exchange_rates' );
}
add_action( 'init', 'platejka_schedule_exchange_rate_refresh' );
