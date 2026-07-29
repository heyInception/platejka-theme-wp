<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package platejka
 */

get_header();
?>

<main id="primary" class="site-main <?php if (is_page(array(20, 22))) : ?>normal-page<?php endif; ?>">
	<div class="bread">
		<div class="container">
			<?php if (function_exists('yoast_breadcrumb')) { ?>
				<div class="breadcrumbs">
					<div class="breadcrumbs__row">
						<?php echo do_shortcode('[pretty_breadcrumb]'); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php if (is_page(20)) : ?>
		<?php get_template_part('template-parts/pages/hero'); ?>
		<?php get_template_part('template-parts/pages/price'); ?>
		<?php get_template_part('template-parts/pages/rev'); ?>
		<?php get_template_part('template-parts/pages/calc'); ?>
		<?php get_template_part('template-parts/pages/about'); ?>
		<?php get_template_part('template-parts/pages/seo'); ?>
		<?php get_template_part('template-parts/pages/faq'); ?>
	<?php elseif (is_page(22)) : ?>
		<?php get_template_part('template-parts/pages/hero'); ?>
		<?php get_template_part('template-parts/pages/second-section'); ?>
		<?php get_template_part('template-parts/pages/company'); ?>
		<?php get_template_part('template-parts/pages/spec'); ?>
		<?php get_template_part('template-parts/pages/service-block'); ?>
		<?php get_template_part('template-parts/pages/seo'); ?>
		<?php get_template_part('template-parts/pages/call'); ?>
	<?php elseif (!is_page(array(3, 1469, 5114, 5170))) : ?>
		<?php get_template_part('template-parts/pages/hero'); ?>
		<?php get_template_part('template-parts/pages/service-block'); ?>
		<?php get_template_part('template-parts/pages/second-section'); ?>
		<?php get_template_part('template-parts/pages/calc'); ?>
		<?php get_template_part('template-parts/pages/rev'); ?>
		<?php get_template_part('template-parts/pages/about'); ?>
		<?php get_template_part('template-parts/pages/slider'); ?>
		<?php get_template_part('template-parts/pages/spec'); ?>
		<?php get_template_part('template-parts/pages/seo'); ?>
		<?php if (have_rows('skvoznye_bloki')): ?>
			<?php while (have_rows('skvoznye_bloki')) : the_row(); ?>
				<?php if (get_row_layout() == 'destinations') : ?>
					<?php if (get_sub_field('vklyuchit_blok') == 1) : ?>
						<section class="destinations">
							<div class="container">
								<div class="destinations__column">
									<div class="destinations__title">
										<?php if (!get_field('zagolovok_destinations')) : ?>
											<h2><?php the_field('zagolovok_destinations', 24); ?></h2>
										<?php else : ?>
											<h2><?php the_field('zagolovok_destinations'); ?></h2>
										<?php endif; ?>
									</div>
									<?php if (!get_field('podzagolovok_destinations')) : ?>
										<div class="destinations__subtitle"><?php the_field('podzagolovok_destinations', 24); ?></div>
									<?php else : ?>
										<div class="destinations__subtitle"><?php the_field('podzagolovok_destinations'); ?></div>
									<?php endif; ?>

									<?php if (!have_rows('napravleniya_destinations')) : ?>
										<div class="destinations__items">
											<?php while (have_rows('napravleniya_destinations', 24)) : the_row(); ?>
												<?php $ssylka = get_sub_field('ssylka'); ?>
												<?php if ($ssylka) : ?>
													<a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>" class="destinations__item" rel="nofollow">
														<?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
														<?php if ($izobrazhenie) : ?>
															<img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
														<?php endif; ?>
														<span><?php the_sub_field('nazvanie'); ?></span>
													</a>
												<?php else: ?>
													<div class="destinations__item">
														<?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
														<?php if ($izobrazhenie) : ?>
															<img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
														<?php endif; ?>
														<span><?php the_sub_field('nazvanie'); ?></span>
													</div>
												<?php endif; ?>

											<?php endwhile; ?>
										</div>
									<?php else : ?>
										<div class="destinations__items">
											<?php while (have_rows('napravleniya_destinations')) : the_row(); ?>
												<div class="destinations__item">
													<?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
													<?php if ($izobrazhenie) : ?>
														<img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
													<?php endif; ?>
													<span><?php the_sub_field('nazvanie'); ?></span>
												</div>
											<?php endwhile; ?>
										</div>
									<?php endif; ?>
									<button class="destinations__btn btn-reset">Показать все</button>
								</div>
							</div>
						</section>
					<?php else : ?>
						<?php // echo 'false'; 
						?>
					<?php endif; ?>
				<?php elseif (get_row_layout() == 'work') : ?>
					<?php get_template_part('template-parts/pages/work-copy'); ?>
				<?php elseif (get_row_layout() == 'wtt') : ?>
					<?php if (get_sub_field('vklyuchit_blok') == 1) : ?>
						<?php get_template_part('template-parts/pages/calculate'); ?>
					<?php else : ?>
						<?php // echo 'false'; 
						?>
					<?php endif; ?>
				<?php elseif (get_row_layout() == 'reviews') : ?>
					<?php if (get_sub_field('vklyuchit_blok') == 1) : ?>
						<?php get_template_part('template-parts/pages/reviews'); ?>
					<?php else : ?>
						<?php // echo 'false'; 
						?>
					<?php endif; ?>
				<?php elseif (get_row_layout() == 'tariff') : ?>
					<?php get_template_part('template-parts/pages/tariffs'); ?>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php else: ?>
			<?php // No layouts found 
			?>
		<?php endif; ?>
		<?php get_template_part('template-parts/pages/clients'); ?>
		<?php get_template_part('template-parts/pages/faq'); ?>
		<?php get_template_part('template-parts/pages/call'); ?>
	<?php else : ?>
		<div class="container">
			<?php do_action('pretty_breadcrumb'); ?>
		</div>
		<section class="seo">
			<div class="container">
				<div class="seo__column">
					<div class="seo__title">
						<h1><?php the_title() ?></h1>
					</div>
					<div class="seo__text">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>


</main><!-- #main -->

<?php
get_footer();
