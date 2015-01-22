<?php
add_action('admin_menu', 'plugin_admin_add_page');

function plugin_admin_add_page() {
    add_options_page('Custom Plugin Page', 'Custom Plugin Menu', 'manage_options', 'plugin', 'plugin_options_page');
}

function plugin_options_page() {
    ?>
    <div>
        <h2>My custom plugin</h2>
        Options relating to the Custom Plugin.
        <form action="options.php" method="post">
            <?php settings_fields('plugin_options'); ?>
            <?php do_settings_sections('plugin'); ?>

            <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
        </form></div>

<?php
}

add_action('admin_init', 'plugin_admin_init');

function plugin_admin_init(){
    register_setting( 'plugin_options', 'plugin_options' );
    add_settings_section('plugin_main', 'Main Settings', 'plugin_section_text', 'plugin');
    add_settings_field('plugin_text_string', 'Plugin Text Input', 'plugin_setting_string', 'plugin', 'plugin_main');

    add_settings_section('disqus_shortcode', 'Disqus Settings', 'disqus_shortcode_text', 'plugin');
    add_settings_field('disqus_shortcode_text_string', 'Disqus Shortcode Input', 'disqus_shortcode_text_string', 'plugin', 'disqus_shortcode');

    add_settings_section('instagram_account_id', 'Instagram Account Id', 'instagram_account_id_text', 'plugin');
    add_settings_field('instagram_account_id_text_string', 'Instagram Account Id Text Input', 'instagram_account_id_text_string', 'plugin', 'instagram_account_id');

    add_settings_section('instagram_client_id', 'Instagram Client Id', 'instagram_client_id_text', 'plugin');
    add_settings_field('instagram_client_id_text_string', 'Instagram Client Id Text Input', 'instagram_client_id_text_string', 'plugin', 'instagram_client_id');
}

function plugin_section_text() {
    echo '<p>Main description of this section here.</p>';
}

function disqus_shortcode_text(){
    echo '<p>Enter your Disqus Shortcode For Comments</p>';
}


function instagram_account_id_text(){
    echo '<p>Enter your Instagram Account Id</p>';
}

function instagram_client_id_text(){
    echo '<p>Enter your Instagram Client Id</p>';
}

function plugin_setting_string() {
    $options = get_option('plugin_options');
    echo "<input id='plugin_text_string' name='plugin_options[text_string]' size='40' type='text' value='{$options['text_string']}' />";
}

function disqus_shortcode_text_string(){
    $options = get_option('plugin_options');
    echo "<input id='disqus_shortcode_text_string' name='plugin_options[disqus_shortcode]' size='40' type='text' value='{$options['disqus_shortcode']}' />";
}

function instagram_account_id_text_string(){
    $options = get_option('plugin_options');
    echo "<input id='instagram_account_id_text_string' name='plugin_options[instagram_account_id]' size='40' type='text' value='{$options['instagram_account_id']}' />";
}

function instagram_client_id_text_string(){
    $options = get_option('plugin_options');
    echo "<input id='instagram_client_id_text_string' name='plugin_options[instagram_client_id]' size='40' type='text' value='{$options['instagram_client_id']}' />";
}

function plugin_options_validate($input) {
    $options = get_option('plugin_options');
    $options['text_string'] = trim($input['text_string']);
    return $options;
}
?>
