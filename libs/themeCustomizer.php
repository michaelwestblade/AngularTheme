<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 1/17/2015
 * Time: 1:26 PM
 */

/**
 * Adds the Customize page to the WordPress admin area
 */
function Customize_Angular_Theme() {
    add_theme_page( 'Customize Angular Theme', 'Customize Angular Theme', 'edit_theme_options', 'customize.php' );
    generate_options_css();
}

add_action( 'admin_menu', 'Customize_Angular_Theme' );

function image_selections( $wp_customize ){
    $wp_customize->add_section(
        'image_options',
        array(
            'title' => 'Image Options',
            'description' => 'Choose Theme Images',
            'priority' => 35,
        )
    );

    $wp_customize->add_setting(
        'logo_img',
        array(
            'default' => '',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo_img',
            array(
                'label'      => 'Upload a logo',
                'section'    => 'image_options',
                'settings'   => 'logo_img'
            )
        )
    );

}

add_action( 'customize_register', 'image_selections' );

function color_selections( $wp_customize ){
    $wp_customize->add_section(
        'color_options',
        array(
            'title' => 'Color Options',
            'description' => 'Choose Theme Colors',
            'priority' => 35,
        )
    );

    $wp_customize->add_setting(
        'main_bg_color',
        array(
            'default' => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'main_bg_color',
            array(
                'label' => 'Main Background Color',
                'section' => 'color_options',
                'settings' => 'main_bg_color',
            )
        )
    );

    $wp_customize->add_setting(
        'headers_bg_color',
        array(
            'default' => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'headers_bg_color',
            array(
                'label' => 'Headers Background Color',
                'section' => 'color_options',
                'settings' => 'headers_bg_color',
            )
        )
    );

    $wp_customize->add_setting(
        'headers_nav_color',
        array(
            'default' => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'headers_nav_color',
            array(
                'label' => 'Headers Navigation Color',
                'section' => 'color_options',
                'settings' => 'headers_nav_color',
            )
        )
    );

}

add_action( 'customize_register', 'color_selections' );

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function footer_options( $wp_customize ) {
    $wp_customize->add_section(
        'footer_options',
        array(
            'title' => 'Footer Options',
            'description' => 'This is a settings section.',
            'priority' => 35,
        )
    );

    $wp_customize->add_setting(
        'copyright_textbox',
        array(
            'default' => 'Default copyright text',
        )
    );

    $wp_customize->add_control(
        'copyright_textbox',
        array(
            'label' => 'Copyright text',
            'section' => 'footer_options',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'show_copyright_year'
    );

    $wp_customize->add_control(
        'show_copyright_year',
        array(
            'type' => 'checkbox',
            'label' => 'Show copyright year',
            'section' => 'footer_options',
        )
    );
}

add_action( 'customize_register', 'footer_options' );

function generate_options_css()
{

    $css_dir = get_stylesheet_directory() . '/css/'; // Shorten code, save 1 call
    ob_start(); // Capture all output (output buffering)

    require($css_dir . 'styles.php'); // Generate CSS

    $css = ob_get_clean(); // Get generated CSS (output buffering)
    file_put_contents($css_dir . 'colors.css', $css, LOCK_EX); // Save it

    echo $css;
}

add_action( 'wp_head', 'generate_options_css');