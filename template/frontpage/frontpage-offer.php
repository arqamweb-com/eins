<?php
// عرض الزيت: المنتج والخصم والنصوص وتاريخ الانتهاء جايين من العرض المربوط في الـ Customizer (بلاجن Arqam Web Offers)
$product = eins_offer_product();
$offer   = eins_linked_offer('offer_link');
if (!$product || !$offer) {
    return;
}
$bottle = get_theme_mod('offer_bottle') ?: get_stylesheet_directory_uri() . '/frontend/assets/eins-oil-hero.png';
$price  = (float) wc_get_price_to_display($product);
$value  = (float) $offer['value'];
$is_set = $offer['type'] === 'bxgy';

// اشتري X وخد Y: الزرار بيضيف الطقم كله (مثلاً إزازتين) من منتج العرض، والسعر محسوب بنفس حساب السلة
$add_qty   = $is_set ? (int) $offer['buy'] + (int) $offer['get'] : 1;
$offer_del = $price * $add_qty;
$offer_ins = $offer_del - Arqam_Offers_Calculator::discount($offer, array_fill(0, $add_qty, $price));
$add_link  = add_query_arg('quantity', $add_qty, $product->add_to_cart_url());

// الرقم الكبير + تاج الإزازة التانية
$is_free  = $is_set && $value >= 100;
$big      = $is_free ? (int) $offer['buy'] . '+' . (int) $offer['get'] : wc_format_localized_decimal($value);
$tag_text = $is_free ? __('Free!', 'woocommerce') : '-' . wc_format_localized_decimal($value) . '%';
?>
<section class="eins-offer">
    <div class="eins-offer-text">
        <span class="eins-offer-eyebrow animate-fade-up"><?php echo __('November Offer', 'arqamweb'); ?></span>
        <div class="eins-offer-num animate-fade-up" style="animation-delay: 0.1s;"><?php echo esc_html($big); ?><?php if (!$is_free) : ?><sup>%</sup><?php endif; ?></div>
        <h1 class="eins-offer-title animate-fade-up" style="animation-delay: 0.1s;"><?php echo esc_html($offer['label']); ?></h1>
        <p class="eins-offer-sub animate-fade-up" style="animation-delay: 0.2s;"><?php echo esc_html(Arqam_Offers_Rules::message($offer)); ?></p>

        <div class="eins-offer-ctas animate-fade-up" style="animation-delay: 0.3s;">
            <a class="eins-offer-btn product_type_<?php echo esc_attr($product->get_type()); ?> add_to_cart_button<?php echo $product->supports('ajax_add_to_cart') ? ' ajax_add_to_cart' : ''; ?>" href="<?php echo esc_url($add_link); ?>" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" data-quantity="<?php echo esc_attr($add_qty); ?>" rel="nofollow"><?php echo $add_qty === 2 ? __('Add 2 bottles to cart', 'arqamweb') : esc_html__('Add to cart', 'woocommerce'); ?></a>
            <a class="eins-offer-btn eins-offer-btn--ghost" href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo __('View product', 'arqamweb'); ?></a>
        </div>

        <div class="eins-offer-meta animate-fade-up" style="animation-delay: 0.3s;" data-eins-countdown="<?php echo esc_attr(eins_offer_end() * 1000); ?>">
            <div class="eins-offer-meta-label"><?php echo __('Offer ends in', 'arqamweb'); ?></div>
            <div><b data-d>00</b><span><?php echo __('Days', 'arqamweb'); ?></span></div>
            <div><b data-h>00</b><span><?php echo __('Hours', 'arqamweb'); ?></span></div>
            <div><b data-m>00</b><span><?php echo __('Minutes', 'arqamweb'); ?></span></div>
            <div><b data-s>00</b><span><?php echo __('Seconds', 'arqamweb'); ?></span></div>
        </div>
    </div>

    <div class="eins-offer-visual">
        <span class="eins-offer-ring" aria-hidden="true"></span>
        <div class="eins-offer-bottles">
            <img class="eins-offer-bottle eins-offer-bottle--1" src="<?php echo esc_url($bottle); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" fetchpriority="high">
            <div class="eins-offer-bottle eins-offer-bottle--2">
                <img src="<?php echo esc_url($bottle); ?>" alt="" aria-hidden="true">
                <span class="eins-offer-tag"><?php echo esc_html($tag_text); ?></span>
            </div>
        </div>
        <div class="eins-offer-badge">
            <b><?php echo __('2 bottles', 'arqamweb'); ?></b>
            <ins><?php echo wc_price($offer_ins); ?></ins>
            <?php if ($offer_del > $offer_ins) : ?>
                <del><?php echo wc_price($offer_del); ?></del>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const box = document.querySelector(".eins-offer [data-eins-countdown]");
        if (!box) return;

        const end = Number(box.dataset.einsCountdown);
        const pad = (n) => String(n).padStart(2, "0");
        const parts = {
            d: box.querySelector("[data-d]"),
            h: box.querySelector("[data-h]"),
            m: box.querySelector("[data-m]"),
            s: box.querySelector("[data-s]"),
        };

        function tick() {
            const left = Math.max(0, Math.floor((end - Date.now()) / 1000));
            parts.d.textContent = pad(Math.floor(left / 86400));
            parts.h.textContent = pad(Math.floor((left % 86400) / 3600));
            parts.m.textContent = pad(Math.floor((left % 3600) / 60));
            parts.s.textContent = pad(left % 60);
        }

        tick();
        setInterval(tick, 1000);
    });
</script>
