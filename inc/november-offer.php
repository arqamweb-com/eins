<?php

/**
 * November Offer: Buy 1 Get 50% on the second
 * مؤقت لحد آخر نوفمبر، وبعدها الهوم بيرجع للسلايدر لوحده
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Customizer: Front End > November Offer
 */
add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_section('frontend_offer_section', [
        'title'       => 'November Offer',
        'panel'       => 'frontend_panel',
        'description' => 'Buy 1 Get 50% on second. الخصم بيتحسب في السلة لوحده، ولما العرض يخلص أو يتقفل الهوم بيرجع للسلايدر.',
    ]);

    $products = ['' => '— Select —'];
    foreach (wc_get_products(['status' => 'publish', 'limit' => -1]) as $product) {
        $products[$product->get_id()] = $product->get_name();
    }

    $wp_customize->add_setting('offer_enabled', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('offer_enabled', [
        'label'   => 'Enable Offer',
        'section' => 'frontend_offer_section',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('offer_product', [
        'default'           => 224,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('offer_product', [
        'label'   => 'Offer Product',
        'section' => 'frontend_offer_section',
        'type'    => 'select',
        'choices' => $products,
    ]);

    $wp_customize->add_setting('offer_bundle', [
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('offer_bundle', [
        'label'       => 'Bundle Product (Add 2 bottles button)',
        'section'     => 'frontend_offer_section',
        'type'        => 'select',
        'choices'     => $products,
        'description' => 'لو فاضي بيدور على منتج اسمه Double Elixir Bundle.',
    ]);

    $wp_customize->add_setting('offer_end', [
        'default'           => '2026-11-30 23:59',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('offer_end', [
        'label'       => 'Ends at (Y-m-d H:i)',
        'section'     => 'frontend_offer_section',
        'type'        => 'text',
        'description' => 'بتوقيت الموقع (Settings > General).',
    ]);

    $wp_customize->add_setting('offer_bottle', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'offer_bottle', [
        'label'       => 'Bottle Image (transparent PNG)',
        'section'     => 'frontend_offer_section',
        'description' => 'لو فاضية بتتعرض صورة الإزازة الافتراضية (frontend/assets/eins-oil-hero.png).',
    ]));
});

/**
 * Offer end as a timestamp (0 if the date is invalid)
 */
function eins_offer_end()
{
    $end = date_create_immutable(get_theme_mod('offer_end', '2026-11-30 23:59'), wp_timezone());

    return $end ? $end->getTimestamp() : 0;
}

/**
 * Offer product in the current language (or null when the offer is off / over)
 */
function eins_offer_product()
{
    if (!function_exists('wc_get_product') || !get_theme_mod('offer_enabled', true) || time() >= eins_offer_end()) {
        return null;
    }

    $id = apply_filters('wpml_object_id', (int) get_theme_mod('offer_product', 224), 'product', true);
    $product = $id ? wc_get_product($id) : null;

    return ($product && $product->is_purchasable()) ? $product : null;
}

/**
 * Two-bottle bundle in the current language (Customizer, or the "Double Elixir Bundle" product)
 */
function eins_offer_bundle()
{
    $id = (int) get_theme_mod('offer_bundle', 0);

    if (!$id) {
        $found = get_posts([
            'post_type'        => 'product',
            'post_status'      => 'publish',
            'title'            => 'Double Elixir Bundle',
            'posts_per_page'   => 1,
            'fields'           => 'ids',
            'suppress_filters' => true,
        ]);
        $id = $found ? (int) $found[0] : 0;
    }

    $id = $id ? apply_filters('wpml_object_id', $id, 'product', true) : 0;
    $product = $id ? wc_get_product($id) : null;

    return ($product && $product->is_purchasable()) ? $product : null;
}

/**
 * Same product across languages (WPML) → compare on the default-language ID
 */
function eins_offer_original_id($product_id)
{
    return (int) apply_filters('wpml_object_id', $product_id, 'product', true, apply_filters('wpml_default_language', null));
}

/**
 * Cart: every second bottle at 50%
 */
add_action('woocommerce_cart_calculate_fees', function ($cart) {
    $offer = eins_offer_product();
    if (!$offer) {
        return;
    }

    $offer_id = eins_offer_original_id($offer->get_id());
    $prices   = [];

    foreach ($cart->get_cart() as $item) {
        if (eins_offer_original_id($item['product_id']) !== $offer_id) {
            continue;
        }
        for ($i = 0; $i < $item['quantity']; $i++) {
            $prices[] = (float) $item['data']->get_price();
        }
    }

    // الأرخص هو اللي بياخد الخصم لو الأسعار مختلفة
    sort($prices);
    $discount = array_sum(array_slice($prices, 0, intdiv(count($prices), 2))) * 0.5;

    if ($discount > 0) {
        $cart->add_fee(__('Buy 1 Get 50% on second', 'arqamweb'), -$discount);
    }
});
