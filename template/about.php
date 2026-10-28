<?php /* Template Name: About Us */ ?>

<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<main class="flex-1">

    <section class="bg-primary py-20 sm:py-28">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">

            <span class="text-brand-neutral text-sm tracking-[0.2em] uppercase mb-4 block">
                <?php echo __("Our Story", "arqamweb"); ?>
            </span>

            <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-medium text-primary-foreground mb-6">
                <?php echo __("About EINS", "arqamweb"); ?>
            </h1>

            <p class="text-lg text-primary-foreground/80 max-w-2xl mx-auto">
                <?php echo __("Where cutting-edge science meets the wisdom of nature to unlock your skin's true radiance.", "arqamweb"); ?>
            </p>

        </div>
    </section>


    <section class="section-padding bg-background">
        <div class="container mx-auto">

            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                <div>

                    <span class="text-brand-neutral text-sm tracking-[0.2em] uppercase">
                        <?php echo __("Our Vision", "arqamweb"); ?>
                    </span>

                    <h2 class="font-serif text-3xl sm:text-4xl font-medium text-foreground mt-2 mb-6">
                        <?php echo __("Leading Innovation in Beauty", "arqamweb"); ?>
                    </h2>

                    <p class="text-muted-foreground leading-relaxed mb-4">
                        <?php echo __("At Eins, our vision is to be the leading innovator in the cosmetics and skincare industry, creating unparalleled beauty solutions that empower individuals to embrace their unique radiance.", "arqamweb"); ?>
                    </p>

                    <p class="text-muted-foreground leading-relaxed">
                        <?php echo __("We strive to set new standards of excellence by delivering groundbreaking, high-quality products that transform beauty routines and inspire confidence globally.", "arqamweb"); ?>
                    </p>

                </div>

                <div class="rounded-lg overflow-hidden">
                    <img src="https://einscosmetics.com/wp-content/uploads/2026/04/Hair-Elixir-scaled.jpg" alt="EINS laboratory" class="w-full h-full object-cover">
                </div>

            </div>
        </div>
    </section>


    <section class="section-padding bg-muted">

        <div class="container mx-auto">

            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                <div class="order-2 lg:order-1 rounded-lg overflow-hidden">
                    <img src="https://einscosmetics.com/wp-content/uploads/2026/04/9-17.png" alt="Natural ingredients" class="w-full h-full object-cover">
                </div>

                <div class="order-1 lg:order-2">

                    <span class="text-brand-neutral text-sm tracking-[0.2em] uppercase">
                        <?php echo __("Our Mission", "arqamweb"); ?>
                    </span>

                    <h2 class="font-serif text-3xl sm:text-4xl font-medium text-foreground mt-2 mb-6">
                        <?php echo __("Exceptional Beauty Solutions", "arqamweb"); ?>
                    </h2>

                    <p class="text-muted-foreground leading-relaxed mb-4">
                        <?php echo __("Eins is dedicated to providing exceptional skincare and haircare products that stand out for their uniqueness and effectiveness. Our mission is to enhance the natural beauty of our customers by combining cutting-edge technology with natural ingredients.", "arqamweb"); ?>
                    </p>

                    <p class="text-muted-foreground leading-relaxed">
                        <?php echo __("We are committed to excellence, innovation, and sustainability, ensuring that every product delivers visible results and fosters self-care and confidence.", "arqamweb"); ?>
                    </p>

                </div>

            </div>
        </div>
    </section>


    <section class="section-padding bg-primary text-primary-foreground">

        <div class="container mx-auto">

            <div class="max-w-3xl mx-auto text-center">

                <span class="text-brand-neutral text-sm tracking-[0.2em] uppercase mb-4 block">
                    <?php echo __("Our Approach", "arqamweb"); ?>
                </span>

                <h2 class="font-serif text-3xl text-primary-foreground sm:text-4xl font-medium mb-6">
                    <?php echo __("Science-Backed Formulations", "arqamweb"); ?>
                </h2>

                <p class="text-primary-foreground/80 text-lg leading-relaxed mb-8">
                    <?php echo __("Our treatments include the most effective active ingredients at the highest concentrations possible, formulated based on the latest scientific research to deliver transformative results.", "arqamweb"); ?>
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-12">

                    <div>
                        <p class="font-serif text-4xl font-medium text-brand-neutral">100%</p>
                        <p class="text-sm text-primary-foreground/70 mt-1">
                            <?php echo __("Clean Ingredients", "arqamweb"); ?>
                        </p>
                    </div>

                    <div>
                        <p class="font-serif text-4xl font-medium text-brand-neutral">50+</p>
                        <p class="text-sm text-primary-foreground/70 mt-1">
                            <?php echo __("Clinical Studies", "arqamweb"); ?>
                        </p>
                    </div>

                    <div>
                        <p class="font-serif text-4xl font-medium text-brand-neutral">98%</p>
                        <p class="text-sm text-primary-foreground/70 mt-1">
                            <?php echo __("Customer Satisfaction", "arqamweb"); ?>
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <section class="section-padding bg-background">

        <div class="container mx-auto text-center">

            <h3 class="font-serif text-2xl sm:text-3xl font-medium text-foreground mb-4">
                <?php echo __("Ready to Discover Your Glow?", "arqamweb"); ?>
            </h3>

            <p class="text-muted-foreground mb-8 max-w-xl mx-auto">
                <?php echo __("Explore our collection of premium skincare and haircare products.", "arqamweb"); ?>
            </p>

            <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:text-primary-foreground hover:bg-primary/90 shadow-soft hover:shadow-medium tracking-wide h-11 rounded-md px-8"
                href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">

                <span><?php echo __("Shop Now", "arqamweb"); ?></span>

            </a>

        </div>
    </section>

</main>

<?php get_footer(); ?>