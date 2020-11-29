<?php

function locationsCpt()
{
    $post_type = 'location';
    $slug = 'locations';
    $taxonomy = 'locations-categories';
    $textDomain = 'vuewp-mix';

    /** Register Post Type */
    $labels = array(
        'name'               => _x('Locations', $textDomain),
        'singular_name'      => _x('Location', $textDomain),
        'add_new'            => _x('Add New Location', $textDomain),
        'add_new_item'       => __('Add New Location', $textDomain),
        'edit_item'          => __('Edit Location', $textDomain),
        'new_item'           => __('New Location', $textDomain),
        'view_item'          => __('View Location', $textDomain),
        'search_items'       => __('Search Locations', $textDomain),
        'not_found'          => __('No Locations found', $textDomain),
        'not_found_in_trash' => __('No Locations found in Trash', $textDomain),
        'parent_item_colon'  => __('Parent Location:', $textDomain),
        'menu_name'          => __('Locations', $textDomain),
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
        'menu_icon'           => 'dashicons-location-alt',
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
            'thumbnail',
            'excerpt',
            'revisions',
        ),
    );
    register_post_type($post_type, $args);

    /** Register Taxonomy */
    $labels = array(
        'name'                  => _x('Location Categories', $textDomain),
        'singular_name'         => _x('Location Category', $textDomain),
        'search_items'          => __('Search Location Categories', $textDomain),
        'popular_items'         => __('Popular Location Categories', $textDomain),
        'all_items'             => __('All Location Categories', $textDomain),
        'parent_item'           => __('Parent Location Category', $textDomain),
        'parent_item_colon'     => __('Parent Location Category', $textDomain),
        'edit_item'             => __('Edit Location Category', $textDomain),
        'update_item'           => __('Update Location Category', $textDomain),
        'add_new_item'          => __('Add New Location Category', $textDomain),
        'new_item_name'         => __('New Location Category Name', $textDomain),
        'add_or_remove_items'   => __('Add or remove Location Categories', $textDomain),
        'choose_from_most_used' => __('Choose from most used Location Categories', $textDomain),
        'menu_name'             => __('Location Category', $textDomain),
    );
    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );
    register_taxonomy($taxonomy, array($post_type), $args);

    /** Options Sub Page */
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page(array(
            'page_title'    => 'Locations Settings',
            'menu_title'    => 'Locations Settings',
            'menu_slug'     => 'locations-settings',
            'capability'    => 'manage_options',
            'parent_slug'   => "edit.php?post_type=$post_type",
        ));
    }

    /** Pre get posts */
    add_action('pre_get_posts', function ($query) use ($post_type) {
        if (is_admin()) return;

        if ($query->is_main_query() && is_post_type_archive($post_type)) {
            $query->set('posts_per_page', 6);
        }

        return $query;
    });

    /** Disable single page view */
    add_action('template_redirect', function () use ($post_type) {
        if (is_singular($post_type)) {
            wp_redirect(home_url(), 301);
            exit;
        }
    });
}

add_action('init', 'locationsCpt');
