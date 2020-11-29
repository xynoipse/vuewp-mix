<?php

function customPostSearch()
{
    $data = json_decode(stripslashes($_POST['data']), true);
    $search = $data['search'];

    $query = new WP_Query([
        'post_type'         => 'custom-post',
        'posts_per_page'    => -1,
        'post_status'       => 'publish',
        'meta_query'        => [
            'relation' => 'OR',
            [
                'key'           => 'custom_text',
                'value'         =>  $search,
                'compare'       => 'LIKE',
            ],
            [
                'key'           => 'custom_date',
                'value'         =>  $search,
                'compare'       => 'LIKE',
            ],
        ],
    ]);

    $data = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
            $id = get_the_id();
            $title = get_the_title();
            $image = getPostFeaturedImage($id)[0];
            $text = get_field('custom_text', $id);
            $date = get_field('custom_date', $id);

            $data[] = [
                'id'        => $id,
                'title'     => [
                    'rendered' => $title
                ],
                '_embedded' => [
                    'wp:featuredmedia' => [
                        [
                            'source_url' => $image
                        ]
                    ]
                ],
                'acf'       => [
                    'custom_text' => $text,
                    'custom_date' => $date,
                ]
            ];

        endwhile;
    }

    echo json_encode($data);
    wp_die();
}
add_action('wp_ajax_customPostSearch', 'customPostSearch');
add_action('wp_ajax_nopriv_customPostSearch', 'customPostSearch');
