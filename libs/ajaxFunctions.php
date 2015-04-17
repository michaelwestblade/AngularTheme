<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 1/24/2015
 * Time: 11:14 PM
 */

function get_post_categories(){
    $args = array(
        'type'                     => 'post',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'name',
        'order'                    => 'ASC',
        'hide_empty'               => 1,
        'hierarchical'             => 1,
        'exclude'                  => '',
        'include'                  => '',
        'number'                   => '',
        'taxonomy'                 => 'category',
        'pad_counts'               => false

    );

    $categories = json_encode(get_categories($args));
    echo $categories;
    die();

}

add_action( 'wp_ajax_nopriv_get_post_categories', 'get_post_categories' );
add_action( 'wp_ajax_get_post_categories', 'get_post_categories' );

function getPostMeta(){
    $post_id = $_REQUEST['post_id'];
    $meta_value = get_post_meta( $post_id);

    echo json_encode($meta_value);
    wp_die();
}

add_action( 'wp_ajax_nopriv_getPostMeta', 'getPostMeta' );
add_action( 'wp_ajax_getPostMeta', 'getPostMeta' );