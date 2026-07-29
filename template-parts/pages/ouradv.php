<?php if (have_rows('nashi_preimushhestva')) : ?>
  <?php while (have_rows('nashi_preimushhestva')) : the_row(); ?>
    <section class="ouradv">
      <div class="container">
        <div class="ouradv__row">
          <div class="ouradv__title">
            <h2><?php the_sub_field('zagolovok'); ?></h2>
          </div>
          <?php if (have_rows('elementy')) : ?>
            <div class="ouradv__items">
              <?php while (have_rows('elementy')) : the_row(); ?>
                <div class="ouradv__item">
                  <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                  <?php if ($izobrazhenie) : ?>
                    <div class="ouradv__img">
                      <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                    </div>
                  <?php endif; ?>
                  <div class="ouradv__content"><?php the_sub_field('zagolovok'); ?></div>
                </div>
              <?php endwhile; ?>
              <div class="ouradv__item">
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