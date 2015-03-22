<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 3/22/2015
 * Time: 3:08 PM
 */

/**
 * Adds a meta box to the post editing screen
 */
function image_position_custom_meta() {
    add_meta_box( 'image_position_meta', __( 'Image Position', 'image-position-textdomain' ), 'image_position_meta_callback', 'post', 'side' );
}
add_action( 'add_meta_boxes', 'image_position_custom_meta' );

/**
 * Outputs the content of the meta box
 */
function image_position_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'image_position_nonce' );
    $image_position_stored_meta = get_post_meta( $post->ID );
    ?>

    <p>
        <label for="meta-select" class="prfx-row-title"><?php _e( 'Select Image Position', 'image-position-textdomain' )?></label>
        <select name="featured_image_position" id="featured_image_position">
            <option value="center" <?php if ( isset ( $image_position_stored_meta['featured_image_position'] ) ) selected( $image_position_stored_meta['featured_image_position'][0], 'center' ); ?>><?php _e( 'Center', 'image-position-textdomain' )?></option>';
            <option value="left" <?php if ( isset ( $image_position_stored_meta['featured_image_position'] ) ) selected( $image_position_stored_meta['featured_image_position'][0], 'left' ); ?>><?php _e( 'Left', 'image-position-textdomain' )?></option>';
            <option value="right" <?php if ( isset ( $image_position_stored_meta['featured_image_position'] ) ) selected( $image_position_stored_meta['featured_image_position'][0], 'right' ); ?>><?php _e( 'Right', 'image-position-textdomain' )?></option>';
        </select>
    </p>

<?php
}

/**
 * Saves the custom meta input
 */
function image_position_meta_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'image_position_nonce' ] ) && wp_verify_nonce( $_POST[ 'image_position_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'featured_image_position' ] ) ) {
        update_post_meta( $post_id, 'featured_image_position', sanitize_text_field( $_POST[ 'featured_image_position' ] ) );
    }

}
add_action( 'save_post', 'image_position_meta_save' );

/**
 * Adds a checkbox to the featured image metabox.
 *
 * @param string $content
 */

function prefix_featured_image_meta( $content ) {
    global $post;
    $text = __( 'Don\'t display image in post.', 'prefix' );
    $id = 'hide_featured_image';
    $value = esc_attr( get_post_meta( $post->ID, $id, true ) );
    $label = '<label for="' . $id . '" class="selectit"><input name="' . $id . '" type="checkbox" id="' . $id . '" value="' . $value . ' "'. checked( $value, 1, false) .'> ' . $text .'</label>';
    return $content .= $label;
}
add_filter( 'admin_post_thumbnail_html', 'prefix_featured_image_meta' );

/**
 * Save featured image meta data when saved
 *
 * @param int $post_id The ID of the post.
 * @param post $post the post.
 */
function prefix_save_featured_image_meta( $post_id, $post, $update ) {

    $value = 0;
    if ( isset( $_REQUEST['hide_featured_image'] ) ) {
        $value = 1;
    }

    // Set meta value to either 1 or 0
    update_post_meta( $post_id, 'hide_featured_image', $value );

}
add_action( 'save_post', 'prefix_save_featured_image_meta', 10, 3 );
