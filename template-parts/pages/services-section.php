<section class="services-section">
  <div class="container">
    <div class="services-section__row">
      <div class="services-section__title"><h1><?php the_title() ?></h1></div>
      <div class="services-section__items">
        <div class="services-section__item services-section__item_half">
          <div class="services-section__head">Международные платежи и расчеты</div>
          <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-3',
                  'menu_id'        => 'serv-1',
                  'menu_class'      => 'services-section__list',
                  'container'       => 'nav',
                )
              );
              ?>
        </div>
        <div class="services-section__item services-section__item_half">
          <div class="services-section__head">Валютные переводы</div>
          <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-4',
                  'menu_id'        => 'serv-2',
                  'menu_class'      => 'services-section__list',
                  'container'       => 'nav',
                )
              );
              ?>
        </div>
        <div class="services-section__item">
          <div class="services-section__head">Платежи в Китай</div>
          <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-5',
                  'menu_id'        => 'serv-3',
                  'menu_class'      => 'services-section__list',
                  'container'       => 'nav',
                )
              );
              ?>
        </div>
        <div class="services-section__item">
          <div class="services-section__head">Платежи в Европу</div>
          <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-6',
                  'menu_id'        => 'serv-4',
                  'menu_class'      => 'services-section__list',
                  'container'       => 'nav',
                )
              );
              ?>
        </div>
        <div class="services-section__item">
          <div class="services-section__head">Аутсорсинг и управление ВЭД</div>
          <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-7',
                  'menu_id'        => 'serv-4',
                  'menu_class'      => 'services-section__list',
                  'container'       => 'nav',
                )
              );
              ?>
        </div>
      </div>
    </div>
  </div>
</section>
