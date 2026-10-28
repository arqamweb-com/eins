<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
</div> <!-- container -->
</div><!-- #content -->

<footer class="bg-primary text-primary-foreground">

	<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12">

			<div class="lg:col-span-1">

				<a href="<?php echo esc_url(home_url('/')); ?>">

					<img src="<?php echo get_stylesheet_directory_uri(); ?>/frontend/assets/logo-white.png"
						alt="<?php echo esc_attr__('EINS', 'arqamweb'); ?>"
						class="h-14 w-auto mb-6">

				</a>

				<p class="text-primary-foreground/80 text-sm leading-relaxed">
					<?php echo esc_html__("At Eins, our vision is to be the leading innovator in the cosmetics and skincare industry, creating unparalleled beauty solutions that empower individuals to embrace their unique radiance.", "arqamweb"); ?>
				</p>

			</div>


			<div>

				<h4 class="font-serif text-lg text-primary-foreground font-semibold mb-6">
					<?php echo esc_html__("Company", "arqamweb"); ?>
				</h4>

				<ul class="space-y-3 text-sm">

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>">
							<?php echo esc_html__("About Us", "arqamweb"); ?>
						</a>
					</li>

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
							<?php echo esc_html__("Shop", "arqamweb"); ?>
						</a>
					</li>

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
							<?php echo esc_html__("Blog", "arqamweb"); ?>
						</a>
					</li>

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(get_permalink(get_page_by_path('contact-us'))); ?>">
							<?php echo esc_html__("Contact", "arqamweb"); ?>
						</a>
					</li>

				</ul>

			</div>



			<div>

				<h4 class="font-serif text-lg text-primary-foreground font-semibold mb-6">
					<?php echo esc_html__("Shop", "arqamweb"); ?>
				</h4>

				<ul class="space-y-3 text-sm">

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
							<?php echo esc_html__("View All Products", "arqamweb"); ?>
						</a>
					</li>

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(add_query_arg('orderby', 'popularity', wc_get_page_permalink('shop'))); ?>">
							<?php echo esc_html__("Best Seller Products", "arqamweb"); ?>
						</a>
					</li>

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(wc_get_cart_url()); ?>">
							<?php echo esc_html__("View Your Cart", "arqamweb"); ?>
						</a>
					</li>

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(wc_get_checkout_url()); ?>">
							<?php echo esc_html__("Checkout", "arqamweb"); ?>
						</a>
					</li>

				</ul>

			</div>



			<div>

				<h4 class="font-serif text-lg text-primary-foreground font-semibold mb-6">
					<?php echo esc_html__("User Links", "arqamweb"); ?>
				</h4>

				<ul class="space-y-3 text-sm">

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(get_permalink(get_page_by_path('terms-and-conditions'))); ?>">
							<?php echo esc_html__("Terms and Conditions", "arqamweb"); ?>
						</a>
					</li>

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(get_permalink(get_page_by_path('return-policy'))); ?>">
							<?php echo esc_html__("Return Policy", "arqamweb"); ?>
						</a>
					</li>

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(get_permalink(get_page_by_path('refund-policy'))); ?>/">
							<?php echo esc_html__("Refund Policy", "arqamweb"); ?>
						</a>
					</li>

					<li>
						<a class="text-primary-foreground/80 hover:text-primary-foreground transition-colors"
							href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>">
							<?php echo esc_html__("Privacy Policy", "arqamweb"); ?>
						</a>
					</li>

				</ul>

			</div>



			<div>

				<h4 class="font-serif text-lg text-primary-foreground font-semibold mb-6">
					<?php echo esc_html__("Stay Connected", "arqamweb"); ?>
				</h4>

				<div class="flex items-center gap-4">

					<a href="https://www.facebook.com/profile.php?id=61565464014787&rdid=yNMsOyN0LSqLxZiF&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F1DMmk61ghq%2F#"
						target="_blank"
						rel="noopener noreferrer"
						class="w-10 h-10 rounded-full bg-primary-foreground/10 flex items-center justify-center text-primary-foreground/80 hover:bg-primary-foreground hover:text-primary transition-colors"
						aria-label="<?php echo esc_attr__('Facebook', 'arqamweb'); ?>">

						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook h-5 w-5">
							<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
						</svg>

					</a>


					<a href="https://www.instagram.com/eins_111?igsh=OWx6dHNyYTlueGdx"
						target="_blank"
						rel="noopener noreferrer"
						class="w-10 h-10 rounded-full bg-primary-foreground/10 flex items-center justify-center text-primary-foreground/80 hover:bg-primary-foreground hover:text-primary transition-colors"
						aria-label="<?php echo esc_attr__('Instagram', 'arqamweb'); ?>">

						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram h-5 w-5">
							<rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
							<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
							<line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
						</svg>

					</a>
					
					
					<a href="https://www.tiktok.com/@eins.cosmetics?_r=1&_t=ZS-94Nja9VOvyB"
						target="_blank"
						rel="noopener noreferrer"
						class="w-10 h-10 rounded-full bg-primary-foreground/10 flex items-center justify-center text-primary-foreground/80 hover:bg-primary-foreground hover:text-primary transition-colors"
						aria-label="<?php echo esc_attr__('Tiktok', 'arqamweb'); ?>">
                            
                        <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram h-5 w-5">
                            <path d="M16.708 0.027c1.745-0.027 3.48-0.011 5.213-0.027 0.105 2.041 0.839 4.12 2.333 5.563 1.491 1.479 3.6 2.156 5.652 2.385v5.369c-1.923-0.063-3.855-0.463-5.6-1.291-0.76-0.344-1.468-0.787-2.161-1.24-0.009 3.896 0.016 7.787-0.025 11.667-0.104 1.864-0.719 3.719-1.803 5.255-1.744 2.557-4.771 4.224-7.88 4.276-1.907 0.109-3.812-0.411-5.437-1.369-2.693-1.588-4.588-4.495-4.864-7.615-0.032-0.667-0.043-1.333-0.016-1.984 0.24-2.537 1.495-4.964 3.443-6.615 2.208-1.923 5.301-2.839 8.197-2.297 0.027 1.975-0.052 3.948-0.052 5.923-1.323-0.428-2.869-0.308-4.025 0.495-0.844 0.547-1.485 1.385-1.819 2.333-0.276 0.676-0.197 1.427-0.181 2.145 0.317 2.188 2.421 4.027 4.667 3.828 1.489-0.016 2.916-0.88 3.692-2.145 0.251-0.443 0.532-0.896 0.547-1.417 0.131-2.385 0.079-4.76 0.095-7.145 0.011-5.375-0.016-10.735 0.025-16.093z"></path>
                        </svg>
						

					</a>


					<a href="http://wa.me/201101062267"
						target="_blank"
						rel="noopener noreferrer"
						class="w-10 h-10 rounded-full bg-primary-foreground/10 flex items-center justify-center text-primary-foreground/80 hover:bg-primary-foreground hover:text-primary transition-colors"
						aria-label="<?php echo esc_attr__('WhatsApp', 'arqamweb'); ?>">

						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle h-5 w-5">
							<path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
						</svg>

					</a>

				</div>

			</div>

		</div>



		<div class="mt-16 pt-8 border-t border-primary-foreground/20" style="border-top-style: solid;">

			<div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-primary-foreground/60">

				<p class="mb-0">
					© 2026
					<a href="http://einscosmetics.com/" target="_blank" rel="noopener noreferrer" class="text-primary-foreground hover:underline">
						<?php echo esc_html__("EINS", "arqamweb"); ?>
					</a>
					<?php echo esc_html__(". All rights reserved.", "arqamweb"); ?>
				</p>

				<p class="mb-0">
					© <?php echo esc_html__("Designed and developed by", "arqamweb"); ?>
					<a href="https://www.arqamweb.com" target="_blank" rel="noopener noreferrer" class="text-primary-foreground hover:underline">
						<?php echo esc_html__('Arqam Web', 'arqamweb'); ?>
					</a>
				</p>

			</div>

		</div>

	</div>

</footer>

<?php
astra_content_after();

astra_footer_before();

astra_footer();

astra_footer_after();
?>
</div><!-- #page -->
<?php
astra_body_bottom();
wp_footer();
?>
</body>

</html>