<section class="numbers">
    <div class="container">
        <div class="new-container">
            <div class="numbers__data">
                <p class="numbers__head"><?php the_field('zagolovok'); ?></p>
                <?php if (have_rows('spisok_numbers')) : ?>
                    <div class="numbers__list">
                        <?php while (have_rows('spisok_numbers')) : the_row(); ?>
                            <div class="numbers__item">
                                <p class="numbers__item-title"><?php the_sub_field('zagolovok'); ?></p>
                                <p class="numbers__item-text"><?php the_sub_field('tekst'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <?php // No rows found 
                    ?>
                <?php endif; ?>
            </div>
            <?php if (have_rows('osnovatel')) : ?>
                <div class="numbers__persona">
                    <?php while (have_rows('osnovatel')) : the_row(); ?>
                        <?php $foto = get_sub_field('foto'); ?>
                        <?php if ($foto) : ?>
                            <img class="numbers__photo lazy-img" src="<?php echo esc_url($foto['url']); ?>" alt="<?php echo esc_attr($foto['alt']); ?>" />
                        <?php endif; ?>
                        <div class="numbers__persona-about">
                            <p class="numbers__persona-head"><?php the_sub_field('fio'); ?></p>
                            <p class="numbers__persona-text"><?php the_sub_field('tekst_pod_fio'); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>