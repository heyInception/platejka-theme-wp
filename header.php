<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package platejka
 */
$modified_date = strtotime($post->post_modified_gmt);
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $modified_date) . ' GMT');
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $modified_date) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
  exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="icon" href="https://platejka.com/favicon.ico" type="image/x-icon">
  <link rel="icon" href="https://platejka.com/favicon.svg" type="image/svg+xml">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <?php wp_head(); ?>
  <!-- <script src="//code.jivo.ru/widget/oZ6zFKOOCS" async></script> -->
  <!-- Top.Mail.Ru counter -->
  <script type="text/javascript">
    var _tmr = window._tmr || (window._tmr = []);
    _tmr.push({
      id: "3554245",
      type: "pageView",
      start: (new Date()).getTime()
    });
  </script>
  <!-- /Top.Mail.Ru counter -->
  <!-- Top100 (Kraken) Counter -->
  <script>
    (function(w, c) {
      (w[c] = w[c] || []).push(function() {
        var options = {
          project: 7731957,
        };
        try {
          w.top100Counter = new top100(options);
        } catch (e) {}
      });
    })(window, "_top100q");
  </script>
  <!-- END Top100 (Kraken) Counter -->
  <!-- Marquiz script start -->
  <script>
    window.platejkaMarquizOptions = {
      host: '//quiz.marquiz.ru',
      region: 'ru',
      id: '689b95fd327d1700199c7e16',
      autoOpen: 10,
      autoOpenFreq: 'once',
      openOnExit: false,
      disableOnMobile: false
    };
  </script>
  <!-- Marquiz script end → -->
  <meta name="yandex-verification" content="fe26ea8b030ef2c2" />
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript">
    window.ym = window.ym || function() {
      (window.ym.a = window.ym.a || []).push(arguments);
    };
    window.ym.l = 1 * new Date();

    ym(97235179, "init", {
      clickmap: true,
      trackLinks: true,
      accurateTrackBounce: true,
      webvisor: true
    });
  </script>
  <!-- /Yandex.Metrika counter -->
  <!-- Google tag (gtag.js) -->
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-765QHYK81H');
  </script>
  <script>
    window.platejkaYourGoodId = '2d1a307b-05ec-4aec-b06e-76e872366ef5';
  </script>
  <script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8" defer></script>
  <script src="https://www.artfut.com/static/tagtag.min.js?campaign_code=af79c4ac45" async
    onerror='var self = this;window.ADMITAD=window.ADMITAD||{},ADMITAD.Helpers=ADMITAD.Helpers||{},ADMITAD.Helpers.generateDomains=function(){for(var e=new Date,n=Math.floor(new Date(2020,e.getMonth(),e.getDate()).setUTCHours(0,0,0,0)/1e3),t=parseInt(1e12*(Math.sin(n)+1)).toString(30),i=["de"],o=[],a=0;a<i.length;++a)o.push({domain:t+"."+i[a],name:t});return o},ADMITAD.Helpers.findTodaysDomain=function(e){function n(){var o=new XMLHttpRequest,a=i[t].domain,D="https://"+a+"/";o.open("HEAD",D,!0),o.onload=function(){setTimeout(e,0,i[t])},o.onerror=function(){++t<i.length?setTimeout(n,0):setTimeout(e,0,void 0)},o.send()}var t=0,i=ADMITAD.Helpers.generateDomains();n()},window.ADMITAD=window.ADMITAD||{},ADMITAD.Helpers.findTodaysDomain(function(e){if(window.ADMITAD.dynamic=e,window.ADMITAD.dynamic){var n=function(){return function(){return self.src?self:""}}(),t=n(),i=(/campaign_code=([^&]+)/.exec(t.src)||[])[1]||"";t.parentNode.removeChild(t);var o=document.getElementsByTagName("head")[0],a=document.createElement("script");a.src="https://www."+window.ADMITAD.dynamic.domain+"/static/"+window.ADMITAD.dynamic.name.slice(1)+window.ADMITAD.dynamic.name.slice(0,1)+".min.js?campaign_code="+i,o.appendChild(a)}});'></script>
  <script type="text/javascript">
    // name of the cookie that stores the source
    // change if you have another name
    var cookie_name = 'deduplication_cookie';
    // cookie lifetime
    var days_to_store = 90;
    // expected deduplication_cookie value for Admitad
    var deduplication_cookie_value = 'admitad';
    // name of GET parameter for deduplication
    // change if you have another name
    var channel_name = 'utm_source';
    // a function to get the source from the GET parameter
    getSourceParamFromUri = function() {
      var pattern = channel_name + '=([^&]+)';
      var re = new RegExp(pattern);
      return (re.exec(document.location.search) || [])[1] || '';
    };
    // a function to get the source from the cookie named cookie_name
    getSourceCookie = function() {
      var matches = document.cookie.match(new RegExp(
        '(?:^|; )' + cookie_name.replace(/([\.$?*|{}\(\)\[\]\\/\+^])/g, '\$1') + '=([^;]*)'
      ));
      return matches ? decodeURIComponent(matches[1]) : undefined;
    };
    // a function to set the source in the cookie named cookie_name
    setSourceCookie = function() {
      var param = getSourceParamFromUri();
      var params = (new URL(document.location)).searchParams;
      if (!params.get(channel_name) && params.get('gclid')) {
        param = 'advAutoMarkup'
      } else if (!params.get(channel_name) && params.get('fbclid')) {
        param = 'facebook'
      } else if (!param) {
        return;
      }
      var period = days_to_store * 60 * 60 * 24 * 1000; // in seconds
      var expiresDate = new Date((period) + +new Date);
      var cookieString = cookie_name + '=' + param + '; path=/; expires=' + expiresDate.toGMTString();
      document.cookie = cookieString;
      document.cookie = cookieString + '; domain=.' + location.host;
    };
    // set cookie
    setSourceCookie();
  </script>
  <?php if (is_page(array(1844))) : ?>
    <script type="text/javascript">
      ADMITAD = window.ADMITAD || {};
      ADMITAD.Invoice = ADMITAD.Invoice || {};

      // define a channel for Admitad
      if (!getSourceCookie(cookie_name)) {
        ADMITAD.Invoice.broker = 'na';
      } else if (getSourceCookie(cookie_name) != deduplication_cookie_value) {
        ADMITAD.Invoice.broker = getSourceCookie(cookie_name);
      } else {
        ADMITAD.Invoice.broker = 'adm';
      };

      ADMITAD.Invoice.category = '1';
      var orderedItem = []; // temporary array for product items

      // repeat for each item in the cart
      orderedItem.push({
        Product: {
          productID: '{{product_id}}', // internal item code (up to 100 characters, matches the ID from the product feed)
          category: '1',
          price: '{{price}}', // item price (if there is a discount, this is a discounted price)
          priceCurrency: '{{currency_code}}', // currency code per ISO-4217 alpha-3
        },
        orderQuantity: '{{quantity}}', // quantity
        additionalType: 'sale' // always sale
      });

      ADMITAD.Invoice.referencesOrder = ADMITAD.Invoice.referencesOrder || [];
      // adding more items
      ADMITAD.Invoice.referencesOrder.push({
        orderNumber: '{{order number}}', // order ID from your CMS (up to 100 characters)
        discountCode: '{{promocode}}', // promo code; this parameter is required if you provide Take&Go promo codes to publishers
        orderedItem: orderedItem
      });

      // Important! If you send data via AJAX or through the one-click order form, uncomment the last string:
      // ADMITAD.Tracking.processPositions();
    </script>
  <?php endif; ?>
  <!-- <script type="text/javascript">
    window._ab_id_ = 131695
  </script>
  <script src="https://cdn.botfaqtor.ru/one.js"></script> -->
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div id="page" class="site-container">
    <header class="header">
      <div class="search search_desk">
        <?php get_search_form(); ?>
      </div>
      <div class="honor-container">
        <div class="container">
          <div class="header__row header__row_top">
            <div class="header__column">
              <div class="header__loc"><?php the_field('adres', 'option'); ?></div>
              <div class="header__time"><?php the_field('vremya_raboty', 'option'); ?></div>
              <div class="header__cb">Внесен в реестр ЦБ</div>
            </div>
            <div class="header__column">
              <div class="header__mail">
                <a href="mailto:<?php the_field('pochta', 'option'); ?>"><?php the_field('pochta', 'option'); ?></a>
              </div>
              <ul class="list-reset social" title="Соц. сети">
                <?php if (have_rows('socz_seti_header', 'option')) : ?>
                  <?php while (have_rows('socz_seti_header', 'option')) : the_row(); ?>
                    <?php $ssylka = get_sub_field('ssylka'); ?>
                    <?php if ($ssylka) : ?>
                      <li class="social__item">
                        <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>" class="social__link <?php the_sub_field('class'); ?>" aria-label="<?php echo esc_html($ssylka['title']); ?>" rel="nofollow">
                          <?php $svg = get_sub_field('svg'); ?>
                          <?php if ($svg) : ?>
                            <img src="<?php echo esc_url($svg['url']); ?>" alt="<?php echo esc_attr($svg['alt']); ?>" />
                          <?php endif; ?>
                        </a>
                      </li>
                    <?php endif; ?>
                  <?php endwhile; ?>
                <?php else : ?>
                  <?php // No rows found 
                  ?>
                <?php endif; ?>
              </ul>
              <div class="header__phone">
                <a href="tel:<?php the_field('telefon', 'option'); ?>" class="zphone"><?php the_field('telefon', 'option'); ?></a>
              </div>
              <a href="mailto:<?php the_field('pochta', 'option'); ?>" class="mail-mobile"></a>
              <a href="#fancyboxID-1" class="btn-reset header__call-btn fancybox-inline">Связаться</a>
            </div>

          </div>
        </div>
      </div>
      <div class="container">
        <div class="header__row header__row_bottom">
          <div class="header__fixed-wrap">
            <div class="header__logo">
              <?php if (is_front_page()) : ?>
                <img src="https://platejka.com/wp-content/uploads/2024/03/logo.svg" alt="Логотип platejka.com">
              <?php else : ?>
                <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
                  <img src="https://platejka.com/wp-content/uploads/2024/03/logo.svg" alt="Логотип platejka.com">
                </a>
              <?php endif; ?>
            </div>
            <a href="mailto:<?php the_field('pochta', 'option'); ?>" target="_blank" rel="nofollow" class="mail-mobile"></a>
            <a href="https://t.me/platejka_com" class="tg-mobile"></a>
            <div class="header__nav">
              <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-1',
                  'menu_id'        => 'primary-menu',
                  'container'       => 'nav',
                )
              );
              ?>
              <div class="header__burger">
                <button class="burger" aria-label="Открыть меню" aria-expanded="false" data-burger>
                  <span class="burger__line"></span>
                </button>
              </div>
            </div>
            <div class="header__button">
              <div class="header__search">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M10.5 2C9.1446 2.00012 7.80887 2.32436 6.60427 2.94569C5.39966 3.56702 4.3611 4.46742 3.57525 5.57175C2.78939 6.67609 2.27902 7.95235 2.08672 9.29404C1.89442 10.6357 2.02576 12.004 2.46979 13.2846C2.91382 14.5652 3.65766 15.7211 4.63925 16.6557C5.62084 17.5904 6.81171 18.2768 8.11252 18.6576C9.41333 19.0384 10.7864 19.1026 12.117 18.8449C13.4477 18.5872 14.6975 18.015 15.762 17.176L19.414 20.828C19.6026 21.0102 19.8552 21.111 20.1174 21.1087C20.3796 21.1064 20.6304 21.0012 20.8158 20.8158C21.0012 20.6304 21.1064 20.3796 21.1087 20.1174C21.111 19.8552 21.0102 19.6026 20.828 19.414L17.176 15.762C18.164 14.5086 18.7792 13.0024 18.9511 11.4157C19.123 9.82905 18.8448 8.22602 18.1482 6.79009C17.4517 5.35417 16.3649 4.14336 15.0123 3.29623C13.6597 2.44911 12.096 1.99989 10.5 2ZM4.00001 10.5C4.00001 8.77609 4.68483 7.12279 5.90382 5.90381C7.1228 4.68482 8.7761 4 10.5 4C12.2239 4 13.8772 4.68482 15.0962 5.90381C16.3152 7.12279 17 8.77609 17 10.5C17 12.2239 16.3152 13.8772 15.0962 15.0962C13.8772 16.3152 12.2239 17 10.5 17C8.7761 17 7.1228 16.3152 5.90382 15.0962C4.68483 13.8772 4.00001 12.2239 4.00001 10.5Z"
                    fill="#222222" fill-opacity="0.5" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="fixed-menu" data-menu>
      <div class="fixed-menu__row">
        <div class="fixed-menu__logo">
          <?php if (is_front_page()) : ?>
            <img src="https://platejka.com/wp-content/uploads/2024/03/logo.svg" alt="Логотип platejka.com">
          <?php else : ?>
            <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
              <img src="https://platejka.com/wp-content/uploads/2024/03/logo.svg" alt="Логотип platejka.com">
            </a>
          <?php endif; ?>
        </div>
        <div class="fixed-menu__close">
          <button class="close-menu burger burger__active" data-close>
            <span class="burger__line"></span>
          </button>
        </div>
      </div>
      <div class="fixed-menu__search">
        <form role="search" method="get" id="searchform" action="https://platejka.com/">
          <input type="text" value="" name="s" class="input-search search-input" id="s" placeholder="Поиск по сайту">
          <button type="submit">
          </button>
        </form>
      </div>

      <div class="fixed-menu__column">
        <div class="fixed-menu__head">Контакты</div>
        <div class="fixed-menu__contacts">
          <p><?php the_field('adres', 'option'); ?></p>
          <a href="tel:<?php the_field('telefon', 'option'); ?>" class="zphone"><?php the_field('telefon', 'option'); ?></a>
          <a href="mailto:<?php the_field('pochta', 'option'); ?>"><?php the_field('pochta', 'option'); ?></a>
        </div>
      </div>
      <div class="fixed-menu__button">
        <a href="#call">Заказать звонок</a>
      </div>
      <!-- <div class="fixed-menu__column">
        <div class="fixed-menu__head">Социальные сети</div>
        <div class="fixed-menu__social">
          <ul class="list-reset social" title="Соц. сети">
            <?php if (have_rows('socz_seti_header', 'option')) : ?>
              <?php while (have_rows('socz_seti_header', 'option')) : the_row(); ?>
                <?php $ssylka = get_sub_field('ssylka'); ?>
                <?php if ($ssylka) : ?>
                  <li class="social__item">
                    <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>" class="social__link <?php the_sub_field('class'); ?>" aria-label="<?php echo esc_html($ssylka['title']); ?>" rel="nofollow">
                      <?php $svg = get_sub_field('svg'); ?>
                      <?php if ($svg) : ?>
                        <img src="<?php echo esc_url($svg['url']); ?>" alt="<?php echo esc_attr($svg['alt']); ?>" />
                      <?php endif; ?>
                    </a>
                  </li>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php else : ?>
              <?php // No rows found 
              ?>
            <?php endif; ?>
          </ul>
        </div>
      </div> -->
      <nav class="mob-menu is-visible">
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'menu-2',
            'menu_id'        => 'primary-menu-2',
            'container_class' => 'menu-container',
            'menu_class'      => 'menu is-visible',
            'container'       => 'div',
          )
        );
        ?>

      </nav>
      <div class="header__review">
        <img src="https://platejka.com/wp-content/uploads/2026/02/ya-1.svg" alt="52 отзыва">
        <a href="https://yandex.ru/profile/217714971749?lang=ru" target="_blank" rel="noopener noreferrer" class="header__count">106 отзывов</a>
        <div class="header__star">
          <div class="a-contacts__star"></div>
          <span>5.0</span>
        </div>
      </div>

    </div>
