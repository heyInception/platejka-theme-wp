<?php
function tarify_sections($post_id)
{
  while (have_rows('tarify', $post_id)) : the_row();
?>
    <section class="tariffs">
      <div class="container">
        <div class="tariffs__row">
          <?php if (have_rows('tariffs')) : ?>
            <?php while (have_rows('tariffs')) : the_row(); ?>
              <div class="tariffs__item tariffs__item_bg-green">
                <div class="tariffs__title tariffs__title_white"><?php the_sub_field('zagolovok'); ?></div>
                <div class="tariffs__content tariffs__content_white"><?php the_sub_field('tekst'); ?></div>
                <button class="tariffs__button btn-reset">Оставить заявку</button>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
          <?php if (have_rows('platezhka_logistik_dostavim_i_sekonomim')) : ?>
            <?php while (have_rows('platezhka_logistik_dostavim_i_sekonomim')) : the_row(); ?>
              <div class="tariffs__item tariffs__item_half tariffs__item_bg-grey">
                <div class="tariffs__title"><?php the_sub_field('zagolovok'); ?></div>
                <div class="tariffs__content"><?php the_sub_field('tekst'); ?></div>
                <div class="tariffs__wrap">
                  <a href="#fancyboxID-1" class="fancybox-inline tariffs__button btn-reset">Оставить заявку</a>
                  <a href="https://platejkalog.com/" target="_blank" rel="nofollow" class="tariffs__button tariffs__button_white btn-reset">Платежка Логистик</a>
                </div>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
          <?php if (have_rows('vygodnye_usloviya_dlya_krupnyh_perevodov')) : ?>
            <?php while (have_rows('vygodnye_usloviya_dlya_krupnyh_perevodov')) : the_row(); ?>
              <div class="tariffs__item tariffs__item_half tariffs__item_bg-light-green">
                <div class="tariffs__title"><?php the_sub_field('zagolovok'); ?></div>
                <div class="tariffs__content"><?php the_sub_field('tekst'); ?></div>
                <a href="#fancyboxID-1" class="fancybox-inline tariffs__button tariffs__button_light-green btn-reset">Оставить заявку</a>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php } ?>
<?php
if (have_rows('tarify')) {
  tarify_sections(null); // Текущий пост
} else {
  tarify_sections('option'); // Пост с ID 23
}

?>