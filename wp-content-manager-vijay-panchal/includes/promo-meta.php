<?php
if (!defined('ABSPATH')) exit;

///// Add meta box
add_action('add_meta_boxes', function () {
    add_meta_box(
        'promo_block_meta',
        'Promo Details',
        'dcm_render_promo_meta',
        'promo_block',
        'normal',
        'default'
    );
});

///// Meta Box HTML Code
function dcm_render_promo_meta($post) {

    wp_nonce_field('dcm_save_promo_meta', 'dcm_promo_nonce');

    $cta_text    = get_post_meta($post->ID, 'cta_text', true);
    $cta_url     = get_post_meta($post->ID, 'cta_url', true);
    $priority    = get_post_meta($post->ID, 'priority', true);
    $expiry_date = get_post_meta($post->ID, 'expiry_date', true);
?>

    <p>
        <label>CTA Text</label><br>
        <input type="text" name="cta_text" value="<?php echo esc_attr($cta_text); ?>">
    </p>

    <p>
        <label>CTA URL</label><br>
        <input type="url" name="cta_url" value="<?php echo esc_url($cta_url); ?>">
    </p>

    <p>
        <label>Display Priority</label><br>
        <input type="number" name="priority" value="<?php echo esc_attr($priority); ?>">
    </p>

    <p>
        <label>Expiry Date</label><br>
        <input type="date" name="expiry_date" value="<?php echo esc_attr($expiry_date); ?>">
    </p>

    <?php
}

///// Save Meta Box Data
add_action('save_post', function ($post_id) {

    if (!isset($_POST['dcm_promo_nonce'])) return;
    if (!wp_verify_nonce($_POST['dcm_promo_nonce'], 'dcm_save_promo_meta')) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, 'cta_text', sanitize_text_field($_POST['cta_text'] ?? ''));
    update_post_meta($post_id, 'cta_url', esc_url_raw($_POST['cta_url'] ?? ''));
    update_post_meta($post_id, 'priority', intval($_POST['priority'] ?? 0));
    update_post_meta($post_id, 'expiry_date', sanitize_text_field($_POST['expiry_date'] ?? ''));

    dcm_clear_promo_cache();
});
