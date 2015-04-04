<?php
add_action('admin_menu', 'plugin_admin_add_page');

function plugin_admin_add_page() {
    add_options_page('Custom Plugin Page', 'Angular Wordpress', 'manage_options', 'plugin', 'plugin_options_page');
}

function plugin_options_page() {
    ?>
    <div>
        <h2>Angular Wordpress Options</h2>
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
    add_settings_section('home_page', 'Home Page', 'home_page_text', 'plugin');
    add_settings_field('home_page_text_string', 'Select Your Home Page', 'home_page_text_string', 'plugin', 'home_page');

    add_settings_section('disqus_shortcode', 'Disqus Settings', 'disqus_shortcode_text', 'plugin');
    add_settings_field('disqus_shortcode_text_string', 'Disqus Shortcode Input', 'disqus_shortcode_text_string', 'plugin', 'disqus_shortcode');

    add_settings_section('ga_code', 'Google Analytics ID', 'ga_code_text', 'plugin');
    add_settings_field('ga_code_text_string', 'Google Analytics ID Input', 'ga_code_text_string', 'plugin', 'ga_code');

    add_settings_section('instagram_account_id', 'Instagram Account Id', 'instagram_account_id_text', 'plugin');
    add_settings_field('instagram_account_id_text_string', 'Instagram Account Id Text Input', 'instagram_account_id_text_string', 'plugin', 'instagram_account_id');

    add_settings_section('instagram_client_id', 'Instagram Client Id', 'instagram_client_id_text', 'plugin');
    add_settings_field('instagram_client_id_text_string', 'Instagram Client Id Text Input', 'instagram_client_id_text_string', 'plugin', 'instagram_client_id');
}

function home_page_text(){
    echo '<p>Select the page to use for your home page.</p>';
}

function disqus_shortcode_text(){
    echo '<p>Enter your Disqus Shortcode For Comments</p>';
}

function ga_code_text(){
    echo '<p>Enter your Google Analytics ID for tracking</p>';
}

function update_post_meta_text(){
    echo '<p>Enter a meta key to update</p>';
}

function instagram_account_id_text(){
    echo '<p>Enter your Instagram Account Id</p>';
}

function instagram_client_id_text(){
    echo '<p>Enter your Instagram Client Id</p>';
}


function home_page_text_string()
{
    $pages = get_pages();
    $options = get_option('plugin_options');
    $selected = $options['home_page'];
    $p = '';
    $r = '';

    echo ' <select name="plugin_options[home_page]" id="home-page-options">';
    echo '<option value="0">None</option>';
    foreach ( $pages as $page ) {
        if ( $selected == $page->ID ) // Make default first in list
            echo '<option selected="selected" value="'.trim($page->ID).'">'.trim($page->post_title).'</option>';
        else
            echo '<option value="'.trim($page->ID).'">'.trim($page->post_title).'</option>';
    }
    echo '</select>';
}

function disqus_shortcode_text_string(){
    $options = get_option('plugin_options');
    echo "<input id='disqus_shortcode_text_string' name='plugin_options[disqus_shortcode]' size='40' type='text' value='{$options['disqus_shortcode']}' />";
}

function ga_code_text_string(){
    $options = get_option('plugin_options');
    echo "<input id='ga_code_text_string' name='plugin_options[ga_code]' size='40' type='text' value='{$options['ga_code']}' />";
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
