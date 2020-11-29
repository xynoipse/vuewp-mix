<?php

defined('ABSPATH') || exit;

get_header();

$postType = getSinglePostType();
$id = get_the_ID();
$title = get_the_title();
$featuredImage = getPostFeaturedImage($id)[0];

view('page-banner', [
    'banner_title' => $title,
    'banner_image' => $featuredImage
]); ?>

<div id="post-single" class="single-container">

    <div class="content-container container mb-5">
        <?php if (have_posts()) {
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        } ?>
    </div>

</div>

<?php

get_footer();
