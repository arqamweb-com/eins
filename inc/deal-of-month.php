<?php

/**
 * Deal of the Month section (home)
 * الخصم نفسه بقى في بلاجن Arqam Web Offers، والسكشن بيقرا من العرض المربوط في الـ Customizer
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Customizer: Front End > Deal of the Month
 */
add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_section('frontend_deal_section', [
        'title'       => 'Deal of the Month',
        'panel'       => 'frontend_panel',
        'description' => 'المنتج والخصم وتاريخ الانتهاء بيتظبطوا من لوحة التحكم > Offers. السكشن بيظهر طول ما العرض المربوط شغال.',
    ]);

    $wp_customize->add_setting('deal_link', [
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('deal_link', [
        'label'       => 'Linked Offer (Arqam Web Offers)',
        'section'     => 'frontend_deal_section',
        'type'        => 'select',
        'choices'     => eins_offer_choices(),
        'description' => 'لازم يكون عرض على منتجات محددة (Selected products) وليه تاريخ انتهاء عشان العداد.',
    ]);

    // صورة الإزازة اللي بتتكرر مرتين في السكشن (بنخزن الـ ID عشان نختار المقاس)
    $wp_customize->add_setting('deal_bottle', [
        'default'           => 708,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'deal_bottle', [
        'label'       => 'Bottle Image (transparent PNG)',
        'section'     => 'frontend_deal_section',
        'mime_type'   => 'image',
        'description' => 'بتتعرض إزازتين منها بأنيميشن. لو فاضية بتتعرض صورة المنتج العادية.',
    ]));
});

/**
 * Bottle image attachment ID for the deal section (0 = use the product image)
 */
function eins_deal_bottle()
{
    $id = absint(get_theme_mod('deal_bottle', 708));

    return ($id && wp_attachment_is_image($id)) ? $id : 0;
}

/**
 * Deal end as a timestamp, from the linked plugin offer (0 when there is none)
 */
function eins_deal_end()
{
    $offer = eins_linked_offer('deal_link');

    return $offer ? Arqam_Offers_Rules::timestamp($offer['end']) : 0;
}

/**
 * Deal product in the current language, null when the linked offer is off / over
 */
function eins_deal_product()
{
    $product = eins_linked_offer_product(eins_linked_offer('deal_link'));

    return ($product && $product->is_visible()) ? $product : null;
}

/**
 * Discount for one unit at $price (0 = no discount)
 * نفس حساب البلاجن، وبيرجع 0 لو المنتج واخد عرض تاني بأولوية أعلى (زي عرض نوفمبر)
 */
function eins_deal_unit_discount($product, $price)
{
    $offer = eins_linked_offer('deal_link');
    if (!$offer || $offer['type'] !== 'discount') {
        return 0;
    }

    $applied = Arqam_Offers_Rules::for_product($product);
    if (!$applied || $applied['id'] !== $offer['id']) {
        return 0;
    }

    return Arqam_Offers_Calculator::discount($offer, [(float) $price]);
}
