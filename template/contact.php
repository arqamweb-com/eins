<?php /* Template Name: Contact Us */ ?>

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
    <main class="flex-1">

        <section class="bg-primary py-16 sm:py-20">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">

                <span class="text-brand-neutral text-sm tracking-[0.2em] uppercase mb-4 block">
                    <?php echo esc_html__("Get in Touch", "arqamweb"); ?>
                </span>

                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-medium text-primary-foreground mb-4">
                    <?php echo esc_html__("Contact Us", "arqamweb"); ?>
                </h1>

                <p class="text-lg text-primary-foreground/80 max-w-2xl mx-auto">
                    <?php echo esc_html__("We'd love to hear from you. Reach out with questions, feedback, or to learn more about our products.", "arqamweb"); ?>
                </p>

            </div>
        </section>


        <section class="section-padding bg-background">
            <div class="container mx-auto">

                <div class="grid lg:grid-cols-2 gap-12 lg:gap-20">

                    <div>

                        <h2 class="font-serif text-2xl sm:text-3xl font-medium text-foreground mb-8">
                            <?php echo esc_html__("Connect With Us", "arqamweb"); ?>
                        </h2>


                        <div class="space-y-6 mb-12">

                            <a href="https://www.facebook.com/people/EINS/61565464014787/" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 p-4 bg-muted rounded-lg hover:bg-accent transition-colors group">

                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook h-5 w-5 text-primary group-hover:text-primary-foreground">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-medium text-foreground mb-0">
                                        <?php echo esc_html__("Facebook", "arqamweb"); ?>
                                    </p>

                                    <p class="text-sm text-muted-foreground mb-0">
                                        <?php echo esc_html__("Follow us on Facebook", "arqamweb"); ?>
                                    </p>
                                </div>

                            </a>


                            <a href="https://www.instagram.com/eins_111" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 p-4 bg-muted rounded-lg hover:bg-accent transition-colors group">

                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram h-5 w-5 text-primary group-hover:text-primary-foreground">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-medium text-foreground mb-0">
                                        <?php echo esc_html__("Instagram", "arqamweb"); ?>
                                    </p>

                                    <p class="text-sm text-muted-foreground mb-0">
                                        @eins_111
                                    </p>
                                </div>

                            </a>


                            <a href="http://wa.me/201101062267" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 p-4 bg-muted rounded-lg hover:bg-accent transition-colors group">

                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle h-5 w-5 text-primary group-hover:text-primary-foreground">
                                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-medium text-foreground mb-0">
                                        <?php echo esc_html__("WhatsApp", "arqamweb"); ?>
                                    </p>

                                    <p class="text-sm text-muted-foreground mb-0">
                                        +20 11 01062267
                                    </p>
                                </div>

                            </a>


                            <a href="mailto:info@einscosmetics.com" class="flex items-center gap-4 p-4 bg-muted rounded-lg hover:bg-accent transition-colors group">

                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail h-5 w-5 text-primary group-hover:text-primary-foreground">
                                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-medium text-foreground mb-0">
                                        <?php echo esc_html__("Email", "arqamweb"); ?>
                                    </p>

                                    <p class="text-sm text-muted-foreground mb-0">
                                        info@einscosmetics.com
                                    </p>
                                </div>

                            </a>


                            <a href="tel:+201101062267" class="flex items-center gap-4 p-4 bg-muted rounded-lg hover:bg-accent transition-colors group">

                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone h-5 w-5 text-primary group-hover:text-primary-foreground">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-medium text-foreground mb-0">
                                        <?php echo esc_html__("Phone", "arqamweb"); ?>
                                    </p>

                                    <p class="text-sm text-muted-foreground mb-0">
                                        +20 11 01062267
                                    </p>
                                </div>

                            </a>

                        </div>
                    </div>


                    <div id="contact" class="bg-muted rounded-lg p-8 pb-0 sm:p-10 sm:pb-0">

                        <h2 class="font-serif text-2xl font-medium text-foreground mb-2">
                            <?php echo esc_html__("Send a Message", "arqamweb"); ?>
                        </h2>

                        <p class="text-muted-foreground mb-8">
                            <?php echo esc_html__("Fill out the form below and we'll get back to you within 24 hours.", "arqamweb"); ?>
                        </p>

                        <?php echo do_shortcode('[contact-form-7 id="5bce570" title="Contact Us"]'); ?>

                    </div>

                </div>
            </div>
        </section>

    </main>

</div><!-- #primary -->


<?php get_footer(); ?>