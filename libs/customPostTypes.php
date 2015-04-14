<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 4/13/2015
 * Time: 8:21 PM
 */

function register_faq_post_type() {
    $labels = array(
        'name'               => _x( 'FAQ', 'post type general name' ),
        'singular_name'      => _x( 'FAQ', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'book' ),
        'add_new_item'       => __( 'Add New FAQ' ),
        'edit_item'          => __( 'Edit FAQ' ),
        'new_item'           => __( 'New FAQ' ),
        'all_items'          => __( 'All FAQs' ),
        'view_item'          => __( 'View FAQs' ),
        'search_items'       => __( 'Search FAQs' ),
        'not_found'          => __( 'No FAQs found' ),
        'not_found_in_trash' => __( 'No FAQs found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'FAQs'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Faq content',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'   => true,
    );
    register_post_type( 'faq', $args );
}
add_action( 'init', 'register_faq_post_type' );

function faq_change_title_text( $title )
{
     $screen = get_current_screen();
     if ('faq' == $screen->post_type) {
          $title = 'Enter FAQ question';
     }
     return $title;
}
add_filter( 'enter_title_here', 'faq_change_title_text' );


function register_project_post_type() {
    $labels = array(
        'name'               => _x( 'Project', 'post type general name' ),
        'singular_name'      => _x( 'Project', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'book' ),
        'add_new_item'       => __( 'Add New Project' ),
        'edit_item'          => __( 'Edit Project' ),
        'new_item'           => __( 'New Project' ),
        'all_items'          => __( 'All Projects' ),
        'view_item'          => __( 'View Projects' ),
        'search_items'       => __( 'Search Projects' ),
        'not_found'          => __( 'No Projects found' ),
        'not_found_in_trash' => __( 'No Projects found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Projects'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Project Content',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'   => true,
    );
    register_post_type( 'project', $args );
}
add_action( 'init', 'register_project_post_type' );

function project_change_title_text( $title )
{
    $screen = get_current_screen();
    if ('faq' == $screen->post_type) {
        $title = 'Enter Project Name';
    }
    return $title;
}
add_filter( 'enter_title_here', 'project_change_title_text' );


$postOption = new PostOption('project_url','Project Url','input','project',array());
