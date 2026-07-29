<?php if (get_field('vklyuchit_blok_package') == 1) : ?>
  <section class="package">
    <div class="container">
      <div class="package__wrap">
        <div class="package__row">
          <div class="package__column">
            <div class="package__title">
              <h2><?php the_field('zagolovok_package'); ?></h2>
            </div>
            <div class="package__subtitle">
              <?php the_field('podzagolovok_package'); ?>
            </div>
            <ul class="package__list list-reset">
              <?php the_field('spisok_package'); ?>
            </ul>
            <div class="package__btn">
              <?php $ssylka_package = get_field('ssylka_package'); ?>
              <?php if ($ssylka_package) : ?>
                <a href="#call" target="<?php echo esc_attr($ssylka_package['target']); ?>"><?php echo esc_html($ssylka_package['title']); ?></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="package__row">
          <div class="package__img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/packedge.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>