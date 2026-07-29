<?php

defined( 'ABSPATH' ) || exit;

$theme_dir = get_template_directory();
$header    = file_get_contents( $theme_dir . '/header.php' );
$loader    = $theme_dir . '/js/modules/third-party-loader.js';

assert( ! str_contains( $header, '<script src="https://p.dmp.one/sync?stock_key=' ) );
assert( str_contains( $header, '3554245' ) );
assert( str_contains( $header, '7731957' ) );
assert( str_contains( $header, '97235179' ) );
assert( str_contains( $header, 'G-765QHYK81H' ) );
assert( str_contains( $header, '2d1a307b-05ec-4aec-b06e-76e872366ef5' ) );
assert( str_contains( $header, 'platejkaMarquizOptions' ) );
assert( str_contains( $header, "id: '689b95fd327d1700199c7e16'" ) );
assert( ! str_contains( $header, 'ts.src = "https://top-fwz1.mail.ru/js/code.js"' ) );
assert( ! str_contains( $header, '//st.top100.ru/top100/top100.js' ) );
assert( ! str_contains( $header, '"https://mc.yandex.ru/metrika/tag.js"' ) );
assert( ! str_contains( $header, '<script async src="https://www.googletagmanager.com/' ) );
assert( ! str_contains( $header, "widget.src = 'https://widget.yourgood.app/" ) );
assert( ! str_contains( $header, "j.src = '//script.marquiz.ru/v2.js'" ) );
assert( str_contains( $header, '//cdn.callibri.ru/callibri.js' ) );
assert( str_contains( $header, 'campaign_code=af79c4ac45' ) );
assert( is_file( $loader ) );

$loader_source = file_get_contents( $loader );

assert( str_contains( $loader_source, 'window.platejkaLoadExternalScript' ) );
assert( str_contains( $loader_source, '892d597ee76ed81ab1fbfb7f2b444b43' ) );
assert( str_contains( $loader_source, 'top-fwz1.mail.ru/js/code.js' ) );
assert( str_contains( $loader_source, 'st.top100.ru/top100/top100.js' ) );
assert( str_contains( $loader_source, 'mc.yandex.ru/metrika/tag.js' ) );
assert( str_contains( $loader_source, 'www.googletagmanager.com/gtag/js?id=G-765QHYK81H' ) );
assert( str_contains( $loader_source, 'widget.yourgood.app/script/widget.js' ) );
assert( str_contains( $loader_source, 'script.marquiz.ru/v2.js' ) );
assert( str_contains( $loader_source, 'GENERAL_FALLBACK_MS = 3000' ) );
assert( str_contains( $loader_source, "rootMargin: '1200px 0px'" ) );
assert( str_contains( $loader_source, 'matchMedia' ) );

echo "third-party loader contract: OK\n";
