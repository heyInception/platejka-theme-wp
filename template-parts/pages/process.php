<?php if (have_rows('process')) : ?>
  <?php while (have_rows('process')) : the_row(); ?>
    <section class="process">
      <div class="container">
        <div class="process__column">
          <div class="process__title">
            <h2><?php the_sub_field('zagolovok'); ?></h2>
          </div>
          <?php if (have_rows('elementy')) : ?>
            <div class="process__items">
              <?php while (have_rows('elementy')) : the_row(); ?>
                <div class="process__item <?php the_sub_field('vybor_elementa'); ?>">
                  <div class="process__wrap">
                    <div class="process__count">
                      <div class="process__arrow"></div>
                    </div>
                    <div class="process__head"><?php the_sub_field('zagolovok'); ?></div>
                  </div>
                  <div class="process__content"><?php the_sub_field('tekst'); ?></div>
                </div>
              <?php endwhile; ?>
            </div>
          <?php else : ?>
            <?php // No rows found 
            ?>
          <?php endif; ?>
          <div class="process__text"><?php the_sub_field('tekst'); ?></div>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>