<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package platejka
 */

?>
<footer class="footer">
  <div class="container">
    <div class="footer__row">
      <div class="footer__column">
        <div class="footer__logo">
          <?php if (is_front_page()) : ?>
            <img src="https://platejka.com/wp-content/uploads/2024/03/logo.svg" alt="Логотип platejka.com">
          <?php else : ?>
            <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
              <img src="https://platejka.com/wp-content/uploads/2024/03/logo.svg" alt="Логотип platejka.com">
            </a>
          <?php endif; ?>
          <div class="header__cb">Внесен в реестр ЦБ </div>
          <div id="consentBox">
            <div id="consentContent">
              <p>
                Мы используем cookies для оптимизации работы сайта и повышения его эффективности. <br>Подробности в нашей <a href="https://platejka.com/privacy-policy">политике конфиденциальности</a>.
              </p>
              <div class="buttons">
                <button class="consentButton btn-reset">
                  Хорошо
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="footer__bottom footer__bottom_hide">
          <p><a href="/cookie-policy">Политика использования cookie-файлов</a></p>
          <p><a href="/privacy-policy">Политика конфиденциальности</a></p>
          <p><a href="/terms">Пользовательское соглашение</a></p>
          <p><a href="/site-map">Карта сайта</a></p>
          <p>2009—<?php echo wp_date('Y'); ?>, сервис «Платежка»</p>
          <p>Вся информация на сайте носит информационный характер и не является публичной офертой, определяемой положениями статьи 437 ГК РФ.</p>
        </div>
      </div>
      <div class="footer__column">
        <div style="display:none" itemprop="name">Cервис «Платежка»</div>
        <div class="footer__head">Контакты</div>
        <<div class="footer__contacts">
          <a href="tel:<?php the_field('telefon', 'option'); ?>" class="zphone"><span><?php the_field('telefon', 'option'); ?></span></a>
          <a href="mailto:<?php the_field('pochta', 'option'); ?>"><span><?php the_field('pochta', 'option'); ?></span></a>
          <p>Фактический адрес: <?php the_field('adres', 'option'); ?></p>
      </div>
      <div class="footer__social footer__social_show">
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
      <div class="footer__wrap">
        <?php if (have_rows('menyu_3', 'option')) : ?>
          <?php while (have_rows('menyu_3', 'option')) : the_row(); ?>
            <div class="footer__head"><?php the_sub_field('zagolovok'); ?></div>
            <ul class="footer__links">
              <?php if (have_rows('ssylki')) : ?>
                <?php while (have_rows('ssylki')) : the_row(); ?>
                  <?php $ssylka_footer = get_sub_field('ssylka_footer'); ?>
                  <?php if ($ssylka_footer) : ?>
                    <?php
                    $title = $ssylka_footer['title'];
                    // Применяем замену к заголовку ссылки
                    if (is_page(2054)) {
                      $title = replace_translation_words($title);
                    }
                    ?>
                    <li><a href="<?php echo esc_url($ssylka_footer['url']); ?>"><?php echo $title; ?></a></li>
                  <?php endif; ?>
                <?php endwhile; ?>
              <?php else : ?>
                <?php // No rows found 
                ?>
              <?php endif; ?>
            </ul>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <div class="footer__bottom footer__bottom_hide">
        <p><?php the_field('servis', 'option'); ?></p>
      </div>
    </div>
    <div class="footer__column">
      <?php if (have_rows('menyu_1', 'option')) : ?>
        <?php while (have_rows('menyu_1', 'option')) : the_row(); ?>
          <div class="footer__head"><?php the_sub_field('zagolovok'); ?></div>
          <ul class="footer__links">
            <?php if (have_rows('ssylki')) : ?>
              <?php while (have_rows('ssylki')) : the_row(); ?>
                <?php $ssylka_footer = get_sub_field('ssylka_footer'); ?>
                <?php if ($ssylka_footer) : ?>
                  <?php
                  $title = $ssylka_footer['title'];
                  // Применяем замену к заголовку ссылки
                  if (is_page(2054)) {
                    $title = replace_translation_words($title);
                  }
                  ?>
                  <li><a href="<?php echo esc_url($ssylka_footer['url']); ?>"><?php echo $title; ?></a></li>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php else : ?>
              <?php // No rows found 
              ?>
            <?php endif; ?>
          </ul>
        <?php endwhile; ?>
      <?php endif; ?>
      <div class="footer__bottom footer__bottom_gap footer__bottom_hide">
        <?php if (have_rows('dannye', 'option')) : ?>
          <?php while (have_rows('dannye', 'option')) : the_row(); ?>
            <div class="footer__head">Реквизиты и ИНН</div>
            <span><?php the_sub_field('inn'); ?></span>
            <span><?php the_sub_field('kpp'); ?></span>
            <span><?php the_sub_field('grn'); ?></span>
            <span><?php the_sub_field('raschyotnyj_schyot'); ?></span>
            <span><?php the_sub_field('ooo'); ?></span>
            <span><?php the_sub_field('korrespondentskij_schyot'); ?></span>
            <span><?php the_sub_field('bik'); ?></span>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="footer__column">
      <?php if (have_rows('menyu_2', 'option')) : ?>
        <?php while (have_rows('menyu_2', 'option')) : the_row(); ?>
          <div class="footer__head"><?php the_sub_field('zagolovok'); ?></div>
          <ul class="footer__links">
            <?php if (have_rows('ssylki')) : ?>
              <?php while (have_rows('ssylki')) : the_row(); ?>
                <?php $ssylka_footer = get_sub_field('ssylka_footer'); ?>
                <?php if ($ssylka_footer) : ?>
                  <?php
                  $title = $ssylka_footer['title'];
                  // Применяем замену к заголовку ссылки
                  if (is_page(2054)) {
                    $title = replace_translation_words($title);
                  }
                  ?>
                  <li><a href="<?php echo esc_url($ssylka_footer['url']); ?>"><?php echo $title; ?></a></li>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php else : ?>
              <?php // No rows found 
              ?>
            <?php endif; ?>
          </ul>
        <?php endwhile; ?>
      <?php endif; ?>
      <div class="footer__social footer__social_hide">
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
          <li>
            <a href="https://www.liveinternet.ru/click" target="_blank" rel="nofollow"><img id="licntE672" width="88" height="31" style="border:0" title="LiveInternet: показано число просмотров и посетителей за 24 часа" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7" alt="" /></a>
          </li>
          <script>
            (function(d, s) {
              d.getElementById("licntE672").src =
                "https://counter.yadro.ru/hit?t52.13;r" + escape(d.referrer) +
                ((typeof(s) == "undefined") ? "" : ";s" + s.width + "*" + s.height + "*" +
                  (s.colorDepth ? s.colorDepth : s.pixelDepth)) + ";u" + escape(d.URL) +
                ";h" + escape(d.title.substring(0, 150)) + ";" + Math.random()
            })
            (document, screen)
          </script><!--/LiveInternet-->

        </ul>
      </div>
      <div class="footer__top">
        Наверх
      </div>
      <div class="footer__bottom footer__bottom_show">
        <p><?php the_field('servis', 'option'); ?></p>
      </div>
      <div class="footer__bottom footer__bottom_gap footer__bottom_show">
        <?php if (have_rows('dannye', 'option')) : ?>
          <?php while (have_rows('dannye', 'option')) : the_row(); ?>
            <div class="footer__head">Реквизиты и ИНН</div>
            <span><?php the_sub_field('inn'); ?></span>
            <span><?php the_sub_field('kpp'); ?></span>
            <span><?php the_sub_field('grn'); ?></span>
            <span><?php the_sub_field('raschyotnyj_schyot'); ?></span>
            <span><?php the_sub_field('ooo'); ?></span>
            <span><?php the_sub_field('korrespondentskij_schyot'); ?></span>
            <span><?php the_sub_field('bik'); ?></span>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <div class="footer__bottom footer__bottom_show">
        <p><a href="/cookie-policy">Политика использования cookie-файлов</a></p>
        <p><a href="/privacy-policy">Политика конфиденциальности</a></p>
        <p><a href="/terms">Пользовательское соглашение</a></p>
        <p><a href="/site-map">Карта сайта</a></p>
        <p>2009—<?php echo wp_date('Y'); ?>, сервис «Платежка»</p>
      </div>
    </div>
  </div>
  </div>

