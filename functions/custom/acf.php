<?php

/**
 * ACF Local JSON
 * @link https://www.advancedcustomfields.com/resources/local-json/
 */

function acfJsonSavePoint($path)
{
    $path = THEME_DIR . '/acf-json';
    return $path;
}
add_filter('acf/settings/save_json', 'acfJsonSavePoint');

function acfJsonLoadPoint($paths)
{
    unset($paths[0]);
    $paths[] = THEME_DIR . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'acfJsonLoadPoint');
