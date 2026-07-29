<?php

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package platejka
 */

?>

<section class="no-results not-found">
	<h1 class="page-title"><?php esc_html_e('Ничего не найдено', 'platejka'); ?></h1>

	<div class="page-content">
		<?php
		if (is_home() && current_user_can('publish_posts')) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__('Готовы опубликовать свой первый пост? <a href="%1$s">Начать можно здесь</a>', 'platejka'),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url(admin_url('post-new.php'))
			);

		elseif (is_search()) :
		?>

			<p><?php esc_html_e('Извините, но ваши поисковые запросы не совпадают. Пожалуйста, попробуйте еще раз, используя другие ключевые слова.', 'platejka'); ?></p>
		<?php

		else :
		?>

			<p><?php esc_html_e('Похоже, мы не можем найти то, что вы ищете. Возможно, поиск может помочь.', 'platejka'); ?></p>
		<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->