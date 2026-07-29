<?php if (have_rows('advantages')) : ?>
  <?php while (have_rows('advantages')) : the_row(); ?>
    <section class="advantages">
      <div class="container">
        <div class="advantages__column">
          <div class="advantages__title">
            <h2><?php the_sub_field('zagolovok'); ?></h2>
          </div>
          <div class="advantages__subtitle"><?php the_sub_field('podzagolovok'); ?></div>
          <?php if (have_rows('elementy')) : ?>
            <div class="advantages__items">
              <?php while (have_rows('elementy')) : the_row(); ?>
                <div class="advantages__item <?php the_sub_field('vybor_elementa'); ?>">
                  <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                  <?php if ($izobrazhenie) : ?>
                    <div class="advantages__img">
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
                    </div>
                  <?php endif; ?>
                  <div class="advantages__wrap">
                    <div class="advantages__head"><?php the_sub_field('zagolovok'); ?></div>
                    <div class="advantages__content"><?php the_sub_field('tekst'); ?></div>
                  </div>
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
