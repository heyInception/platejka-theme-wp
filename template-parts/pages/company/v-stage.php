<section class="v-stage">
  <div class="container">
    <div class="v-stage__column">
      <div class="v-stage__title">
        <h2><?php the_sub_field('zagolovok'); ?></h2>
      </div>
      <div class="v-stage__subtitle"><?php the_sub_field('podzagolovok'); ?></div>
      <?php if (have_rows('pervye_tri_etapa')) : ?>
        <div class="v-stage__items">
          <?php while (have_rows('pervye_tri_etapa')) : the_row(); ?>
            <div class="v-stage__item v-stage__item_<?php the_sub_field('god'); ?>"><?php the_sub_field('tekst'); ?>
              <?php if (have_rows('izobrazheniya')) : ?>
                <div class="v-stage__wrap">
                  <?php while (have_rows('izobrazheniya')) : the_row(); ?>
                    <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                    <?php if ($izobrazhenie) : ?>
                      <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                    <?php endif; ?>
                  <?php endwhile; ?>
                </div>
              <?php else : ?>
                <?php // No rows found 
                ?>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <?php // No rows found 
        ?>
      <?php endif; ?>
      <?php if (have_rows('pervye_tri_etapa')) : ?>
        <div class="v-stage__date v-stage__date_ml282">
          <?php while (have_rows('pervye_tri_etapa')) : the_row(); ?>
            <div class="v-stage__date-item v-stage__date-item_<?php the_sub_field('god'); ?>"><?php the_sub_field('god'); ?></div>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <?php // No rows found 
        ?>
      <?php endif; ?>
      <?php if (have_rows('vtorye_tri_etapa')) : ?>
        <div class="v-stage__date v-stage__date_mr282">
          <?php while (have_rows('vtorye_tri_etapa')) : the_row(); ?>
            <div class="v-stage__date-item v-stage__date-item_<?php the_sub_field('god'); ?>"><?php the_sub_field('god'); ?></div>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <?php // No rows found 
        ?>
      <?php endif; ?>
      <?php if (have_rows('vtorye_tri_etapa')) : ?>
        <div class="v-stage__items v-stage__items_pleft">
          <?php while (have_rows('vtorye_tri_etapa')) : the_row(); ?>
            <div class="v-stage__item v-stage__item_<?php the_sub_field('god'); ?>">
              <?php the_sub_field('tekst'); ?>
              <?php if (have_rows('izobrazheniya')) : ?>
                <div class="v-stage__wrap">
                  <?php while (have_rows('izobrazheniya')) : the_row(); ?>
                    <?php $izobrazhenie_2 = get_sub_field('izobrazhenie_2'); ?>
                    <?php if ($izobrazhenie_2) : ?>
                      <img src="<?php echo esc_url($izobrazhenie_2['url']); ?>" alt="<?php echo esc_attr($izobrazhenie_2['alt']); ?>" />
                    <?php endif; ?>
                  <?php endwhile; ?>
                </div>
              <?php else : ?>
                <?php // No rows found 
                ?>
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