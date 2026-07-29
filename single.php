<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package platejka
 */

get_header();
$tags = wp_get_post_tags(get_the_ID());
if ($tags) {
	$htmlTags = '';
	$htmlTags .= '<div class="wz-content__tags">';
	foreach ($tags as $tag) {
		$htmlTags .= '<a href="' . get_home_url() . '/tag/' . $tag->slug . '" class="wz-content__tags--item">' . $tag->name . '</a>';
	}
	$htmlTags .= '</div>';
} else {
	$htmlTags = '';
}
?>

<main id="primary" class="site-main site-main-mt main">
	<div class="main__column">
		<div class="container">
			<?php if (function_exists('yoast_breadcrumb')) { ?>
				<div class="breadcrumbs">
					<div class="breadcrumbs__row">
						<?php echo do_shortcode('[pretty_breadcrumb]'); ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<section class="category category_single">
			<div class="container">
				<div class="category__wrap category__wrap_single">
					<div class="category__date"><?php echo get_the_date(); ?></div>
					<div class="category__views"><?php echo pvc_post_views(); ?></div>
				</div>
			</div>
		</section>
		<div class="container">
			<div class="main__title">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="wz-content">
				<div class="wz-content__img">
					<?php platejka_post_thumbnail(); ?>
				</div>
				<div class="wz-content__row">
					<div class="wz-content__wrap">
						<section class="like">
							<div class="like__wrap">
								<div class="like__share">
									<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect width="32" height="32" rx="3.2" fill="#EFEFF2" />
										<path d="M23 15.0667L17.5556 9V12.4667C12.1111 13.3333 9.77778 17.6667 9 22C10.9444 18.9667 13.6667 17.58 17.5556 17.58V21.1333L23 15.0667Z" fill="#202227" />
									</svg>
									<span>Поделиться</span>
									<div class="list-reset social" title="Соц. сети">
										<?php if (have_rows('socz_seti_all', 'option')) : ?>
											<?php while (have_rows('socz_seti_all', 'option')) : the_row(); ?>
												<?php $ssylka = get_sub_field('ssylka'); ?>
												<?php if ($ssylka) : ?>
													<li class="social__item">
														<a href="<?php echo esc_url($ssylka['url']); ?>" target="<?php echo esc_attr($ssylka['target']); ?>" class="social__link <?php the_sub_field('class'); ?>" aria-label="<?php echo esc_html($ssylka['title']); ?>"><?php echo esc_html($ssylka['title']); ?></a>
													</li>
												<?php endif; ?>
											<?php endwhile; ?>
										<?php else : ?>
											<?php // No rows found 
											?>
										<?php endif; ?>
										<div class="social__item">
											<a href="#" id="copyButton" target="_blank" class="social__link social__link--copy" aria-label="Скопировать ссылку" onclick="return false;">
												Скопировать ссылку
											</a>
											<div id="copyNotification" class="notification">Ссылка скопирована!</div>
										</div>
									</div>
								</div>
							</div>
						</section>
						<?php
						while (have_posts()) :
							the_post();

							get_template_part('template-parts/content', get_post_type());
						?>
						<?php

						endwhile; // End of the loop.
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
