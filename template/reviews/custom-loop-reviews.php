<?php
$per_paged = get_query_var('per_paged') ?: -1;
$style = get_query_var('style') ?: 'style-4';


$args = [
    'post_type'      => 'review',
    'posts_per_page' => $per_paged,
    'orderby'        => 'date',
    'order'          => 'ASC',
];

$q = new WP_Query($args);
?>

<?php if ($q->have_posts()) : $i = 0; ?>

    <style>
        /* fix layout shifts */
        .blaze-slider.my-slider {
            --slides-to-show: 3;
            --slide-gap: 20px;
        }

        @media (max-width: 900px) {
            .blaze-slider.my-slider {
                --slides-to-show: 2;
            }
        }

        @media (max-width: 500px) {
            .blaze-slider.my-slider {
                --slides-to-show: 1;
            }
        }

        /* other styles */
        .blaze-slider.dragging .blaze-track {
            cursor: grabbing;
        }

        /* pagination buttons */
        .blaze-pagination {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .blaze-pagination button {
            font-size: 0;
            border-radius: 999px;
            background-color: #d1e0df;
            cursor: pointer;
            transition: transform 200ms ease, background-color 300ms ease;
            padding: 3px;
            width: 8px;
            height: 8px;
        }

        .blaze-pagination button:hover {
            background-color: #fbfbf980;
        }

        .blaze-pagination button.active {
            background-color: #a5a08d;
            width: 24px;
        }

        .blaze-next,
        .blaze-prev {
            border: none;
            font-size: 0;
            cursor: pointer;
            background-position: center;
            background-size: 100%;
        }

        /* for loop: false */
        .blaze-slider.start .blaze-prev,
        .blaze-slider.end .blaze-next {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* other styles */
    </style>

    <div class="blaze-slider my-slider" data-slider-blaze>
        <div class="blaze-container">
            <div class="blaze-track-container">
                <div class="blaze-track">
                    <?php
                    while ($q->have_posts()) : $q->the_post();
                        get_template_part('template/content/reviews/review', $style);
                    endwhile;
                    ?>
                </div>
            </div>
        </div>

        <button class="blaze-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-8 z-10 bg-primary-foreground/10 hover:bg-primary-foreground/20 backdrop-blur-sm rounded-full p-3 transition-all duration-300 hover:scale-110" aria-label="Previous testimonials"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left h-6 w-6 text-primary-foreground">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
        </button>
        <button class="blaze-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-8 z-10 text-primary-foreground bg-primary-foreground/10 hover:bg-primary-foreground/20 backdrop-blur-sm rounded-full p-3 transition-all duration-300 hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hover:text-white focus:text-white lucide lucide-chevron-right w-6 h-6">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </button>

        <!-- dots -->
        <div class="blaze-pagination"></div>
    </div>

    <script>
        window.addEventListener('load', () => {
            document.querySelectorAll('[data-slider-blaze]').forEach((sliderEl) => {
                new BlazeSlider(sliderEl, {
                    all: {
                        enableAutoplay: true,
                        slidesToScroll: 1,
                        slidesToShow: 3,
                        transitionDuration: 700,
                        loop: false,
                        control: true,
                        pagination: {
                            el: sliderEl.querySelector('.blaze-pagination'),
                            clickable: true,
                        }
                    },
                    "(max-width: 900px)": {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        slidesGap: "40px",
                    },
                    "(max-width: 500px)": {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                });
            });
        });
    </script>

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <div class="col-span-full text-center text-muted-foreground mb-4">
        <?php echo __('No review are currently available.', 'arqamweb'); ?>
    </div>
<?php endif; ?>