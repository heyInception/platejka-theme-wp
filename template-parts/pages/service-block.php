<?php if (get_field('vklyuchit_blok_service') == 1) : ?>
  <section class="service">
    <div class="container">
      <div class="service__column">
        <div class="service__title">
          <?php if (get_field('zagolovok_service')) : ?>
            <h2><?php the_field('zagolovok_service'); ?></h2>
          <?php else : ?>
            <?php the_field('zagolovok_service', 24); ?>
          <?php endif; ?>
        </div>
        <?php if (get_field('podzagolovok_service')) : ?><div class="service__subtitle"><?php the_field('podzagolovok_service'); ?></div><?php endif; ?>
        <div class="service__items">
          <?php if (have_rows('uslugi_service')) : ?>
            <?php while (have_rows('uslugi_service')) : the_row(); ?>
              <?php $ssylka = get_sub_field('ssylka'); ?>
              <div class="service__item">
                <a href="<?php echo esc_url($ssylka['url']); ?>" class="service__head"><?php the_sub_field('zagolovok'); ?></a>
                <div class="service__subhead"><?php the_sub_field('tekst'); ?></div>
                <div class="service__buttons">
                  <?php $cena = get_sub_field('czena'); ?>
                  <?php if ($cena) : ?>
                    <button class="btn-reset service__buttons_bwhite"><?php the_sub_field('czena'); ?></button>
                  <?php endif; ?>

                  <?php if ($ssylka) : ?>
                    <a href="<?php echo esc_url($ssylka['url']); ?>" class="btn-reset service__buttons_blue"><?php echo esc_html($ssylka['title']); ?></a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
            <?php while (have_rows('uslugi_service', 24)) : the_row(); ?>
              <div class="service__item">
                <div class="service__head"><?php the_sub_field('zagolovok'); ?></div>
                <div class="service__subhead"><?php the_sub_field('tekst'); ?></div>
                <div class="service__buttons">
                  <button class="btn-reset service__buttons_bwhite"><?php the_sub_field('czena'); ?></button>
                  <?php $ssylka = get_sub_field('ssylka'); ?>
                  <?php if ($ssylka) : ?>
                    <a href="<?php echo esc_url($ssylka['url']); ?>" class="btn-reset service__buttons_blue"><?php echo esc_html($ssylka['title']); ?></a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>