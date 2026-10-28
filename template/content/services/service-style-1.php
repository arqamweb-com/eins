<article class="group gradient-card border border-solid border-border/50 rounded-2xl overflow-hidden hover:border-primary/50 transition-all duration-500 hover:-translate-y-2 card-shine flex flex-col" style="animation-delay: 0s;">
    <div class="w-full h-44 overflow-hidden">
        <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500']) ?>
    </div>
    <div class="p-6 flex flex-col flex-grow">
        <h3 class="font-heading text-xl font-semibold text-foreground mb-3 group-hover:text-primary transition-colors"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="text-muted-foreground text-sm leading-relaxed line-clamp-4 flex-grow"><?php the_excerpt(); ?></div>
        <div class="mt-auto">
            <a href="<?php the_permalink(); ?>">
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border-2 border-primary bg-transparent text-primary hover:bg-primary hover:text-primary-foreground h-9 rounded-md px-3 w-full">Read More</button>
            </a>
        </div>
    </div>
</article>