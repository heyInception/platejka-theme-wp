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
 * Template Name: Спасибо
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

</main><!-- #main -->

<?php
get_footer();
