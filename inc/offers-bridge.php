<?php

/**
 * Bridge with the Arqam Web Offers plugin
 * سكاشن الهوم (عرض نوفمبر + عرض الشهر) بتقرا المنتج والخصم وتاريخ الانتهاء من عرض في البلاجن،
 * والخصم نفسه بيتحسب في السلة من البلاجن بس.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * The plugin offer linked to a Customizer setting, only while it is running (null otherwise)
 */
function eins_linked_offer($setting)
{
    if (!class_exists('Arqam_Offers_Rules')) {
        return null;
    }

    $id = (int) get_theme_mod($setting, 0);
    if (!$id || get_post_type($id) !== Arqam_Offers_Rules::POST_TYPE) {
        return null;
    }

    $offer = Arqam_Offers_Rules::get($id);

    return Arqam_Offers_Rules::status($offer) === 'active' ? $offer : null;
}

/**
 * First product of an offer, in the current language
 */
function eins_linked_offer_product($offer)
{
    if (!$offer || $offer['scope'] !== 'products' || !$offer['products'] || !function_exists('wc_get_product')) {
        return null;
    }

    $id = (int) apply_filters('wpml_object_id', $offer['products'][0], 'product', true);

    return $id ? wc_get_product($id) : null;
}

/**
 * Offers list for Customizer selects
 */
function eins_offer_choices()
{
    $choices = ['' => '— None (section hidden) —'];

    if (!class_exists('Arqam_Offers_Rules')) {
        return $choices;
    }

    $ids = get_posts([
        'post_type'        => Arqam_Offers_Rules::POST_TYPE,
        'post_status'      => 'publish',
        'posts_per_page'   => -1,
        'fields'           => 'ids',
        'suppress_filters' => true,
    ]);

    foreach ($ids as $id) {
        $choices[$id] = get_the_title($id);
    }

    return $choices;
}

/**
 * One-time move of the old Customizer offers into the plugin
 * بيشتغل مرة واحدة (على اللوكال وعلى السيرفر بعد الرفع) وبيربط السكاشن بالعروض الجديدة
 */
add_action('init', function () {
    if (!class_exists('Arqam_Offers_Rules') || !function_exists('wc_get_product') || get_option('eins_offers_migrated')) {
        return;
    }

    update_option('eins_offers_migrated', time(), false);

    $date = function ($value) {
        $parsed = date_create_immutable((string) $value, wp_timezone());
        return $parsed ? $parsed->format('Y-m-d\TH:i') : '';
    };

    $product_id = function ($id, $title) {
        $id = (int) $id;
        if (!$id) {
            $found = get_posts([
                'post_type'        => 'product',
                'post_status'      => 'publish',
                's'                => $title,
                'search_columns'   => ['post_title'],
                'posts_per_page'   => 1,
                'fields'           => 'ids',
                'suppress_filters' => true,
            ]);
            $id = $found ? (int) $found[0] : 0;
        }
        return Arqam_Offers_Rules::original_id($id);
    };

    $create = function ($title, $arabic, array $settings) {
        $id = wp_insert_post([
            'post_type'   => Arqam_Offers_Rules::POST_TYPE,
            'post_status' => 'publish',
            'post_title'  => $title,
        ]);

        if (!$id || is_wp_error($id)) {
            return 0;
        }

        update_post_meta($id, Arqam_Offers_Rules::META, array_merge(Arqam_Offers_Rules::defaults(), $settings));

        // اسم العرض بالعربي في السلة (WPML String Translation)
        if (function_exists('icl_register_string') && function_exists('icl_add_string_translation')) {
            $string_id = icl_register_string('arqamweb-offers', 'offer-title-' . $id, $title);
            if ($string_id) {
                icl_add_string_translation($string_id, 'ar', $arabic, defined('ICL_TM_COMPLETE') ? ICL_TM_COMPLETE : 10);
            }
        }

        return $id;
    };

    // November offer: Buy 1 Get 50% on the second (Hair Elixir)
    $offer_product = $product_id(get_theme_mod('offer_product', 224), 'Hair Elixir');
    if ($offer_product) {
        $id = $create('Buy 1 Get 50% on second', 'اشترِ قطعة واحصل على الثانية بنصف السعر', [
            'enabled'  => get_theme_mod('offer_enabled', true) ? 'yes' : 'no',
            'type'     => 'bxgy',
            'value'    => 50,
            'buy'      => 1,
            'get'      => 1,
            'scope'    => 'products',
            'products' => [$offer_product],
            'end'      => $date(get_theme_mod('offer_end', '2026-11-30 23:59')),
            'priority' => 20,
        ]);
        if ($id) {
            set_theme_mod('offer_link', $id);
        }
    }

    // Deal of the Month: 15% on Skin Revive (old "percent" source; the coupon source was never used)
    $deal_product = $product_id(get_theme_mod('deal_product', 0), 'Skin Revive');
    if ($deal_product && get_theme_mod('deal_discount_source', 'percent') === 'percent') {
        $id = $create('Deal of the Month', 'عرض الشهر', [
            'type'        => 'discount',
            'amount_type' => 'percent',
            'value'       => min(100, (int) get_theme_mod('deal_percent', 15)),
            'scope'       => 'products',
            'products'    => [$deal_product],
            'end'         => $date(get_theme_mod('deal_end', '2026-11-30 23:59')),
            'priority'    => 10,
        ]);
        if ($id) {
            set_theme_mod('deal_link', $id);
        }
    }

    Arqam_Offers_Rules::flush();
}, 20);

/**
 * Card badges: الثيم بيحط بادج العرض أول واحد في الـ stack بتاعه (eins_category_badges)
 * بدل البادج اللي البلاجن بتحطه لوحدها على كروت WooCommerce
 */
add_filter('arqam_offers_show_card_badge', '__return_false');

add_filter('eins_product_badges', function ($extra, $product_id) {
    if (function_exists('arqam_offers_badge_text') && ($badge = arqam_offers_badge_text($product_id))) {
        array_unshift($extra, $badge);
    }

    return $extra;
}, 10, 2);
