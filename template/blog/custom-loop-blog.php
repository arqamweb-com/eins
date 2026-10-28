<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php

    $count = get_query_var('count', -1);

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => $count,
    ];

    $query = new WP_Query($args);
    $delay = 0;

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

            get_template_part('/template/content/blog/styles/blog', 'standard');

            $delay += 100;
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>