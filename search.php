<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package platejka
 */

get_header();
?>

<main id="primary" class="site-main">

	<div class="container">
		<?php if (have_posts()) : ?>
			<section id="article" class="articles">
				<div class="container">
					<h1 class="articles__title">
						<?php
						/* translators: %s: search query. */
						printf(esc_html__('Результаты поиска по: %s', 'platejka'), '<span>' . get_search_query() . '</span>');
						?>
					</h1>
					<div class="articles__wrapper">
						<div class="articles__row">
						<?php
						/* Start the Loop */
						while (have_posts()) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part('template-parts/content', 'search');

						endwhile;

						the_posts_navigation();

					else :

						get_template_part('template-parts/content', 'none');

					endif;
						?>
						</div>
					</div>
				</div>
			</section>

	</div>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
