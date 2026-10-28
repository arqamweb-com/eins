<section class="section-padding bg-primary text-primary-foreground overflow-hidden">
    <div class="container mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-up"><span class="text-brand-neutral text-sm tracking-[0.2em] uppercase"><?php echo __('Customer Love', 'arqamweb'); ?></span>
            <h2 class="font-serif text-3xl text-primary-foreground sm:text-4xl lg:text-5xl font-medium mt-2"><?php echo __('What Our Customers Say', 'arqamweb'); ?></h2>
        </div>

        <div class="relative">
            
            <?php
            
            get_template_part('template/reviews/custom-loop', 'reviews'); 
            
            ?>
        </div>

    </div>
</section>