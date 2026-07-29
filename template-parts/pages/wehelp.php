<?php if (have_rows('wehelp')) : ?>
  <?php while (have_rows('wehelp')) : the_row(); ?>
    <section class="wehelp">
      <div class="container">
        <div class="wehelp__row">
          <div class="wehelp__column">
            <div class="wehelp__title">
              <h2><?php the_sub_field('zagolovok'); ?></h2>
            </div>
            <div class="wehelp__subtitle"><?php the_sub_field('tekst'); ?></div>
            <?php if (have_rows('elementy')) : ?>
              <div class="wehelp__items">
                <?php while (have_rows('elementy')) : the_row(); ?>
                  <div class="wehelp__item <?php the_sub_field('vybor_elementa'); ?>"><?php the_sub_field('tekst'); ?></div>
                <?php endwhile; ?>
              </div>
            <?php else : ?>
              <?php // No rows found 
              ?>
            <?php endif; ?>
          </div>
          <div class="wehelp__form">
            <div class="wehelp__head"><?php the_sub_field('zagolovok_formy'); ?></div>
            <?php echo do_shortcode('[contact-form-7 id="fb334d6" title="Помогаем продолжать работать в условиях существующих ограничений"]') ?>
          </div>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>