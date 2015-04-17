<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 4/4/2015
 * Time: 1:04 AM
 */

function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

function build_header_menu(){
    // Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
    // This code based on wp_nav_menu's code to get Menu ID from menu slug

    $menu_name = 'header-menu';

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '';

        foreach ( (array) $menu_items as $key => $menu_item ) {
            $title = $menu_item->title;
            $url = $menu_item->url;
            $pageId = $menu_item->object_id;
            $menu_list .= '<li ng-class="{active:$state.includes(\'page\', {pageId: \''.$pageId.'\'})}"><a class="HeadersTextColor" href="" ui-sref="page({pageId:'.$pageId.'})">' . $title . '</a></li>';
        }
    }
    // $menu_list now ready to output
    echo $menu_list;
}