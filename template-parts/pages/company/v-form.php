<div id="call" class="v-wrap-form">
  <section class="v-form">
    <div class="container">
      <div class="v-form__row">
        <div class="v-form__column">
          <div class="v-form__title">
            <h2><?php the_sub_field('zagolovok'); ?></h2>
          </div>
          <div class="v-form__subtitle"><?php the_sub_field('podzagolovok'); ?></div>
          <div class="v-form__form">
            <?php echo do_shortcode('[contact-form-7 id="a43b674" title="О компании"]') ?>
          </div>
        </div>
        <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
        <?php $mobilnoe_izobrazhenie = get_sub_field('mobilnoe_izobrazhenie'); ?>
        <div class="v-form__column v-form__column_img">
          <?php if (!wp_is_mobile()) { ?>
            <?php if ($izobrazhenie) : ?>
              <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
            <?php endif; ?>
          <?php } else { ?>
            <?php if ($mobilnoe_izobrazhenie) : ?>
              <img src="<?php echo esc_url($mobilnoe_izobrazhenie['url']); ?>" alt="<?php echo esc_attr($mobilnoe_izobrazhenie['alt']); ?>" />
            <?php endif; ?>
          <?php } ?>
        </div>

      </div>
    </div>
  </section>
  <?php if (have_rows('socz_seti')) : ?>
    <div class="v-social">
      <div class="container">
        <div class="v-social__row">
          <?php while (have_rows('socz_seti')) : the_row(); ?>
            <div class="v-social__item v-social__item_<?php the_sub_field( 'class' ); ?>">
              <div class="v-social__title"><?php the_sub_field('nazvanie'); ?></div>
              <?php if (have_rows('ssylki')) : ?>
                <ul class="list-reset social" title="">
                  <?php while (have_rows('ssylki')) : the_row(); ?>
                    <?php $ssylka = get_sub_field('ssylka'); ?>
                    <?php if ($ssylka) : ?>
                      <li class="social__item">
                          <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>" rel="nofollow"  class="social__link social__link--<?php the_sub_field('tag'); ?>" aria-label="<?php echo esc_html($ssylka['title']); ?>"></a>
                        </li>
                    <?php endif; ?>
                  <?php endwhile; ?>
                </ul>
              <?php else : ?>
                <?php // No rows found 
                ?>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  <?php else : ?>
    <?php // No rows found 
    ?>
  <?php endif; ?>
</div>















