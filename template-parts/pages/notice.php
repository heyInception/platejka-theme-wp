<section class="notice">
  <div class="container">
    <div class="notice__row">
      <div class="notice__item notice__item_white">
        <div class="notice__title">Об услуге</div>
        <div class="notice__content">Мы помогаем вашему бизнесу легко отправлять и получать деньги по всему миру быстро,
          и с минимальной комиссией. Проанализируем ваши потребности, разработаем оптимальное решение, выполним
          транзакцию и предоставим закрывающие документы. Каждый этап тщательно контролируется вашим персональным
          менеджером, чтобы обеспечить максимальную надежность и эффективность.</div>
        <div class="notice__head">
          <span>Оплачивайте контрагентам по всему миру</span>
          <p>Договор субподряда / агентский договор</p>
        </div>
        <div class="notice__head">
          <span>Получайте выручку от международных заказчиков </span>
          <p>Официальный агентский договор с отчетом платежного агента</p>
        </div>
      </div>
      <div class="notice__item notice__item_white">
        <div class="notice__title">Как это работает</div>
        <div class="notice__content">На примере платежа в Китай за поставку товара</div>
        <div class="notice__head">Вы заключаете договор с компанией Платежка в РФ (расчет в рублях)</div>
        <div class="notice__head">Платежка расплачивается с Вашим контрагентом в его стране (доллары, евро, юани)</div>
      </div>
      <div class="notice__rows">
        <div class="notice__top">Рассчитаем размер комиссии и ответим на вопросы в течении 5 минут</div>
        <div class="notice__wrap">
          <div class="notice__img">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/notice-img.png" alt="" width="266" height="276" loading="lazy" decoding="async">
          </div>
          <div class="notice__wrapper">
            <p>Проконсультирует главный менеджер компании, который работает с международными операциями около 8 лет</p>
			  <ul class="list-reset social" title="Соц. сети">
              <?php if (have_rows('socz_seti_header', 'option')) : ?>
                <?php while (have_rows('socz_seti_header', 'option')) : the_row(); ?>
                  <?php $ssylka = get_sub_field('ssylka'); ?>
                  <?php if ($ssylka) : ?>
                    <li class="social__item">
                      <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>" class="social__link <?php the_sub_field('class'); ?>" aria-label="<?php echo esc_html($ssylka['title']); ?>" rel="nofollow"></a>
                    </li>
                  <?php endif; ?>
                <?php endwhile; ?>
              <?php else : ?>
                <?php // No rows found 
                ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
