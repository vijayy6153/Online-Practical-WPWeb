<?php
/**
 * Plugin Name: WP Content Manager – Vijay Panchal
 * Description: Dynamic Promo Blocks with shortcode, REST API, caching and AJAX loading.
 * Version: 1.0.0
 * Author: Vijay Panchal
 * Text Domain: wp-content-manager-vijay-panchal
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DCM_PATH', plugin_dir_path(__FILE__));
define('DCM_URL', plugin_dir_url(__FILE__));

///// Load Plugin Files
require_once DCM_PATH . 'includes/promo-cpt.php';
require_once DCM_PATH . 'includes/promo-meta.php';
require_once DCM_PATH . 'includes/promo-settings.php';
require_once DCM_PATH . 'includes/promo-cache.php';
require_once DCM_PATH . 'includes/promo-render.php';
require_once DCM_PATH . 'includes/promo-rest.php';
require_once DCM_PATH . 'includes/promo-ajax.php';


