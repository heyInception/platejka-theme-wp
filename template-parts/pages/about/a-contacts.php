<section class="a-contacts">
  <div class="container">
    <div class="a-contacts__column">
      <div class="a-contacts__row">
        <div class="a-contacts__title">
          <h2><?php the_sub_field('zagolovok'); ?></h2>
        </div>
        <div class="a-contacts__adress">
          <span>Адрес</span>
          <p><?php the_sub_field('adres'); ?></p>
        </div>
        <div class="a-contacts__phone">
          <span>Телефон</span>
          <a href="tel:<?php the_field('telefon', 'option'); ?>"><?php the_field('telefon', 'option'); ?></a>
        </div>
      </div>
      <map id="yamap" name="">
        <?php if (have_rows('slajder')) : ?>
          <div class="a-contacts__slider">
            <div class="swiper mySwiper2 single_realization_2_slider a-contacts__imgs">
              <div class="swiper-wrapper">
                <?php while (have_rows('slajder')) : the_row(); ?>
                  <?php $izobrazhenie_images = get_sub_field('izobrazhenie'); ?>
                  <?php if ($izobrazhenie_images) : ?>
                    <?php foreach ($izobrazhenie_images as $izobrazhenie_image): ?>
                      <div class="swiper-slide">
                        <a href="<?php echo esc_url($izobrazhenie_image['url']); ?>">
                          <img src="<?php echo esc_url($izobrazhenie_image['sizes']['large']); ?>" alt="<?php echo esc_attr($izobrazhenie_image['alt']); ?>" />
                        </a>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php endwhile; ?>
              </div>
              <div class="a-contacts__button a-contacts__button_prev"></div>
              <div class="a-contacts__button a-contacts__button_next"></div>
            </div>
            <div thumbsSlider="" class="swiper mySwiper single_realization_slider">
              <div class="swiper-wrapper">
                <?php while (have_rows('slajder')) : the_row(); ?>
                  <?php if ($izobrazhenie_images) : ?>
                    <?php foreach ($izobrazhenie_images as $izobrazhenie_image): ?>
                      <div class="swiper-slide">
                        <img src="<?php echo esc_url($izobrazhenie_image['sizes']['medium']); ?>" alt="<?php echo esc_attr($izobrazhenie_image['alt']); ?>" />
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
        <?php else : ?>
          <?php // No rows found 
          ?>
        <?php endif; ?>
      </map>
      <?php if (have_rows('otzyvy')) : ?>
        <div class="a-contacts__reviews">
          <?php while (have_rows('otzyvy')) : the_row(); ?>
            <div class="a-contacts__review">
              <div class="a-contacts__wrap">
                <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                <?php if ($izobrazhenie) : ?>
                  <div class="a-contacts__review-img">
                    <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                  </div>
                <?php endif; ?>
                <?php $ssylka = get_sub_field('ssylka'); ?>
                <?php if ($ssylka) : ?>
                  <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>" rel="noopener noreferrer" class="a-contacts__review-link"><?php echo esc_html($ssylka['title']); ?></a>
                <?php endif; ?>
              </div>
              <div class="a-contacts__review-count">
                <div class="a-contacts__star"></div>
                <span><?php the_sub_field('rejting'); ?></span>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <?php // No rows found 
        ?>
      <?php endif; ?>
    </div>
  </div>
</section>