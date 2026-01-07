<?php
if (!defined('ABSPATH')) exit;

///// Register Promo Block Custom Post Type
add_action('init', function () {
    register_post_type('promo_block', [
        'labels' => [
            'name' => 'Promo Blocks',
            'singular_name' => 'Promo Block',
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => ['title', 'editor', 'thumbnail'],
    ]);
});
