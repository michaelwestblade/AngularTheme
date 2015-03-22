<?php

add_action('admin_menu', 'add_update_meta_key_options');

function add_update_meta_key_options()
{
    add_options_page('Update Post Meta', 'Update Post Meta', 'manage_options', 'functions','update_meta_key_options');
}

function update_meta_key_options()
{
    if( isset($_POST['meta_key']) && isset($_POST['meta_value']) ){
        updateMetaKey($_POST['meta_key'],$_POST['meta_value']);
    }
    ?>
    <div class="wrap">
        <h2>Global Custom Options</h2>
        <form method="post" action="">
            <p><strong>Meta Key:</strong><br />
                <input type="text" name="meta_key" size="45" value="" />
            </p>
            <p><strong>Key Value:</strong><br />
                <input type="text" name="meta_value" size="45" value="" />
            </p>
            <p><input type="submit" name="Submit" value="Update Post Meta" /></p>
        </form>
    </div>
<?php
}

function updateMetaKey($key,$value){
    $args = array(
        'numberposts'       => -1,
        'order'             => 'DESC',
        'post_type'         => 'post',
        'post_status'       => 'publish'
    );
    $posts_array = get_posts( $args );
    foreach($posts_array as $post){
        update_post_meta($post->ID,$key,$value);
    }
}
