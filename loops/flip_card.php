<?php

/**
 * 同時給shortcode和loop使用
 *
 * @todo Ajax load more
 * @todo pin to top
 * @todo 只撈分類
 */



$the_post = isset($args['the_post']) ? $args['the_post'] : $post;
$args['column_classes'] = isset($args['column_classes']) ? $args['column_classes'] : 'col-xxl-3 col-lg-4 col-sm-6 ';
$args['output_article_class'] = isset($args['output_article_class']) ? $args['output_article_class'] : '';
$args['output_featured_image_format'] = isset($args['output_featured_image_format']) ? $args['output_featured_image_format'] : 'full';
$args['output_featured_image_class'] = isset($args['output_featured_image_class']) ? $args['output_featured_image_class'] : 'ratio-4x3';
$args['output_hide_elements'] = isset($args['output_hide_elements']) ? $args['output_hide_elements'] : '';
$args['output_excerpt_length'] = isset($args['output_excerpt_length']) ? $args['output_excerpt_length'] : '100';
$args['output_excerpt_text'] = isset($args['output_excerpt_text']) ? $args['output_excerpt_text'] : '閱讀更多';
$args['$output_heading_tag'] = isset($args['$output_heading_tag']) ? $args['$output_heading_tag'] : 'h2';






?>

<div class="<?php echo $args['column_classes']; ?> mb-2r px-1hr">

        <article role="article" id="post-<?php echo $the_post->ID; ?>" class="row flip-card rounded-2 <?php echo $args['output_article_class']; ?>">
            <div class="flip-item d-flex justify-content-center align-items-center h-100 <?php echo ($args['output_article_class'] == 'featured') ? ('col-md-6 px-0') : ('col-12 px-md-1r'); ?>">
            <a class="nolightbox" title="<?= $the_post->post_title; ?>" href="<?= get_the_permalink($the_post); ?>">
                <?php
                $title_class = ($args['output_article_class'] == 'featured') ? ('h4 mb-2') : ('h6');
                if (strpos($args['output_hide_elements'], 'title')  === false) {
                    echo '<' . $args['$output_heading_tag'] . ' class="text-white ' . $title_class . '">' . get_the_title($the_post) . '</' . $args['$output_heading_tag'] . '>';
                }
                ?>
                </a>
                <div class="position-absolute" style="top:1rem;left:1rem">
                    <?php the_level(); ?>

                </div>
                <div class="position-absolute d-flex justify-content-between w-100 px-1r" style="bottom:0rem;">
                    <p class="small text-gray-700"><i class="fa-light fa-clock me-2"></i><?php the_readding_time(); ?>mins</>
                    <p class="small text-gray-700"><i class="fa-light fa-calendar-day me-2"></i><?= get_the_date('Y/m/d'); ?></p>
                </div>

            </div><!-- /col -->

            <div class="flip-content bg-primary-100 rounded-2 p-1hr <?php echo ($args['output_article_class'] == 'featured') ? ('col-md-6') : ('col-12'); ?>">

                <div class="h-100 d-flex flex-column">

                    <div class="col border-top border-bottom border-gray-100 overflow-hidden text-white py-1r">
                    <a class="nolightbox text-gray-400" title="<?= $the_post->post_title; ?>" href="<?= get_the_permalink($the_post); ?>">
                        <?php
                        $excerpt = (strpos($args['output_hide_elements'], 'excerpt')  === false  && $args['output_excerpt_length'] != 0) ? (apply_filters('NOOO_the_content',  wp_trim_words(wp_strip_all_tags(($the_post->post_content)), $args['output_excerpt_length'], $args['output_excerpt_text']))) : ('');
                        echo $excerpt;
                        ?>
                    </a>

                    </div>
                    <div class="col-auto text-end pt-1r">
                        <a href="<?php echo get_the_permalink($the_post); ?>" class="nolightbox text-gray-900 btn btn-secondary pt-1 text-white <?php echo ($args['output_article_class'] == 'featured') ? ('') : (''); ?>"><?= $args['output_excerpt_text'] ?></a>
                    </div>
                </div>



            </div><!-- /col -->
        </article>

</div>