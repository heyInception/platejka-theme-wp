<?php

defined( 'ABSPATH' ) || exit;

assert( function_exists( 'platejka_get_exchange_rates' ) );
assert( function_exists( 'platejka_refresh_exchange_rates' ) );

$stored_rates = array(
	'values'     => array(
		'eur_usd'  => 1.2,
		'usdt_rub' => 82.3,
		'cny_usd'  => 0.15,
	),
	'updated_at' => time(),
);

add_filter(
	'pre_option_platejka_exchange_rates',
	static fn() => $stored_rates
);

$rates = platejka_get_exchange_rates();

assert( 1.2 === $rates['eur_usd'] );
assert( 82.3 === $rates['usdt_rub'] );
assert( 0.15 === $rates['cny_usd'] );

$calc = file_get_contents( get_template_directory() . '/template-parts/pages/calc.php' );

assert( ! str_contains( $calc, 'file_get_contents($url' ) );
assert( str_contains( $calc, 'platejka_get_exchange_rates()' ) );

echo "exchange rates contract: OK\n";
