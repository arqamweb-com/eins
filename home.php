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
	exit(); // Exit if accessed directly.
} ?>
<?php get_header(); ?>
<div <?php astra_primary_class(); ?>>

	<main class="flex-1">
		<section class="bg-muted py-16 sm:py-20">
			<div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center"><span class="text-brand-neutral text-sm tracking-[0.2em] uppercase mb-4 block"><?php echo esc_html__('Beauty Journal', 'arqamweb'); ?></span>
				<h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-medium text-foreground mb-4"><?php echo esc_html__('Our Blog', 'arqamweb'); ?></h1>
				<p class="text-muted-foreground max-w-2xl mx-auto"><?php echo esc_html__('Discover the science behind beauty, ingredient spotlights, and expert tips for your skincare and haircare journey.', 'arqamweb'); ?></p>
			</div>
		</section>
		<section class="section-padding bg-background">
			<div class="container mx-auto">


				<div class="featured">
					<?php
					$featured_query = new WP_Query([
						'post_type'      => 'post',
						'posts_per_page' => 1,
						'category_name'  => 'featured',
					]);
					?>

					<?php if ($featured_query->have_posts()) : ?>
						<?php while ($featured_query->have_posts()) : $featured_query->the_post(); ?>
							<article class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-16">

								<a class="block group" href="<?php the_permalink(); ?>">
									<div class="aspect-[16/10] rounded-lg overflow-hidden">
										<?php the_post_thumbnail('large', [
											'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105'
										]); ?>
									</div>
								</a>

								<div>
									<div class="flex items-center gap-4 mb-4">
										<span class="text-xs text-brand-neutral tracking-wide uppercase bg-brand-neutral/10 px-3 py-1 rounded-full">
											<?php echo esc_html__('Featured', 'arqamweb'); ?>
										</span>
										<span class="text-xs text-muted-foreground">
											<?php echo get_the_date(); ?>
										</span>
									</div>

									<a href="<?php the_permalink(); ?>">
										<h2 class="font-serif text-2xl sm:text-3xl font-medium text-foreground hover:text-primary transition-colors mb-4">
											<?php the_title(); ?>
										</h2>
									</a>

									<p class="text-muted-foreground leading-relaxed mb-6">
										<?php echo wp_trim_words(get_the_excerpt(), 30); ?>
									</p>

									<a class="inline-flex items-center text-sm font-medium text-primary hover:text-primary/80 transition-colors"
										href="<?php the_permalink(); ?>">
										<?php echo esc_html__('Read Article', 'arqamweb'); ?>
										<svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none"
											viewBox="0 0 24 24" stroke="currentColor">
											<path d="M5 12h14" />
											<path d="m12 5 7 7-7 7" />
										</svg>
									</a>
								</div>

							</article>
						<?php endwhile; ?>
					<?php endif;
					wp_reset_postdata(); ?>
				</div>
				<div>
					<?php
					$posts_query = new WP_Query([
						'post_type'      => 'post',
						'posts_per_page' => -1,
						'category__not_in' => get_term_by('slug', 'featured', 'category')->term_id,
					]);
					?>

					<div>
						<h3 class="font-serif text-2xl font-medium text-foreground mb-8">
							All Articles
						</h3>

						<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
							<?php if ($posts_query->have_posts()) : ?>
								<?php $delay = 0; ?>
								<?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
									<?php $delay += 0.1; ?>

									<article class="group animate-fade-up" style="animation-delay: <?php echo esc_attr($delay); ?>s;">
										<a class="block" href="<?php the_permalink(); ?>">

											<div class="aspect-[16/10] rounded-lg overflow-hidden mb-4">
												<?php the_post_thumbnail('large', [
													'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105'
												]); ?>
											</div>

											<div class="flex items-center gap-4 mb-3">
												<?php
												$cat = get_the_category();
												if ($cat) :
												?>
													<span class="text-xs text-brand-neutral tracking-wide uppercase">
														<?php echo esc_html($cat[0]->name); ?>
													</span>
												<?php endif; ?>

												<span class="flex items-center gap-1 text-xs text-muted-foreground">
													⏱ <?php echo ceil(str_word_count(get_the_content()) / 200); ?> <?php echo esc_html__('min read', 'arqamweb'); ?>
												</span>
											</div>

											<h3 class="font-serif text-lg font-medium text-foreground group-hover:text-primary transition-colors line-clamp-2 mb-2">
												<?php the_title(); ?>
											</h3>

											<p class="text-sm text-muted-foreground line-clamp-2">
												<?php echo wp_trim_words(get_the_excerpt(), 18); ?>
											</p>

										</a>
									</article>

								<?php endwhile; ?>
							<?php endif;
							wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

</div><!-- #primary -->

<?php get_footer(); ?>