</footer>
</div><!-- #page -->

<script>
  const consentBox =
    document.getElementById("consentBox");
  const acceptBtn =
    document.querySelector(".consentButton");

  let checkCookie = document.cookie.indexOf("CookieBy=GeeksForGeeks");
  checkCookie !== -1 ? consentBox.classList.remove("open") : consentBox.classList.add("open");

  console.log(checkCookie);

  acceptBtn.onclick = () => {
    document.cookie = "CookieBy=GeeksForGeeks; max-age=" +
      60 * 60 * 24;
    if (document.cookie) {
      consentBox.classList.remove("open");
    } else {
      alert
        ("Cookie can't be set! Please" +
          " unblock this site from the cookie" +
          " setting of your browser.");
    }
  };
</script>
<?php wp_footer(); ?>

<?php
$schema_url = untrailingslashit(home_url());
$organization_id = $schema_url . '/#organization';
$localbusiness_id = $schema_url . '/#localbusiness';

$schema = array(
  '@context' => 'https://schema.org',
  '@graph' => array(
    array(
      '@type' => 'Organization',
      '@id' => $organization_id,
      'name' => 'Сервис «Платежка»',
      'url' => $schema_url . '/',
      'logo' => 'https://platejka.com/wp-content/uploads/2024/03/logo.svg',
      'sameAs' => ['https://telegram.me/platejka_com'],
      'image' => 'https://platejka.com/wp-content/uploads/2024/03/logo.svg',
      'telephone' => '+7 985 786 98 09',
      'email' => get_field('pochta', 'option'),
      'address' => array(
        '@type' => 'PostalAddress',
        'streetAddress' => 'ул. Нобеля, дом 7, этаж 4, помещение 10',
        'addressLocality' => 'Москва',
        'postalCode' => '121205',
        'addressCountry' => 'RU',
      ),
    ),
    array(
      '@type' => 'FinancialService',
      '@id' => $localbusiness_id,
      'name' => 'Сервис «Платежка»',
      'url' => $schema_url . '/',
      'image' => 'https://platejka.com/wp-content/uploads/2024/03/logo.svg',
      'telephone' => '+7 985 786 98 09',
      'priceRange' => 'от 1%',
      'parentOrganization' => array(
        '@id' => $organization_id,
      ),
      'address' => array(
        '@type' => 'PostalAddress',
        'streetAddress' => 'ул. Нобеля, дом 7, этаж 4, помещение 10',
        'addressLocality' => 'Москва',
        'postalCode' => '121205',
        'addressCountry' => 'RU',
      ),
      'geo' => array(
        '@type' => 'GeoCoordinates',
        'latitude' => 55.673309,
        'longitude' => 37.632546,
      ),
      'openingHoursSpecification' => array(
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => array(
          'Monday',
          'Tuesday',
          'Wednesday',
          'Thursday',
          'Friday',
          'Saturday',
          'Sunday',
        ),
        'opens' => '09:00',
        'closes' => '18:00',
      ),
    ),
  ),
);

