<?php

/**
 * platejka functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package platejka
 */
if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function platejka_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on platejka, use a find and replace
		* to change 'platejka' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('platejka', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'platejka'),
			'menu-2' => esc_html__('Mobile', 'platejka'),
			'menu-3' => esc_html__('Услуги 1', 'platejka'),
			'menu-4' => esc_html__('Услуги 2', 'platejka'),
			'menu-5' => esc_html__('Услуги 3', 'platejka'),
			'menu-6' => esc_html__('Услуги 4', 'platejka'),
			'menu-7' => esc_html__('Услуги 5', 'platejka'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'platejka_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'platejka_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function platejka_content_width()
{
	$GLOBALS['content_width'] = apply_filters('platejka_content_width', 640);
}
add_action('after_setup_theme', 'platejka_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function platejka_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'platejka'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'platejka'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'platejka_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function platejka_scripts()
{

	wp_style_add_data('platejka-style', 'rtl', 'replace');

	wp_enqueue_style('platejka-vendor', get_stylesheet_directory_uri() . '/css/vendor.css');
	wp_enqueue_style('platejka-main', get_stylesheet_directory_uri() . '/css/main.css');
	wp_enqueue_style('platejka-about', get_stylesheet_directory_uri() . '/css/about.css');
	wp_enqueue_style('platejka-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_script('platejka-main-js', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true);
	wp_enqueue_script('search', get_template_directory_uri() . '/js/search.js', array('jquery'), false, true);
	wp_enqueue_script('leader-line', get_template_directory_uri() . '/js/leader-line.min.js', array('jquery'), false, true);
	wp_enqueue_script('platejka-navigation', get_template_directory_uri() . '/js/navigation.js',  array('jquery'), _S_VERSION, true);
	if (is_home() || is_single()) {
		wp_enqueue_script('wazzup-js-blog-TweenMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js', array(), _S_VERSION, true);
	}
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'platejka_scripts');

require get_template_directory() . '/inc/countries.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


require get_template_directory() . '/inc/blog-ajax.php';

require get_template_directory() . '/inc/yoast-breadcrumbs.php';



function artabr_opengraph_fix_yandex($lang)
{
	$lang_prefix = 'prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article# profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#"';
	$lang_fix = preg_replace('!prefix="(.*?)"!si', $lang_prefix, $lang);
	return $lang_fix;
}
add_filter('language_attributes', 'artabr_opengraph_fix_yandex', 20, 1);

add_filter('get_search_form', 'ba_search_form');
function ba_search_form($form)
{
	$form = '
	 <div class="container">
					<form role="search" method="get" action="' . home_url('/') . '">
						<input type="text" value="' . get_search_query() . '" name="s" class="input-search search-input"  placeholder="Поиск по сайту">
						<button type="submit">
						</button>
					</form>
				</div>
				<div class="container">
				<div class="result-search">
					<div class="preloader"><img src="' . get_bloginfo('template_directory') . '/img/loader.gif" class="loader" alt="Загрузка">
					</div>
					<div class="result-search-list"></div>
				</div>
				</div> ';
	return $form;
}

function ba_ajax_search()
{
	$args = array(
		's' => $_POST['term'],
		'posts_per_page' => 5
	);
	$the_query = new WP_Query($args);
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
?>
			<div class="result_item clear">
				<?php
				if (has_post_thumbnail()) {
					the_post_thumbnail(array('class' => 'post_thumbnail'));
				} else {
				?>
				<?php } ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
		<?php
		}
	} else {
		?>
		<div class="result_item">
			<span class="not_found">Ничего не найдено, попробуйте другой запрос</span>
		</div>
<?php
	}
	exit;
}
add_action('wp_ajax_nopriv_ba_ajax_search', 'ba_ajax_search');
add_action('wp_ajax_ba_ajax_search', 'ba_ajax_search');


add_filter('wpseo_canonical', 'removeCanonicalArchivePagination');
function removeCanonicalArchivePagination($link)
{
	$link = preg_replace('#\\??/page[\\/=]\\d+#', '', $link);
	return $link;
}

if (!function_exists('avf_add_page_number_to_title')) {
	function avf_add_page_number_to_title($s)
	{
		global $page;
		$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		!empty($page) && 1 < $page && $paged = $page;

		$paged > 1 && $s .= ' - ' . sprintf(__('Page %s'), $paged);

		return $s;
	}

	add_filter('wpseo_metadesc', 'avf_add_page_number_to_title', 100, 1);
	add_filter('wpseo_title', 'avf_add_page_number_to_title', 100, 1);
}

add_filter('disable_wpseo_json_ld_search', '__return_true');


// Добавление атрибута rel="nofollow" ко всем исходящим ссылкам
function add_nofollow_to_external_links($content)
{
	return preg_replace_callback('/<a[^>]*href\s*=\s*["\']([^"\']*)["\'][^>]*>/i', function ($matches) {
		$href = $matches[1];

		if (strpos($href, home_url()) === false && strpos($href, '://') !== false) {
			return str_replace('<a', '<a rel="nofollow"', $matches[0]);
		} else {
			return $matches[0];
		}
	}, $content);
}

add_filter('the_content', 'add_nofollow_to_external_links', 999);

function restrict_category_indexing()
{
	if (is_category() || is_tag()) {
		echo '<meta name="robots" content="noindex, nofollow">';
	}
}
add_action('wp_head', 'restrict_category_indexing');

// a) The debug function to generate the console error message. 

function debug_cf7_add_error($items, $result)
{
	if ('mail_failed' == $result['status']) {
		// invoke global phpmailer object
		global $phpmailer;
		// append error info to ajax response.
		$items['errorInfo'] = $phpmailer->ErrorInfo;
	}
	return $items;
}
add_action('wpcf7_ajax_json_echo', 'debug_cf7_add_error', 10, 2);


// b) Did not work for me. 
add_filter('wpcf7_spam', '__return_false');

// c) There is another filter for the boolean used in the control statement. This successfully disabled the spam check of CF7 for me. 
add_filter('wpcf7_skip_spam_check', '__return_true');


add_filter('wpcf7_autop_or_not', '__return_false');





add_filter( 'the_content', 'modify_page_2054_content' );
add_filter( 'wp_nav_menu_items', 'modify_page_2054_content', 10, 2 );
add_filter( 'acf/format_value', 'modify_acf_content', 10, 3 );
add_filter( 'acf/load_value', 'modify_acf_content', 10, 3 );

// Для ACF полей в опциях (option)
add_filter( 'acf/load_value/type=text', 'modify_acf_option_content', 20, 3 );
add_filter( 'acf/load_value/type=textarea', 'modify_acf_option_content', 20, 3 );
add_filter( 'acf/load_value/type=wysiwyg', 'modify_acf_option_content', 20, 3 );

function modify_page_2054_content( $content, $args = null ) {
    if ( is_page( 2054 ) ) {
        return replace_translation_words( $content );
    }
    return $content;
}

function modify_acf_content( $value, $post_id, $field ) {
    if ( is_page( 2054 ) && is_string( $value ) ) {
        return replace_translation_words( $value );
    }
    return $value;
}

function modify_acf_option_content( $value, $post_id, $field ) {
    // Для полей в настройках темы (option)
    if ( strpos( $post_id, 'option' ) !== false && is_page( 2054 ) && is_string( $value ) ) {
        return replace_translation_words( $value );
    }
    return $value;
}

function replace_translation_words( $text ) {
    if ( empty( $text ) || ! is_string( $text ) ) {
        return $text;
    }

    // Заменяем точные слова с границами \b
    $text = preg_replace( '/\bпереводов\b/u', '<span class="perevodov"></span>', $text );
    $text = preg_replace( '/\bпереводы\b/u', '<span class="perevods"></span>', $text );
	$text = preg_replace( '/\bПереводы\b/u', '<span class="perevodsUp"></span>', $text );
    $text = preg_replace( '/\bперевод\b/u', '<span class="perevod"></span>', $text );
    $text = preg_replace( '/\переводом\b/u', '<span class="perevodom"></span>', $text );

    return $text;
}

// Функция проверки поисковых ботов
function is_search_bot() {
    if (empty($_SERVER['HTTP_USER_AGENT'])) {
        return false;
    }

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $bots = array('Googlebot', 'YandexBot', 'YandexAccessibilityBot', 'YandexMobileBot',
                  'Googlebot-Image', 'YandexImages', 'Mail.RU_Bot', 'bingbot', 'Baiduspider',
                  'FacebookExternalHit', 'Twitterbot', 'WhatsApp', 'TelegramBot');

    foreach ($bots as $bot) {
        if (stripos($user_agent, $bot) !== false) {
            return true;
        }
    }

    return false;
}

add_filter( 'wpseo_json_ld_output', '__return_false' );
