<?php

/**
 * Deal of the Month: منتج واحد ثابت (Skin Revive) بخصم لحد آخر الشهر
 * الخصم بيتحدد من الـ Customizer (نسبة) أو من كوبون WooCommerce، وبيتحسب في السلة على السيرفر
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
        'description' => 'منتج واحد ثابت بخصم لحد تاريخ الانتهاء. منتج عرض نوفمبر مستثنى من الخصم طول ما العرض شغال.',
    ]);

    $products = ['' => '— Select —'];
    foreach (wc_get_products(['status' => 'publish', 'limit' => -1]) as $product) {
        $products[$product->get_id()] = $product->get_name();
    }

    $fields = [
        'deal_product' => [
            'label'       => 'Deal Product',
            'type'        => 'select',
            'default'     => '',
            'choices'     => $products,
            'description' => 'لو فاضي بيدور على منتج اسمه Skin Revive.',
        ],
        'deal_end' => [
            'label'       => 'Ends at (Y-m-d H:i)',
            'type'        => 'text',
            'default'     => '2026-11-30 23:59',
            'description' => 'بتوقيت الموقع (Settings > General). بعدها السكشن بيختفي والخصم بيقف.',
        ],
        'deal_discount_source' => [
            'label'   => 'Discount from',
            'type'    => 'select',
            'default' => 'percent',
            'choices' => [
                'none'    => 'No discount (display only)',
                'percent' => 'Customizer percentage',
                'coupon'  => 'WooCommerce coupon',
            ],
        ],
        'deal_percent' => [
            'label'   => 'Discount %',
            'type'    => 'number',
            'default' => 15,
        ],
        'deal_coupon' => [
            'label'       => 'Coupon Code',
            'type'        => 'text',
            'default'     => '',
            'description' => 'بياخد نوع وقيمة الخصم وتاريخ الانتهاء من الكوبون (Percentage أو Fixed). مش لازم العميل يكتب الكود.',
        ],
    ];

    foreach ($fields as $id => $field) {
        $sanitize = 'sanitize_text_field';
        if ($field['type'] === 'number' || $id === 'deal_product') {
            $sanitize = 'absint';
        }

        $wp_customize->add_setting($id, [
            'default'           => $field['default'],
            'sanitize_callback' => $sanitize,
        ]);

        $wp_customize->add_control($id, array_merge([
            'section' => 'frontend_deal_section',
        ], array_intersect_key($field, array_flip(['label', 'type', 'choices', 'description']))));
    }
});

/**
 * Deal end as a timestamp (0 if the date is invalid)
 */
function eins_deal_end()
{
    $end = date_create_immutable(get_theme_mod('deal_end', '2026-11-30 23:59'), wp_timezone());

    return $end ? $end->getTimestamp() : 0;
}

/**
 * Deal product in the current language (Customizer, or the "Skin Revive" product), null when the deal is over
 */
function eins_deal_product()
{
    if (!function_exists('wc_get_product') || time() >= eins_deal_end()) {
        return null;
    }

    $id = (int) get_theme_mod('deal_product', 0);

    if (!$id) {
        $found = get_posts([
            'post_type'        => 'product',
            'post_status'      => 'publish',
            's'                => 'Skin Revive',
            'search_columns'   => ['post_title'],
            'posts_per_page'   => 1,
            'fields'           => 'ids',
            'suppress_filters' => true,
        ]);
        $id = $found ? (int) $found[0] : 0;
    }

    $id = $id ? apply_filters('wpml_object_id', $id, 'product', true) : 0;
    $product = $id ? wc_get_product($id) : null;

    return ($product && $product->is_visible()) ? $product : null;
}

/**
 * Discount for one unit at $price (0 = no discount)
 */
function eins_deal_unit_discount($product, $price)
{
    $offer = eins_offer_product();
    if ($offer && eins_offer_original_id($offer->get_id()) === eins_offer_original_id($product->get_id())) {
        return 0;
    }

    $source = get_theme_mod('deal_discount_source', 'percent');

    if ($source === 'percent') {
        $discount = $price * min(100, (int) get_theme_mod('deal_percent', 15)) / 100;
    } elseif ($source === 'coupon') {
        $code = wc_format_coupon_code(get_theme_mod('deal_coupon', ''));
        if (!$code || !wc_get_coupon_id_by_code($code)) {
            return 0;
        }

        $coupon  = new WC_Coupon($code);
        $expires = $coupon->get_date_expires();
        if ($expires && $expires->getTimestamp() < time()) {
            return 0;
        }

        $discount = $coupon->is_type('percent') ? $price * $coupon->get_amount() / 100 : (float) $coupon->get_amount();
    } else {
        return 0;
    }

    return round(min($price, $discount), wc_get_price_decimals());
}

/**
 * Cart: discount on the deal product until the deal ends
 */
add_action('woocommerce_cart_calculate_fees', function ($cart) {
    $deal = eins_deal_product();
    if (!$deal) {
        return;
    }

    $deal_id  = eins_offer_original_id($deal->get_id());
    $discount = 0;

    foreach ($cart->get_cart() as $item) {
        if (eins_offer_original_id($item['product_id']) !== $deal_id) {
            continue;
        }

        $discount += eins_deal_unit_discount($item['data'], (float) $item['data']->get_price()) * $item['quantity'];
    }

    if ($discount > 0) {
        $cart->add_fee(__('Deal of the Month', 'arqamweb'), -$discount);
    }
});
