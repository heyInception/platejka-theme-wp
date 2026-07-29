<?php if (get_field('vklyuchit_blok_slider_two') == 1) : ?>
  <section class="slider">
    <div class="container">
      <div class="slider__row">
        <div class="slider__title">
          <h2>Отзывы клиентов</h2>
        </div>
        <div class="slider__wrapper">

          <div class="slider__nav">
            <div class="slider__button slider__button_clients-prev">
              <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                <circle cx="20" cy="19.9995" r="20" fill="#F9FAFB" />
                <path d="M27 19.9995H13M13 19.9995L20 12.9995M13 19.9995L20 26.9995" stroke="#343433" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>

            </div>
            <div class="slider__button slider__button_clients-next">
              <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                <circle cx="20" cy="19.9995" r="20" fill="#F9FAFB" />
                <path d="M13 19.9995H27M27 19.9995L20 12.9995M27 19.9995L20 26.9995" stroke="#343433" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>

            </div>
          </div>
          <div class="swiper slider__clients">
            <div class="swiper-wrapper">
              <?php if (have_rows('slajder_slider_two', 24)) : ?>
                <?php while (have_rows('slajder_slider_two', 24)) : the_row(); ?>
                  <div class="swiper-slide">
                    <div class="slider__card">
                      <div class="slider__wrp">
                        <div class="slider__col">
                          <div class="slider__name"><?php the_sub_field('imya'); ?></div>
                          <div class="slider__company"><?php the_sub_field('kompaniya'); ?></div>
                        </div>
                        <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                        <?php if ($izobrazhenie) : ?>
                          <div class="slider__img">
                            <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                          </div>
                        <?php endif; ?>
                      </div>
                      <div class="slider__text"><?php the_sub_field('tekst'); ?></div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php else : ?>
                <?php // No rows found 
                ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>