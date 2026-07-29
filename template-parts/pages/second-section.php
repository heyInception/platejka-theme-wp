<?php if (get_field('vklyuchit_blok_services') == 1) : ?>
  <section class="second-section">
    <div class="container">
      <div class="second-section__column">
        <div class="second-section__title">
			<?php if (is_page(2054)) : ?>
				<?php the_title() ?>
			<?php else : ?>
			<h2><?php the_field('zagolovok_services'); ?></h2>
        <?php endif; ?>
        </div>
        <?php if (have_rows('uslugi_services')) : ?>
          <div class="second-section__items">
            <?php while (have_rows('uslugi_services')) : the_row(); ?>
              <div class="second-section__item  <?php the_sub_field('cardclass'); ?>">
                <div class="second-section__head"><?php the_sub_field('zagolovok'); ?></div>
                <div class="second-section__text"><?php the_sub_field('tekst'); ?></div>
                <?php $izobrazhenie_services = get_sub_field('izobrazhenie_services'); ?>
                <?php if ($izobrazhenie_services) : ?>
                  <div class="second-section__img">
                    <img src="<?php echo esc_url($izobrazhenie_services['url']); ?>" alt="<?php echo esc_attr($izobrazhenie_services['alt']); ?>" />
                  </div>
                <?php else : ?>
                  <a href="#fancyboxID-1" class="fancybox-inline second-section__button btn-reset">Начать</a>
                <?php endif; ?>
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
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>