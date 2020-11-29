<?php

/*Change the wp-admin logo*/
function change_my_wp_login_image()
{
    echo "<link rel='stylesheet' href='" . THEME_URL . "/assets/css/backend.css' />"; ?>

    <style>
        body.login #login h1 a {
            background: url(<?php header_image(); ?>) center no-repeat;
        }
    </style>

<?php
}
add_action('login_head', 'change_my_wp_login_image');

/*Change the wp-admin logo link*/
add_filter('login_headerurl', 'get_site_url');

/*Change the wp-admin logo title*/
add_filter('login_headertext', function () {
    return get_bloginfo('name');
});

/*Hide update notification*/
function hide_update()
{
    // if ( !current_user_can('update_core') ) {
    remove_action('admin_notices', 'update_nag', 3);
    // }
}
add_action('admin_head', 'hide_update', 1);

/** Remove some stuff on backend */
function annointed_admin_bar_remove()
{
    global $wp_admin_bar;

    /* Remove their stuff */
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

/** Remove Dashboard Metabox */
function function_remove_ataglance()
{
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'function_remove_ataglance');

// /*Hide update notification on footer*/
// add_filter( 'admin_footer_text', '__return_empty_string', 11 ); 
// add_filter( 'update_footer', '__return_empty_string', 11 );

/** Admin Menu */
function remove_admin_menus()
{
    // global $submenu;
    // unset($submenu['themes.php'][6]);

    remove_menu_page('edit.php');  // Posts
    remove_menu_page('link-manager.php'); // Links
    remove_menu_page('edit-comments.php'); // Comments
    //remove_menu_page( 'plugins.php' ); // Plugins
    //remove_menu_page( 'users.php' ); // Users
    remove_menu_page('tools.php'); // Tools
    //remove_menu_page(‘options-general.php’); // Settings
    // remove_menu_page('wpcf7'); // Contact Form 7

    remove_submenu_page('index.php', 'update-core.php'); //Dashboard->Updates
    remove_submenu_page('themes.php', 'themes.php'); // Appearance-->Themes
    //remove_submenu_page ( 'themes.php', 'widgets.php' ); // Appearance-->Widgets
    remove_submenu_page('themes.php', 'theme-editor.php'); // Appearance-->Editor
    remove_submenu_page('themes.php', 'customize.php'); // Appearance-->Editor
    //remove_submenu_page ( 'options-general.php', 'options-general.php' ); // Settings->General
    //remove_submenu_page ( 'options-general.php', 'options-writing.php' ); // Settings->Writing
    //remove_submenu_page ( 'options-general.php', 'options-reading.php' ); // Settings->Reading
    //remove_submenu_page ( 'options-general.php', 'options-discussion.php' ); // Settings->Discussion
    //remove_submenu_page ( 'options-general.php', 'options-media.php' ); // Settings->Media
    //remove_submenu_page ( 'options-general.php', 'options-privacy.php' ); // Settings->Privacy

    remove_submenu_page('plugins.php', 'plugin-editor.php'); // Plugins->Editor

    //remove_submenu_page( 'options-general.php', 'tinymce-advanced' );
    // remove_submenu_page( 'options-general.php', 'swpsmtp_settings' );
    remove_submenu_page('options-general.php', 'radio-buttons-for-taxonomies');
    // remove_submenu_page('options-general.php', 'scporder-settings');
    remove_submenu_page('options-general.php', 'breadcrumb-navxt');

    // remove_menu_page( 'edit.php?post_type=acf-field-group' );
}
add_action('admin_menu', 'remove_admin_menus', 102);
