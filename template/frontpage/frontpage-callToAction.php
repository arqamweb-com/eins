<section class="section-padding bg-muted overflow-hidden">
    <div class="container mx-auto">
        <div class="max-w-2xl mx-auto text-center animate-fade-up"><span class="text-brand-neutral text-sm tracking-[0.2em] uppercase"><?php echo __('Join Our Community', 'arqamweb'); ?></span>
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-medium text-foreground mt-2 mb-4"><?php echo __('Stay in the Glow', 'arqamweb'); ?></h2>
            <p class="text-muted-foreground leading-relaxed mb-8"><?php echo __('Subscribe to receive exclusive offers, beauty tips, and the latest news about our science-backed formulations. Your journey to radiant beauty starts here.', 'arqamweb'); ?></p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto animate-fade-up" style="animation-delay: 0.2s;">
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <input type="email" placeholder="Enter your email" required="" class="w-full pl-12 pr-4 py-4 bg-background border border-border rounded text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" value="">
                </div>
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 shadow-soft hover:shadow-medium tracking-wide h-11 rounded-md px-8 hover:scale-105 transition-transform duration-300" type="submit">
                    <span><?php echo __('Subscribe', 'arqamweb'); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-4 w-4">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </button>
            </form>
            <p class="mt-4 text-xs text-muted-foreground animate-fade-up" style="animation-delay: 0.3s;"><?php echo __('By subscribing, you agree to our Privacy Policy. Unsubscribe anytime.', 'arqamweb'); ?></p>
        </div>
    </div>
</section>