<?php

/**
 * Add acf option page in every sidebar menu in wordpress backend.
 * Note: You must have ACF first with Opition
 **/
if (function_exists('acf_add_options_page')) {

    acf_add_options_page([
        'page_title'    => 'Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'manage_options',
        'position'      => 2,
    ]);

    acf_add_options_sub_page([
        'page_title'    => 'Subpage Settings',
        'menu_title'    => 'Subpage Settings',
        'parent_slug'   => 'theme-settings',
    ]);

    acf_add_options_page([
        'page_title'    => 'Options Page',
        'menu_title'    => 'Options Page',
        'menu_slug'     => 'options-settings',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-book',
        'redirect'      => true
    ]);
}
