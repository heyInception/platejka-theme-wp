<?php if (have_rows('work_section')) : ?>
  <?php while (have_rows('work_section')) : the_row(); ?>
    <section class="work">
      <div class="container">
        <div class="work__row">
          <div class="work__column work__column_left">
            <div class="work__head">
              <h3><?php the_sub_field('zagolovok_left'); ?></h3>
            </div>
            <?php if (have_rows('elementy_left')) : ?>
              <div class="work__wrap">
                <?php while (have_rows('elementy_left')) : the_row(); ?>
                  <div class="work__box">
                    <div class="work__top"><?php the_sub_field('zagolovok'); ?></div>
                    <div class="work__bottom"><?php the_sub_field('tekst'); ?></div>
                  </div>
                <?php endwhile; ?>
              </div>
            <?php else : ?>
              <?php // No rows found 
              ?>
            <?php endif; ?>
          </div>
          <div class="work__column work__column_right">
            <div class="work__title">
              <h2><?php the_sub_field('zagolovok'); ?></h2>
            </div>
            <?php if (have_rows('elementy')) : ?>
              <div class="work__items">
                <?php while (have_rows('elementy')) : the_row(); ?>
                  <div class="work__item <?php the_sub_field('vybor_elementa'); ?>">
                    <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                    <?php if ($izobrazhenie) : ?>
                      <div class="work__img">
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
                    <div class="work__wrapper">
                      <div class="work__head-main"><?php the_sub_field('zagolovok'); ?></div>
                      <div class="work__content"><?php the_sub_field('tekst'); ?></div>
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
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
