<section class="seo">
  <div class="container">
    <div class="seo__column">
      <div class="seo__title">
		  <?php if (is_page(2054)) : ?>
		  <h2><?php the_field('zagolovok_services'); ?></h2>	
			<?php else : ?>
			<?php the_title() ?>
        <?php endif; ?>
      </div>
      <div class="seo__wrap">
        <div class="seo__text">
          <?php the_content(); ?>
        </div>
        <div class="seo__img"><img src="<?php echo get_template_directory_uri(); ?>/img/adv-coin.png" alt=""></div>
      </div>

    </div>
  </div>
</section>