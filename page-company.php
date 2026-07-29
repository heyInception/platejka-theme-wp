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
 * Template name: О компании
 * @package platejka
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php if (have_rows('o_kompanii')): ?>
		<?php while (have_rows('o_kompanii')) : the_row(); ?>


			<?php if (get_row_layout() == 'first_screen') : ?>
				<?php get_template_part('template-parts/pages/about/a-hero'); ?>
			<?php elseif (get_row_layout() == 'v-contacts') : ?>
				<?php get_template_part('template-parts/pages/about/a-contacts'); ?>
			<?php elseif (get_row_layout() == 'a-about') : ?>
				<?php get_template_part('template-parts/pages/about/a-about'); ?>
			<?php elseif (get_row_layout() == 'v-service') : ?>
				<?php get_template_part('template-parts/pages/about/a-service'); ?>
			<?php elseif (get_row_layout() == 'exhibitions') : ?>
				<?php get_template_part('template-parts/pages/about/a-exhibitions'); ?>
			<?php elseif (get_row_layout() == 'v-stage') : ?>
				<?php get_template_part('template-parts/pages/about/a-stage'); ?>
			<?php elseif (get_row_layout() == 'v-form') : ?>
				<?php get_template_part('template-parts/pages/company/v-form'); ?>
			<?php elseif (get_row_layout() == 'v-slider') : ?>
				<?php get_template_part('template-parts/pages/about/v-slider'); ?>
			<?php elseif (get_row_layout() == 'v-staff') : ?>
				<?php get_template_part('template-parts/pages/about/v-staff'); ?>
			<?php elseif (get_row_layout() == 'v-spec') : ?>
				<?php get_template_part('template-parts/pages/about/v-spec'); ?>
			<?php endif; ?>

		<?php endwhile; ?>
	<?php else: ?>
		<?php // No layouts found 
		?>
	<?php endif; ?>







</main><!-- #main -->
<script src="https://api-maps.yandex.ru/2.1/?apikey=f0ea8217-775f-491e-bb80-41f935262ea4&lang=ru_RU"
	type="text/javascript"></script>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", () => {
		ymaps.ready(init);

		function init() {
			// Координаты метки
			var coords = [55.921612, 37.534927];

			// Определяем отступы в зависимости от ширины экрана
			const breakpointDesktop = window.matchMedia('(max-width: 1230px)');
			const breakpointMobile = window.matchMedia('(max-width: 768px)');

			var x1 = breakpointDesktop.matches ? 300 : 900;
			var y1 = 350;

			// Для мобильных устройств
			if (breakpointMobile.matches) {
				x1 = 200;
				y1 = 200;
			}

			var myMap = new ymaps.Map('yamap', {
				center: coords,
				zoom: 16,
				controls: []
			}, {
				suppressMapOpenBlock: true
			});

			// Указываем URL иконки
			var iconUrl = 'https://platejka.com/wp-content/uploads/2026/02/map.png';

			// Параметры иконки ВНЕ объекта свойств метки
			var placemarkOptions = {
				// Важно: параметры иконки указываются как третий параметр конструктора Placemark
				// или вторым параметром в options при создании
				iconLayout: 'default#image',
				iconImageHref: iconUrl,
				iconImageSize: [40, 40], // Укажите реальные размеры вашей иконки
				iconImageOffset: [-20, -40] // Центрирование иконки (половина ширины и полная высота)
			};

			// Способ 1: Правильное создание метки
			var placemark = new ymaps.Placemark(coords, {
				balloonContentHeader: '<a href="https://platejka.com/" class="contacts__head" rel="noopener noreferrer" style="font-family: var(--font-family);font-weight: 600;font-size: 24px;line-height: 110%;letter-spacing: -0.03em;background: linear-gradient(47deg, #106907 0%, #228d18 100%);background-clip: text;-webkit-background-clip: text;-webkit-text-fill-color: transparent;">Платёжка</a><br>' +
					'<span class="description">Международные платежи<br/> за 1 день для Вашего бизнеса</span>',
				balloonContentBody: 'г. Москва, Технопарк «Физтехпарк»,<br/> Долгопрудненское шоссе, д. 3.<br/> ' +
					'<a href="tel:+7 800 533-88-19">+7 800 533-88-19</a><br/>' +
					'<a href="mailto:a@platejka.com">a@platejka.com</a> <br/>'
			}, placemarkOptions); // Третий параметр - опции иконки!

			myMap.geoObjects.add(placemark);

			// Открываем балун только после добавления на карту

			// Для отладки: проверяем, какая иконка установлена
			console.log('Параметры иконки:', placemark.options.get('iconLayout'));
			console.log('URL иконки:', placemark.options.get('iconImageHref'));

			// Функция для обновления отступов
			function mapOffset() {
				var pixelCoords = myMap.options.get('projection').toGlobalPixels(coords, myMap.getZoom());
				var mapSize = myMap.container.getSize();
				myMap.setGlobalPixelCenter([
					pixelCoords[0] + mapSize[0] / 2 - x1,
					pixelCoords[1] + mapSize[1] / 2 - y1
				]);
			}

			const isMobile = window.matchMedia('(max-width: 768px)').matches;
			if (isMobile) {
				placemark.balloon.close();
			}

			// Обработчик изменения размера окна
			function handleResize() {
				const isMobile = window.matchMedia('(max-width: 768px)').matches;
				const isTablet = window.matchMedia('(max-width: 1230px)').matches;

				if (isMobile) {
					x1 = 200;
					y1 = 270;
				} else {
					x1 = isTablet ? 300 : 900;
					y1 = 350;
				}

				mapOffset();
			}

			// Инициализация и подписка на события
			mapOffset();
			myMap.events.add('boundschange', mapOffset);
			window.addEventListener('resize', handleResize);
		}
	});
</script>
<?php
get_footer();
