<?php if (have_rows('features')) : ?>
  <?php while (have_rows('features')) : the_row(); ?>
    <section class="features">
      <div class="container">
        <div class="features__column">
          <div class="features__title">
            <h2><?php the_sub_field('zagolovok'); ?></h2>
          </div>
          <div class="features__row">
            <?php if (have_rows('elementy')) : ?>
              <div class="features__items">
                <?php while (have_rows('elementy')) : the_row(); ?>
                  <div class="features__item">
                    <p><?php the_sub_field('tekst'); ?></p>
                  </div>
                <?php endwhile; ?>
              </div>
            <?php else : ?>
              <?php // No rows found 
              ?>
            <?php endif; ?>
            <div class="features__box">
              <p><?php the_sub_field('opisanie'); ?></p>
              <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
              <?php if ($izobrazhenie) : ?>
                <?php
                echo platejka_render_acf_image(
                  $izobrazhenie,
                  'medium',
                  array(
                    'alt'   => $izobrazhenie['alt'] ?? '',
                    'sizes' => '(max-width: 767px) 100vw, 320px',
                  )
                );
                ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
