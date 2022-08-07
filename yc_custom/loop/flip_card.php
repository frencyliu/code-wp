<?php
/**
 * Flip Card View
 * Overwrite the View of lc_get_posts
 * see /wp-content/plugins/livecanvas/modules/shortcodes.php
 */

function yc_get_posts_flip_card_view($the_posts, $get_posts_shortcode_atts)
{
    extract($get_posts_shortcode_atts);


    $out = ''; // INIT
    $output_hide_elements = strtolower($output_hide_elements);

    //default is 3 rows
    if ($output_number_of_columns == 1) $column_classes = 'col-12';
    if ($output_number_of_columns == 2) $column_classes = 'col-xl-6';
    if ($output_number_of_columns == 3) $column_classes = 'col-xl-4';
    if ($output_number_of_columns == 4) $column_classes = 'col-xl-3';



    foreach ($the_posts as $the_post) :
        ob_start();

        $args = array(
            'the_post' => $the_post,
            'column_classes' => $column_classes,
            'output_article_class' => $output_article_class,
            'output_featured_image_format' => $output_featured_image_format,
            'output_featured_image_class' => $output_featured_image_class,
            'output_hide_elements' => $output_hide_elements,
            'output_excerpt_length' => $output_excerpt_length,
            'output_excerpt_text' => $output_excerpt_text,
            'output_heading_tag' => $output_heading_tag,
        );
        get_template_part('loops/flip_card', null, $args);
        $out .= ob_get_clean();
    endforeach;


    return  "<div class='row " . $output_wrapper_class . "'> " . $out . "</div>";
}

