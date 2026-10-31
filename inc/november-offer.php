<?php

/**
 * November Offer section (home + exit pop-up)
 * الخصم نفسه بقى في بلاجن Arqam Web Offers، والسكشن بيقرا من العرض المربوط في الـ Customizer
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
        'description' => 'المنتج والخصم وتاريخ الانتهاء بيتظبطوا من لوحة التحكم > Offers. السكشن بيظهر طول ما العرض المربوط شغال، ولما يخلص أو يتقفل الهوم بيرجع للسلايدر.',
    ]);

    $wp_customize->add_setting('offer_link', [
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('offer_link', [
        'label'       => 'Linked Offer (Arqam Web Offers)',
        'section'     => 'frontend_offer_section',
        'type'        => 'select',
        'choices'     => eins_offer_choices(),
        'description' => 'لازم يكون عرض على منتجات محددة (Selected products) وليه تاريخ انتهاء عشان العداد.',
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
 * Offer end as a timestamp, from the linked plugin offer (0 when there is none)
 */
function eins_offer_end()
{
    $offer = eins_linked_offer('offer_link');

    return $offer ? Arqam_Offers_Rules::timestamp($offer['end']) : 0;
}

/**
 * Offer product in the current language (or null when the linked offer is off / over)
 */
function eins_offer_product()
{
    $product = eins_linked_offer_product(eins_linked_offer('offer_link'));

    return ($product && $product->is_purchasable()) ? $product : null;
}

/**
 * Same product across languages (WPML) → compare on the default-language ID
 */
function eins_offer_original_id($product_id)
{
    return (int) apply_filters('wpml_object_id', $product_id, 'product', true, apply_filters('wpml_default_language', null));
}
