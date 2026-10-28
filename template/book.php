<?php /* Template Name: Book Your Consultation */ ?>

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

<div>

    <main>

        <section class="py-20 lg:py-28 relative overflow-hidden" style="background-color: rgb(20, 17, 11);">

            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute w-96 h-96 rounded-full bg-gradient-to-br from-primary/10 to-transparent blur-3xl" style="top: -10%; right: -5%;"></div>
                <div class="absolute w-64 h-64 rounded-full bg-gradient-to-tl from-primary/5 to-transparent blur-2xl" style="bottom: 10%; left: 5%;"></div>
            </div>

            <div class="container mx-auto px-4 relative z-10">

                <div class="text-center max-w-3xl mx-auto">

                    <span class="text-primary font-medium tracking-wider uppercase text-sm">
                        <?php echo esc_html__("Get Started", "arqamweb"); ?>
                    </span>

                    <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold text-foreground mt-3 mb-6">
                        <?php echo esc_html__("Book Your", "arqamweb"); ?>
                        <span class="text-gradient-gold">
                            <?php echo esc_html__("Consultation", "arqamweb"); ?>
                        </span>
                    </h1>

                    <p class="text-muted-foreground text-lg leading-relaxed">
                        <?php echo esc_html__("Take the first step toward transforming your business. Book a personalized consultation with our experts and discover how we can help you achieve your marketing and business goals.", "arqamweb"); ?>
                    </p>

                </div>
            </div>
        </section>


        <section class="py-16 lg:py-20">

            <div class="container mx-auto px-4">

                <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6 text-primary">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                        </div>

                        <div>

                            <h3 class="font-heading text-lg font-semibold mb-2">
                                <?php echo esc_html__("Expert Guidance", "arqamweb"); ?>
                            </h3>

                            <p class="text-sm">
                                <?php echo esc_html__("Get personalized advice from industry professionals with 15+ years of experience.", "arqamweb"); ?>
                            </p>

                        </div>
                    </div>


                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-6 h-6 text-primary">
                                <path d="M8 2v4"></path>
                                <path d="M16 2v4"></path>
                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                <path d="M3 10h18"></path>
                            </svg>
                        </div>

                        <div>

                            <h3 class="font-heading text-lg font-semibold mb-2">
                                <?php echo esc_html__("Flexible Scheduling", "arqamweb"); ?>
                            </h3>

                            <p class="text-sm">
                                <?php echo esc_html__("Choose a time that works for you. We accommodate your busy schedule.", "arqamweb"); ?>
                            </p>

                        </div>
                    </div>


                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6 text-primary">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>

                        <div>

                            <h3 class="font-heading text-lg font-semibold mb-2">
                                <?php echo esc_html__("Quick Response", "arqamweb"); ?>
                            </h3>

                            <p class="text-sm">
                                <?php echo esc_html__("We'll confirm your booking within 24 hours and prepare for your session.", "arqamweb"); ?>
                            </p>

                        </div>
                    </div>


                </div>
            </div>
        </section>


        <section id="contact" class="py-20 lg:py-28 gradient-section-alt">

            <div class="container mx-auto px-4">

                <div class="max-w-2xl mx-auto">

                    <div class="gradient-card border border-border/50 rounded-2xl p-8 lg:p-12 pb-0 lg:pb-0">

                        <h2 class="font-heading text-2xl md:text-3xl font-bold text-foreground mb-2 text-center">
                            <?php echo esc_html__("Schedule Your Session", "arqamweb"); ?>
                        </h2>

                        <p class="text-muted-foreground text-center mb-8">
                            <?php echo esc_html__("Fill out the form below and we'll get back to you within 24 hours.", "arqamweb"); ?>
                        </p>

                        <?php echo do_shortcode('[contact-form-7 id="31e8413" title="Book Consultation"]'); ?>

                    </div>

                </div>
            </div>
        </section>
    </main>
</div><!-- #primary -->


<?php get_footer(); ?>