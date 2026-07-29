<?php if (get_field('vklyuchit_blok_request') == 1) : ?>
  <section class="request">
    <div class="container">
      <div class="request__row">
        <div class="request__column">
          <div class="request__title">
            <h3><?php the_field('zagolovok_request', 24); ?></h3>
          </div>
          <div class="request__subtitle"><?php the_field('podzagolovok_request', 24); ?></div>
          <div class="request__btn request__btn_hide">
            <a href="#fancyboxID-1" class="fancybox-inline btn-reset">Стать клиентом</a>
          </div>
        </div>
        <div class="request__column">
          <div class="request__img">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/request.png" alt="Предприниматели мыслят возможностями, а не ограничениями" width="575" height="278" loading="lazy" decoding="async">
          </div>
          <div class="request__btn request__btn_show">
            <a href="#fancyboxID-1" class="fancybox-inline btn-reset">Стать клиентом</a>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>
