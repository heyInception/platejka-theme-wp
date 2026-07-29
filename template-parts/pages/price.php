<?php if (get_field('vklyuchit_blok_service_ip') == 1) : ?>
    <section class="service">
        <div class="container">
            <div class="service__column">
                <div class="service__title">
                    <h2><?php the_field('zagolovok_service_ip'); ?></h2>
                </div>
                <div class="service__items">
                    <?php if (have_rows('uslugi_service_ip')) : ?>
                        <?php while (have_rows('uslugi_service_ip')) : the_row(); ?>
                            <div class="service__item">
                                <div class="service__head"><?php the_sub_field('zagolovok'); ?></div>
                                <div class="service__subhead"><?php the_sub_field('tekst'); ?></div>
                                <div class="service__buttons">
                                    <button class="btn-reset service__buttons_bwhite"><?php the_sub_field('czena'); ?></button>
                                    <?php $ssylka = get_sub_field('ssylka'); ?>
                                    <?php if ($ssylka) : ?>
                                        <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>"><button class="btn-reset service__buttons_blue"><?php echo esc_html($ssylka['title']); ?></button></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <?php // echo 'false'; 
    ?>
<?php endif; ?>
<?php get_template_part('template-parts/pages/call'); ?>
<?php if (get_field('vklyuchit_blok_service_ooo') == 1) : ?>
    <section class="service">
        <div class="container">
            <div class="service__column">
                <div class="service__title">
                    <h2><?php the_field('zagolovok_service_ooo'); ?></h2>
                </div>
                <div class="service__items">
                    <?php if (have_rows('uslugi_service_ooo')) : ?>
                        <?php while (have_rows('uslugi_service_ooo')) : the_row(); ?>
                            <div class="service__item">
                                <div class="service__head"><?php the_sub_field('zagolovok'); ?></div>
                                <div class="service__subhead"><?php the_sub_field('tekst'); ?></div>
                                <div class="service__buttons">
                                    <button class="btn-reset service__buttons_bwhite"><?php the_sub_field('czena'); ?></button>
                                    <?php $ssylka = get_sub_field('ssylka'); ?>
                                    <?php if ($ssylka) : ?>
                                        <a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>"><button class="btn-reset service__buttons_blue"><?php echo esc_html($ssylka['title']); ?></button></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <?php // echo 'false'; 
    ?>
<?php endif; ?>
<section class="seo">
    <div class="container">
        <div class="seo__column">
            <div class="seo__title">
                <h2><?php the_field('zagolovok_dop'); ?></h2>
            </div>
            <div class="seo__text">
                <?php the_field('tekst_dop_uslug'); ?>
            </div>
        </div>
    </div>
</section>
<?php if (have_rows('blok_s_czenami')) : ?>
    <?php while (have_rows('blok_s_czenami')) : the_row(); ?>
        <?php if (get_sub_field('vklyuchit_blok') == 1) : ?>
            <section id="compare" class="compare">
                <div class="container">
                    <div class="compare__row">
                        <div class="compare__title">
                            <h3><?php the_sub_field('zagolovok_czeny_na_registracziyu_biznesa_h3'); ?></h3>
                        </div>
                        <div class="compare__inner">
                            <?php
                            $table = get_sub_field('tablicza_reg_biznesa');

                            if (!empty($table)) {

                                echo '<table border="0">';

                                if (!empty($table['caption'])) {

                                    echo '<caption>' . $table['caption'] . '</caption>';
                                }

                                if (!empty($table['header'])) {

                                    echo '<thead>';

                                    echo '<tr>';

                                    foreach ($table['header'] as $th) {

                                        echo '<th>';
                                        echo $th['c'];
                                        echo '</th>';
                                    }

                                    echo '</tr>';

                                    echo '</thead>';
                                }

                                echo '<tbody>';

                                foreach ($table['body'] as $tr) {

                                    echo '<tr>';

                                    foreach ($tr as $td) {

                                        echo '<td>';
                                        echo $td['c'];
                                        echo '</td>';
                                    }

                                    echo '</tr>';
                                }

                                echo '</tbody>';

                                echo '</table>';
                            }
                            ?>
                        </div>
                        <div class="compare__sldr">
                            <div class="compare__slider_<?php the_sub_field('id'); ?> swiper-container swiper">
                                <div class="compare__button-prev compare__button">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20" cy="19.9995" r="20" fill="#F9FAFB"></circle>
                                        <path d="M27 19.9995H13M13 19.9995L20 12.9995M13 19.9995L20 26.9995" stroke="#343433" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div class="swiper-wrapper">
                                    <!-- Ваши слайды с таблицей сюда -->
                                    <?php

                                    if (!empty($table)) {

                                        foreach ($table['body'] as $tr) {
                                            echo '<div class="swiper-slide">';
                                            echo '<div class="swiper-slide__head">' . $tr[0]['c'] . '</div>'; // Output the first column in each row
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- Добавьте стрелки навигации для переключения слайдов -->
                                <div class="compare__button-next compare__button">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20" cy="19.9995" r="20" fill="#F9FAFB"></circle>
                                        <path d="M13 19.9995H27M27 19.9995L20 12.9995M27 19.9995L20 26.9995" stroke="#343433" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>

                                <!-- Добавьте индикацию текущего слайда -->
                                <div class="swiper-scrollbar"></div>
                            </div>
                            <div class="swiper compare__thumbs_<?php the_sub_field('id'); ?>">
                                <div class="swiper-wrapper">
                                    <?php
                                    if (!empty($table)) {
                                        foreach ($table['body'] as $tr) {
                                            echo '<div class="swiper-slide">';
                                            for ($i = 1; $i < count($tr); $i++) {
                                                echo '<div class="swiper-slide__content">' . $tr[$i]['c'] . '</div>'; // Output all columns except the first one
                                            }
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="seo">
                <div class="container">
                    <div class="seo__column">
                        <div class="seo__text">
                            <?php the_sub_field('tekst_reg_biznesa'); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <?php // echo 'false'; 
            ?>
        <?php endif; ?>

    <?php endwhile; ?>
<?php else : ?>
    <?php // No rows found 
    ?>
<?php endif; ?>