<?php if (have_rows('shema')) : ?>
  <?php while (have_rows('shema')) : the_row(); ?>
    <section class="scheme">
      <div class="container">
        <div class="scheme__column">
          <div class="scheme__title">
            <h2><?php the_sub_field('zagolovok'); ?></h2>
          </div>
          <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
          <?php if ($izobrazhenie) : ?>
            <div class="scheme__img">
              <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>