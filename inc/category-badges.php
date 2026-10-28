<?php

/**
 * Category badges on product cards (Concept A — Soft Pills)
 * أول 3 كاتيجوريز بالترتيب الأبجدي، تحت بعض فوق صورة المنتج
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get up to 3 product category names, sorted alphabetically
 */
function eins_get_badge_categories($product_id, $limit = 3)
{
    $terms = get_the_terms($product_id, 'product_cat');

    if (!$terms || is_wp_error($terms)) {
        return [];
    }

    // شيل الكاتيجوري الافتراضي (Uncategorized)
    $default_cat = (int) get_option('default_product_cat');
    $terms = array_filter($terms, function ($term) use ($default_cat) {
        return (int) $term->term_id !== $default_cat;
    });

    $names = wp_list_pluck($terms, 'name');
    natcasesort($names);

    return array_slice(array_values($names), 0, $limit);
}

/**
 * Print the badges stack
 *
 * @param int   $product_id
 * @param array $extra  بادجات إضافية تظهر الأول (زي Sale أو Best Seller)
 */
function eins_category_badges($product_id = null, $extra = [])
{
    $product_id = $product_id ?: get_the_ID();
    $badges = array_merge(array_filter($extra), eins_get_badge_categories($product_id));

    if (!$badges) {
        return;
    }

    echo '<div class="eins-badges">';
    foreach ($badges as $badge) {
        echo '<span class="eins-badge">' . esc_html($badge) . '</span>';
    }
    echo '</div>';
}

/**
 * WooCommerce loops (Shop, Categories, Search, Related, Upsells...)
 * Astra بيحط الـ Sale flash جوه الـ thumbnail wrap، فبنستبدله بالـ stack بتاعنا
 */
add_action('wp', function () {
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 9);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
}, 20);

add_action('woocommerce_before_shop_loop_item', function () {
    global $product;

    if (!$product) {
        return;
    }

    eins_category_badges($product->get_id(), [
        $product->is_on_sale() ? __('Sale!', 'woocommerce') : '',
    ]);
}, 9);
