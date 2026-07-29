<?php

defined( 'ABSPATH' ) || exit;

assert( function_exists( 'platejka_get_countries' ), 'Country provider must be registered by the theme.' );

$countries = platejka_get_countries();
$iso_codes = array_column( $countries, 'iso' );

assert( count( $countries ) >= 70, 'Fallback must preserve the calculator country coverage.' );
assert( count( $iso_codes ) === count( array_unique( $iso_codes ) ), 'Country ISO codes must be unique.' );
assert( in_array( 'CN', $iso_codes, true ), 'China must remain available.' );
assert( in_array( 'TR', $iso_codes, true ), 'Turkey must remain available.' );
assert( in_array( 'US', $iso_codes, true ), 'United States must remain available.' );

foreach ( $countries as $country ) {
	assert( 1 === preg_match( '/^[A-Z]{2}$/', $country['iso'] ), 'Every country must have a two-letter ISO code.' );
	assert( '' !== trim( $country['country_ru'] ), 'Every country must have a Russian display name.' );
}

echo "countries: OK\n";
