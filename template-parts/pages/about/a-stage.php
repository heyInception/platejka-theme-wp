<section class="a-stage">
  <div class="container">
    <div class="a-stage__column">
      <div class="a-stage__row">
        <div class="a-stage__title">
          <h2><?php the_sub_field('zagolovok'); ?></h2>
        </div>
        <div class="a-stage__navigation">
          <div class="a-stage__button a-stage__button_prev"></div>
          <div class="a-stage__button a-stage__button_next"></div>
        </div>
      </div>
      <?php if (have_rows('etapy')) : ?>
        <div class="a-stage__slider">
          <div class="swiper a-stage__swiper">
            <div class="swiper-wrapper">
              <?php while (have_rows('etapy')) : the_row(); ?>
                <div class="swiper-slide">
                  <div class="a-stage__year">
                    <p><?php the_sub_field('god'); ?></p>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
          <div thumbsSlider="" class="swiper a-stage__thumbs">
            <div class="swiper-wrapper">
              <?php while (have_rows('etapy')) : the_row(); ?>
                <div class="swiper-slide">
                  <div class="a-stage__item">
                    <div class="a-stage__head"><?php the_sub_field('zagolovok'); ?></div>
                    <div class="a-stage__content">
                      <?php the_sub_field('tekst'); ?>
                    </div>
                    <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                    <?php if ($izobrazhenie) : ?>
                      <div class="a-stage__img">
                        <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
            <div class="swiper-scrollbar"></div>
          </div>
        </div>
      <?php else : ?>
        <?php // No rows found 
        ?>
      <?php endif; ?>
    </div>
  </div>
</section>