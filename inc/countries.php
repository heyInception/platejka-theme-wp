<?php

/**
 * Country data used by the payment calculator.
 *
 * @package platejka
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return calculator countries from WordPress or a safe built-in fallback.
 *
 * @return array<int, array{iso: string, country_ru: string}>
 */
function platejka_get_countries(): array {
	global $wpdb;

	$previous_suppression = $wpdb->suppress_errors();
	$database_rows        = $wpdb->get_results(
		'SELECT iso, country_ru FROM country ORDER BY id',
		ARRAY_A
	);
	$wpdb->suppress_errors( $previous_suppression );

	if ( is_array( $database_rows ) && array() !== $database_rows ) {
		$normalized_rows = array();

		foreach ( $database_rows as $row ) {
			$iso          = strtoupper( sanitize_key( $row['iso'] ?? '' ) );
			$country_name = sanitize_text_field( $row['country_ru'] ?? '' );

			if ( 1 !== preg_match( '/^[A-Z]{2}$/', $iso ) || '' === $country_name ) {
				continue;
			}

			$normalized_rows[ $iso ] = array(
				'iso'        => $iso,
				'country_ru' => $country_name,
			);
		}

		if ( array() !== $normalized_rows ) {
			return array_values( $normalized_rows );
		}
	}

	$fallback = array(
		'CN' => 'Китай',
		'TR' => 'Турция',
		'US' => 'Соединенные Штаты Америки',
		'AU' => 'Австралия',
		'AT' => 'Австрия',
		'AZ' => 'Азербайджан',
		'AL' => 'Албания',
		'AM' => 'Армения',
		'AR' => 'Аргентина',
		'BE' => 'Бельгия',
		'BY' => 'Беларусь',
		'BG' => 'Болгария',
		'BA' => 'Босния и Герцеговина',
		'BR' => 'Бразилия',
		'GB' => 'Великобритания',
		'HU' => 'Венгрия',
		'VN' => 'Вьетнам',
		'DE' => 'Германия',
		'GR' => 'Греция',
		'GE' => 'Грузия',
		'DK' => 'Дания',
		'EG' => 'Египет',
		'IL' => 'Израиль',
		'IN' => 'Индия',
		'ID' => 'Индонезия',
		'IE' => 'Ирландия',
		'ES' => 'Испания',
		'IT' => 'Италия',
		'KZ' => 'Казахстан',
		'CA' => 'Канада',
		'KE' => 'Кения',
		'KG' => 'Киргизия',
		'CO' => 'Колумбия',
		'CR' => 'Коста-Рика',
		'LV' => 'Латвия',
		'LT' => 'Литва',
		'LI' => 'Лихтенштейн',
		'LU' => 'Люксембург',
		'MY' => 'Малайзия',
		'MT' => 'Мальта',
		'MX' => 'Мексика',
		'MD' => 'Молдавия',
		'MC' => 'Монако',
		'NA' => 'Намибия',
		'NL' => 'Нидерланды',
		'NG' => 'Нигерия',
		'NZ' => 'Новая Зеландия',
		'NO' => 'Норвегия',
		'AE' => 'Объединенные Арабские Эмираты',
		'PE' => 'Перу',
		'PL' => 'Польша',
		'PT' => 'Португалия',
		'RO' => 'Румыния',
		'SA' => 'Саудовская Аравия',
		'MK' => 'Северная Македония',
		'RS' => 'Сербия',
		'SG' => 'Сингапур',
		'SK' => 'Словакия',
		'SI' => 'Словения',
		'TJ' => 'Таджикистан',
		'TH' => 'Таиланд',
		'TW' => 'Тайвань',
		'TZ' => 'Танзания',
		'TN' => 'Тунис',
		'TM' => 'Туркмения',
		'UZ' => 'Узбекистан',
		'PH' => 'Филиппины',
		'FI' => 'Финляндия',
		'FR' => 'Франция',
		'HR' => 'Хорватия',
		'TD' => 'Чад',
		'ME' => 'Черногория',
		'CZ' => 'Чехия',
		'CL' => 'Чили',
		'CH' => 'Швейцария',
		'SE' => 'Швеция',
		'ZA' => 'Южно-Африканская Республика',
		'KR' => 'Южная Корея',
		'JP' => 'Япония',
	);

	$countries = array();

	foreach ( $fallback as $iso => $country_name ) {
		$countries[] = array(
			'iso'        => $iso,
			'country_ru' => $country_name,
		);
	}

	return $countries;
}
