<section class="section-padding bg-background overflow-hidden">
    <div class="container mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-12 animate-fade-up">
            <div>
                <span class="text-brand-neutral text-sm tracking-[0.2em] uppercase"><?php echo __('Curated Selection', 'arqamweb'); ?></span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium text-foreground mt-2"><?php echo __('Best Sellers', 'arqamweb'); ?></h2>
            </div>
            <a class="items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-solid border-primary text-primary bg-transparent hover:bg-primary hover:text-primary-foreground tracking-wide h-10 px-4 py-2 hidden sm:flex hover:scale-105 transition-transform" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                <span><?php echo __('View All Products', 'arqamweb'); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-4 w-4">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <?php
        $args = [
            'post_type'      => 'product',
            'posts_per_page' => 8,
            'post_status'    => 'publish',
        ];

        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                <?php $delay = 0; ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php
                    global $product;
                    $delay += 0.1;
                    ?>
                    <div class="animate-fade-up hover:scale-[1.02] transition-transform duration-300"
                        style="animation-delay: <?php echo esc_attr($delay); ?>s;">

                        <article class="group relative bg-card rounded-lg overflow-hidden hover-lift">

                            <!-- Badges -->
                            <?php eins_category_badges(get_the_ID(), [
                                $product->is_featured() ? __('Best Seller', 'arqamweb') : '',
                            ]); ?>

                            <!-- Add to cart -->
                            <div class="absolute top-4 right-4 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>

                            <!-- Image -->
                            <a href="<?php the_permalink(); ?>" class="block aspect-[3/4] overflow-hidden bg-muted">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium', [
                                        'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105'
                                    ]);
                                }
                                ?>
                            </a>

                            <!-- Content -->
                            <div class="p-4">
                                <!-- Category -->
                                <?php
                                $terms = get_the_terms(get_the_ID(), 'product_cat');
                                if ($terms && !is_wp_error($terms)) :
                                ?>
                                    <span class="text-xs text-muted-foreground tracking-wide uppercase">
                                        <?php echo esc_html($terms[0]->name); ?>
                                    </span>
                                <?php endif; ?>

                                <!-- Title -->
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="font-serif text-lg font-medium text-foreground mt-1 mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                        <?php the_title(); ?>
                                    </h3>
                                </a>

                                <!-- Rating -->
                                <?php
                                $rating_count = $product->get_rating_count();
                                $average      = $product->get_average_rating();

                                if ($rating_count > 0) :
                                ?>
                                    <div class="flex items-center gap-1 mb-3 row-reverse">
                                        <span class="text-xs text-muted-foreground ml-1">
                                            (<?php echo esc_html($rating_count); ?>)
                                        </span>
                                        <?php echo wc_get_rating_html($average); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Price -->
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold text-foreground">
                                        <?php echo $product->get_price_html(); ?>
                                    </span>
                                </div>
                            </div>

                        </article>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>

        <div class="mt-10 text-center sm:hidden animate-fade-up" style="animation-delay: 0.5s;">
            <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-primary text-primary bg-transparent hover:bg-primary hover:text-primary-foreground tracking-wide h-10 px-4 py-2" href="/shop">
                <span><?php echo __('View All Products', 'arqamweb'); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-4 w-4">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>