<article class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center ">
    <div>
        <a class="block relative overflow-hidden rounded-2xl aspect-[4/3] group" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']) ?>
            <div class="absolute inset-0 bg-gradient-to-t from-background/80 to-transparent"></div>
        </a>
    </div>
    <div>

        <?php
        $sub_heading = get_field('sub_heading');

        if ($sub_heading) {
            echo "<span class='text-primary font-medium text-sm'>$sub_heading</span>";
        }
        ?>

        <a href="<?php the_permalink(); ?>">
            <h3 class="font-heading text-2xl md:text-3xl font-bold text-foreground mt-2 mb-4 hover:text-primary transition-colors"><?php the_title(); ?></h3>
        </a>
        <p class="text-muted-foreground leading-relaxed mb-6"><?php echo get_the_excerpt(); ?></p>
        <div class="mb-6">
            <span class="text-sm text-muted-foreground block mb-3">Services Provided:</span>


            <?php
            $services = get_field('select_services');

            if ($services) {
                echo '<ul class="client-services flex flex-wrap gap-2">';

                foreach ($services as $service) {
                    echo '<li>';
                    echo '<a href="' . esc_url(get_permalink($service->ID)) . '"class="px-3 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full inline-block hover:bg-primary/20 transition">';
                    echo esc_html(get_the_title($service->ID));
                    echo '</a>';
                    echo '</li>';
                }

                echo '</ul>';
            }
            ?>
        </div>
        <blockquote class="border-l-2 border-primary pl-4 italic text-muted-foreground mb-6">
            <?php

            if (get_field('the_result_in_one_line')) {
                echo get_field('the_result_in_one_line');
            }
            ?>
        </blockquote>
        <a class="inline-flex items-center gap-2 text-primary font-medium hover:gap-3 transition-all" href="<?php the_permalink(); ?>">
            <span>View Full Case Study</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4">
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
            </svg>
        </a>
    </div>
</article>