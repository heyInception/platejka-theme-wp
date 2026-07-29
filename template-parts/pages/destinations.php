<?php if (get_field('vklyuchit_blok_destinations') == 1) : ?>
  <section class="destinations">
    <div class="container">
      <div class="destinations__column">
        <div class="destinations__title">
          <h2><?php the_field('zagolovok_destinations', 24); ?></h2>
        </div>
        <div class="destinations__subtitle"><?php the_field('podzagolovok_destinations', 24); ?>
        </div>
        <?php if (have_rows('napravleniya_destinations', 24)) : ?>
          <div class="destinations__items">
            <?php while (have_rows('napravleniya_destinations', 24)) : the_row(); ?>
              <?php $ssylka = get_sub_field('ssylka'); ?>
              <?php if ($ssylka) : ?>
                <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>" class="destinations__item" rel="nofollow">
                  <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                  <?php if ($izobrazhenie) : ?>
                    <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                  <?php endif; ?>
                  <span><?php the_sub_field('nazvanie'); ?></span>
                </a>
              <?php else: ?>
                <div class="destinations__item">
                  <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                  <?php if ($izobrazhenie) : ?>
                    <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                  <?php endif; ?>
                  <span><?php the_sub_field('nazvanie'); ?></span>
                </div>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        <?php else : ?>
          <?php // No rows found 
          ?>
        <?php endif; ?>
        <button class="destinations__btn btn-reset">Показать все</button>
      </div>
    </div>
  </section>
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>