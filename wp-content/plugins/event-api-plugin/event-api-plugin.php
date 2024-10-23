<?php

/**
 * Plugin Name: Event API
 * Description: A plugin to API functionality.
 * Version: 1.0
 * Author: Arafat Hossain
 */

if (!defined('ABSPATH')) {
    exit;
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php'; // Existing shortcode file
require_once plugin_dir_path(__FILE__) . 'includes/event-forms.php'; // Existing event forms
require_once plugin_dir_path(__FILE__) . 'includes/event-update-delete.php'; // Existing update/delete functions

// Include registration and login shortcodes
require_once plugin_dir_path(__FILE__) . 'includes/registration.php'; // User registration shortcode
require_once plugin_dir_path(__FILE__) . 'includes/login.php'; // User login shortcode

// Enqueue styles and auth guard script
function event_api_enqueue_styles() {
    wp_enqueue_style('event-api-plugin-style', plugin_dir_url(__FILE__) . 'event-api-plugin.css');
    wp_enqueue_script('event-api-auth-guard', plugin_dir_url(__FILE__) . 'js/auth-guard.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'event_api_enqueue_styles');

// Redirect users who are not logged in from certain pages
add_action('template_redirect', 'check_user_logged_in');

function check_user_logged_in() {
    // Specify the pages that require authentication
    $restricted_pages = array('addevent', 'another-restricted-page'); // Add slugs of pages

    if (is_page($restricted_pages) && !is_user_logged_in()) {
        wp_redirect(home_url()); // Redirect to the homepage or login page
        exit;
    }
}