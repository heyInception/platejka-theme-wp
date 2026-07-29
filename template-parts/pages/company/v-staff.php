<section class="v-staff">
  <div class="container">
    <div class="v-staff__column">
      <div class="v-staff__title">
        <h2><?php the_sub_field('zagolovok'); ?></h2>
      </div>
      <div class="v-staff__row">
        <?php $foto = get_sub_field('foto'); ?>
        <?php if ($foto) : ?>
          <div class="v-staff__img">
            <img src="<?php echo esc_url($foto['url']); ?>" alt="<?php echo esc_attr($foto['alt']); ?>" />
          </div>
        <?php endif; ?>
        <div class="v-staff__content">
          <p>М<?php the_sub_field('opisanie'); ?></p>
          <div class="v-staff__wrap">
            <b><?php the_sub_field('fio'); ?></b>
            <p><?php the_sub_field('osnovatel'); ?></p>
          </div>
        </div>
      </div>
      <?php if (have_rows('informacziya')) : ?>
        <div class="v-staff__items">
          <?php while (have_rows('informacziya')) : the_row(); ?>
            <div class="v-staff__item">
              <div class="v-staff__num"><?php the_sub_field('kolichestvo'); ?></div>
              <div class="v-staff__text"><?php the_sub_field('tekst'); ?></div>
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