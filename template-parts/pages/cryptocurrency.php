<?php if (have_rows('cryptocurrency')) : ?>
  <?php while (have_rows('cryptocurrency')) : the_row(); ?>
    <section class="cryptocurrency">
      <div class="container">
        <div class="cryptocurrency__column">
          <div class="cryptocurrency__title">
            <h2><?php the_sub_field('zagolovok'); ?></h2>
          </div>
          <?php if (have_rows('elementy')) : ?>
            <div class="cryptocurrency__items">
            <?php while (have_rows('elementy')) : the_row(); ?>
              <div class="cryptocurrency__item">
                <div class="cryptocurrency__wrap">
                  <div class="cryptocurrency__count">
                    <div class="cryptocurrency__arrow"></div>
                  </div>
                  <div class="cryptocurrency__head"><?php the_sub_field('zagolovok'); ?></div>
                </div>
                <div class="cryptocurrency__content"><?php the_sub_field('tekst'); ?></div>
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