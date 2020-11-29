<?php

function customCpt()
{
    $postType = 'custom-post';
    $slug = 'custom-posts';
    $taxonomy = 'custom-categories';
    $textDomain = 'vuewp-mix';

    /** Register Post Type */
    $labels = array(
        'name'               => _x('Custom Posts', $textDomain),
        'singular_name'      => _x('Custom Post', $textDomain),
        'add_new'            => _x('Add New Custom Post', $textDomain),
        'add_new_item'       => __('Add New Custom Post', $textDomain),
        'edit_item'          => __('Edit Custom Post', $textDomain),
        'new_item'           => __('New Custom Post', $textDomain),
        'view_item'          => __('View Custom Post', $textDomain),
        'search_items'       => __('Search Custom Posts', $textDomain),
        'not_found'          => __('No Custom Posts found', $textDomain),
        'not_found_in_trash' => __('No Custom Posts found in Trash', $textDomain),
        'parent_item_colon'  => __('Parent Custom Post:', $textDomain),
        'menu_name'          => __('Custom Posts', $textDomain),
    );
    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-admin-post',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => array('slug' => $slug),
        'capability_type'     => 'post',
        'supports'            => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'revisions',
        ),
    );
    register_post_type($postType, $args);

    /** Register Taxonomy */
    $labels = array(
        'name'                  => _x('Custom Categories', $textDomain),
        'singular_name'         => _x('Custom Category', $textDomain),
        'search_items'          => __('Search Custom Categories', $textDomain),
        'popular_items'         => __('Popular Custom Categories', $textDomain),
        'all_items'             => __('All Custom Categories', $textDomain),
        'parent_item'           => __('Parent Custom Category', $textDomain),
        'parent_item_colon'     => __('Parent Custom Category', $textDomain),
        'edit_item'             => __('Edit Custom Category', $textDomain),
        'update_item'           => __('Update Custom Category', $textDomain),
        'add_new_item'          => __('Add New Custom Category', $textDomain),
        'new_item_name'         => __('New Custom Category', $textDomain),
        'add_or_remove_items'   => __('Add or remove Custom Categories', $textDomain),
        'choose_from_most_used' => __('Choose from most used Custom Categories', $textDomain),
        'menu_name'             => __('Custom Category', $textDomain),
    );
    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'show_in_rest'      => false,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );
    register_taxonomy($taxonomy, array($postType), $args);

    /** Options Sub Page */
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page(array(
            'page_title'    => 'Custom Settings',
            'menu_title'    => 'Custom Settings',
            'menu_slug'     => 'custom-settings',
            'capability'    => 'manage_options',
            'parent_slug'   => "edit.php?post_type=$postType",
        ));
    };

    /** Pre get posts */
    add_action('pre_get_posts', function ($query) use ($postType) {
        if (is_admin()) return;

        if ($query->is_main_query() && is_post_type_archive($postType)) {
            $query->set('posts_per_page', 6);
        }

        return $query;
    });
}

add_action('init', 'customCpt');
