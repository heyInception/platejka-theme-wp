<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package platejka
 */
$tags = wp_get_post_tags(get_the_ID());
if ($tags) {
	$htmlTags = '';
	$i = 0;
	$htmlTags .= '<div class="article__tags">';
	while ( $i < 3 ) {
		if (isset($tags[$i])) {
			$htmlTags .= '<a href="' . get_home_url() . '/tag/' . $tags[$i]->slug . '" class="article-tags__item">'. $tags[$i]->name . '</a>';
		}
		
		$i++;
	}
	$htmlTags .= '</div>';
}else{
	$htmlTags = '';
}
?>

<article id="post-<?php the_ID(); ?>" class="article__column">
	<div class="article__img"><?php platejka_post_thumbnail(); ?></div>
	<? echo $htmlTags; ?>
	<div class="article__head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
	<div class="article__wrap">
		<div class="article__date"><?php echo get_the_date('j F Y'); ?> г.</div>
		<div class="article__views"><?php echo pvc_post_views(); ?></div>
	</div>
</article>
