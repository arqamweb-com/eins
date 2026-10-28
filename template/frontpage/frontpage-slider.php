<?php
$slides = array_values(array_filter([
    get_theme_mod('hero_slide_1', get_stylesheet_directory_uri() . '/frontend/assets/hero-background-CnRpD7Yp.png'),
    get_theme_mod('hero_slide_2', get_stylesheet_directory_uri() . '/frontend/assets/hero-slide-2-Bs2o41R2.png'),
]));

if (!$slides) {
    return;
}
?>
<section class="eins-hero-slider">
    <!-- أول صورة هي اللي بتحدد ارتفاع السلايدر، والباقي فوقها -->
    <?php foreach ($slides as $index => $slide_url) : ?>
        <img class="hero-slide <?php echo ($index === 0) ? 'is-active' : ''; ?>"
            src="<?php echo esc_url($slide_url); ?>"
            alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
            <?php echo ($index === 0) ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
    <?php endforeach; ?>

    <?php if (count($slides) > 1) : ?>
        <button class="eins-hero-arrow eins-hero-prev" aria-label="Previous slide">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
        </button>
        <button class="eins-hero-arrow eins-hero-next" aria-label="Next slide">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </button>

        <div class="eins-hero-dots">
            <?php foreach ($slides as $index => $slide_url) : ?>
                <button class="<?php echo ($index === 0) ? 'is-active' : ''; ?>" aria-label="Go to slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const slides = document.querySelectorAll(".eins-hero-slider .hero-slide");
        const dots = document.querySelectorAll(".eins-hero-dots button");
        let current = 0;
        const interval = 5000; // 5 ثواني

        if (slides.length < 2) return;

        function showSlide(index) {
            slides.forEach((slide, i) => slide.classList.toggle("is-active", i === index));
            dots.forEach((dot, i) => dot.classList.toggle("is-active", i === index));
            current = index;
        }

        function nextSlide() {
            showSlide((current + 1) % slides.length);
        }

        let sliderInterval = setInterval(nextSlide, interval);

        function goTo(index) {
            clearInterval(sliderInterval);
            showSlide((index + slides.length) % slides.length);
            sliderInterval = setInterval(nextSlide, interval);
        }

        dots.forEach((dot, index) => {
            dot.addEventListener("click", () => goTo(index));
        });

        document.querySelector(".eins-hero-prev").addEventListener("click", () => goTo(current - 1));
        document.querySelector(".eins-hero-next").addEventListener("click", () => goTo(current + 1));
    });
</script>
