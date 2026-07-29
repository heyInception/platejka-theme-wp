<?php

/**
 * The template for displaying archive pages
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
	$countPosts = 12;
}

$heroPost = get_field('wz-first-section-article', $toCall);
if ($heroPost) {
	$heroCat = get_the_category($heroPost->ID)[0];
} else {
	// Handle the case where $heroPost is null
	echo '';
}
$current_cat_id = get_query_var('cat');
$current_cat_link = get_category_link($current_cat_id); // Получаем ссылку на текущую категорию
$current_cat = get_queried_object(); // Получаем объект текущей категории
$current_cat_name = $current_cat->slug;
$current_tags = get_term_by('slug', get_query_var('tag'), 'post_tag'); // Получаем текущее значение тега
?>

<main id="primary" class="site-main">
	<div class="container">
		<?php do_action('pretty_breadcrumb'); ?>
	</div>
	<section id="article" class="articles">
		<div class="container">
			<a href="<?php if(is_tag()) { 
				get_home_url();
			} else {
				echo esc_url($current_cat_link);
			} ?>">
				<h1 class="articles__title"><?php single_cat_title(); ?></h1>
			</a>
			<div class="articles__wrapper">
				<?php
				// Теперь учитываем как категорию, так и теги
				$args = array(
					'posts_per_page' => $countPosts,
					'orderby' => 'DESC',
					'tax_query' => array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => $current_cat_name,
						),
						array(
							'taxonomy' => 'post_tag',
							'field'    => 'slug',
							'terms'    => $current_tags ? $current_tags->slug : '',
						),
					),
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
					// Сообщение, если нет постов
					echo '<p>Посты не найдены.</p>';
				}
				wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
