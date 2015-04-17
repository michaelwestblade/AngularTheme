<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 9/27/14
 * Time: 2:06 PM
 */

require_once 'libs/PostOption.php';
require_once 'libs/settingsMenu.php';
require_once 'libs/themeCustomizer.php';
require_once 'libs/ajaxFunctions.php';
require_once 'libs/postOptions.php';
require_once 'libs/pageOptions.php';
require_once 'libs/metaKeySettings.php';
require_once 'libs/menus.php';
require_once 'libs/customPostTypes.php';

function angularTheme_enqueue_scripts(){
    angularTheme_load_stylesheets();

    angularTheme_load_angularCore();

    // load angular dependecies
    angularTheme_load_dependencies();
    $options = get_option('plugin_options');
    $disqus_shortcode = $options['disqus_shortcode'];
    $whitelist = array('127.0.0.1', "::1");
    $dev = true;

    if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        $dev = false;
    }

    wp_localize_script( 'angular-core', 'WP_API_Settings', array( 'root' => esc_url_raw( get_json_url() ), 'nonce' => wp_create_nonce( 'wp_json' ) ) );

    // we need to create a JavaScript variable to store our API endpoint...
    wp_localize_script( 'angular-core', 'AppAPI', array( 'url' => get_bloginfo('wpurl').'/wp-json/') ); // this is the API address of the JSON API plugin
    // ... and useful information such as the theme directory and website url
    wp_localize_script( 'angular-core', 'BlogInfo', array( 'adminAjax'=>admin_url('admin-ajax.php'),'name' => get_bloginfo('name'), 'url' => get_bloginfo('template_directory').'/', 'site' => get_bloginfo('wpurl'), 'disqus_shortcode' => $disqus_shortcode, 'DEV' => ($dev ? true : false)) );

    wp_localize_script( 'angular-core', 'PageInfo', array( 'home'=>$options['home_page'] ));

    angularTheme_load_controllers();
    angularTheme_load_services();
    angularTheme_load_directives();
}

function angularTheme_load_angularCore(){
    //register angular js
    wp_register_script('angular-core',get_bloginfo('template_directory').'/scripts/angular/angular.js');
    wp_register_script('angular-route',get_bloginfo('template_directory').'/scripts/angular/angular-route.js');
    wp_register_script('angular-animate',get_bloginfo('template_directory').'/scripts/angular/angular-animate.js');
    wp_register_script('angular-aria',get_bloginfo('template_directory').'/scripts/angular/angular-aria.js');
    wp_register_script('angular-sanitize',get_bloginfo('template_directory').'/scripts/angular/angular-sanitize.js');
    wp_register_script('angular-material',get_bloginfo('template_directory').'/scripts/angular-material.js');
    // register angular disqus plugin
    wp_register_script('angular-disqus',get_bloginfo('template_directory').'/scripts/dirDisqus.js');

    // register our angular app
    wp_register_script('angular-app',get_bloginfo('template_directory').'/js/app.js');

    // enqueue all scripts
    wp_enqueue_script('angular-core');
    wp_enqueue_script('angular-route');
    wp_enqueue_script('angular-animate');
    wp_enqueue_script('angular-aria');
    wp_enqueue_script('angular-sanitize');
    //wp_enqueue_script('angular-material');
    wp_enqueue_script('angular-disqus');
    wp_enqueue_script('angular-app');
}

function angularTheme_load_stylesheets(){
    wp_enqueue_style('main_css', get_bloginfo('template_directory').'/css/main.css');

    wp_enqueue_style('bootstrap', get_bloginfo('template_directory').'/style/bootstrap/bootstrap.css');
    wp_enqueue_style('bootstrap-material', get_bloginfo('template_directory').'/style/material/css/material-wfont.min.css');
    //wp_enqueue_style('angular-material', get_bloginfo('template_directory').'/style/angular-material.min.css');
}

function angularTheme_load_dependencies(){
    // register angular bootstrap
    wp_register_script('angular-bootstrap',get_bloginfo('template_directory').'/scripts/ui-bootstrap-tpls-0.11.2.js');

    // register angular ui router
    wp_register_script('angular-ui-router',get_bloginfo('template_directory').'/scripts/angular/angular-ui-router.js');

    // register angular in-view
    wp_register_script('angular-inview',get_bloginfo('template_directory').'/scripts/angular/angular-inview.js');

    // register angular analytics
    wp_register_script('angular-analytics',get_bloginfo('template_directory').'/scripts/angulartics.js');
    wp_register_script('angular-analytics-ga',get_bloginfo('template_directory').'/scripts/angulartics-ga.js');

    // social share
    wp_register_script('angular-social-share',get_bloginfo('template_directory').'/scripts/angular-socialshare.js');

    wp_enqueue_script('angular-bootstrap');
    wp_enqueue_script('angular-ui-router');
    wp_enqueue_script('angular-inview');
    wp_enqueue_script('angular-analytics');
    wp_enqueue_script('angular-analytics-ga');
    wp_enqueue_script('angular-social-share');
}

function angularTheme_load_controllers(){
    // register our controllers
    wp_register_script('postsController',get_bloginfo('template_directory').'/js/controllers/PostsController.js');
    wp_enqueue_script('postsController');

    wp_register_script('postController',get_bloginfo('template_directory').'/js/controllers/PostController.js');
    wp_enqueue_script('postController');

    wp_register_script('pageController',get_bloginfo('template_directory').'/js/controllers/PageController.js');
    wp_enqueue_script('pageController');
}

function angularTheme_load_services(){
    // register our services
    wp_register_script('ajaxService',get_bloginfo('template_directory').'/js/services/AjaxService.js');
    wp_enqueue_script('ajaxService');

    wp_register_script('postService',get_bloginfo('template_directory').'/js/services/PostsService.js');
    wp_enqueue_script('postService');

    wp_register_script('instagramService',get_bloginfo('template_directory').'/js/services/InstagramService.js');
    wp_enqueue_script('instagramService');
}

function angularTheme_load_directives(){
    // register our directives
    wp_register_script('html',get_bloginfo('template_directory').'/js/directives/html.js');
    wp_enqueue_script('html');
}

add_theme_support( 'post-thumbnails' );

