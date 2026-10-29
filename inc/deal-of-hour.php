<?php

/**
 * Deal of the Hour: خصم حقيقي لمنتج الساعة
 * الخصم بيتحدد من الـ Customizer (نسبة) أو من كوبون WooCommerce، وبيتحسب في السلة على السيرفر
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Customizer: Front End > Deal of the Hour
 */
add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_section('frontend_deal_section', [
        'title'       => 'Deal of the Hour',
        'panel'       => 'frontend_panel',
        'description' => 'المنتج بيتغير كل ساعة. الخصم بيتطبق على المنتج لو اتضاف للسلة في ساعته، ومنتج عرض نوفمبر مستثنى طول ما العرض شغال.',
    ]);

    $fields = [
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
        'deal_hold' => [
            'label'       => 'Keep the price after the hour (minutes)',
            'type'        => 'number',
            'default'     => 30,
            'description' => 'العميل اللي ضاف المنتج في ساعته بيفضل محتفظ بالسعر المدة دي بعد ما الساعة تخلص.',
        ],
    ];

    foreach ($fields as $id => $field) {
        $sanitize = 'sanitize_text_field';
        if ($field['type'] === 'number') {
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
 * Deal products in the current language, in a fixed order (by default-language ID)
 * عشان الترتيب يبقى واحد في العربي والإنجليزي وعلى السيرفر والـ JS
 */
function eins_deal_products()
{
    $ids = array_map('eins_offer_original_id', wc_get_products([
        'status' => 'publish',
        'limit'  => -1,
        'return' => 'ids',
    ]));

    $ids = array_unique($ids);
    sort($ids);

    $products = [];
    foreach (array_slice($ids, 0, 8) as $id) {
        $product = wc_get_product(apply_filters('wpml_object_id', $id, 'product', true));
        if ($product && $product->is_visible()) {
            $products[] = $product;
        }
    }

    return $products;
}

/**
 * Current hour number (same as Math.floor(Date.now() / 36e5) in JS)
 */
function eins_deal_hour()
{
    return intdiv(time(), HOUR_IN_SECONDS);
}

/**
 * Default-language ID of the product of the current hour
 */
function eins_deal_current_id()
{
    $products = eins_deal_products();
    if (!$products) {
        return 0;
    }

    return eins_offer_original_id($products[eins_deal_hour() % count($products)]->get_id());
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
 * Add to cart during the product's hour → remember the hour on the cart item
 */
add_filter('woocommerce_add_cart_item_data', function ($data, $product_id) {
    if (eins_offer_original_id($product_id) === eins_deal_current_id()) {
        $data['eins_deal_hour'] = eins_deal_hour();
    }

    return $data;
}, 10, 2);

/**
 * Cart: discount on items added in their hour (+ hold minutes)
 */
add_action('woocommerce_cart_calculate_fees', function ($cart) {
    $hold     = (int) get_theme_mod('deal_hold', 30) * MINUTE_IN_SECONDS;
    $discount = 0;

    foreach ($cart->get_cart() as $item) {
        if (empty($item['eins_deal_hour']) || time() >= ($item['eins_deal_hour'] + 1) * HOUR_IN_SECONDS + $hold) {
            continue;
        }

        $discount += eins_deal_unit_discount($item['data'], (float) $item['data']->get_price()) * $item['quantity'];
    }

    if ($discount > 0) {
        $cart->add_fee(__('Deal of the Hour', 'arqamweb'), -$discount);
    }
});
