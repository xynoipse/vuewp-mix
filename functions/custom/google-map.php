<?php

/**
 * ACF Google Map
 * @link https://www.advancedcustomfields.com/resources/google-map/
 */

function acfGoogleMapAPI($api)
{
    $googleMapAPIKey = get_field('google_maps_api_key', 'option');
    $api['key'] = $googleMapAPIKey;
    return $api;
}
add_filter('acf/fields/google_map/api', 'acfGoogleMapAPI');
