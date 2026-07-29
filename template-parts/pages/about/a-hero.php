<section class="a-hero">
  <div class="container">
    <div class="a-hero__row">
      <div class="a-hero__column a-hero__column_left">
        <div class="a-hero__title">
          <div class="a-hero__top"><?php the_sub_field('verh'); ?> <div class="a-hero__top-blue"></div>
          </div>
          <div class="a-hero__bottom"><?php the_sub_field('niz'); ?></div>
          <h1>Платежка — ваш надёжный платежный агент</h1>
        </div>
        <?php if (have_rows('spisok')) : ?>
          <ul class="a-hero__list list-reset">
            <?php while (have_rows('spisok')) : the_row(); ?>
              <li><?php the_sub_field('tekst'); ?></li>
            <?php endwhile; ?>
          </ul>
        <?php else : ?>
          <?php // No rows found 
          ?>
        <?php endif; ?>
        <div class="a-hero__coin-wrap">
          <div class="a-hero__coin a-hero__coin_one"></div>
          <div class="a-hero__coin a-hero__coin_two"></div>
          <div class="a-hero__coin a-hero__coin_three"></div>
          <div class="a-hero__coin a-hero__coin_four"></div>
        </div>
        <div class="a-hero__top-blue a-hero__top-blue_m"></div>
      </div>
      <?php if (have_rows('vakansii')) : ?>
        <div class="a-hero__column a-hero__column_right">
          <?php while (have_rows('vakansii')) : the_row(); ?>
            <div class="a-hero__item">
              <div class="a-hero__head">
                <?php the_sub_field('tekst'); ?>
              </div>
              <?php if (get_sub_field('opisanie')) : ?>
                <div class="a-hero__content"><?php the_sub_field('opisanie'); ?></div>
              <?php endif; ?>
              <?php $ssylka = get_sub_field('ssylka'); ?>
              <?php if ($ssylka) : ?>
                <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>"><button class="a-hero__button btn-reset"><?php echo esc_html($ssylka['title']); ?></button></a>
              <?php endif; ?>
              <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
              <?php if ($izobrazhenie) : ?>
                <div class="a-hero__img">
                  <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                </div>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <?php // No rows found 
        ?>
      <?php endif; ?>
    </div>
    <?php if (have_rows('indeksy')) : ?>
      <div class="a-hero__items">
        <?php while (have_rows('indeksy')) : the_row(); ?>
          <div class="a-hero__item-t">
            <div class="a-hero__item-top"  <?php if (get_sub_field('czvet')) : ?>style="color:<?php the_sub_field( 'czvet' ); ?>"<?php endif; ?>><?php the_sub_field('chislo'); ?></div>
            <div class="a-hero__item-content"><?php the_sub_field('opisanie'); ?></div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <?php // No rows found 
      ?>
    <?php endif; ?>
  </div>
</section>