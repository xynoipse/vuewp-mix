<?php

defined('ABSPATH') || exit;

get_header();

$title = get_the_title();
$featuredImage = getPostFeaturedImage($id)[0];

view('page-banner', [
    'banner_title' => $title,
    'banner_image' => $featuredImage
]);

if (have_posts()) {
    while (have_posts()) : the_post();
        the_content();
    endwhile;
}

get_footer();
