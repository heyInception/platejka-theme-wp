jQuery(document).ready(function ($) {
	if (jQuery(window).width() < 1230) {
		var nav = $('.mob-menu');

		// Функция для обновления текста в кнопках "назад"
		function updateBackButtonText($subMenu, text) {
			var $backBtn = $subMenu.find('> .hide-sub-menu');
			if ($backBtn.length) {
				$backBtn.text(text);
			} else {
				// Если кнопки нет, создаем её
				var backButton = '<div class="hide-sub-menu">' + text + '</div>';
				$subMenu.prepend(backButton);
			}
		}

		// Рекурсивная функция для обработки всех уровней подменю
		function initSubMenuButtons($menuItem) {
			var $this = $menuItem;

			// Оборачиваем ссылку и добавляем переключатель (только если еще не обернуто)
			if (!$this.find('> .link-wrap').length) {
				$this.find('> a').wrapAll('<div class="link-wrap"></div>').after('<span class="submenu-toggle"></span>');
			}

			// Получаем подменю и текст родителя
			var $subMenu = $this.find('> .sub-menu');
			var parentText = $this.find('> .link-wrap a').text().trim();

			// Если есть подменю, добавляем кнопку "назад"
			if ($subMenu.length) {
				// Добавляем кнопку с текстом родителя
				updateBackButtonText($subMenu, parentText);
				$subMenu.addClass('has-back-button');

				// Рекурсивно обрабатываем дочерние подменю
				$subMenu.find('> li.menu-item-has-children').each(function () {
					initSubMenuButtons($(this));
				});
			}
		}

		// Инициализация всех меню (рекурсивно)
		$('#primary-menu > li.menu-item-has-children').each(function () {
			initSubMenuButtons($(this));
		});

		// Показываем подменю
		$(document).on("click", '.menu-item-has-children .submenu-toggle', function (e) {
			e.preventDefault();
			e.stopPropagation();

			var $this = $(this);
			var $parentLi = $this.closest('li.menu-item-has-children');
			var $currentSubMenu = $parentLi.find('> .sub-menu');

			// Добавляем класс для отслеживания открытых подменю
			$parentLi.addClass('opened-submenu');

			// Скрываем только соседние подменю (на том же уровне), но не родительские
			$parentLi.siblings().find('> .sub-menu').hide();
			$parentLi.siblings().removeClass('opened-submenu');

			// Показываем текущее подменю
			$currentSubMenu.show();

			// Обновляем текст кнопки "назад" во всех дочерних подменю
			$currentSubMenu.find('.menu-item-has-children').each(function () {
				var $childMenuItem = $(this);
				var $childSubMenu = $childMenuItem.find('> .sub-menu');

				if ($childSubMenu.length) {
					var childText = $childMenuItem.find('> .link-wrap a').text().trim();
					updateBackButtonText($childSubMenu, childText);
				}
			});

			// Определяем уровень подменю
			var parentSubMenuLevel = $parentLi.parents('.sub-menu').length;

			// Добавляем классы на nav в зависимости от уровня
			if (parentSubMenuLevel === 0) {
				nav.addClass('view-sub-menu');
				nav.removeClass('view-sub-sub-menu');
			} else {
				nav.addClass('view-sub-sub-menu');
				nav.removeClass('view-sub-menu');
			}
		});

		// Скрываем подменю
		$(document).on("click", '.hide-sub-menu', function (e) {
			e.preventDefault();
			e.stopPropagation();

			var $this = $(this);
			var $currentSubMenu = $this.closest('.sub-menu');
			var $parentLi = $currentSubMenu.closest('li.menu-item-has-children');
			var $parentSubMenu = $parentLi.closest('.sub-menu');

			// Скрываем текущее подменю
			$currentSubMenu.hide();
			$parentLi.removeClass('opened-submenu');

			// Если есть родительское подменю, показываем его
			if ($parentSubMenu.length) {
				$parentSubMenu.show();
				$parentSubMenu.closest('li.menu-item-has-children').addClass('opened-submenu');

				// Определяем уровень родительского подменю
				var parentLevel = $parentSubMenu.closest('li.menu-item-has-children').parents('.sub-menu').length;

				// Обновляем классы на nav
				if (parentLevel === 0) {
					nav.addClass('view-sub-menu');
					nav.removeClass('view-sub-sub-menu');
				} else {
					nav.addClass('view-sub-sub-menu');
					nav.removeClass('view-sub-menu');
				}
			} else {
				// Если это корневое подменю, удаляем классы
				nav.removeClass('view-sub-menu view-sub-sub-menu');
			}
		});

		// Закрываем все подменю при клике вне меню
		$(document).on('click', function (e) {
			if (!$(e.target).closest('.mob-menu').length) {
				$('.sub-menu').hide();
				$('.menu-item-has-children').removeClass('opened-submenu');
				nav.removeClass('view-sub-menu view-sub-sub-menu');
			}
		});
	}
});
document.querySelectorAll(".header__search svg").forEach((e => {
	e.addEventListener("click", (function () {
		document.querySelector(".search_desk").classList.toggle("search_open")
	}))
}));
if (jQuery(window).innerWidth() <= 1439) {
	jQuery(document).ready(function ($) {
		var $window = $(window), $target = $(".header__row_bottom"), $target_top = $(".header__row_top"),
			$target_header = $(".header"),
			$h = $target.offset().top; $window.on('scroll', function () {
				var scrollTop = window.pageYOffset || document.documentElement.scrollTop; if (scrollTop > $h) {
					$target.addClass("header__row_fixed"); $target_top.addClass("header__row_fixed-top");
					$target_header.addClass("header__fixed")
				} else {
					$target.removeClass("header__row_fixed"); $target_top.removeClass("header__row_fixed-top"); $target_header.removeClass("header__fixed")
				}
			})
	})
} else {
	jQuery(document).ready(function ($) {
		var $window = $(window), $target = $(".header__row_bottom"), $target_top = $(".header__row_top"),
			$target_header = $(".header"),
			$h = $target.offset().top; $window.on('scroll', function () {
				var scrollTop = window.pageYOffset || document.documentElement.scrollTop; if (scrollTop > $h) {
					$target.addClass("header__row_fixed");
					$target_header.addClass("header__fixed")
				} else {
					$target.removeClass("header__row_fixed");
					$target_header.removeClass("header__fixed")
				}
			})
	})
}
jQuery(document).ready(function ($) {
	let menu = $('.header__nav ul li.menu-item-has-children');
	menu.hover(function () {
		$(this).find('.sub-menu').stop(!0, !0).slideDown(500).css('display', 'flex')
	},
		function () {
			$(this).find('.sub-menu').stop(!0, !0).slideUp(500).css('display', 'flex')
		})
});
jQuery(function ($) {
	var searchTerm = ''; $('.search-input').keydown(function () { searchTerm = $.trim($(this).val()) });
	$('.search-input').keyup(function () {
		if ($.trim($(this).val()) != searchTerm) {
			searchTerm = $.trim($(this).val()); if (searchTerm.length > 2) {
				$.ajax({
					url: '/wp-admin/admin-ajax.php', type: 'POST', data: { 'action': 'ba_ajax_search', 'term': searchTerm }, beforeSend: function () {
						$('.result-search .result-search-list').fadeOut();
						$('.result-search .result-search-list').empty();
						$('.result-search .preloader').show()
					}, success: function (result) { $('.result-search .preloader').hide(); $('.result-search .result-search-list').fadeIn().html(result) }
				})
			}
		}
	}); $('.search-input').focusin(function () { $('.result-search').fadeIn() })
	$(document).mouseup(function (e) { if ((!$('.result-search').is(e.target) && $('.result-search').has(e.target).length === 0) && (!$('.search-input').is(e.target) && $('.search-input').has(e.target).length === 0)) { $('.result-search').fadeOut() } })
}); try { const faqItem = document.querySelector('.faq__items:first-child .faq__item:first-child'); const faqText = document.querySelector('.faq__items:first-child .faq__item:first-child .faq__text'); faqItem.classList.add('faq__item_active'); faqText.classList.add('faq__text_active'); const isMobile = window.matchMedia("(max-width: 1024px)").matches; if (isMobile) { document.querySelectorAll('a[href^="#"]').forEach(anchor => { anchor.addEventListener('click', function (e) { e.preventDefault(); const targetId = this.getAttribute('href'); const targetElement = document.querySelector(targetId); if (targetElement) { window.scrollTo({ top: targetElement.offsetTop - 110, behavior: 'smooth' }) } }) }) } else { document.querySelectorAll('a[href^="#"]').forEach(anchor => { anchor.addEventListener('click', function (e) { e.preventDefault(); const targetId = this.getAttribute('href'); const targetElement = document.querySelector(targetId); if (targetElement) { window.scrollTo({ top: targetElement.offsetTop - 20, behavior: 'smooth' }) } }) }) } } catch (error) { console.log(error) }