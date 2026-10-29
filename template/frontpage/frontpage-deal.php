<?php
// منتج الشهر ثابت (Skin Revive)، والخصم بيتحسب في السلة لحد آخر الشهر
$product = eins_deal_product();

if (!$product) {
    return;
}

$offer = eins_offer_product();

$price   = (float) wc_get_price_to_display($product);
$monthly = eins_deal_unit_discount($product, $price);

if ($monthly > 0) {
    $off = round($monthly / $price * 100);
} else {
    $regular = (float) $product->get_regular_price();
    $sale    = (float) $product->get_sale_price();
    $off     = ($product->is_on_sale() && $regular > 0 && $sale > 0) ? round((1 - $sale / $regular) * 100) : 0;
}
?>
<section class="eins-deal section-padding">
    <div class="container mx-auto">
        <div class="eins-deal-head animate-fade-up">
            <span class="eins-deal-eyebrow"><?php echo __('Deal of the Month', 'arqamweb'); ?></span>
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium mt-2"><?php echo __('One product · One offer · One month', 'arqamweb'); ?></h2>
        </div>

        <div class="eins-deal-list">
            <article class="eins-deal-card">
                <a href="<?php echo esc_url($product->get_permalink()); ?>" class="eins-deal-img">
                    <?php if ($off) : ?>
                        <span class="eins-deal-tag">-<?php echo esc_html($off); ?>%</span>
                    <?php endif; ?>
                    <?php echo $product->get_image('large'); ?>
                </a>

                <div class="eins-deal-body">
                    <span class="eins-deal-note"><?php echo __('This month only', 'arqamweb'); ?></span>
                    <h3 class="eins-deal-name"><a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a></h3>
                    <?php if ($product->get_short_description()) : ?>
                        <p class="eins-deal-desc"><?php echo esc_html(wp_trim_words(wp_strip_all_tags($product->get_short_description()), 22)); ?></p>
                    <?php endif; ?>

                    <div class="eins-deal-price">
                        <?php if ($monthly > 0) : ?>
                            <del><?php echo wc_price($price); ?></del> <ins><?php echo wc_price($price - $monthly); ?></ins>
                        <?php else : ?>
                            <?php echo $product->get_price_html(); ?>
                        <?php endif; ?>
                    </div>

                    <?php if ($offer && $product->get_id() === $offer->get_id()) : ?>
                        <p class="eins-deal-offer"><?php echo __('Buy 1 Get 50% on second', 'arqamweb'); ?></p>
                    <?php endif; ?>

                    <div class="eins-deal-timer" data-eins-deal-end="<?php echo esc_attr(eins_deal_end() * 1000); ?>">
                        <span><?php echo __('Offer ends in', 'arqamweb'); ?></span>
                        <strong data-eins-deal-timer>00:00:00:00</strong>
                    </div>

                    <?php $GLOBALS['product'] = $product; woocommerce_template_loop_add_to_cart(['class' => 'eins-deal-add button add_to_cart_button ajax_add_to_cart product_type_' . $product->get_type()]); ?>
                </div>
            </article>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const box = document.querySelector(".eins-deal [data-eins-deal-end]");
        if (!box) return;

        const end = Number(box.dataset.einsDealEnd);
        const timer = box.querySelector("[data-eins-deal-timer]");
        const pad = (n) => String(n).padStart(2, "0");

        // أيام:ساعات:دقايق:ثواني
        function tick() {
            const left = Math.max(0, Math.floor((end - Date.now()) / 1000));
            timer.textContent = [Math.floor(left / 86400), Math.floor((left % 86400) / 3600), Math.floor((left % 3600) / 60), left % 60].map(pad).join(":");
        }

        tick();
        setInterval(tick, 1000);
    });
</script>
