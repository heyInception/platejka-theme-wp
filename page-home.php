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
 * Template name: главная
 * @package platejka
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/pages/hero'); ?>
	<?php get_template_part('template-parts/pages/service-block'); ?>
	<?php get_template_part('template-parts/pages/guarantees'); ?>
	<?php get_template_part('template-parts/pages/quiz'); ?>
	<?php get_template_part('template-parts/pages/notice'); ?>
	<?php get_template_part('template-parts/pages/calc'); ?>
	<?php if (have_rows('o_kompanii')): ?>
		<?php while (have_rows('o_kompanii')) : the_row(); ?>
			<?php if (get_row_layout() == 'a-about') : ?>
				<?php get_template_part('template-parts/pages/about/a-about'); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php else: ?>
		<?php // No layouts found 
		?>
	<?php endif; ?>
	<?php get_template_part('template-parts/pages/rev'); ?>
	<?php get_template_part('template-parts/pages/compare'); ?>
	<?php get_template_part('template-parts/pages/destinations'); ?>
	<?php get_template_part('template-parts/pages/about'); ?>
	<?php get_template_part('template-parts/pages/reviews'); ?>
	<?php get_template_part('template-parts/pages/international'); ?>
	<?php get_template_part('template-parts/pages/advantages'); ?>
	<?php get_template_part('template-parts/pages/features'); ?>
	<?php get_template_part('template-parts/pages/work'); ?>
	<?php get_template_part('template-parts/pages/process'); ?>
	<?php get_template_part('template-parts/pages/request'); ?>
	<?php get_template_part('template-parts/pages/faq'); ?>
	<?php get_template_part('template-parts/pages/call'); ?>

</main><!-- #main -->

<?php
get_footer();
