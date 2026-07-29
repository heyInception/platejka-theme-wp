<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package platejka
 */

get_header();


if (!is_tax()) {
	$toCall = 22;
}

if (wp_is_mobile()) {
	$countPosts = 2;
} else {
	$countPosts = 4;
}

$heroPost = get_field('wz-first-section-article', $toCall);

if ($heroPost) {
	$heroCat = get_the_category($heroPost->ID)[0];
} else {
	// Handle the case where $heroPost is null
	echo '';
}
?>

<main id="primary" class="site-main">
	<div class="container">
		<?php do_action('pretty_breadcrumb'); ?>
		<div class="hero__title articles">
			<h1><?php single_post_title(); ?></h1>
		</div>
	</div>
	<section id="article" class="articles">
		<div class="container">
			<a href="<? echo get_home_url() . '/category/internet-buhgalteriya/' ?>">
				<h2 class="articles__title">Интернет-бухгалтерия</h2>
			</a>
			<div class="articles__wrapper">
				<?php
				$args = array(
					'posts_per_page' => $countPosts,
					'orderby' => 'DESC',
					'category_name' => 'internet-buhgalteriya'
				);
				$query = new WP_Query($args);
				if ($query->have_posts()) {
				?>
					<div class="articles__row">
						<?php
						while ($query->have_posts()) {
							$query->the_post();
							get_template_part('template-parts/content-single', 'card');
						}
						?>
					</div>
				<?php
				} else {
				}
				wp_reset_postdata(); ?>
			</div>
			<?php $count = $query->found_posts; ?>
			<?php if (wp_is_mobile()) { ?>
				<?php if ($count >= $countPosts) :  ?>
					<button class="articles__call-more" data-cat="internet-buhgalteriya" data-page="0">Показать ещё</button>
				<?php endif; ?>
			<?php } else { ?>
				<?php if ($count >= $countPosts) :  ?>
					<button class="articles__call-more" data-cat="internet-buhgalteriya" data-page="0">Показать ещё</button>
				<?php endif; ?>
			<?php } ?>
		</div>
	</section>
	<section id="cases" class="articles">
		<div class="container">
			<a href="<? echo get_home_url() . '/category/buhgalterskie-uslugi/' ?>">
				<h2 class="articles__title">Бухгалтерские услуги</h2>
			</a>
			<div class="articles__wrapper">
				<?php
				$args = array(
					'posts_per_page' => $countPosts,
					'orderby' => 'DESC',
					'category_name' => 'buhgalterskie-uslugi'
				);
				$query = new WP_Query($args);
				if ($query->have_posts()) {
				?>
					<div class="articles__row">
						<?php
						while ($query->have_posts()) {
							$query->the_post();
							get_template_part('template-parts/content-single', 'card');
						}
						?>
					</div>
				<?php
				} else {
				}
				wp_reset_postdata(); ?>
			</div>
			<?php $count = $query->found_posts; ?>
			<?php if (wp_is_mobile()) { ?>
				<?php if ($count >= $countPosts) :  ?>
					<button class="articles__call-more" data-cat="buhgalterskie-uslugi" data-page="0">Показать ещё</button>
				<?php endif; ?>
			<?php } else { ?>
				<?php if ($count >= $countPosts) :  ?>
					<button class="articles__call-more" data-cat="buhgalterskie-uslugi" data-page="0">Показать ещё</button>
				<?php endif; ?>
			<?php } ?>
		</div>
	</section>
	<section id="mass-media" class="articles">
		<div class="container">
			<a href="<? echo get_home_url() . '/category/news/' ?>">
				<h2 class="articles__title">Новости</h2>
			</a>
			<div class="articles__wrapper">
				<?php
				$args = array(
					'posts_per_page' => $countPosts,
					'orderby' => 'DESC',
					'category_name' => 'news'
				);
				$query = new WP_Query($args);
				if ($query->have_posts()) {
				?>
					<div class="articles__row">
						<?php
						while ($query->have_posts()) {
							$query->the_post();
							get_template_part('template-parts/content-single', 'card');
						}
						?>
					</div>
				<?php
				} else {
				}
				wp_reset_postdata(); ?>
			</div>
			<?php $count = $query->found_posts; ?>
			<?php if (wp_is_mobile()) { ?>
				<?php if ($count >= $countPosts) :  ?>
					<button class="articles__call-more" data-cat="news" data-page="0">Показать ещё</button>
				<?php endif; ?>
			<?php } else { ?>
				<?php if ($count >= $countPosts) :  ?>
					<button class="articles__call-more" data-cat="news" data-page="0">Показать ещё</button>
				<?php endif; ?>
			<?php } ?>
		</div>
	</section>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
