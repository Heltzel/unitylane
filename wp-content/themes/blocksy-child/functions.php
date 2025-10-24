<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')):
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

// END ENQUEUE PARENT ACTION


// ============================
// ENQUEUE CHILD THEME STYLES
// ============================
if (!function_exists('my_child_theme_enqueue_styles')):
    function my_child_theme_enqueue_styles()
    {
        // Parent theme CSS
        wp_enqueue_style(
            'parent-style',
            get_template_directory_uri() . '/style.css'
        );

        // Child theme hoofd CSS (styles.css importeert evt. andere CSS)
        wp_enqueue_style(
            'child-styles',
            get_stylesheet_directory_uri() . '/css/styles.css',
            array('parent-style'),
            filemtime(get_stylesheet_directory() . '/css/styles.css')
        );
    }
endif;
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');


// ============================
// ENQUEUE CHILD THEME SCRIPTS
// ============================
if (!function_exists('my_child_theme_enqueue_scripts')):
    function my_child_theme_enqueue_scripts()
    {
        // Voorbeeld: main.js
        wp_enqueue_script(
            'child-main',
            get_stylesheet_directory_uri() . '/js/main.js',
            array('jquery'), // zet leeg array() als je geen jQuery gebruikt
            filemtime(get_stylesheet_directory() . '/js/main.js'),
            true
        );

        // Voorbeeld: menu.js
        wp_enqueue_script(
            'child-menu',
            get_stylesheet_directory_uri() . '/js/menu.js',
            array('child-main'),
            filemtime(get_stylesheet_directory() . '/js/menu.js'),
            true
        );

        // Voorbeeld: animations.js
        wp_enqueue_script(
            'child-animations',
            get_stylesheet_directory_uri() . '/js/animations.js',
            array('child-main'),
            filemtime(get_stylesheet_directory() . '/js/animations.js'),
            true
        );
    }
endif;
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_scripts');
