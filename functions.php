<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 9/27/14
 * Time: 2:06 PM
 */

require_once 'InstagramPHP/Instagram.php';

function angularTheme_enqueue_scripts(){
    angularTheme_load_stylesheets();

    angularTheme_load_angularCore();

    // load angular dependecies
    angularTheme_load_dependencies();

    wp_localize_script( 'angular-core', 'WP_API_Settings', array( 'root' => esc_url_raw( get_json_url() ), 'nonce' => wp_create_nonce( 'wp_json' ) ) );

    // we need to create a JavaScript variable to store our API endpoint...
    wp_localize_script( 'angular-core', 'AppAPI', array( 'url' => get_bloginfo('wpurl').'/wp-json/') ); // this is the API address of the JSON API plugin
    // ... and useful information such as the theme directory and website url
    wp_localize_script( 'angular-core', 'BlogInfo', array( 'adminAjax'=>admin_url('admin-ajax.php'),'name' => get_bloginfo('name'), 'url' => get_bloginfo('template_directory').'/', 'site' => get_bloginfo('wpurl'), 'user' => wp_get_current_user()) );

    angularTheme_load_controllers();
    angularTheme_load_services();
    angularTheme_load_directives();
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
    wp_enqueue_style('main', get_bloginfo('template_directory').'/css/main.css');

    wp_enqueue_style('bootstrap', get_bloginfo('template_directory').'/style/bootstrap/bootstrap.css');
    wp_enqueue_style('material', get_bloginfo('template_directory').'/style/material/css/material-wfont.min.css');
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

    wp_register_script('postController',get_bloginfo('template_directory').'/js/controllers/PostController.js');
    wp_enqueue_script('postController');
}

function angularTheme_load_services(){
    // register our services
    wp_register_script('ajaxService',get_bloginfo('template_directory').'/js/services/AjaxService.js');
    wp_enqueue_script('ajaxService');

    wp_register_script('postService',get_bloginfo('template_directory').'/js/services/PostsService.js');
    wp_enqueue_script('postService');

    wp_register_script('commentsService',get_bloginfo('template_directory').'/js/services/CommentsService.js');
    wp_enqueue_script('commentsService');

    wp_register_script('usersService',get_bloginfo('template_directory').'/js/services/UsersService.js');
    wp_enqueue_script('usersService');

    wp_register_script('instagramService',get_bloginfo('template_directory').'/js/services/InstagramService.js');
    wp_enqueue_script('instagramService');
}

function angularTheme_load_directives(){
    // register our directives
    wp_register_script('html',get_bloginfo('template_directory').'/js/directives/html.js');
    wp_enqueue_script('html');
}

function getInstagramPhotos(){
    $url = 'https://api.instagram.com/v1/users/201994052/media/recent/?client_id=95c1f3da8b3246e68b3532210d811f7f';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    $feed = json_decode(curl_exec($ch));
    curl_close($ch);

    $result = json_encode($feed);
	echo $result;
	die();
}

add_action( 'wp_ajax_nopriv_getInstagramPhotos', 'getInstagramPhotos' );