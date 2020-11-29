<?php

/**
 * Homepage Shortcodes
 * Vue components - src/js/components/pages/home
 */

/**
 *  Latest Custom
 */
function latestCustom()
{
    ob_start();

    $customPosts = get_posts([
        'post_type'         => 'custom-post',
        'posts_per_page'    => 3,
        // 'meta_key'          => 'custom_date',
        // 'orderby'           => 'meta_value',
        // 'order'             => 'DESC',
        // 'suppress_filters'  => true,
    ]);

    $data = [];
    foreach ($customPosts as $item) {
        $id = $item->ID;

        $data[] = [
            'id'        => $id,
            'title'     => get_the_title($id),
            'image'     => getPostFeaturedImage($id)[0],
            'excerpt'   => get_the_excerpt($id),
            'link'      => get_the_permalink($id),
            'day'       => get_the_date('d'),
            'month'     => get_the_date('F'),
        ];
    }

    $data = json_encode($data); ?>

    <latest-custom :data='<?= $data ?>' />

<?php return ob_get_clean();
}
add_shortcode('latest_custom', 'latestCustom');


/**
 *  Custom List
 */
function customLists()
{
    ob_start();

    $customPosts = get_posts([
        'post_type'         => 'custom-post',
        'posts_per_page'    => -1
    ]); ?>

    <custom-lists>
        <div class="custom-lists">
            <?php foreach ($customPosts as $item) {
                $id = $item->ID;
                $title = get_the_title($id);
                $image = getPostFeaturedImage($id)[0];
                $excerpt = get_the_excerpt($id);
                $link = get_the_permalink($id); ?>

                <custom-item image="<?= $image ?>" title="<?= $title ?>" excerpt="<?= $excerpt ?>" link="<?= $link ?>">
                </custom-item>

            <?php } ?>
        </div>
    </custom-lists>

<?php return ob_get_clean();
}
add_shortcode('custom_lists', 'customLists');
