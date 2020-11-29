<?php

/** 
 * Register template_name menu
 **/
if (!function_exists('addMenus')) {

    function addMenus()
    {
        // Menu locations set in backend
        register_nav_menus(array(
            'main_menu' => __('Main Menu', 'template_name'),
        ));
    }

    add_action('after_setup_theme', 'addMenus');
}

/*
to show specific menu place this code on specific location

$menuargs = array(
	'theme_location'	=> 	'Main Menu',
	'menu'				=>  'Main Menu',
    'menu_class'        =>  'main-menu list-inline',
);
wp_nav_menu($menuargs); 
*/