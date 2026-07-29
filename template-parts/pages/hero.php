<section class="hero">
  <h1><?php the_title() ?></h1>
  <div class="container">
    <div class="hero__wrap <?php if (get_field('pereklyuchatel_hero') == 1) : ?>hero__wrap_img<?php endif; ?>">
      <div class="hero__row hero__row_left <?php if (get_field('pereklyuchatel_hero') == 1) : ?>hero__row_img<?php endif; ?>">
        <div class="hero__column">
          <div class="hero__badge">Для юр. лиц</div>
          <div class="hero__title">
            <?php if (!get_field('zaglovok_hero')) : ?>
              <?php the_field('zaglovok_hero', 24); ?>
            <?php else : ?>
              <?php the_field('zaglovok_hero'); ?>
            <?php endif; ?>
          </div>
          <?php if (get_field('podzaglovok_hero')) : ?><div class="hero__subtitle"><?php the_field('podzaglovok_hero'); ?></div><?php endif; ?>
          <?php the_field('tekst_hero'); ?>
          <?php $ssylka_hero = get_field('ssylka_hero'); ?>
          <?php if ($ssylka_hero) : ?>
            <div class="hero__button">
              <a href="#fancyboxID-1" class="fancybox-inline"><?php echo esc_html($ssylka_hero['title']); ?></a>
            </div>
          <?php else : ?>
            <div class="hero__button">
              <a href="#fancyboxID-1" class="fancybox-inline">Оставить заявку</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="hero__row hero__row_right <?php if (get_field('pereklyuchatel_hero') == 1) : ?>hero__row_after<?php endif; ?>">
        <div class="hero__col">
          <div class="hero__img">
            <?php if (get_field('pereklyuchatel_hero') == 1) : ?>
              <picture>
                <source media="(max-width: 1229px)" srcset="<?php the_field('izobrazhenie_m_hero'); ?>">
                <img src="<?php the_field('izobrazhenie'); ?>" alt="">
              </picture>
            <?php else : ?>
              <video width="553" height="553" autoplay muted loop preload="auto">
                <source src="https://platejka.com/wp-content/uploads/2025/01/0001.mp4" type="video/mp4">
              </video>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="ach">
  <div class="container">
    <div class="ach__items">
      <?php if (have_rows('priemushhestva_ach')) : ?>
        <?php while (have_rows('priemushhestva_ach')) : the_row(); ?>
          <div class="ach__item">
            <?php $izobrazheniya = get_sub_field('izobrazheniya'); ?>
            <?php if ($izobrazheniya) : ?>
              <div class="ach__img">
                <img src="<?php echo esc_url($izobrazheniya['url']); ?>" alt="<?php echo esc_attr($izobrazheniya['alt']); ?>" />
              </div>
            <?php endif; ?>
            <?php if (get_sub_field('tekst_bots')) : ?>
              <?php if (is_search_bot()): ?>
                <div class="ach__text"><?php the_sub_field('tekst_bots'); ?></div>
              <?php else : ?>
                <div class="ach__text"><?php the_sub_field('tekst'); ?></div>
              <?php endif; ?>
            <?php else : ?>
              <div class="ach__text"><?php the_sub_field('tekst'); ?></div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      <?php else : ?>
        <?php while (have_rows('priemushhestva_ach', 24)) : the_row(); ?>
          <div class="ach__item">
            <?php $izobrazheniya = get_sub_field('izobrazheniya'); ?>
            <?php if ($izobrazheniya) : ?>
              <div class="ach__img">
                <img src="<?php echo esc_url($izobrazheniya['url']); ?>" alt="<?php echo esc_attr($izobrazheniya['alt']); ?>" />
              </div>
            <?php endif; ?>
            <div class="ach__text"><?php the_sub_field('tekst'); ?></div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
  class WindowOpener {
    constructor(linkSelector) {
      this.links = document.querySelectorAll(linkSelector);
      this.init();
    }

    init() {
      this.links.forEach(link => {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          this.openSmallWindow(link.dataset.url);
        });
      });
    }

    openSmallWindow(url) {
      const windowWidth = 800;
      const windowHeight = 600;

      // Вычисляем позицию для центрирования
      const left = (window.screen.width - windowWidth) / 2;
      const top = (window.screen.height - windowHeight) / 2;

      const features = [
        `width=${windowWidth}`,
        `height=${windowHeight}`,
        `left=${left}`,
        `top=${top}`,
        'menubar=no',
        'toolbar=no',
        'location=no',
        'status=no',
        'scrollbars=yes',
        'resizable=no'
      ].join(',');

      window.open(url, '_blank', features);
    }
  }

  // Инициализация при загрузке страницы
  document.addEventListener('DOMContentLoaded', () => {
    new WindowOpener('.open-window');
  });
</script>