if (is_front_page()) {
  $schema['@graph'][] = array(
    '@type' => 'WebPage',
    '@id' => $schema_url . '/',
    'url' => $schema_url . '/',
    'name' => 'Международные платежи | Агент по международным платежам для бизнеса | Сервис «Платежка»',
    'isPartOf' => array(
      '@id' => $schema_url . '/#website',
    ),
    'about' => array(
      '@id' => $organization_id,
    ),
    'primaryImageOfPage' => array(
      '@id' => $schema_url . '/#primaryimage',
    ),
    'image' => array(
      '@id' => $schema_url . '/#primaryimage',
    ),
    'thumbnailUrl' => 'https://platejka.com/wp-content/uploads/2024/04/platejka.jpg',
    'datePublished' => get_post_time('c', true, (int) get_option('page_on_front')),
    'dateModified' => get_post_modified_time('c', true, (int) get_option('page_on_front')),
    'description' => 'Международные платежи для юридических лиц с сервисом Платежка ⭐ Быстрое и надежное проведение финансовых операций для вашего бизнеса ⭐ Строгое соблюдение требований законодательства ☎ 8(800)533-88-19',
    'inLanguage' => 'ru-RU',
    'potentialAction' => array(
      array(
        '@type' => 'ReadAction',
        'target' => array($schema_url . '/'),
      ),
    ),
  );

  $schema['@graph'][] = array(
    '@type' => 'ImageObject',
    '@id' => $schema_url . '/#primaryimage',
    'inLanguage' => 'ru-RU',
    'url' => 'https://platejka.com/wp-content/uploads/2024/04/platejka.jpg',
    'contentUrl' => 'https://platejka.com/wp-content/uploads/2024/04/platejka.jpg',
    'width' => 673,
    'height' => 546,
    'caption' => 'platejka',
  );

  $schema['@graph'][] = array(
    '@type' => 'WebSite',
    '@id' => $schema_url . '/#website',
    'url' => $schema_url . '/',
    'name' => 'platejka.com',
    'description' => 'Международные платежи для юридических лиц, оплата поставщикам, переводы в Китай, Турцию, Европу и другие страны.',
    'publisher' => array(
      '@id' => $organization_id,
    ),
    'inLanguage' => 'ru-RU',
  );
}
?>
<?php echo '<script type="application/ld+json">' ?>
<?php echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
<?php echo '</script>' ?>


