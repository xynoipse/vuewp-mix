<?php

/**
 * Add custom image size
 * add_image_size( string $name, int $width, int $height, bool|array $crop = false )
 */
if (!function_exists('imageSize')) {

    function imageSize()
    {
        add_image_size('featured-image-app', 500, 200, false);
    }
    add_action('after_setup_theme', 'imageSize');
}
