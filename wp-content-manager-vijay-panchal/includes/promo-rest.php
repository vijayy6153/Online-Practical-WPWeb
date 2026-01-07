<?php
if (!defined('ABSPATH')) exit;

add_action('rest_api_init', function () {

    register_rest_route('dcm/v1', '/promos', [
        'methods' => 'GET',
        'callback' => 'dcm_rest_promos',
    ]);
});

function dcm_rest_promos() {

    $settings = get_option('dcm_settings');
    $cached = dcm_get_promo_cache();

    if ($cached) {
        return $cached;
    }

    $today = date('Y-m-d');

    $query = new WP_Query([
        'post_type' => 'promo_block',
        'posts_per_page' => $settings['limit'] ?? 5,
        'meta_key' => 'priority',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'expiry_date',
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATE',
            ]
        ]
    ]);

    $data = [];

    foreach ($query->posts as $post) {
        $data[] = [
            'title' => get_the_title($post),
            'content' => apply_filters('the_content', $post->post_content),
            'image' => get_the_post_thumbnail_url($post, 'medium'),
            'cta_text' => get_post_meta($post->ID, 'cta_text', true),
            'cta_url' => get_post_meta($post->ID, 'cta_url', true),
        ];
    }

    dcm_set_promo_cache($data, $settings['ttl'] ?? 10);
    return $data;
}
