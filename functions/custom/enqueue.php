<?php

/**
 * Include default css and scripts
 * Include in wp_header() and wp_footer()
 **/
if (!function_exists('enqueueStyleScript')) {

    function enqueueStyleScript()
    {
        wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.15.1/css/all.css');
        wp_enqueue_style('app', THEME_URL . '/assets/css/app.css');

        if (is_post_type_archive('location')) {
            $googleMapAPIKey = get_field('google_maps_api_key', 'option');
            wp_enqueue_script('google-api', "https://maps.googleapis.com/maps/api/js?key={$googleMapAPIKey}&libraries=places,visualization", null, null, true);
        }

        wp_enqueue_script('manifest', THEME_URL . '/assets/js/manifest.js', array('jquery'), null, true);
        wp_enqueue_script('vendor', THEME_URL . '/assets/js/vendor.js', array('jquery'), null, true);
        wp_enqueue_script('script', THEME_URL . '/assets/js/script.js', array('jquery'), null, true);
    }
    add_action('wp_enqueue_scripts', 'enqueueStyleScript');
}
