<?php
if (!defined('ABSPATH')) exit;

///// Shortcode Handler
add_shortcode('dynamic_promo', function () {

    $settings = get_option('dcm_settings');
    if (empty($settings['enabled'])) {
        return '';
    }

    wp_enqueue_style('dcm-promo', DCM_URL . 'assets/css/promo.css');
    wp_enqueue_script('dcm-promo', DCM_URL . 'assets/js/promo.js', ['jquery'], null, true);

    wp_localize_script('dcm-promo', 'DCM', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('dcm_ajax'),
        'useAjax' => !empty($settings['ajax']),
    ]);

    return '<div id="dcm-promo-wrapper"></div>';
});
