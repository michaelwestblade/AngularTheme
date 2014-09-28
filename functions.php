<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 9/27/14
 * Time: 2:06 PM
 */

function angularTheme_enqueue_scripts(){
    angularTheme_load_stylesheets();

    angularTheme_load_angularCore();

    // load angular dependecies
    angularTheme_load_dependencies();

    wp_localize_script( 'angular-core', 'WP_API_Settings', array( 'root' => esc_url_raw( get_json_url() ), 'nonce' => wp_create_nonce( 'wp_json' ) ) );

    // we need to create a JavaScript variable to store our API endpoint...
    wp_localize_script( 'angular-core', 'AppAPI', array( 'url' => get_bloginfo('wpurl').'/wp-json/') ); // this is the API address of the JSON API plugin
    // ... and useful information such as the theme directory and website url
    wp_localize_script( 'angular-core', 'BlogInfo', array( 'url' => get_bloginfo('template_directory').'/', 'site' => get_bloginfo('wpurl')) );

    angularTheme_load_controllers();
    angularTheme_load_services();
}

function angularTheme_load_angularCore(){
    //register angular js
    wp_register_script('angular-core',get_bloginfo('template_directory').'/scripts/angular/angular.js');
    wp_register_script('angular-route',get_bloginfo('template_directory').'/scripts/angular/angular-route.js');

    // register our angular app
    wp_register_script('angular-app',get_bloginfo('template_directory').'/js/app.js');

    // enqueue all scripts
    wp_enqueue_script('angular-core');
    wp_enqueue_script('angular-route');
    wp_enqueue_script('angular-app');
}

function angularTheme_load_stylesheets(){
    wp_enqueue_style('bootstrap', get_bloginfo('template_directory').'/style/bootstrap.css');
}

function angularTheme_load_dependencies(){
    // register angular bootstrap
    wp_register_script('angular-bootstrap',get_bloginfo('template_directory').'/scripts/ui-bootstrap-tpls-0.11.2.js');

    // register angular ui router
    wp_register_script('angular-ui-router',get_bloginfo('template_directory').'/scripts/angular/angular-ui-router.js');

    wp_enqueue_script('angular-bootstrap');
    wp_enqueue_script('angular-ui-router');
}

function angularTheme_load_controllers(){
    // register our controllers
    wp_register_script('postsController',get_bloginfo('template_directory').'/js/controllers/PostsController.js');
    wp_enqueue_script('postsController');
}

function angularTheme_load_services(){
    // register our services
    wp_register_script('ajaxService',get_bloginfo('template_directory').'/js/services/AjaxService.js');
    wp_enqueue_script('ajaxService');

    wp_register_script('postService',get_bloginfo('template_directory').'/js/services/PostsService.js');
    wp_enqueue_script('postService');
}

add_action('wp_enqueue_scripts', 'angularTheme_enqueue_scripts');