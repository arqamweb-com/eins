<?php
$per_paged = get_query_var('per_paged') ?: -1;

$args = [
    'post_type'      => 'review',
    'posts_per_page' => $per_paged,
    'orderby'        => 'date',
    'order'          => 'ASC',
];

$q = new WP_Query($args);
?>

<?php if ($q->have_posts()) : $i = 0; ?>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <?php
        while ($q->have_posts()) : $q->the_post();
            get_template_part('template/content/reviews/review', 'style-3');
        endwhile;
        ?>
    </div>
    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <div class="col-span-full text-center text-muted-foreground mb-4">
        No review are currently available.
    </div>
<?php endif; ?>