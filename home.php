<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>



<section class="my-6r text-center">
    <div class="container">
        <h1><?php bloginfo('Name') ?></h1>
        <div class="lead text-muted col-md-8 offset-md-2 archive-description"><?php bloginfo('description') ?></div>
        <p class="mt-2r"><?php the_levels() ?></p>

    </div>
</section>







<section>
    <div class="container">

        <div class="row">

            <?php
            // The Query
            $args = [
                'post_type' => ['post', 'tutorial'],
                'posts_per_page ' => -1,
                'post_status' => 'publish',
            ];
            $the_query = new WP_Query($args);

            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();

                    get_template_part('loops/flip_card', null, array(
                        'output_article_class' => 'ratio ratio-3x4 mx-auto',
                    ));

                endwhile;
            else :
                _e('Sorry, no posts matched your criteria.', 'textdomain');
            endif;

            /* Restore original Post Data */
            wp_reset_postdata();
            ?>
        </div>

        <div class="row">
            <div class="col lead text-center w-100">
                <div class="d-inline-block"><?php picostrap_pagination() ?></div>
            </div><!-- /col -->
        </div> <!-- /row -->
    </div>
</section>

<?php get_footer();
