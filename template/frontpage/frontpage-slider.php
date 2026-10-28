<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
    <?php
$slides = [
    get_theme_mod('hero_slide_1', get_stylesheet_directory_uri() . '/frontend/assets/hero-background-CnRpD7Yp.png'),
    get_theme_mod('hero_slide_2', get_stylesheet_directory_uri() . '/frontend/assets/hero-slide-2-Bs2o41R2.png'),
    get_theme_mod('hero_slide_3', get_stylesheet_directory_uri() . '/frontend/assets/hero-slide-3-D45pmCRH.png'),
];

foreach ($slides as $index => $slide_url) :
    if (!$slide_url) continue;
    // آخر سلايد هو اللي بيبدأ ظاهر زي الكود الأصلي
    $opacity = ($index === 2) ? 'opacity-100' : 'opacity-0';
?>
    <div class="hero-slide absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000 ease-in-out <?php echo $opacity; ?>"
         style="background-image: url(<?php echo esc_url($slide_url); ?>);"></div>
<?php endforeach; ?>
    
    
    
    <div class="absolute inset-0 bg-primary/70"></div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-block text-brand-neutral text-sm tracking-[0.3em] uppercase mb-6 fade-up opacity-0" style="animation-delay: 0.1s; animation-fill-mode: forwards;"><?php echo __('Science meets nature', 'arqamweb'); ?></span>
            <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-medium text-primary-foreground leading-[1.1] mb-8 fade-up opacity-0" style="animation-delay: 0.2s; animation-fill-mode: forwards;"><?php echo __('Discover', 'arqamweb'); ?><br><span class="italic"><?php echo __('your glow', 'arqamweb'); ?></span></h1>
            <p class="text-lg sm:text-xl text-primary-foreground/80 max-w-2xl mx-auto mb-12 leading-relaxed fade-up opacity-0" style="animation-delay: 0.3s; animation-fill-mode: forwards;"><?php echo __('Premium skincare and haircare formulated with the most effective active ingredients at the highest concentrations, backed by the latest scientific research.', 'arqamweb'); ?></p>
            <div class="flex justify-center fade-up opacity-0" style="animation-delay: 0.4s; animation-fill-mode: forwards;">
                <a class="btn-secondary" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                    <span><?php echo __('Shop Now', 'arqamweb'); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-5 w-5">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-2 z-10">
        <button class="w-2 h-2 rounded-full transition-all duration-300 bg-primary-foreground/40 hover:bg-primary-foreground/60 p-0" aria-label="Go to slide 1"></button>
        <button class="w-2 h-2 rounded-full transition-all duration-300 bg-primary-foreground/40 hover:bg-primary-foreground/60 p-0" aria-label="Go to slide 2"></button>
        <button class="w-2 h-2 rounded-full transition-all duration-300 bg-primary-foreground w-6 p-0" aria-label="Go to slide 3"></button>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const elements = document.querySelectorAll(".fade-up");

        elements.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add("is-visible");
            }, index * 120);
        });
    });



    document.addEventListener("DOMContentLoaded", () => {
        const slides = document.querySelectorAll(".hero-slide");
        const dots = document.querySelectorAll("[aria-label^='Go to slide']");
        let current = 0;
        const interval = 5000; // 5 ثواني

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle("opacity-100", i === index);
                slide.classList.toggle("opacity-0", i !== index);
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle("w-6", i === index);
                dot.classList.toggle("bg-primary-foreground", i === index);
                dot.classList.toggle("bg-primary-foreground/40", i !== index);
            });

            current = index;
        }

        function nextSlide() {
            const next = (current + 1) % slides.length;
            showSlide(next);
        }

        let sliderInterval = setInterval(nextSlide, interval);

        dots.forEach((dot, index) => {
            dot.addEventListener("click", () => {
                clearInterval(sliderInterval);
                showSlide(index);
                sliderInterval = setInterval(nextSlide, interval);
            });
        });
    });
</script>