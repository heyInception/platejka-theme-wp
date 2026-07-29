<section class="v-slider">
  <div class="container">
    <div class="v-slider__column">
      <div class="v-slider__title">
        <h2><?php the_sub_field('zagolovok'); ?></h2>
        <div class="v-slider__navigation">
          <div class="v-slider__prev"></div>
          <div class="v-slider__next"></div>
        </div>
      </div>
      <?php if (have_rows('slajder')) : ?>
        <div class="swiper v-slider__start">
          <div class="swiper-wrapper">
            <?php while (have_rows('slajder')) : the_row(); ?>
              <div class="swiper-slide">
                <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                <?php if ($izobrazhenie) : ?>
                  <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      <?php else : ?>
        <?php // No rows found 
        ?>
      <?php endif; ?>
    </div>
  </div>
</section>