<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>



<section class="my-6r text-center">
    <div class="container">
        <h1><?php the_archive_title() ?></h1>
        <div class="lead text-muted col-md-8 offset-md-2 archive-description"><?php echo category_description(); ?></div>
        <p class="mt-2r"><?php the_levels() ?></p>

    </div>
</section>







<section>
    <div class="container">

        <div class="row">

            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    get_template_part('loops/flip_card', null, array(
                        'output_article_class' => 'ratio ratio-3x4 mx-auto',
                    ));
                endwhile;
            else :
                _e('Sorry, no posts matched your criteria.', 'textdomain');
            endif;
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