<script type="text/javascript">
  document.addEventListener('wpcf7mailsent', function(event) {
    location = '//platejka.com/thanks';
  }, false);
  jQuery('.menu-item.noopenner>a').on('click', function(e) {
    e.preventDefault();
  });
</script>
<script>
  setTimeout(() => {
    jQuery(".salebot_circle_trigger").append('<span class="on-hover-text">Связаться с нами!</span>');
    jQuery(".salebot_circle_trigger").on({
      mouseenter: function() {
        jQuery('.on-hover-text').fadeOut();
      },
      mouseleave: function() {
        setInterval(() => {
          jQuery('.on-hover-text').fadeIn();
        }, 7000);
      }
    });
  }, 1000);

  jQuery(document).ready(function() {
    setTimeout(() => {
      jQuery('.table-scroll').each(function(index, element) {
        let width = jQuery(this).outerWidth();

        // Добавляем атрибут scope к первому th в каждой строке tr
        jQuery(this).find('tr').each(function() {
          jQuery(this).find('td:first').attr('scope', 'row');
          jQuery(this).find('th:first').attr('scope', 'row');
        });

        console.log('Ширина элемента ' + index + ':', width);
      });
    }, 500);
  });
</script>
<div id="fancyboxID-1" class="fancybox-hidden hentry" style="width:460px;max-width:100%;">
  <div class="wehelp__form">
    <div class="wehelp__head" style="text-align: center;">Свяжитесь с нами и мы вам перезвоним</div>
    <?php echo do_shortcode('[contact-form-7 id="fb334d6" title="Помогаем продолжать работать в условиях существующих ограничений"]') ?>
  </div>
</div>
<div id="fancyboxID-2" class="fancybox-hidden hentry" style="width:460px;max-width:100%;">
  <div class="wehelp__form">
    <div class="wehelp__head" style="text-align: center;">Свяжитесь с нами и мы вам перезвоним</div>
    <?php echo do_shortcode('[contact-form-7 id="716b6b5" title="Заявка на перевод"]') ?>
  </div>
</div>


</body>

</html>