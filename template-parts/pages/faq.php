<section class="faq">
    <div class="container">
      <div class="faq__column">
        <div class="faq__title">
          <h2><?php the_field('zagolovok_faq', 24); ?></h2>
        </div>
        <div class="faq__wrap">
          <div class="faq__items">
            <?php if (have_rows('repeater_column_1')) : ?>
              <?php while (have_rows('repeater_column_1')) : the_row(); ?>
                <div class="faq__item">
                  <div class="faq__head"><?php the_sub_field('column1_btn'); ?></div>
                  <div class="faq__text"><?php the_sub_field('column1_text'); ?></div>
                </div>
              <?php endwhile; ?>
            <?php else : ?>
              <?php // No rows found 
              ?>
            <?php endif; ?>
          </div>
          <div class="faq__items">
            <?php if (have_rows('repeater_column_2')) : ?>
              <?php while (have_rows('repeater_column_2')) : the_row(); ?>
                <div class="faq__item">
                  <div class="faq__head"><?php the_sub_field('column2_btn'); ?></div>
                  <div class="faq__text"><?php the_sub_field('column2_text'); ?></div>
                </div>
              <?php endwhile; ?>
            <?php else : ?>
              <?php // No rows found 
              ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>