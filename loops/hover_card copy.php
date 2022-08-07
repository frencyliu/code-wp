<?php

/**
 * 同時給shortcode和loop使用
 *
 * @todo Ajax load more
 * @todo pin to top
 * @todo 只撈分類
 */


$the_post = isset($args['the_post']) ? $args['the_post'] : $post;
$args['column_classes'] = isset($args['column_classes']) ? $args['column_classes'] : 'col-md-3';
$args['output_article_class'] = isset($args['output_article_class']) ? $args['output_article_class'] : '';
$args['output_featured_image_format'] = isset($args['output_featured_image_format']) ? $args['output_featured_image_format'] : 'full';
$args['output_featured_image_class'] = isset($args['output_featured_image_class']) ? $args['output_featured_image_class'] : 'ratio-4x3';
$args['output_hide_elements'] = isset($args['output_hide_elements']) ? $args['output_hide_elements'] : '';
$args['output_excerpt_length'] = isset($args['output_excerpt_length']) ? $args['output_excerpt_length'] : '100';
$args['output_excerpt_text'] = isset($args['output_excerpt_text']) ? $args['output_excerpt_text'] : '...';
$args['$output_heading_tag'] = isset($args['$output_heading_tag']) ? $args['$output_heading_tag'] : 'h3';

?>

<div class="<?php echo $args['column_classes']; ?> mb-2r px-1hr">
    <article role="article" id="post-<?php echo $the_post->ID; ?>" class="row position-relative <?php echo $args['output_article_class']; ?>">
        <div class="<?php echo ($args['output_article_class'] == 'featured') ? ('col-md-6 px-md-0') : ('col-12 mb-1r px-md-0'); ?>">
            <a class="nolightbox" href="<?php echo get_the_permalink($the_post); ?>">
                <?php
                echo get_the_post_thumbnail($the_post, $args['output_featured_image_format'], array('class'    => $args['output_featured_image_class'] . ' w-100 ratio'));
                ?>
            </a>
        </div><!-- /col -->
        <div class="position-absolute top-0 start-0 h-100 w-100 bg-primary rounded-1 p-1hr <?php echo ($args['output_article_class'] == 'featured') ? ('col-md-6') : ('col-12'); ?>">
            <div class="h-100">
                <div editable="rich" class="d-flex h-100 flex-column justify-content-between">

                    <?php
                    if (strpos($args['output_hide_elements'], 'author')  === false) {
                        $authors = get_post_meta($the_post->ID, 'multi_author', true);
                        $user = get_userdata($authors[0]);
                        $author = $user->data->display_name;
                        $author = (empty($author)) ? '' : $author;
                    } else {
                        $author = '';
                    }


                    $date = (strpos($args['output_hide_elements'], 'date')  === false) ? ('<time>' . get_the_date('Y.m.d', $the_post) . '</time>') : ('');

                    $excerpt = (strpos($args['output_hide_elements'], 'excerpt')  === false  && $args['output_excerpt_length'] != 0) ? (apply_filters('NOOO_the_content',  wp_trim_words(wp_strip_all_tags(($the_post->post_content)), $args['output_excerpt_length'], $args['output_excerpt_text']))) : ('');
                    ?>
                    <p class="text-gray-900 <?php echo ($args['output_article_class'] == 'featured') ? ('') : ('small mb-2'); ?>"><?php echo $date . ' ' . $author; ?></p>

                    <?php
                    $title_class = ($args['output_article_class'] == 'featured') ? ('h4 text-gray-900 mb-2') : ('h6');
                    if (strpos($args['output_hide_elements'], 'title')  === false) {
                        echo '<a href="' . get_the_permalink($the_post) . '"><' . $args['$output_heading_tag'] . ' class="nolightbox max-3-line ' . $title_class . '">' . get_the_title($the_post) . '</' . $args['$output_heading_tag'] . '></a>';
                    }


                    ?>
                    <p class="text-gray-700 <?php echo ($args['output_article_class'] == 'featured') ? ('') : ('small'); ?>"><?php echo $excerpt; ?></p>
                    <a href="<?php echo get_the_permalink($the_post); ?>" class="nolightbox text-primary-d-100 pt-1  <?php echo ($args['output_article_class'] == 'featured') ? ('') : ('d-none'); ?>">了解更多<i class="far fa-arrow-right ms-2"></i></a>
                </div>
            </div><!-- /lc-block -->
        </div><!-- /col -->
    </article>
</div>