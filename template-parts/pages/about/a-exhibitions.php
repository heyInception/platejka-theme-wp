<section class="exhibitions">
  <div class="container">
    <div class="exhibitions__row">
      <div class="exhibitions__column">
        <div class="exhibitions__title">
          <h2><?php the_sub_field('zagolovok'); ?></h2>
        </div>
        <div class="exhibitions__content">
          <?php the_sub_field('opisanie'); ?>
        </div>
        <div class="exhibitions__item">
          <span><?php the_sub_field('tekst'); ?></span>
        </div>
      </div>
      <?php $izobrazheniya_images = get_sub_field('izobrazheniya'); ?>
      <?php if ($izobrazheniya_images) : ?>
        <div class="exhibitions__slider" data-title="<?php the_sub_field('zagolovok'); ?>">
          <div class="swiper exhibitions__swiper">
            <div class="swiper-wrapper">
              <?php foreach ($izobrazheniya_images as $izobrazheniya_image): ?>
                <div class="swiper-slide">
                  <a href="<?php echo esc_url($izobrazheniya_image['url']); ?>">
                    <img src="<?php echo esc_url($izobrazheniya_image['sizes']['large']); ?>" alt="<?php echo esc_attr($izobrazheniya_image['alt']); ?>" />
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-scrollbar"></div>
          </div>
        <?php endif; ?>
        <?php $yozh = get_sub_field('yozh'); ?>
        <?php if ($yozh) : ?>
          <div class="exhibitions__hedgehog">
            <img src="<?php echo esc_url($yozh['url']); ?>" alt="<?php echo esc_attr($yozh['alt']); ?>" />
          </div>
        <?php endif; ?>
        </div>
    </div>
  </div>
</section>