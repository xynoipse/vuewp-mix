<?php

add_filter('show_admin_bar', '__return_false');

/**
 * Global JS variables
 */
if (!function_exists('globalJsVar')) {
    function globalJsVar()
    { ?>
        <script type="text/javascript">
            window.publicPath = '<?= home_url(); ?>';
            window.ajaxUrl = '<?= esc_js(admin_url('admin-ajax.php')); ?>';
            window.themeUrl = '<?= esc_js(get_template_directory_uri()); ?>';
        </script>
<?php }
    add_action('wp_head', 'globalJsVar');
}

/**
 * Defer Javascripts
 * Defer jQuery Parsing using the HTML5 defer property
 */
if (!(is_admin())) {
    function deferJavascript($url)
    {
        if (FALSE === strpos($url, '.js')) return $url;
        if (strpos($url, 'jquery.js')) return $url;
        return "$url' defer onload='";
    }
    add_filter('clean_url', 'deferJavascript', 11, 1);
}

include_once 'helpers/custom.php';
include_once 'helpers/query.php';

/**
 * Theme url and dir
 */
define('THEME_URL', get_template_directory_uri());
define('THEME_DIR', get_template_directory());
