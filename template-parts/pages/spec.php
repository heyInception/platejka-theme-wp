<?php if ( get_field( 'vklyuchit_blok_spec' ) == 1 ) : ?>
	<section class="spec">
  <div class="container">
    <div class="spec__row">
      <div class="spec__title">
        <?php if (get_field('zagolovok_spec')) : ?>
            <h2><?php the_field('zagolovok_spec'); ?></h2>
          <?php else : ?>
            <h2><?php the_field('zagolovok_spec', 24); ?></h2>
          <?php endif; ?>
      </div>
      <div class="tabs spec__tabs" data-tabs="spec">
        <ul class="list-reset tabs__nav">
          <?php if (have_rows('speczialisty_spec', 24)) : ?>
            <?php while (have_rows('speczialisty_spec', 24)) : the_row(); ?>
              <li class="tabs__nav-item"><button class="btn-reset tabs__nav-btn" type="button"><?php the_sub_field('professiya'); ?></button></li>
            <?php endwhile; ?>
          <?php else : ?>
            <?php // No rows found 
            ?>
          <?php endif; ?>
        </ul>
        <div class="spec__select">
          <label for="specialization"></label>
          <select id="specialization">
            <?php if (have_rows('speczialisty_spec', 24)) : $i = 0; ?>
              <?php while (have_rows('speczialisty_spec', 24)) : the_row(); $i++; ?>
                <option value="spec<?php echo $i; ?>"><?php the_sub_field('professiya'); ?></option>
              <?php endwhile; ?>
            <?php else : ?>
              <?php // No rows found 
              ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="tabs__content">
          <?php if (have_rows('tabs', 24)) : ?>
            <?php while (have_rows('tabs', 24)) : the_row(); ?>
              <div class="tabs__panel">
                <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                <?php if ($izobrazhenie) : ?>
                  <div class="spec__img">
                    <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                  </div>
                <?php endif; ?>
                <div class="spec__wrap">
                  <div class="spec__head"><?php the_sub_field('imya'); ?></div>
                  <div class="spec__year"><?php the_sub_field('god'); ?></div>
                  <div class="spec__text"><?php the_sub_field('tekst'); ?>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
            <?php // No rows found 
            ?>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>
<?php else : ?>
	<?php // echo 'false'; ?>
<?php endif; ?>