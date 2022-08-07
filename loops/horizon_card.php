<?php

/**
 * 同時給shortcode和loop使用
 *
 * @todo Ajax load more
 * @todo pin to top
 * @todo 只撈分類
 */


$the_post = isset($args['the_post']) ? $args['the_post'] : $post;
$args['column_classes'] = isset($args['column_classes']) ? $args['column_classes'] : 'col-md-4';
$args['output_article_class'] = isset($args['output_article_class']) ? $args['output_article_class'] : '';
$args['output_featured_image_format'] = isset($args['output_featured_image_format']) ? $args['output_featured_image_format'] : 'full';
$args['output_featured_image_class'] = isset($args['output_featured_image_class']) ? $args['output_featured_image_class'] : 'ratio-4x3';
$args['output_hide_elements'] = isset($args['output_hide_elements']) ? $args['output_hide_elements'] : '';
$args['output_excerpt_length'] = isset($args['output_excerpt_length']) ? $args['output_excerpt_length'] : '100';
$args['output_excerpt_text'] = isset($args['output_excerpt_text']) ? $args['output_excerpt_text'] : '...';
$args['output_heading_tag'] = isset($args['output_heading_tag']) ? $args['output_heading_tag'] : 'h3';

$count_post_view = get_post_meta( $the_post->ID, 'wpb_post_views_count', true );
?>

<div class="<?php echo $args['column_classes']; ?> mb-2r">
    <article count_post_view="<?php echo $count_post_view; ?>" role="article" id="post-<?php echo $the_post->ID; ?>" class="row <?php echo $args['output_article_class']; ?>">
        <div class="col-6 lc-block">
            <a class="nolightbox" href="<?php echo get_the_permalink($the_post); ?>">
                <?php
                echo get_the_post_thumbnail($the_post, $args['output_featured_image_format'], array('class'    => $args['output_featured_image_class'] . ' w-100 ratio ratio-4x3'));
                ?>
            </a>
        </div>
        <div class="col-6 lc-block">
            <div editable="rich" class="h-100 position-relative" style="min-height:3rem">


                <?php
                if (strpos($args['output_hide_elements'], 'title')  === false) {
                    echo '<a href="' . get_the_permalink($the_post) . '"><' . $args['output_heading_tag'] . ' class="nolightbox h6 text-gray-800 max-3-line lh-sm">' . get_the_title($the_post) . '</' . $args['output_heading_tag'] . '></a>';
                }

                if (strpos($args['output_hide_elements'], 'author')  === false) {
                    $authors = get_post_meta($the_pos->ID, 'multi_author', true);
                    $user = get_userdata($authors[0]);
                    $author = $user->data->display_name;
                    $author = (empty($author)) ? '' : $author;
                } else {
                    $author = '';
                }

                $date = (strpos($args['output_hide_elements'], 'date')  === false) ? ('<time>' . get_the_date('Y.m.d', $the_post) . '</time>') : ('');
                ?>
                <p class="small text-gray-600 mb-0 position-absolute bottom-0"><?php echo $date . ' ' . $author; ?></p>
            </div>
        </div>
    </article>
</div>