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
 * Template name: Платежный агент
 * @package platejka
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/pages/hero'); ?>
	<?php get_template_part('template-parts/pages/second-section'); ?>
	<?php get_template_part('template-parts/pages/rev'); ?>
	<?php get_template_part('template-parts/pages/spec'); ?>
	<?php get_template_part('template-parts/pages/why'); ?>
	<?php get_template_part('template-parts/pages/seo'); ?>
	<?php get_template_part('template-parts/pages/working'); ?>
	<?php get_template_part('template-parts/pages/ouradv'); ?>
	<?php get_template_part('template-parts/pages/wehelp'); ?>
	<?php get_template_part('template-parts/pages/calculate'); ?>
	<?php get_template_part('template-parts/pages/request'); ?>
	<?php get_template_part('template-parts/pages/faq'); ?>
	<?php get_template_part('template-parts/pages/call'); ?>
</main><!-- #main -->

<?php
get_footer();
