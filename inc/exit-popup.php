<?php

/**
 * Exit Pop-up for abandoned carts (Concept A)
 * بيظهر لما العميل اللي في سلته منتجات يحاول يخرج أو يرجع، وبيعرض عليه خصم يكمل بيه
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Customizer: Front End > Exit Pop-up
 */
add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_section('frontend_exit_popup_section', [
        'title'       => 'Exit Pop-up',
        'panel'       => 'frontend_panel',
        'description' => 'بيظهر للعميل اللي ضاف منتجات للسلة وبيحاول يخرج أو يرجع. لازم الكوبون يكون متعمل الأول من WooCommerce > Marketing > Coupons.',
    ]);

    $fields = [
        'exit_popup_enabled'  => ['label' => 'Enable Exit Pop-up', 'type' => 'checkbox', 'default' => true],
        'exit_popup_coupon'   => ['label' => 'Coupon Code', 'type' => 'text', 'default' => ''],
        'exit_popup_eyebrow'  => ['label' => 'Small Title', 'type' => 'text', 'default' => 'Wait a moment'],
        'exit_popup_title'    => ['label' => 'Title', 'type' => 'text', 'default' => 'Your glow is waiting'],
        'exit_popup_text'     => ['label' => 'Text', 'type' => 'textarea', 'default' => 'Complete your order now and enjoy an exclusive discount on everything in your cart.'],
        'exit_popup_button'   => ['label' => 'Button Text', 'type' => 'text', 'default' => 'Claim my discount'],
        'exit_popup_days'     => ['label' => 'Hide after closing (days)', 'type' => 'number', 'default' => 1],
    ];

    foreach ($fields as $id => $field) {
        $sanitize = 'sanitize_text_field';
        if ($field['type'] === 'checkbox') {
            $sanitize = 'wp_validate_boolean';
        } elseif ($field['type'] === 'textarea') {
            $sanitize = 'sanitize_textarea_field';
        } elseif ($field['type'] === 'number') {
            $sanitize = 'absint';
        }

        $wp_customize->add_setting($id, [
            'default'           => $field['default'],
            'sanitize_callback' => $sanitize,
        ]);

        $wp_customize->add_control($id, [
            'label'   => $field['label'],
            'section' => 'frontend_exit_popup_section',
            'type'    => $field['type'],
        ]);
    }
});

/**
 * Valid coupon from the Customizer (or null)
 */
function eins_exit_popup_coupon()
{
    $code = wc_format_coupon_code(get_theme_mod('exit_popup_coupon', ''));

    if (!$code || !wc_get_coupon_id_by_code($code)) {
        return null;
    }

    return new WC_Coupon($code);
}

/**
 * Discount label like "10% OFF" or "EGP 50 OFF"
 */
function eins_exit_popup_discount_label($coupon)
{
    if (!$coupon) {
        return '';
    }

    $amount = $coupon->get_amount();

    if ($coupon->is_type('percent')) {
        return sprintf(__('%s%% OFF', 'arqamweb'), wc_format_localized_decimal($amount));
    }

    return sprintf(__('%s OFF', 'arqamweb'), wp_strip_all_tags(wc_price($amount)));
}

/**
 * Enqueue + popup shell (المحتوى بيتجاب بـ AJAX عشان الكاش ما يأثرش)
 */
add_action('wp_enqueue_scripts', function () {
    if (!function_exists('WC') || !get_theme_mod('exit_popup_enabled', true) || is_cart() || is_checkout()) {
        return;
    }

    wp_enqueue_script(
        'eins-exit-popup',
        get_stylesheet_directory_uri() . '/frontend/public/js/exit-popup.js',
        [],
        CHILD_THEME_ARQAMWEB_VERSION,
        [
            'strategy'  => 'defer',
            'in_footer' => true,
        ]
    );

    wp_localize_script('eins-exit-popup', 'einsExitPopup', [
        'endpoint' => WC_AJAX::get_endpoint('eins_exit_popup'),
        'days'     => (int) get_theme_mod('exit_popup_days', 1),
    ]);

    add_action('wp_footer', 'eins_exit_popup_markup');
});

