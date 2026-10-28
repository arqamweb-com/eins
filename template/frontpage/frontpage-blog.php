<section class="section-padding bg-background overflow-hidden">
    <div class="container mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-12 animate-fade-up">
            <div><span class="text-brand-neutral text-sm tracking-[0.2em] uppercase"><?php echo __('Beauty Journal', 'arqamweb'); ?></span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium text-foreground mt-2"><?php echo __('Latest from Our Blog', 'arqamweb'); ?></h2>
            </div>
            <a class="items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-solid border-primary text-primary bg-transparent hover:bg-primary hover:text-primary-foreground tracking-wide h-10 px-4 py-2 hidden sm:flex hover:scale-105 transition-transform" href="/blog">
                <span><?php echo __('Read All Articles', 'arqamweb'); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-4 w-4">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <?php
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
        ];

        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php $delay = 0; ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php
                    $delay += 0.15;
                    $categories = get_the_category();
                    ?>
                    <article class="group animate-fade-up" style="animation-delay: <?php echo esc_attr($delay); ?>s;">
                        <a class="block" href="<?php the_permalink(); ?>">

                            <!-- Image -->
                            <div class="aspect-[16/10] rounded-lg overflow-hidden mb-4">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', [
                                        'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110'
                                    ]); ?>
                                <?php endif; ?>
                            </div>

                            <!-- Meta -->
                            <div class="flex items-center gap-4 mb-3">
                                <?php if (! empty($categories)) : ?>
                                    <span class="text-xs text-brand-neutral tracking-wide uppercase">
                                        <?php echo esc_html($categories[0]->name); ?>
                                    </span>
                                <?php endif; ?>

                                <span class="flex items-center gap-1 text-xs text-muted-foreground">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="h-3 w-3">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <?php echo esc_html(ceil(str_word_count(get_the_content()) / 200)); ?> min read
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="font-serif text-xl font-medium text-foreground group-hover:text-primary transition-colors line-clamp-2 mb-2">
                                <?php the_title(); ?>
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-sm text-muted-foreground line-clamp-2">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </p>

                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php endif;
        wp_reset_postdata(); ?>

        <div class="mt-10 text-center sm:hidden animate-fade-up" style="animation-delay: 0.5s;">
            <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium
              border border-primary text-primary bg-transparent hover:bg-primary hover:text-primary-foreground
              transition-all duration-300 tracking-wide h-10 px-4 py-2"
                href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">

                <span><?php echo __('Read All Articles', 'arqamweb'); ?></span>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="ml-2 h-4 w-4">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>