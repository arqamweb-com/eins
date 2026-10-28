<?php
$per_paged = get_query_var('per_paged') ?: -1;
$style = get_query_var('style') ?: 'style-1';

$args = [
    'post_type'      => 'service',
    'posts_per_page' => $per_paged,
    'orderby'        => 'date',
    'order'          => 'ASC',
    // 'tax_query'      => [
    //     [
    //         'taxonomy' => 'resource-category',
    //         'field'    => 'slug',
    //         'terms'    => 'videos',
    //     ]
    // ]
];

$q = new WP_Query($args);
?>

<?php if ($q->have_posts()) : $i = 0; ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php
        while ($q->have_posts()) : $q->the_post();
            get_template_part('template/content/services/service', $style);
        endwhile;
        ?>
    </div>
    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <div class="col-span-full text-center text-muted-foreground mb-4">
        <p class="mb-0"> No service are currently available. </p>
    </div>
<?php endif; ?>