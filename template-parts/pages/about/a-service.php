<section class="a-service">
  <div class="container">
    <div class="a-service__column">
      <div class="a-service__title">
        <h2><?php the_sub_field('zagolovok'); ?></h2>
      </div>
      <div class="a-service__row">
        <div class="a-service__col a-service__col_globe">
          <?php if (have_rows('levaya_chast_stran')) : ?>
            <div class="a-service__country a-service__country_left">
              <?php while (have_rows('levaya_chast_stran')) : the_row(); ?>
                <div class="a-service__country-name a-service__country-name_<?php the_sub_field('flag'); ?>" <?php if (get_sub_field('lejbl')) : ?>data-label="<?php the_sub_field('lejbl'); ?>" <?php endif; ?> <?php if (get_sub_field('info')) : ?>data-info="<?php the_sub_field('info'); ?>" <?php endif; ?>> <?php the_sub_field('nazvanie_strany'); ?></div>
              <?php endwhile; ?>
            </div>
          <?php else : ?>
            <?php // No rows found 
            ?>
          <?php endif; ?>
          <div class="a-service__globe">
            <img src="<?php echo get_template_directory_uri(); ?>/img/globe.png" alt="">
            <img class="a-service__globe_mob" src="<?php echo get_template_directory_uri(); ?>/img/globe-m.svg" alt="">
            <div class="a-service__globe-point a-service__globe-usa"></div>
            <div class="a-service__globe-point a-service__globe-ger"></div>
            <div class="a-service__globe-point a-service__globe-ch"></div>
            <div class="a-service__globe-point a-service__globe-tur"></div>
            <div class="a-service__globe-point a-service__globe-kz"></div>
            <div class="a-service__globe-point a-service__globe-est"></div>
            <div class="a-service__globe-point a-service__globe-ru"></div>
            <div class="a-service__globe-point a-service__globe-gk"></div>
            <div class="a-service__globe-point a-service__globe-vet"></div>
            <div class="a-service__globe-point a-service__globe-kir"></div>
            <div class="a-service__globe-point a-service__globe-sing"></div>
          </div>
          <?php if (have_rows('pravaya_chast')) : ?>
            <div class="a-service__country a-service__country_right">
              <?php while (have_rows('pravaya_chast')) : the_row(); ?>
                <div class="a-service__country-name a-service__country-name_<?php the_sub_field('flag'); ?>" <?php if (get_sub_field('lejbl')) : ?>data-label="<?php the_sub_field('lejbl'); ?>" <?php endif; ?> <?php if (get_sub_field('info')) : ?>data-info="<?php the_sub_field('info'); ?>" <?php endif; ?>><?php the_sub_field('nazvanie_strany'); ?></div>
              <?php endwhile; ?>
            </div>
          <?php else : ?>
            <?php // No rows found 
            ?>
          <?php endif; ?>
        </div>
        <div class="a-service__country a-service__country_left a-service__country_mob">
          <div class="a-service__country-name a-service__country-name_ru">Россия</div>
          <div class="a-service__country-name a-service__country-name_tur">Турция</div>
          <div class="a-service__country-name a-service__country-name_est">Эстония</div>
          <div class="a-service__country-name a-service__country-name_usa">США</div>
          <div class="a-service__country-name a-service__country-name_gk" data-info="*">Китай</div>
          <div class="a-service__country-name a-service__country-name_kz">Казахстан</div>
          <div class="a-service__country-name a-service__country-name_ger" data-label="3 юр лица">Германия</div>
          <div class="a-service__country-name a-service__country-name_kir">Киргизия</div>
          <div class="a-service__country-name a-service__country-name_vet">Тайланд</div>
          <div class="a-service__country-name a-service__country-name_sing" data-label="2 юр лица">ОАЭ</div>
        </div>
      </div>

      <div class="a-service__col a-service__col_info">
        <div class="a-service__alert"><?php the_sub_field('preduprezhdenie'); ?></div>
        <?php if (have_rows('informacziya')) : ?>
          <div class="a-service__items">
            <?php while (have_rows('informacziya')) : the_row(); ?>
              <div class="a-service__item">
                <div class="a-service__number" <?php if (get_sub_field('czvet')) : ?>style="color:<?php the_sub_field('czvet'); ?>" <?php endif; ?>><?php the_sub_field('kolichistvo'); ?></div>
                <div class="a-service__content"><?php the_sub_field('tekst'); ?></div>
              </div>
            <?php endwhile; ?>
          </div>
        <?php else : ?>
          <?php // No rows found 
          ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>