<?php if (get_field('vklyuchit_blok_about') == 1) : ?>
  <section class="about">
    <div class="container">
      <div class="about__row">
        <div class="about__title">
          <?php if (get_field('zagolovok_about')) : ?>
            <h2><?php the_field('zagolovok_about'); ?></h2>
          <?php else : ?>
            <?php the_field('zagolovok_about', 24); ?>
          <?php endif; ?>
        </div>
        <div class="about__subtitle">Наши достижения и признания подтверждают высокий уровень профессионализма и надежности наших услуг.</div>
        <div class="about__cards">
        <?php $page_id_to_check = 24;  ?>
          <?php if (have_rows('kartochka_about')) : ?>
            <?php while (have_rows('kartochka_about')) : the_row(); ?>
              <div class="about__card <?php the_sub_field('card_class'); ?>">
                <div class="about__head <?php the_sub_field('zagolovok_class'); ?>"><?php the_sub_field('zagolovok'); ?></div>
                <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                <?php if ($izobrazhenie) : ?>
                  <div class="about__img">
                    <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                  </div>
                <?php endif; ?>
                
                <?php $ssylka = get_sub_field('ssylka'); ?>
                <?php if ($ssylka) : ?>
                  <div class="about__btn">
                    <a href="<?php echo esc_url( $ssylka['url'] ); ?>"><?php echo esc_html($ssylka['title']); ?></a>
                  </div>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
            <?php while (have_rows('kartochka_about', $page_id_to_check)) : the_row(); ?>
              <div class="about__card <?php the_sub_field('card_class'); ?>">
                <div class="about__head <?php the_sub_field('zagolovok_class'); ?>"><?php the_sub_field('zagolovok'); ?></div>
                <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                <?php if ($izobrazhenie) : ?>
                  <div class="about__img">
                    <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                  </div>
                <?php endif; ?>
                <?php $ssylka = get_sub_field('ssylka'); ?>
                <?php if ($ssylka) : ?>
                  <div class="about__btn">
                    <a href="<?php echo esc_url( $ssylka['url'] ); ?>"><?php echo esc_html($ssylka['title']); ?></a>
                  </div>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
        <ul class="about__list list-reset">
          <?php if (get_field('spisok_about')) : ?>
            <?php the_field('spisok_about'); ?>
          <?php else : ?>
            <?php the_field('spisok_about', 24); ?>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </section>
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>
