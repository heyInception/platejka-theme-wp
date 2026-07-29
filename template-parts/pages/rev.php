<?php if (get_field('vklyuchit_blok_rev') == 1) : ?>
  <div class="rev">
    <div class="container">
      <div class="rev__column">
        <div class="rev__title">
          <?php if (get_field('zagolovok_reev')) : ?>
            <?php if (is_page(1873)) : ?>
              <h2><?php the_field('zagolovok_reev'); ?>
                <?php
                $current_date = current_time('timestamp'); // Получаем текущую дату и время в timestamp
                $month_name = date_i18n('n', $current_date); // Получаем номер текущего месяца

                // Массив склонений для месяцев в родительном падеже
                $months_genitive = array(
                  "в январе",
                  "в феврале",
                  "в марте",
                  "в апреле",
                  "в мае",
                  "в июне",
                  "в июле",
                  "в августе",
                  "в сентябре",
                  "в октябре",
                  "в ноябре",
                  "в декабре"
                );

                $formatted_date = ' ' . $months_genitive[$month_name - 1] . date_i18n(' Y года', $current_date); // Форматируем дату в нужный формат

                echo $formatted_date; // Выводим отформатированную дату на экран
                ?></h2>
                
            <?php else : ?>
              <h2><?php the_field('zagolovok_reev'); ?></h2>
              <?php if (have_rows('izobrazheniya_reev')) : ?>
                <?php while (have_rows('izobrazheniya_reev')) : the_row(); ?>
                  <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                  <?php if ($izobrazhenie) : ?>
                    <?php
                    echo platejka_render_acf_image(
                      $izobrazhenie,
                      'large',
                      array(
                        'alt'   => $izobrazhenie['alt'] ?? '',
                        'sizes' => '(max-width: 767px) 100vw, (max-width: 1229px) 50vw, 600px',
                      )
                    );
                    ?>
                  <?php endif; ?>
                <?php endwhile; ?>
              <?php else : ?>
                <?php // No rows found 
                ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php else : ?>
            <h2><?php the_field('zagolovok_reev', 24); ?></h2>
          <?php endif; ?>
        </div>
        <div class="rev__row">
          <?php if (have_rows('klienty_rev')) : ?>
            <?php while (have_rows('klienty_rev')) : the_row(); ?>
              <div class="rev__item rev__item_hide">
                <?php $izobrazheie = get_sub_field('izobrazheie'); ?>
                <?php if ($izobrazheie) : ?>
                  <div class="rev__img">
                    <?php
                    echo platejka_render_acf_image(
                      $izobrazheie,
                      'medium',
                      array(
                        'alt'   => $izobrazheie['alt'] ?? '',
                        'sizes' => '(max-width: 767px) 100vw, 320px',
                      )
                    );
                    ?>
                  </div>
                <?php endif; ?>
                <div class="rev__text"><?php the_sub_field('zagolovok'); ?></div>
                <div class="rev__name"><?php the_sub_field('imya'); ?><br>
                  <?php the_sub_field('kompaniya'); ?></div>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
            <?php while (have_rows('klienty_rev', 24)) : the_row(); ?>
              <div class="rev__item <?php the_sub_field('colors'); ?>">
                <?php $izobrazheie = get_sub_field('izobrazheie'); ?>
                <?php if ($izobrazheie) : ?>
                  <div class="rev__img">
                    <?php
                    echo platejka_render_acf_image(
                      $izobrazheie,
                      'medium',
                      array(
                        'alt'   => $izobrazheie['alt'] ?? '',
                        'sizes' => '(max-width: 767px) 100vw, 320px',
                      )
                    );
                    ?>
                  </div>
                <?php endif; ?>
                <div class="rev__text"><?php the_sub_field('zagolovok'); ?></div>
                <div class="rev__name"><?php the_sub_field('imya'); ?><br>
                  <?php the_sub_field('kompaniya'); ?></div>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php else : ?>
  <?php // echo 'false'; 
  ?>
<?php endif; ?>
