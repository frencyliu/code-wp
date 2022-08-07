<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$filename = __DIR__ . '/post575.png';
var_dump(wp_upload_dir()['path'] . '/post575.png');

?>


<!-- <div class="py-6 bg-light">
    <div class="container text-center">
        <h1 class="display-4"><?php the_title(); ?></h1>

  </div>
</div> -->

<div class="container my-3r">
    <div class="row px-1r">
        <div class="col-lg-10 mt-3r mt-md-6r offset-lg-1 py-2 px-lg-2r px-1r">
            <?php the_breadcrumb(); ?>
        </div>
        <div class="col-lg-10 mb-6r offset-lg-1 py-2r px-lg-2r px-1r rounded-2 post-body">


            <p class="mt-0 pe-1r pe-lg-0 small text-gray-700 d-flex justify-content-between">
                <span><i class="fa-light fa-clock me-2"></i><?php the_readding_time(); ?> mins read ‧ <i class="fa-light fa-calendar-day me-2"></i><?php echo date('Y/m/d', get_post_time('U')); ?></span>

                <?php the_level(); ?></p>
            <h1><?php the_title(); ?></h1>




            <hr>
            <?php

            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
            else :
                _e('Sorry, no posts matched your criteria.', 'textdomain');
            endif;
            ?>

            <div class="pb-2r">
                <h2>Categories & Tags</h2>
                <div>
                    <?php $cats = get_the_category();
                    if (!empty($cats)) :
                        foreach ($cats as $cat) : ?>
                            <a href="<?= get_term_link($cat->term_id, 'category') ?>" class="text-decoration-none badge text-white bg-primary-100 rounded-1 me-1"><?= $cat->name ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mt-1">

                    <?php $tags = get_the_tags();
                    if (!empty($tags)) :
                        foreach ($tags as $tag) : ?>
                            <a href="<?= get_term_link($tag->term_id, 'post_tag') ?>" class="text-decoration-none small me-1">#<?= $tag->name ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>






                <div class="col-12">
                    <h2>覺得不錯的話，請給我點個推薦<i class="fa-duotone fa-thumbs-up text-secondary ms-2"></i></h2>
                    <p>您的支持與鼓勵是我們前進的最大動力！</p>
                </div>
                <?php the_share_btn_and_fb(); ?>

                <div class="col-12">
                    <div class="rounded-2 bg-light p-2r mt-3r">
                        <div class="fb-comments" data-href="<?= $url ?>" data-width="100%" data-numposts="10" data-colorscheme="dark" data-lazy="true"></div>
                    </div>
                </div>


        </div>
    </div>
</div>




<?php get_footer();
