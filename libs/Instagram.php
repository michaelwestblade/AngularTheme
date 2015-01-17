<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 1/16/2015
 * Time: 8:25 PM
 */

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
add_action( 'wp_ajax_getInstagramPhotos', 'getInstagramPhotos' );