function eins_exit_popup_markup()
{
    $coupon = eins_exit_popup_coupon();
    $label  = eins_exit_popup_discount_label($coupon);
?>
    <div class="eins-exit-overlay" id="eins-exit-popup" role="dialog" aria-modal="true" aria-labelledby="eins-exit-title" hidden>
        <div class="eins-exit-modal">
            <button type="button" class="eins-exit-close" data-eins-exit-close aria-label="<?php esc_attr_e('Close', 'arqamweb'); ?>">&times;</button>

            <span class="eins-exit-eyebrow"><?php echo esc_html(get_theme_mod('exit_popup_eyebrow', 'Wait a moment')); ?></span>
            <h3 class="eins-exit-title" id="eins-exit-title"><?php echo esc_html(get_theme_mod('exit_popup_title', 'Your glow is waiting')); ?></h3>
            <p class="eins-exit-text"><?php echo esc_html(get_theme_mod('exit_popup_text', 'Complete your order now and enjoy an exclusive discount on everything in your cart.')); ?></p>

            <?php if ($coupon) : ?>
                <div class="eins-exit-offer">
                    <span class="eins-exit-offer-amount"><?php echo esc_html($label); ?></span>
                    <span class="eins-exit-offer-code">
                        <?php esc_html_e('Code', 'arqamweb'); ?>: <b><?php echo esc_html(strtoupper($coupon->get_code())); ?></b>
                    </span>
                </div>
            <?php endif; ?>

            <div class="eins-exit-items" data-eins-exit-items></div>

            <a class="eins-exit-cta" href="<?php echo esc_url(add_query_arg('eins_exit_coupon', '1', wc_get_checkout_url())); ?>">
                <?php echo esc_html(get_theme_mod('exit_popup_button', 'Claim my discount')); ?> &rarr;
            </a>
            <button type="button" class="eins-exit-later" data-eins-exit-close><?php esc_html_e('Continue shopping', 'arqamweb'); ?></button>
        </div>
    </div>
<?php
}

/**
 * wc-ajax=eins_exit_popup → cart items HTML
 */
add_action('wc_ajax_eins_exit_popup', function () {
    if (!WC()->cart || WC()->cart->is_empty()) {
        wp_send_json_success(['count' => 0]);
    }

    ob_start();
    foreach (WC()->cart->get_cart() as $item) {
        $product = $item['data'];
        if (!$product) {
            continue;
        }
    ?>
        <div class="eins-exit-item">
            <div class="eins-exit-thumb"><?php echo $product->get_image('thumbnail'); ?></div>
            <div class="eins-exit-name">
                <?php echo esc_html($product->get_name()); ?>
                <span><?php printf(esc_html__('Qty %d', 'arqamweb'), (int) $item['quantity']); ?></span>
            </div>
            <div class="eins-exit-price"><?php echo WC()->cart->get_product_subtotal($product, $item['quantity']); ?></div>
        </div>
    <?php
    }
    ?>
    <div class="eins-exit-total">
        <span><?php esc_html_e('Subtotal', 'arqamweb'); ?></span>
        <span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
    </div>
<?php
    wp_send_json_success([
        'count' => WC()->cart->get_cart_contents_count(),
        'html'  => ob_get_clean(),
    ]);
});

/**
 * ?eins_exit_coupon=1 → apply the coupon then redirect to clean URL
 */
add_action('template_redirect', function () {
    if (empty($_GET['eins_exit_coupon']) || !function_exists('WC') || !WC()->cart) {
        return;
    }

    $coupon = eins_exit_popup_coupon();

    if ($coupon && !WC()->cart->has_discount($coupon->get_code())) {
        WC()->cart->apply_coupon($coupon->get_code());
    }

    wp_safe_redirect(remove_query_arg('eins_exit_coupon'));
    exit;
});
