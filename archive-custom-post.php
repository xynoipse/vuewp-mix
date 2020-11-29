<?php

defined('ABSPATH') || exit;

get_header();

$postType = getArchivePostType();
$taxonomy = 'custom-categories';
$categories = getCategories($taxonomy);

view('page-banner', [
    'banner_image' => get_field('custom_page_banner_image', 'options'),
    'banner_title' => get_field('custom_page_banner_title', 'options')
]);

?>

<div id="archive" class="archive-container mb-5">
    <div class="container">
        <custom-archive>
            <div class="custom-lists row">
                <?php if (have_posts()) {
                    while (have_posts()) : the_post();
                        $id = $post->ID;
                        $title = get_the_title();
                        $image = getPostFeaturedImage($id)[0];
                        $day = get_the_date('d');
                        $month = get_the_date('F');
                        $link = get_the_permalink(); ?>

                        <custom-item title="<?= $title ?>" image="<?= $image ?>" link="<?= $link ?>" day="<?= $day ?>" month="<?= $month ?>"></custom-item>

                <?php endwhile;
                } ?>
            </div>
        </custom-archive>
    </div>
</div>

<?php

get_footer();
