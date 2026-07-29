<section class="v-contacts">
  <div class="container">
    <div class="v-contacts__column">
      <div class="v-contacts__title">
        <h2><?php the_sub_field('zagolovok'); ?></h2>
      </div>
      <div class="v-contacts__items">
        <div class="v-contacts__item">
          <div class="v-contacts__adress">
            <span>Адрес: </span>
            <p><?php the_sub_field('adres'); ?></p>
          </div>
          <div class="v-contacts__phone">
            <span>Телефон: </span>
            <a href="tel:<?php the_field('telefon', 'option'); ?>"><?php the_field('telefon', 'option'); ?></a>
          </div>
          <a href="#call"><button class="v-contacts__button btn-reset">Оставить заявку</button></a>
        </div>
        <?php $izobrazhenie_1 = get_sub_field('izobrazhenie_1'); ?>
        <?php if ($izobrazhenie_1) : ?>
          <div class="v-contacts__item v-contacts__item_img">
            <img src="<?php echo esc_url($izobrazhenie_1['url']); ?>" alt="<?php echo esc_attr($izobrazhenie_1['alt']); ?>" />
          </div>
        <?php endif; ?>
        <?php $izobrazhenie_2 = get_sub_field('izobrazhenie_2'); ?>
        <?php if ($izobrazhenie_2) : ?>
          <div class="v-contacts__item v-contacts__item_img">
            <img src="<?php echo esc_url($izobrazhenie_2['url']); ?>" alt="<?php echo esc_attr($izobrazhenie_2['alt']); ?>" />
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>