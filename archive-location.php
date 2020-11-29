<?php

defined('ABSPATH') || exit;

get_header();

$postType = getArchivePostType();
$taxonomy = 'locations-categories';
$categories = getCategories($taxonomy);

view('page-banner', [
    'banner_image' => get_field('locations_page_banner_image', 'options'),
    'banner_title' => get_field('locations_page_banner_title', 'options')
]);

?>

<div id="locations" class="locations-container mb-5">
    <div class="container">

        <locations></locations>

    </div>
</div>

<?php

get_footer();
