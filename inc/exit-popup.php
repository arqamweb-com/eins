<?php

/**
 * Offer Pop-up: Reminder للعرض الحالي (Buy 1 Get 50% on second + Free Shipping)
 * بيظهر لأي زائر بعد ثواني أو لما يحاول يخرج / يرجع، وبيتقفل لوحده لما العرض يخلص
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Customizer: Front End > Offer Pop-up
 * النصوص لو فاضية بتاخد الافتراضي المترجم (WPML String Translation)
 */
add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_section('frontend_exit_popup_section', [
        'title'       => 'Offer Pop-up',
        'panel'       => 'frontend_panel',
        'description' => 'Reminder للعرض اللي في Front End > November Offer. بيظهر بس طول ما العرض شغال. سيب النصوص فاضية عشان تاخد الافتراضي بالعربي والإنجليزي.',
    ]);

    $fields = [
        'exit_popup_enabled'  => ['label' => 'Enable Pop-up', 'type' => 'checkbox', 'default' => true],
        'exit_popup_eyebrow'  => ['label' => 'Small Title', 'type' => 'text', 'default' => ''],
        'exit_popup_title'    => ['label' => 'Title', 'type' => 'text', 'default' => ''],
        'exit_popup_text'     => ['label' => 'Text', 'type' => 'textarea', 'default' => ''],
        'exit_popup_button'   => ['label' => 'Button Text', 'type' => 'text', 'default' => ''],
        'exit_popup_delay'    => ['label' => 'Show after (seconds, 0 = exit only)', 'type' => 'number', 'default' => 8],
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
 * Enqueue + popup markup
 */
add_action('wp_enqueue_scripts', function () {
    $product = eins_offer_product();

    // مالوش لازمة في السلة والدفع أو في صفحة منتج العرض نفسه
    if (!get_theme_mod('exit_popup_enabled', true) || !$product || is_cart() || is_checkout() || is_single($product->get_id())) {
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
        'delay' => (int) get_theme_mod('exit_popup_delay', 8),
        'days'  => (int) get_theme_mod('exit_popup_days', 1),
    ]);

    add_action('wp_footer', 'eins_exit_popup_markup');
});

function eins_exit_popup_markup()
{
    $product = eins_offer_product();
?>
    <div class="eins-exit-overlay" id="eins-exit-popup" role="dialog" aria-modal="true" aria-labelledby="eins-exit-title" hidden>
        <div class="eins-exit-modal">
            <button type="button" class="eins-exit-close" data-eins-exit-close aria-label="<?php esc_attr_e('Close', 'arqamweb'); ?>">&times;</button>

            <span class="eins-exit-eyebrow"><?php echo esc_html(get_theme_mod('exit_popup_eyebrow') ?: __('November Offer', 'arqamweb')); ?></span>
            <h3 class="eins-exit-title" id="eins-exit-title"><?php echo esc_html(get_theme_mod('exit_popup_title') ?: __('Don\'t miss this month\'s offer', 'arqamweb')); ?></h3>
            <p class="eins-exit-text"><?php echo esc_html(get_theme_mod('exit_popup_text') ?: sprintf(__('Order two bottles of %s and get the second one at half price, until the end of November.', 'arqamweb'), $product->get_name())); ?></p>

            <div class="eins-exit-offer">
                <span class="eins-exit-offer-amount"><?php echo __('50% OFF the 2nd', 'arqamweb'); ?></span>
                <span class="eins-exit-offer-plus">+ <?php echo __('Free Shipping', 'arqamweb'); ?></span>
            </div>

            <a class="eins-exit-cta" href="<?php echo esc_url($product->get_permalink()); ?>">
                <?php echo esc_html(get_theme_mod('exit_popup_button') ?: __('Shop the offer', 'arqamweb')); ?> &rarr;
            </a>
            <button type="button" class="eins-exit-later" data-eins-exit-close><?php esc_html_e('Maybe later', 'arqamweb'); ?></button>
        </div>
    </div>
<?php
}
