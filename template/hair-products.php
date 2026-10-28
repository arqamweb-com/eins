<?php /* Template Name: Hair Products */ ?>

<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div>

    <main class="flex-1">

        <section class="relative bg-primary py-20 sm:py-28 overflow-hidden">

            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-96 h-96 bg-brand-neutral rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <div class="max-w-3xl">

                    <span class="text-brand-neutral text-sm tracking-[0.2em] uppercase mb-4 block">
                        <?php echo esc_html__("Hair Care Collection", "arqamweb"); ?>
                    </span>

                    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-medium text-primary-foreground mb-6 leading-tight">
                        <?php echo esc_html__("Transform Your Hair", "arqamweb"); ?>
                        <span class="italic"><?php echo esc_html__("Naturally", "arqamweb"); ?></span>
                    </h1>

                    <p class="text-lg text-primary-foreground/80 leading-relaxed max-w-2xl">
                        <?php echo esc_html__("Our hair care range harnesses the power of nature's most potent botanicals—patchouli, coconut, and eucalyptus—combined with advanced science for hair that radiates health and vitality.", "arqamweb"); ?>
                    </p>

                </div>
            </div>
        </section>


        <section class="py-12 bg-muted border-b border-border">

            <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">

                    <div>
                        <h3 class="font-serif text-lg font-medium text-foreground mb-1">
                            <?php echo esc_html__("Deep Nourishment", "arqamweb"); ?>
                        </h3>

                        <p class="text-sm text-muted-foreground">
                            <?php echo esc_html__("Coconut oil penetrates the hair shaft", "arqamweb"); ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="font-serif text-lg font-medium text-foreground mb-1">
                            <?php echo esc_html__("Scalp Health", "arqamweb"); ?>
                        </h3>

                        <p class="text-sm text-muted-foreground">
                            <?php echo esc_html__("Eucalyptus purifies and refreshes", "arqamweb"); ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="font-serif text-lg font-medium text-foreground mb-1">
                            <?php echo esc_html__("Balance & Repair", "arqamweb"); ?>
                        </h3>

                        <p class="text-sm text-muted-foreground">
                            <?php echo esc_html__("Patchouli restores natural beauty", "arqamweb"); ?>
                        </p>
                    </div>

                </div>
            </div>
        </section>


        <section class="section-padding bg-background">

            <div class="container mx-auto">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-12">

                    <div>

                        <h2 class="font-serif text-3xl sm:text-4xl font-medium text-foreground">
                            <?php echo esc_html__("Hair Care Products", "arqamweb"); ?>
                        </h2>

                        <p class="text-muted-foreground mt-2">
                            <?php echo esc_html__("5 products for radiant, healthy hair", "arqamweb"); ?>
                        </p>

                    </div>

                    <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border border-primary text-primary bg-transparent hover:bg-primary hover:text-primary-foreground tracking-wide h-10 px-4 py-2"
                        href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">

                        <?php echo esc_html__("View All Products", "arqamweb"); ?>

                    </a>

                </div>



                <?php

                $args = [
                    'post_type'      => 'product',
                    'posts_per_page' => 8,
                    'post_status'    => 'publish',
                    'tax_query'      => [
                        [
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => 'hair-products',
                        ],
                    ],
                ];

                $query = new WP_Query($args);

                ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

                    <?php if ($query->have_posts()) : ?>

                        <?php $delay = 0; ?>

                        <?php while ($query->have_posts()) : $query->the_post(); ?>

                            <?php
                            global $product;
                            $delay += 0.1;
                            ?>

                            <div class="animate-fade-up" style="animation-delay: <?php echo esc_attr($delay); ?>s;">

                                <article class="group relative bg-card rounded-lg overflow-hidden hover-lift">

                                    <?php eins_category_badges(get_the_ID(), [
                                        $product->is_on_sale() ? __("Sale", "arqamweb") : '',
                                    ]); ?>


                                    <div class="absolute top-4 right-4 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                    </div>


                                    <a href="<?php the_permalink(); ?>" class="block aspect-[3/4] overflow-hidden bg-muted">

                                        <?php

                                        if (has_post_thumbnail()) {

                                            the_post_thumbnail('medium', [
                                                'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105'
                                            ]);
                                        }

                                        ?>

                                    </a>


                                    <div class="p-4">

                                        <?php
                                        $terms = get_the_terms(get_the_ID(), 'product_cat');

                                        if ($terms && ! is_wp_error($terms)) :
                                        ?>

                                            <span class="text-xs text-muted-foreground tracking-wide uppercase">
                                                <?php echo esc_html($terms[0]->name); ?>
                                            </span>

                                        <?php endif; ?>


                                        <a href="<?php the_permalink(); ?>">

                                            <h3 class="font-serif text-lg font-medium text-foreground mt-1 mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                                <?php the_title(); ?>
                                            </h3>

                                        </a>


                                        <?php if ($product->get_rating_count() > 0) : ?>

                                            <div class="flex items-center gap-1 mb-3">

                                                <?php echo wc_get_rating_html($product->get_average_rating()); ?>

                                                <span class="text-xs text-muted-foreground ml-1">
                                                    (<?php echo esc_html($product->get_rating_count()); ?>)
                                                </span>

                                            </div>

                                        <?php endif; ?>


                                        <div class="flex items-center gap-2">

                                            <span class="font-semibold text-foreground">
                                                <?php echo $product->get_price_html(); ?>
                                            </span>

                                        </div>

                                    </div>

                                </article>

                            </div>

                        <?php endwhile; ?>

                    <?php endif;
                    wp_reset_postdata(); ?>

                </div>

            </div>
        </section>


        <section class="py-16 bg-muted">

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">

                <h3 class="font-serif text-2xl sm:text-3xl font-medium text-foreground mb-4">
                    <?php echo esc_html__("Not Sure Where to Start?", "arqamweb"); ?>
                </h3>

                <p class="text-muted-foreground mb-6 max-w-xl mx-auto">
                    <?php echo esc_html__("Contact us for personalized recommendations based on your hair type and concerns.", "arqamweb"); ?>
                </p>

                <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium bg-primary text-primary-foreground hover:text-primary-foreground hover:bg-primary/90 tracking-wide h-11 rounded-md px-8"
                    href="<?php echo esc_url(get_permalink(get_page_by_path('contact-us'))); ?>">

                    <?php echo esc_html__("Get in Touch", "arqamweb"); ?>

                </a>

            </div>
        </section>

    </main>

</div><!-- #primary -->




<?php get_footer(); ?>