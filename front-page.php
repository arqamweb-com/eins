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

<div>
	<main>
		<!-- عرض نوفمبر مكان السلايدر، ولما يخلص السلايدر بيرجع لوحده -->
		<?php if (eins_offer_product()) : ?>
			<?php get_template_part('template/frontpage/frontpage', 'offer'); ?>
		<?php else : ?>
			<?php get_template_part('template/frontpage/frontpage', 'slider'); ?>
		<?php endif; ?>

		<?php get_template_part('template/frontpage/frontpage', 'deal'); ?>

		<?php get_template_part('template/frontpage/frontpage', 'best_sellers'); ?>

		<?php get_template_part('template/frontpage/frontpage', 'why-choose-us'); ?>

		<?php get_template_part('template/frontpage/frontpage', 'about'); ?>

		<?php get_template_part('template/frontpage/frontpage', 'reviews'); ?>

		<?php get_template_part('template/frontpage/frontpage', 'blog'); ?>

		<?php get_template_part('template/frontpage/frontpage', 'consultation'); ?>

		<?php get_template_part('template/frontpage/frontpage', 'callToAction'); ?>
	</main>
</div><!-- #primary -->

<?php get_footer(); ?>