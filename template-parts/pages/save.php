<?php if (get_field('vklyuchit_blok_save') == 1) : ?>
  <section class="save">
    <div class="container">
      <div class="save__column">
        <div class="save__title">
          <h2><?php the_field('zagolovok_save'); ?></h2>
        </div>
        <div class="save__row">
          <div class="save__left save__left_green">
            <div class="save__wrap">
              <div class="save__head save__head_white"><?php the_field('head_save'); ?>
              </div>
              <div class="save__text save__text_white"><?php the_field('tekst_save'); ?>
              </div>
            </div>
            <div class="save__img">
              <img src="<?php echo get_template_directory_uri(); ?>/img/save.png" alt="">
            </div>
          </div>
          <div class="save__right save__right_grey">
            <?php if (have_rows('kartochki_save')) : ?>
              <?php while (have_rows('kartochki_save')) : the_row(); ?><div class="save__col">
                  <div class="save__head"><?php the_sub_field('zagolovok'); ?></div>
                  <div class="save__text"><?php the_sub_field('tekst'); ?></div>
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
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>