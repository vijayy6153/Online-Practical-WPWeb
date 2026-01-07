<?php
if (!defined('ABSPATH')) exit;

///// Add Settings Page
add_action('admin_menu', function () {
    add_options_page(
        'Dynamic Content',
        'Dynamic Content',
        'manage_options',
        'dcm-settings',
        'dcm_settings_page'
    );
});

add_action('admin_init', function () {
    register_setting('dcm_settings_group', 'dcm_settings', 'dcm_sanitize_settings');
    add_settings_section('dcm_main', '', null, 'dcm-settings');
    add_settings_field('enabled', 'Enable Promo Blocks', 'dcm_field_enabled', 'dcm-settings', 'dcm_main');
    add_settings_field('limit', 'Max Promo Blocks', 'dcm_field_limit', 'dcm-settings', 'dcm_main');
    add_settings_field('ttl', 'Cache TTL (minutes)', 'dcm_field_ttl', 'dcm-settings', 'dcm_main');
    add_settings_field('ajax', 'Enable AJAX Loading', 'dcm_field_ajax', 'dcm-settings', 'dcm_main');
});

function dcm_sanitize_settings($input) {
    return [
        'enabled' => !empty($input['enabled']),
        'limit'   => absint($input['limit']),
        'ttl'     => absint($input['ttl']),
        'ajax'    => !empty($input['ajax']),
    ];
}

function dcm_field_enabled() {
    $opt = get_option('dcm_settings');
    ?>
    <input type="checkbox" name="dcm_settings[enabled]" value="1"
        <?php checked(!empty($opt['enabled'])); ?>>
    <?php
}

function dcm_field_limit() {
    $opt = get_option('dcm_settings');
    ?>
    <input type="number" min="1" name="dcm_settings[limit]"
           value="<?php echo esc_attr($opt['limit'] ?? 5); ?>">
    <?php
}

function dcm_field_ttl() {
    $opt = get_option('dcm_settings');
    ?>
    <input type="number" min="1" name="dcm_settings[ttl]"
           value="<?php echo esc_attr($opt['ttl'] ?? 10); ?>">
    <?php
}

function dcm_field_ajax() {
    $opt = get_option('dcm_settings');
    ?>
    <input type="checkbox" name="dcm_settings[ajax]" value="1"
        <?php checked(!empty($opt['ajax'])); ?>>
    <?php
}

///// Settings Page Html Code
function dcm_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Dynamic Content', 'wp-content-manager-vijay-panchal'); ?></h1>

        <form method="post" action="options.php">
            <?php
            settings_fields('dcm_settings_group');
            do_settings_sections('dcm-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
