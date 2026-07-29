<?php if (get_field('vklyuchit_blok_slider') == 1) : ?>
  <section class="slider slider_top">
    <div class="container">
      <div class="slider__row">
        <div class="slider__title">
          <?php if (get_field('zagolovok_slider')) : ?>
            <h2><?php the_field('zagolovok_slider'); ?></h2>
          <?php else : ?>
            <?php the_field('zagolovok_slider', 24); ?>
          <?php endif; ?>

          <div class="slider__nav">
            <div class="slider__button_prev">
              <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="19.9995" r="20" fill="#F9FAFB" />
                <path d="M27 19.9995H13M13 19.9995L20 12.9995M13 19.9995L20 26.9995" stroke="#343433" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="slider__button_next">
              <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="19.9995" r="20" fill="#F9FAFB" />
                <path d="M13 19.9995H27M27 19.9995L20 12.9995M27 19.9995L20 26.9995" stroke="#343433" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
          </div>
        </div>
        <div class="slider__wrapper">
          <div class="slider__nav">
            <div class="slider__button_prev">
              <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="19.9995" r="20" fill="#F9FAFB" />
                <path d="M27 19.9995H13M13 19.9995L20 12.9995M13 19.9995L20 26.9995" stroke="#343433" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="slider__button_next">
              <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="19.9995" r="20" fill="#F9FAFB" />
                <path d="M13 19.9995H27M27 19.9995L20 12.9995M27 19.9995L20 26.9995" stroke="#343433" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>

            </div>
          </div>
          <div class="swiper slider__start">
            <div class="swiper-wrapper">
              <?php $page_id_to_check = 24;  ?>
              <?php if (have_rows('sliders')) : ?>
                <?php while (have_rows('sliders')) : the_row(); ?>
                  <?php if (get_row_layout() == '') : ?>
                    <div class="swiper-slide">
                      <div class="slider__items">
                        <?php if (have_rows('slajder_slider')) : ?>
                          <?php while (have_rows('slajder_slider')) : the_row(); ?>
                            <div class="slider__item">
                              <div class="slider__head"><?php the_sub_field('zagolovok'); ?></div>
                              <div class="slider__subhead"><?php the_sub_field('podzagolovok'); ?></div>
                              <div class="slider__wrap">
                                <button class="slider__price"><?php the_sub_field('czena'); ?></button>
                                <?php $ssylka = get_sub_field('ssylka'); ?>
                                <?php if ($ssylka) : ?>
                                  <a href="#call" class="slider__link" target="<?php echo esc_attr($ssylka['target']); ?>"><?php echo esc_html($ssylka['title']); ?></a>
                                <?php endif; ?>
                              </div>
                            </div>
                          <?php endwhile; ?>
                        <?php else : ?>
                          <?php // No rows found 
                          ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endwhile; ?>
              <?php else : ?>
                <?php while (have_rows('sliders', $page_id_to_check)) : the_row(); ?>
                  <?php if (get_row_layout() == '') : ?>
                    <div class="swiper-slide">
                      <div class="slider__items">
                        <?php if (have_rows('slajder_slider')) : ?>
                          <?php while (have_rows('slajder_slider')) : the_row(); ?>
                            <div class="slider__item">
                              <div class="slider__head"><?php the_sub_field('zagolovok'); ?></div>
                              <div class="slider__subhead"><?php the_sub_field('podzagolovok'); ?></div>
                              <div class="slider__wrap">
                                <button class="slider__price"><?php the_sub_field('czena'); ?></button>
                                <?php $ssylka = get_sub_field('ssylka'); ?>
                                <?php if ($ssylka) : ?>
                                  <a href="<?php echo esc_url($ssylka['url']); ?>" class="slider__link" target="<?php echo esc_attr($ssylka['target']); ?>"><?php echo esc_html($ssylka['title']); ?></a>
                                <?php endif; ?>
                              </div>
                            </div>
                          <?php endwhile; ?>
                        <?php else : ?>
                          <?php // No rows found 
                          ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endwhile; ?>
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