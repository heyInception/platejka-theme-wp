<section class="v-hero">
  <div class="container">
    <div class="v-hero__row">
      <div class="v-hero__column v-hero__column_left">
        <div class="v-hero__title">
          <div class="v-hero__top"><?php the_sub_field('verh'); ?> <div class="v-hero__top-blue"></div>
          </div>
          <div class="v-hero__bottom"><?php the_sub_field('niz'); ?></div>
          <h1>Платежка — ваш надёжный платежный агент</h1>
        </div>
        <?php if (have_rows('spisok')) : ?>
          <ul class="v-hero__list list-reset">
            <?php while (have_rows('spisok')) : the_row(); ?>
              <li><?php the_sub_field('tekst'); ?></li>
            <?php endwhile; ?>
          </ul>
        <?php else : ?>
          <?php // No rows found 
          ?>
        <?php endif; ?>
        <div class="v-hero__coin-wrap">
          <div class="v-hero__coin v-hero__coin_one"></div>
          <div class="v-hero__coin v-hero__coin_two"></div>
          <div class="v-hero__coin v-hero__coin_three"></div>
          <div class="v-hero__coin v-hero__coin_four"></div>
        </div>
      </div>
      <?php if (have_rows('vakansii')) : ?>
        <div class="v-hero__column v-hero__column_right">
          <?php while (have_rows('vakansii')) : the_row(); ?>
            <div class="v-hero__item">
              <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
              <?php if ($izobrazhenie) : ?>
                <div class="v-hero__img">
                  <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                </div>
              <?php endif; ?>
              <div class="v-hero__content"><?php the_sub_field('tekst'); ?></div>
              <?php $ssylka = get_sub_field('ssylka'); ?>
              <?php if ($ssylka) : ?>
                <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>" rel="nofollow"><button class="v-hero__button btn-reset"><?php echo esc_html($ssylka['title']); ?></button></a>
              <?php endif; ?>
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














