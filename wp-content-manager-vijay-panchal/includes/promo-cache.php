<?php
if (!defined('ABSPATH')) exit;

function dcm_get_promo_cache() {
    return get_transient('dcm_promo_blocks');
}

function dcm_set_promo_cache($data, $ttl) {
    set_transient('dcm_promo_blocks', $data, $ttl * MINUTE_IN_SECONDS);
}

function dcm_clear_promo_cache() {
    delete_transient('dcm_promo_blocks');
}

///// WP-CLI Command
if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('dcm clear-cache', function () {
        dcm_clear_promo_cache();
        WP_CLI::success('Promo block cache cleared.');
    });
}