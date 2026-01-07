<?php
if (!defined('ABSPATH')) exit;

add_action('wp_ajax_dcm_load_promos', 'dcm_ajax_promos');
add_action('wp_ajax_nopriv_dcm_load_promos', 'dcm_ajax_promos');

function dcm_ajax_promos() {
    check_ajax_referer('dcm_ajax', 'nonce');
    $data = dcm_rest_promos();
    wp_send_json_success($data);
}
