<?php if (have_rows('polnaya_shema')) : ?>
  <?php while (have_rows('polnaya_shema')) : the_row(); ?>
    <section class="schemefull">
      <div class="container">
        <div class="schemefull__column">
          <div class="schemefull__title">
            <h2><?php the_sub_field('zagolovok'); ?></h2>
          </div>
          <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
          <?php $izobrazhenie_mobilnoe = get_sub_field('izobrazhenie_mobilnoe'); ?>
          <?php if ($izobrazhenie) : ?>
            <div class="schemefull__img">
              <picture>
                <?php if ($izobrazhenie_mobilnoe) : ?>
                  <source media="(max-width: 1229px)" srcset="<?php echo esc_url($izobrazhenie_mobilnoe['url']); ?>">
                <?php endif; ?>
                <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
              </picture>
            </div>
          <?php endif; ?>
          <?php if (have_rows('elementy')) : ?>
            <div class="schemefull__items">
            <?php while (have_rows('elementy')) : the_row(); ?>
              <div class="schemefull__item">
                <div class="schemefull__count"></div>
                <div class="schemefull__content"><?php the_sub_field('tekst'); ?></div>
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
  <?php endwhile; ?>
<?php endif; ?>