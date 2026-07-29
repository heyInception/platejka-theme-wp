<section class="a-about">
  <div class="container">
    <div class="a-about__column">
      <div class="a-about__title">
        <h2><?php the_sub_field('zagolovok'); ?></h2>
      </div>
      <div class="a-about__row">
        <div class="a-about__info">
          <div class="a-about__head"><?php the_sub_field('zagolovok_head'); ?></div>
          <div class="a-about__subhead"><?php the_sub_field('podzagolovok'); ?></div>
          <div class="a-about__content"><?php the_sub_field('opisanie'); ?></div>
        </div>
        <div class="a-about__teams">
          <div class="a-about__team-head"><?php if (is_front_page()) : ?> Наш отдел продаж <?php else: ?> <?php the_sub_field('zagolovok_team'); ?> <?php endif;?></div>
          <div class="a-about__team-content"><?php the_sub_field('opisanie_team'); ?></div>
          <?php if (have_rows('slajder')) : ?>
            <div class="a-about__slider">
              <div class="swiper a-about__swiper">
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
              </div>
              <div thumbsSlider class="swiper a-about__thumbs" <?php if (is_front_page() && wp_is_mobile()) : ?> style="display: none;" <?php endif;?>>
                <div class="swiper-wrapper">
                  <?php while (have_rows('slajder')) : the_row(); ?>
                    <?php if ($izobrazhenie_images) : ?>
                      <?php foreach ($izobrazhenie_images as $izobrazhenie_image): ?>
                        <div class="swiper-slide">
                          <img src="<?php echo esc_url($izobrazhenie_image['sizes']['large']); ?>" alt="<?php echo esc_attr($izobrazhenie_image['alt']); ?>" />
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
        </div>
      </div>
    </div>
  </div>
</section>