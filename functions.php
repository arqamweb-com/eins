<?php

/**
 * ArqamWeb Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ArqamWeb
 * @since 1.0.1
 */

/**
 * Define Constants
 */
define('CHILD_THEME_ARQAMWEB_VERSION', '1.1.7');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{
    wp_enqueue_style(
        'arqamweb-theme-css',
        get_stylesheet_directory_uri() . '/style.css',
        ['astra-theme-css'],
        CHILD_THEME_ARQAMWEB_VERSION,
        'all'
    );

    wp_enqueue_style(
        'aos-css',
        get_stylesheet_directory_uri() . '/frontend/public/css/aos-css.min.css',
        ['astra-theme-css'],
        CHILD_THEME_ARQAMWEB_VERSION,
        'all'
    );

    wp_enqueue_style(
        'blaze-slider-css',
        get_stylesheet_directory_uri() . '/frontend/public/css/blaze.css',
        ['astra-theme-css'],
        CHILD_THEME_ARQAMWEB_VERSION,
        'all'
    );

    wp_enqueue_style(
        'style-css',
        get_stylesheet_directory_uri() . '/frontend/public/style.min.css',
        array('arqamweb-theme-css'),
        CHILD_THEME_ARQAMWEB_VERSION,
        'all'
    );
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);



/**

 * Enqueue script

 */

function my_custom_scripts()
{

    wp_enqueue_script(

        'blaze-slider-js',

        get_stylesheet_directory_uri() . '/frontend/public/js/blaze-slider.min.js',

        array(),

        CHILD_THEME_ARQAMWEB_VERSION,

        array(
            'strategy' => 'defer',
            'in_footer' => 'false',
        )
    );


    wp_enqueue_script(

        'aos-js',

        get_stylesheet_directory_uri() . '/frontend/public/js/aos.js',

        array(),

        CHILD_THEME_ARQAMWEB_VERSION,

        array(
            'strategy' => 'defer',
            'in_footer' => 'false',
        )
    );


    wp_enqueue_script(

        'flowbite-js',

        get_stylesheet_directory_uri() . '/frontend/public/js/flowbite.min.js',

        array(),

        CHILD_THEME_ARQAMWEB_VERSION,

        array(
            'strategy' => 'defer',
            'in_footer' => 'false',
        )
    );

    wp_enqueue_script(

        'main-js',

        get_stylesheet_directory_uri() . '/frontend/public/js/main.js',

        array(),

        CHILD_THEME_ARQAMWEB_VERSION,

        array(
            'strategy' => 'defer',
            'in_footer' => 'true',
        )
    );
}

add_action('wp_enqueue_scripts', 'my_custom_scripts');


require_once(get_stylesheet_directory() . '/inc/features.php');
require_once(get_stylesheet_directory() . '/inc/category-badges.php');
require_once(get_stylesheet_directory() . '/inc/november-offer.php');
require_once(get_stylesheet_directory() . '/inc/deal-of-hour.php');
require_once(get_stylesheet_directory() . '/inc/exit-popup.php');

add_filter('astra_page_layout', function () {
    return 'no-sidebar';
});

add_filter('woocommerce_checkout_fields', 'remove_postcode_checkout_field');
function remove_postcode_checkout_field($fields)
{
    unset($fields['billing']['billing_postcode']);
    unset($fields['shipping']['shipping_postcode']);
    return $fields;
}


add_action('woocommerce_single_product_summary', 'custom_product_gallery_below_cart', 35);

function custom_product_gallery_below_cart()
{
    global $product;

    $attachment_ids = [
        get_field('icon_1'),
        get_field('icon_2'),
        get_field('icon_3'),
        get_field('icon_4'),
    ];

    // شيل أي فيلد فاضي أو مش متظبط
    $attachment_ids = array_filter($attachment_ids);

    if ($attachment_ids) {
        echo '<div class="custom-gallery-below" style="margin-top:20px;">';

        foreach ($attachment_ids as $attachment_id) {
            $image = wp_get_attachment_image($attachment_id, 'medium');
            echo '<div style="display:inline-block;margin:5px;">' . $image . '</div>';
        }

        echo '</div>';
    }
}

/**
 * Allow Order Manager role to access wp-admin
 * and prevent WooCommerce from redirecting it to My Account
 */

// 1) اسمح لـ WooCommerce بدخول الأدمن لهذا الدور
add_filter('woocommerce_prevent_admin_access', function ($prevent_access) {
    if (current_user_can('edit_shop_orders')) {
        return false;
    }

    return $prevent_access;
});

// 2) لو فيه أي redirect عام لغير الأدمن، اسمح لهذا الدور
add_action('admin_init', function () {
    if (
        is_user_logged_in() &&
        current_user_can('edit_shop_orders')
    ) {
        return;
    }
}, 1);

// 3) بعد تسجيل الدخول، وديه مباشرة لصفحة الطلبات
add_filter('login_redirect', function ($redirect_to, $request, $user) {
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array('order_manager', $user->roles)) {
            return admin_url('edit.php?post_type=shop_order');
        }
    }

    return $redirect_to;
}, 10, 3);


// add panel to customize to slider 
add_action('customize_register', 'frontend_customizer_settings');

function frontend_customizer_settings($wp_customize)
{
    // 1. الـ Panel الرئيسي: Front End
    $wp_customize->add_panel('frontend_panel', [
        'title'    => 'Front End',
        'priority' => 30,
    ]);

    // 2. الـ Section: Slider (جوا الـ Panel)
    $wp_customize->add_section('frontend_slider_section', [
        'title' => 'Slider',
        'panel' => 'frontend_panel',
    ]);

    // 3. صورتين السلايدر
    for ($i = 1; $i <= 2; $i++) {
        $wp_customize->add_setting("hero_slide_$i", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "hero_slide_$i",
            [
                'label'   => "Slide Image $i",
                'section' => 'frontend_slider_section',
            ]
        ));
    }
}
