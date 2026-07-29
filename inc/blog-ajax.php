<?php
add_action('wp_ajax_get_articles_blog', 'get_articles_blog');
add_action('wp_ajax_nopriv_get_articles_blog', 'get_articles_blog');
function get_articles_blog()
{
	$result = '';

	if (wp_is_mobile()) {
		$posts_per_page = 2;
	} else {
		$posts_per_page = 6;
	}

	if (array_key_exists('cat', $_GET)) {
		$cat = $_GET['cat'];
		$formatted_cat = str_replace(" ", ",", $cat);
	}

	if (array_key_exists('page', $_GET)) {
		$current_page = $_GET['page'];
	}

	$args = array(
		'posts_per_page' => $posts_per_page,
		'orderby' => 'DESC',
		'category_name' => $formatted_cat,
		'offset' => 3 + $current_page * $posts_per_page
	);

	$query = new WP_Query($args);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$result .= get_template_part('template-parts/content-single', 'card');
		}
	}

	$json = json_encode($result, JSON_HEX_QUOT | JSON_HEX_TAG);

	echo $result;
	wp_die();
}


/*
 * Добавление пересенной с адресом admin-ajax.php для файла javascript Ajax во фронтэнде
 */
add_action('wp_enqueue_scripts', 'myajax_data', 99);
function myajax_data()
{
	wp_localize_script(
		'jquery',
		'myajax',
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);
}



function get_related_category_posts()
{
	// Check if we are on a single page, ift, return false
	if (!is_single())
		return false;

	// Get the current post id
	$post_id = get_queried_object_id();

	// Get the post categories
	$categories = get_the_category($post_id);

	// Lets build our array
	// If we don have categories, bail
	if (!$categories)
		return false;

	foreach ($categories as $category) {
		if ($category->parent == 0) {
			$term_ids[] = $category->term_id;
		} else {
			$term_ids[] = $category->parent;
			$term_ids[] = $category->term_id;
		}
	}

	// Remove duplicate values from the array
	$unique_array = array_unique($term_ids);

	// Lets build our query
	$args = [
		'post__not_in' => [$post_id],
		'posts_per_page' => 3, // Note: showposts is depreciated in favor of posts_per_page
		'ignore_sticky_posts' => 1, // Note: caller_get_posts is depreciated
		'orderby' => 'DESC',
		'no_found_rows' => true,
		'tax_query' => [
			[
				'taxonomy' => 'category',
				'terms' => $unique_array,
				'include_children' => false,
			],
		],
	];
	$q = new WP_Query($args);
	return $q;
}
