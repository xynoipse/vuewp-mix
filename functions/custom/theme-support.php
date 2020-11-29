<?php

/** Theme Support */
if (!function_exists('themeSupport')) {

    function themeSupport()
    {
        // Enable support for Post Thumbnails, and declare two sizes.
        add_theme_support('post-thumbnails');

        /**
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
        ));

        /** This theme uses its own gallery styles */
        add_filter('use_default_gallery_style', '__return_false');
    }
    add_action('after_setup_theme', 'themeSupport');
}

/**
 * Header image
 **/
add_theme_support('custom-header', apply_filters('custom_header_args', array(
    'default-text-color'     => 'fff',
    'width'                  => 76,
    'flex-width'             => true,
    'height'                 => 103,
    'flex-height'            => true,
)));

/**
 * Custom Background
 */
// $defaults = array(
// 	'default-color'          => '',
// 	'default-image'          => '',
// 	'wp-head-callback'       => '_custom_background_cb',
// 	'admin-head-callback'    => '',
// 	'admin-preview-callback' => ''
// );
// add_theme_support('custom-background', $defaults);
