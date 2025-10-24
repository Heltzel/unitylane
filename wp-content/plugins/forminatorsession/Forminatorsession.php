<?php

/**
 * Plugin Name: Forminator Session
 * Description: Vangt door gebruiker ingevulde Forminator-data op in sessionStorage en toont ze in een DataTable met veld-labels (submit-time labels, dynamische forms ondersteund).
 * Version: 1.8
 * Author: Heltson
 */

if (!defined('ABSPATH')) exit;

// JS + CSS inladen
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'datatables-js',
        plugin_dir_url(__FILE__) . 'assets/js/jquery.dataTables.min.js',
        ['jquery'],
        '1.13.6',
        true
    );
    wp_enqueue_style(
        'datatables-css',
        plugin_dir_url(__FILE__) . 'assets/css/jquery.dataTables.min.css',
        [],
        '1.13.6'
    );

    wp_enqueue_script(
        'forminator-session-js',
        plugin_dir_url(__FILE__) . 'assets/js/forminator-session.js',
        ['jquery', 'datatables-js'],
        '1.8',
        true
    );
});

// Shortcode voor de DataTable
add_shortcode('forminator_datatable', function () {
    return '<table id="forminator-table" class="display" style="width:100%"></table>';
});
