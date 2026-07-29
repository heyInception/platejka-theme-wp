<?php if (have_rows('international')) : ?>
  <?php while (have_rows('international')) : the_row(); ?>
    <section class="international">
      <div class="container">
        <div class="international__row">
          <div class="international__column international__column_left">
            <div class="international__title">
              <h2><?php the_sub_field('zagolovok'); ?></h2>
            </div>
            <div class="international__content">
              <?php the_sub_field('opisanie'); ?>
            </div>
            <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
            <?php if ($izobrazhenie) : ?>
              <div class="international__img">
                <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
              </div>
            <?php endif; ?>
          </div>
          <?php if (have_rows('spisok')) : ?>
            <div class="international__column international__column_right">
              <div class="international__items">
                <?php while (have_rows('spisok')) : the_row(); ?>
                  <div class="international__item">
                    <div class="international__head"><?php the_sub_field('zagolovok'); ?></div>
                    <div class="international__text">
                    <?php the_sub_field('tekst'); ?>
                    </div>
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
  <?php endwhile; ?>
<?php endif; ?>