<?php
// نفس ترتيب السيرفر عشان المنتج اللي ظاهر هو اللي بياخد الخصم في السلة
$deals = eins_deal_products();

if (!$deals) {
    return;
}

$offer = eins_offer_product();
?>
<section class="eins-deal section-padding">
    <div class="container mx-auto">
        <div class="eins-deal-head animate-fade-up">
            <span class="eins-deal-eyebrow"><?php echo __('Deal of the Hour', 'arqamweb'); ?></span>
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium mt-2"><?php echo __('One product · One price · One hour', 'arqamweb'); ?></h2>
        </div>

        <!-- كل المنتجات بتترندر، والـ JS بيختار منتج الساعة عشان الكاش ما يثبتش العرض -->
        <div class="eins-deal-list" data-eins-deal>
            <?php foreach ($deals as $index => $product) : ?>
                <?php
                $price  = (float) wc_get_price_to_display($product);
                $hourly = eins_deal_unit_discount($product, $price);

                if ($hourly > 0) {
                    $off = round($hourly / $price * 100);
                } else {
                    $regular = (float) $product->get_regular_price();
                    $sale    = (float) $product->get_sale_price();
                    $off     = ($product->is_on_sale() && $regular > 0 && $sale > 0) ? round((1 - $sale / $regular) * 100) : 0;
                }
                ?>
                <article class="eins-deal-card" data-name="<?php echo esc_attr($product->get_name()); ?>" <?php echo $index ? "hidden" : ""; ?>>
                    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="eins-deal-img">
                        <?php if ($off) : ?>
                            <span class="eins-deal-tag">-<?php echo esc_html($off); ?>%</span>
                        <?php endif; ?>
                        <?php echo $product->get_image('large'); ?>
                    </a>

                    <div class="eins-deal-body">
                        <span class="eins-deal-note"><?php echo __('This deal changes every hour', 'arqamweb'); ?></span>
                        <h3 class="eins-deal-name"><a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a></h3>
                        <?php if ($product->get_short_description()) : ?>
                            <p class="eins-deal-desc"><?php echo esc_html(wp_trim_words(wp_strip_all_tags($product->get_short_description()), 22)); ?></p>
                        <?php endif; ?>

                        <div class="eins-deal-price">
                            <?php if ($hourly > 0) : ?>
                                <del><?php echo wc_price($price); ?></del> <ins><?php echo wc_price($price - $hourly); ?></ins>
                            <?php else : ?>
                                <?php echo $product->get_price_html(); ?>
                            <?php endif; ?>
                        </div>

                        <?php if ($offer && $product->get_id() === $offer->get_id()) : ?>
                            <p class="eins-deal-offer"><?php echo __('Buy 1 Get 50% on second', 'arqamweb'); ?></p>
                        <?php endif; ?>

                        <div class="eins-deal-timer">
                            <span><?php echo __('Next deal in', 'arqamweb'); ?></span>
                            <strong data-eins-deal-timer>59:59</strong>
                        </div>

                        <?php $GLOBALS['product'] = $product; woocommerce_template_loop_add_to_cart(['class' => 'eins-deal-add button add_to_cart_button ajax_add_to_cart product_type_' . $product->get_type()]); ?>

                        <p class="eins-deal-next" data-eins-deal-next></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const list = document.querySelector("[data-eins-deal]");
        if (!list) return;

        const cards = list.querySelectorAll(".eins-deal-card");
        const nextLabel = <?php echo wp_json_encode(__('Next hour:', 'arqamweb')); ?>;
        const pad = (n) => String(n).padStart(2, "0");
        let shown = -1;

        function render() {
            const now = new Date();
            const index = Math.floor(now.getTime() / 36e5) % cards.length;

            if (index !== shown) {
                cards.forEach((card, i) => (card.hidden = i !== index));
                shown = index;

                const next = list.querySelector(".eins-deal-card:not([hidden]) [data-eins-deal-next]");
                next.textContent = cards.length > 1 ? nextLabel + " " + cards[(index + 1) % cards.length].dataset.name : "";
            }

            const left = 3599 - (now.getMinutes() * 60 + now.getSeconds());
            cards[index].querySelector("[data-eins-deal-timer]").textContent = pad(Math.floor(left / 60)) + ":" + pad(left % 60);
        }

        render();
        setInterval(render, 1000);
    });
</script>
