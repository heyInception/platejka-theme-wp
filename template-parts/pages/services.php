<?php if (get_field('vklyuchit_blok_services') == 1) : ?>
  <section class="services">
    <div class="container">
      <div class="services__column">
        <div class="services__title">
          <h2><?php the_field('zagolovok_services'); ?></h2>
        </div>
        <div class="services__row">
          <?php if (have_rows('uslugi_services')) : ?>
            <?php while (have_rows('uslugi_services')) : the_row(); ?>
              <div class="services__item <?php the_sub_field('cardclass'); ?>">
                <div class="services__head">
                  <h3><?php the_sub_field('zagolovok'); ?></h3>
                </div>
                <div class="services__text"><?php the_sub_field('tekst'); ?></div>
                <?php $izobrazhenie_services = get_sub_field('izobrazhenie_services'); ?>
                <?php if ($izobrazhenie_services) : ?>
                  <div class="services__img">
                    <img src="<?php echo esc_url($izobrazhenie_services['url']); ?>" alt="<?php echo esc_attr($izobrazhenie_services['alt']); ?>" />
                  </div>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
            <?php // No rows found 
            ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>