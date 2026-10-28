<section class="section-padding bg-background overflow-hidden">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <div class="relative order-2 lg:order-1 animate-fade-up" style="animation-delay: 0.1s;">
                <div class="aspect-[4/5] rounded-lg overflow-hidden group">
                    <img
                        src="https://einscosmetics.com/wp-content/uploads/2026/07/Artboard-25767.png?w=800&amp;h=1000&amp;fit=crop"
                        alt="<?php echo esc_attr__('Woman with healthy, shiny hair', 'arqamweb'); ?>"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>

                <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-brand-neutral/20 rounded-lg -z-10 animate-pulse"></div>
            </div>

            <div class="order-1 lg:order-2 animate-fade-up" style="animation-delay: 0.2s;">

                <span class="text-brand-neutral text-sm tracking-[0.2em] uppercase">
                    <?php echo esc_html__('Hair Care Collection', 'arqamweb'); ?>
                </span>

                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium text-foreground mt-2 mb-6 leading-tight">
                    <?php echo esc_html__('Unlock the Secret to', 'arqamweb'); ?>
                    <span class="italic"><?php echo esc_html__('Radiant Hair', 'arqamweb'); ?></span>
                </h2>

                <p class="text-muted-foreground leading-relaxed mb-6">
                    <?php echo esc_html__("Our hair care line combines nature's most potent botanical extracts with advanced scientific formulations. From nourishing coconut oil treatments to revitalizing eucalyptus scalp care, discover products that transform your hair from root to tip.", "arqamweb"); ?>
                </p>

                <ul class="space-y-3 mb-8">

                    <li class="flex items-center gap-3 text-foreground animate-fade-up" style="animation-delay: 0.3s;">
                        <span class="w-2 h-2 rounded-full bg-brand-neutral"></span>
                        <?php echo esc_html__('Patchouli Oil for balance and repair', 'arqamweb'); ?>
                    </li>

                    <li class="flex items-center gap-3 text-foreground animate-fade-up" style="animation-delay: 0.4s;">
                        <span class="w-2 h-2 rounded-full bg-brand-neutral"></span>
                        <?php echo esc_html__('Coconut Oil for deep nourishment', 'arqamweb'); ?>
                    </li>

                    <li class="flex items-center gap-3 text-foreground animate-fade-up" style="animation-delay: 0.5s;">
                        <span class="w-2 h-2 rounded-full bg-brand-neutral"></span>
                        <?php echo esc_html__('Eucalyptus for scalp renewal', 'arqamweb'); ?>
                    </li>

                </ul>

                <a href="<?php echo esc_url(get_permalink(get_page_by_path('hair-products'))); ?>"
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:text-primary-foreground hover:bg-primary/90 shadow-soft hover:shadow-medium tracking-wide h-11 rounded-md px-8 hover:scale-105 transition-transform duration-300">

                    <span><?php echo esc_html__('Explore Hair Products', 'arqamweb'); ?></span>

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-arrow-right ml-2 h-5 w-5">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>

                </a>

            </div>

        </div>
    </div>
</section>