<?php

function blogrock_theme_init()
{
    register_nav_menus(array(
        'header_nav' => 'Header navigation',
        'footer_nav' => 'Footer navigation'
    ));

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    add_theme_support('post-thumbnails');

    add_image_size('promo_post_size', 730, 500, true);
    add_image_size('last_posts_size', 235, 235, true);
    add_image_size('promo_us_size', 453, 627, true);
    add_image_size('mobile_post_size', 285, 285, true);
    add_image_size('about_us_size', 1170, 698, true);
    add_image_size('land_us_size', 610, 452, true);




}

add_action('after_setup_theme', 'blogrock_theme_init');

function blogrock_custom_logo_setup()
{
    $defaults = array(
        'height'               => 30,
        'width'                => 138,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array('site-title', 'site-description'),
    );

    add_theme_support('custom-logo', $defaults);
}
