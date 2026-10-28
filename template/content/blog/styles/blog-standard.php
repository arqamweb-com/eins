<?php
$cat = get_the_category();
$category_title = esc_html($cat ? $cat[0]->slug : 'blog');
?>
<article class="gradient-card border border-border/50 rounded-2xl overflow-hidden group hover-glow card-shine" style="animation-delay: 0s;">
    <div class="relative overflow-hidden aspect-[16/10]">
        <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', [
                    'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500'
                ]); ?>
            <?php else : ?>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/frontend/assets/placeholder.jpg" class="w-full h-full object-cover" alt="<?php the_title(); ?>">
            <?php endif; ?>
        </a>


        <div class="absolute top-4 left-4">
            <span class="px-3 py-1 bg-primary text-primary-foreground text-xs font-semibold rounded-full"><?php echo $category_title; ?></span>
        </div>
    </div>
    <div class="p-6">
        <div class="flex items-center gap-4 text-sm text-muted-foreground mb-4">
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                    <path d="M8 2v4"></path>
                    <path d="M16 2v4"></path>
                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                    <path d="M3 10h18"></path>
                </svg>
                <span><?php echo get_the_date('M j, Y'); ?></span>
            </span>
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <?php echo ceil(str_word_count(get_the_content()) / 200); ?> min read</span>
        </div>
        <h3 class="font-heading text-xl font-semibold text-foreground mb-3 group-hover:text-primary transition-colors line-clamp-2"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
        <p class="text-muted-foreground text-sm leading-relaxed mb-4 line-clamp-3"><?php echo get_the_excerpt(); ?></p>
        <div class="flex items-center justify-between pt-4 border-t border-border/50">
            <span class="flex items-center gap-2 text-sm text-muted-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span><?php the_author(); ?></span>
            </span>
            <a href="<?php the_permalink(); ?>" class="text-primary font-medium text-sm flex items-center gap-1 group-hover:gap-2 transition-all cursor-pointer">
                <span>Read More</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </span>
        </div>
    </div>
</article>