<?php

// Customize mce editor font sizes
if (!function_exists('tinyMceTextSizes')) {
    function tinyMceTextSizes($initArray)
    {
        $initArray['fontsize_formats'] = "12px 13px 14px 15px 16px 17px 18px 20px 30px 32px 36px 40px 42px 44px 46px 48px 72px 80px";
        return $initArray;
    }
}
add_filter('tiny_mce_before_init', 'tinyMceTextSizes');

// Add custom Fonts to the Fonts list
if (!function_exists('tinyMceFontsFormats')) {
    function tinyMceFontsFormats($initArray)
    {
        $initArray['font_formats'] = "Montserrat=Montserrat;Open Sans='Open Sans'";
        return $initArray;
    }
}
add_filter('tiny_mce_before_init', 'tinyMceFontsFormats');

if (!function_exists('tinyMceGoogleFonts')) {
    function tinyMceGoogleFonts()
    {
        $fonts = 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400%3b500%3b600%3b700&family=Open+Sans:ital,wght@0,400%3b0,600%3b0,700%3b1,300&family=Nunito&display=swap';
        add_editor_style(str_replace(',', '%2C', $fonts));
    }
}
add_action('init', 'tinyMceGoogleFonts');

if (!function_exists('tinyMceStyleFormats')) {
    function tinyMceStyleFormats($init_array)
    {
        // Define the style_formats array
        $style_formats = array(
            // Each array child is a format with it's own settings
            array(
                'title' => 'bold',
                'inline' => 'span',
                'classes' => 'bold',
            ),
            array(
                'title' => 'semibold',
                'inline' => 'span',
                'classes' => 'semibold',
            ),
            array(
                'title' => 'regular',
                'inline' => 'span',
                'classes' => 'regular',
            ),
            array(
                'title' => 'light',
                'inline' => 'span',
                'classes' => 'light',
            ),
            array(
                'title' => 'thin',
                'inline' => 'span',
                'classes' => 'thin',
            ),
        );
        // Insert the array, JSON ENCODED, into 'style_formats'
        $init_array['style_formats'] = json_encode($style_formats);

        return $init_array;
    }
}
add_filter('tiny_mce_before_init', 'tinyMceStyleFormats');

// get your custom style
function plugin_mce_css($mce_css)
{

    if (!empty($mce_css)) $mce_css .= ',';

    $mce_css .= get_bloginfo('template_url') . '/assets/css/tinymce.css';

    return $mce_css;
}
add_filter('mce_css', 'plugin_mce_css');
