<section class="v-service">
  <div class="container">
    <div class="v-service__column">
      <div class="v-service__title">
        <h2><?php the_sub_field('zagolovok'); ?></h2>
      </div>
      <div class="v-service__subtitle"><?php the_sub_field('podzagolovok'); ?></div>
      <div class="v-service__alert"><?php the_sub_field('preduprezhdenie'); ?></div>
      <div class="v-service__row">
        <div class="v-service__col v-service__col_globe">
          <?php if (have_rows('levaya_chast_stran')) : ?>
            <div class="v-service__country v-service__country_left">
              <?php while (have_rows('levaya_chast_stran')) : the_row(); ?>
                <div class="v-service__country-name v-service__country-name_<?php the_sub_field('flag'); ?>"> <?php the_sub_field('nazvanie_strany'); ?></div>
              <?php endwhile; ?>
            </div>
          <?php else : ?>
            <?php // No rows found 
            ?>
          <?php endif; ?>
          <div class="v-service__globe">
            <?php $globus = get_sub_field('globus'); ?>
            <?php if ($globus) : ?>
              <img src="<?php echo esc_url($globus['url']); ?>" alt="<?php echo esc_attr($globus['alt']); ?>" />
            <?php endif; ?>
            <?php $globus_mob = get_sub_field('globus_mob'); ?>
            <?php if ($globus_mob) : ?>
              <img class="v-service__globe_mob" src="<?php echo esc_url($globus_mob['url']); ?>" alt="<?php echo esc_attr($globus_mob['alt']); ?>" />
            <?php endif; ?>
            <div class="v-service__globe-point v-service__globe-usa"></div>
            <div class="v-service__globe-point v-service__globe-ger"></div>
            <div class="v-service__globe-point v-service__globe-ch"></div>
            <div class="v-service__globe-point v-service__globe-tur"></div>
            <div class="v-service__globe-point v-service__globe-kz"></div>
            <div class="v-service__globe-point v-service__globe-est"></div>
            <div class="v-service__globe-point v-service__globe-ru"></div>
            <div class="v-service__globe-point v-service__globe-gk"></div>
            <div class="v-service__globe-point v-service__globe-vet"></div>
            <div class="v-service__globe-point v-service__globe-kir"></div>
            <div class="v-service__globe-point v-service__globe-sing"></div>
          </div>
          <?php if (have_rows('pravaya_chast')) : ?>
            <div class="v-service__country v-service__country_right">
              <?php while (have_rows('pravaya_chast')) : the_row(); ?>
                <div class="v-service__country-name v-service__country-name_<?php the_sub_field('flag'); ?>"><?php the_sub_field('nazvanie_strany'); ?></div>
              <?php endwhile; ?>
            </div>
          <?php else : ?>
            <?php // No rows found 
            ?>
          <?php endif; ?>
        </div>
        <div class="v-service__country v-service__country_left v-service__country_mob">
          <?php while (have_rows('levaya_chast_stran')) : the_row(); ?>
            <div class="v-service__country-name v-service__country-name_<?php the_sub_field('flag'); ?>"> <?php the_sub_field('nazvanie_strany'); ?></div>
          <?php endwhile; ?>
          <?php while (have_rows('pravaya_chast')) : the_row(); ?>
            <div class="v-service__country-name v-service__country-name_<?php the_sub_field('flag'); ?>"><?php the_sub_field('nazvanie_strany'); ?></div>
          <?php endwhile; ?>
        </div>
        <?php if (have_rows('informacziya')) : ?>
          <div class="v-service__col">
            <div class="v-service__items">
              <?php while (have_rows('informacziya')) : the_row(); ?>
                <div class="v-service__item">
                  <div class="v-service__number"><?php the_sub_field('kolichistvo'); ?></div>
                  <div class="v-service__content"><?php the_sub_field('tekst'); ?></div>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        <?php else : ?>
          <?php // No rows found 
          ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>