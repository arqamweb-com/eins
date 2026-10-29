<?php
$product = eins_offer_product();
if (!$product) {
    return;
}

$bottle = get_theme_mod('offer_bottle') ?: get_stylesheet_directory_uri() . '/frontend/assets/eins-oil-hero.png';

$price  = (float) wc_get_price_to_display($product);
$bundle = eins_offer_bundle();

// الزرار بيضيف منتج الباندل (إزازتين)، ولو مش موجود بيضيف إزازتين من منتج العرض
if ($bundle) {
    $add_link   = $bundle->add_to_cart_url();
    $offer_ins  = (float) wc_get_price_to_display($bundle);
    $offer_del  = (float) wc_get_price_to_display($bundle, ['price' => $bundle->get_regular_price()]);
} else {
    $add_link   = add_query_arg('quantity', 2, $product->add_to_cart_url());
    $offer_ins  = $price * 1.5;
    $offer_del  = $price * 2;
}
?>
<section class="eins-offer">
    <div class="eins-offer-text">
        <span class="eins-offer-eyebrow animate-fade-up"><?php echo __('November Offer', 'arqamweb'); ?></span>
        <div class="eins-offer-num animate-fade-up" style="animation-delay: 0.1s;">50<sup>%</sup></div>
        <h1 class="eins-offer-title animate-fade-up" style="animation-delay: 0.1s;"><?php echo __('Buy 1 Get 50% on second', 'arqamweb'); ?></h1>
        <p class="eins-offer-sub animate-fade-up" style="animation-delay: 0.2s;">
            <?php printf(
                esc_html__('Order two bottles of %s and the second one is half price. The discount is applied automatically in your cart.', 'arqamweb'),
                esc_html($product->get_name())
            ); ?>
        </p>

        <div class="eins-offer-ctas animate-fade-up" style="animation-delay: 0.3s;">
            <a class="eins-offer-btn" href="<?php echo esc_url($add_link); ?>" rel="nofollow"><?php echo __('Add 2 bottles to cart', 'arqamweb'); ?></a>
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
                <span class="eins-offer-tag">-50%</span>
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
