<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package platejka
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found">
		<div class="container">
			<h1 class="articles__title"><?php esc_html_e('Упс! Эту страницу невозможно найти.', 'platejka'); ?></h1>

			<div class="page-content">
				<p><?php esc_html_e('Похоже, по этому адресу ничего не найдено. Может быть, воспользуетесь одной из приведенных ниже ссылок или поиском?', 'platejka'); ?></p>
				<a href="<?php echo get_home_url(); ?>" class="articles__links">На главную</a>
			</div><!-- .page-content -->
		</div>
	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
