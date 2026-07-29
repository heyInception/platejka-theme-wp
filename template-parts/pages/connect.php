<?php if (get_field('vklyuchit_blok_connect') == 1) : ?>
  <section class="connect">
    <div class="container">
      <div class="connect__row">
        <div class="connect__title">
          <h2><?php the_field('zagolovok_connect'); ?></h2>
        </div>
        <div class="connect__subtitle">Выполняем подключение наших клиентов за 3 шага</div>
        <div class="connect__items">
          <?php if (have_rows('shagi_connect')) : ?>
            <?php while (have_rows('shagi_connect')) : the_row(); ?>
              <div class="connect__item">
                <div class="connect__step <?php the_sub_field('class'); ?>">
                  <?php the_sub_field('zagolovok'); ?>
                </div>
                <div class="connect__clap">
                  <div class="connect__text">
                    <?php the_sub_field('tekst_1'); ?>
                  </div>
                  <?php if (get_sub_field('tekst_2')) : ?>
                    <div class="connect__text connect__text_strong"><?php the_sub_field('tekst_2'); ?></div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
            <?php // No rows found 
            ?>
          <?php endif; ?>
          <div class="connect__item connect__item_last">
            <div class="connect__wrap">
              <div class="connect__step  connect__step_green">
                <span>3</span>
                шаг
              </div>
              <div class="connect__clap">
                <div class="connect__text">
                Мы сами будем загружать платежки, рассчитывать комиссии, проверять платежи.
                </div>
                <div class="connect__text connect__text_strong">А вы - экономить время.</div>
              </div>
            </div>
            <div class="connect__wrap">
              <div class="connect__img">
                <img src="<?php echo get_template_directory_uri(); ?>/img/hp.png" alt="">
              </div>
              <a href="#call"><button class="connect__btn btn-reset">Оставить заявку</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>