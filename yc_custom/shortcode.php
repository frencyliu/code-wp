<?php

/**
 * All include here
 */


function get_section_f($atts = array())
{
    // set up default parameters
    extract(shortcode_atts(array(
        'name' => 'ALL'
    ), $atts));

    $html = '';

    //var_dump(get_stylesheet_directory() . '/template-livecanvas-sections/');
    if ($name == 'ALL') {
        foreach (scandir(get_stylesheet_directory() . '/template-livecanvas-sections/') as $filename) {
            $path = get_stylesheet_directory() . '/template-livecanvas-sections/' . $filename;
            if (is_file($path)) {
                $html .= '<h2 class="text-center py-3r bg-gray-200">' . str_replace('.html', '', $filename) . '</h2>';
                $html .=  file_get_contents($path);

                $html .= '<div class="container code-block mt-3r mb-2r"><p class="text-end mb-0"><button class="btn btn-sm btn-outline-white btn-copy"><i class="fa-regular fa-copy me-2"></i>複製</button></p><pre class="code">' . htmlentities(file_get_contents($path)) . '</pre></div>';
            }
        }
    } else {
        foreach (scandir(get_stylesheet_directory() . '/template-livecanvas-sections/') as $filename) {
            if ($filename == $name . '.html') {
                $path = get_stylesheet_directory() . '/template-livecanvas-sections/' . $filename;
                if (is_file($path)) {
                    $html .=  file_get_contents($path);
                }
            }
        }
    }
    //var_dump($html);

    return $html;
}

add_shortcode('get_section', 'get_section_f');


/**
 * Cards View
 * Overwrite the View of lc_get_posts
 * see /wp-content/plugins/livecanvas/modules/shortcodes.php
 */

function yc_get_posts_card_view($the_posts, $get_posts_shortcode_atts)
{
    extract($get_posts_shortcode_atts);


    $out = ''; // INIT
    $output_hide_elements = strtolower($output_hide_elements);

    //default is 3 rows
    if ($output_number_of_columns == 1) $column_classes = 'col-12';
    if ($output_number_of_columns == 2) $column_classes = 'col-lg-6';
    if ($output_number_of_columns == 3) $column_classes = 'col-lg-4';
    if ($output_number_of_columns == 4) $column_classes = 'col-lg-3';


    foreach ($the_posts as $the_post) :
        ob_start();
        $locale = get_locale();
?>
        <div class="<?php echo $column_classes; ?>">
            <article role="article" id="post-<?php echo $the_post->ID; ?>" class="row <?php echo $output_article_class; ?>">
                <a href="<?php echo get_the_permalink($the_post); ?>">
                    <?php
                    echo get_the_post_thumbnail($the_post, $output_featured_image_format, array('class'    => $output_featured_image_class . ' w-100 ratio ratio-16x9 mb-1r me-0'));
                    ?>
                </a>
                <?php
                if (strpos($output_hide_elements, 'title')  === false) {
                    echo '<a href="' . get_the_permalink($the_post) . '"><' . $output_heading_tag . ' class="h5 max-3-line mb-2">' . get_the_title($the_post) . '</' . $output_heading_tag . '></a>';
                }

                if (strpos($output_hide_elements, 'author')  === false) {
                    $authors = get_post_meta($the_post->ID, 'multi_author', true);
                    $user = get_userdata($authors[0]);
                    $user_id = $user->ID;
                    switch ($locale) {
                        case 'en_US':
                            $author = get_user_meta( $user_id, 'display_name_en', true );
                            break;

                        default:
                            $author = $user->data->display_name;
                            break;
                    }
                    $author = (empty($author)) ? '' : $author;
                } else {
                    $author = '';
                }

                $date = (strpos($output_hide_elements, 'date')  === false) ? ('<time>' . get_the_date('Y.m.d', $the_post) . '</time>') : ('');

                $excerpt = (strpos($output_hide_elements, 'excerpt')  === false  && $output_excerpt_length != 0) ? (apply_filters('NOOO_the_content',  wp_trim_words(wp_strip_all_tags(($the_post->post_content)), $output_excerpt_length, $output_excerpt_text))) : ('');
                ?>
                <p class="text-gray-700 mb-2"><?php echo $date . ' ' . $author; ?></p>

                <p class="text-gray-400"><?php echo $excerpt; ?></p>
            </article>
        </div>

    <?php
        $out .= ob_get_clean();
    endforeach;


    return  "<div class='row " . $output_wrapper_class . "'> " . $out . "</div>";
}



/**
 * Horizon Cards View
 * Overwrite the View of lc_get_posts
 * see /wp-content/plugins/livecanvas/modules/shortcodes.php
 */

function yc_get_posts_horizon_card_view($the_posts, $get_posts_shortcode_atts)
{
    extract($get_posts_shortcode_atts);


    $out = ''; // INIT
    $output_hide_elements = strtolower($output_hide_elements);

    //default is 3 rows
    if ($output_number_of_columns == 1) $column_classes = 'col-12';
    if ($output_number_of_columns == 2) $column_classes = 'col-lg-6';
    if ($output_number_of_columns == 3) $column_classes = 'col-lg-4';
    if ($output_number_of_columns == 4) $column_classes = 'col-lg-3';


    foreach ($the_posts as $the_post) :
        ob_start();
        $locale = get_locale();
    ?>
        <div class="<?php echo $column_classes; ?> mb-2r">
            <article role="article" id="post-<?php echo $the_post->ID; ?>" class="row <?php echo $output_article_class; ?>">
                <div class="col-6 lc-block">
                    <a href="<?php echo get_the_permalink($the_post); ?>">
                        <?php
                        echo get_the_post_thumbnail($the_post, $output_featured_image_format, array('class'    => $output_featured_image_class . ' w-100 ratio ratio-4x3'));
                        ?>
                    </a>
                </div>
                <div class="col-6 lc-block">
                    <div editable="rich" class="h-100 position-relative" style="min-height:3rem">


                        <?php
                        if (strpos($output_hide_elements, 'title')  === false) {
                            echo '<a href="' . get_the_permalink($the_post) . '"><' . $output_heading_tag . ' class="h6 text-gray-800 max-3-line lh-sm">' . get_the_title($the_post) . '</' . $output_heading_tag . '></a>';
                        }

                        if (strpos($args['output_hide_elements'], 'author')  === false) {
                            $authors = get_post_meta($the_pos->ID, 'multi_author', true);
                            $user = get_userdata($authors[0]);
                            $user_id = $user->ID;
                            switch ($locale) {
                                case 'en_US':
                                    $author = get_user_meta($user_id, 'display_name_en', true);
                                    break;

                                default:
                                    $author = $user->data->display_name;
                                    break;
                            }
                            $author = (empty($author)) ? '' : $author;
                        } else {
                            $author = '';
                        }

                        $date = (strpos($output_hide_elements, 'date')  === false) ? ('<time>' . get_the_date('Y.m.d', $the_post) . '</time>') : ('');
                        ?>
                        <p class="small text-gray-600 mb-0 position-absolute bottom-0"><?php echo $date . ' ' . $author; ?></p>
                    </div>
                </div>
            </article>
        </div>
    <?php
        $out .= ob_get_clean();
    endforeach;


    return  "<div class='row " . $output_wrapper_class . "'> " . $out . "</div>";
}



/**
 * Blog View
 * Overwrite the View of lc_get_posts
 * see /wp-content/plugins/livecanvas/modules/shortcodes.php
 */

function yc_get_posts_blog_view($the_posts, $get_posts_shortcode_atts)
{
    extract($get_posts_shortcode_atts);


    $out = ''; // INIT
    $output_hide_elements = strtolower($output_hide_elements);

    //default is 3 rows
    if ($output_number_of_columns == 1) $column_classes = 'col-12';
    if ($output_number_of_columns == 2) $column_classes = 'col-md-6';
    if ($output_number_of_columns == 3) $column_classes = 'col-md-4';
    if ($output_number_of_columns == 4) $column_classes = 'col-md-3';



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
        get_template_part('loops/blog', null, $args);
        $out .= ob_get_clean();
    endforeach;


    return  "<div class='row " . $output_wrapper_class . "'> " . $out . "</div>";
}



/**
 * List View
 * Overwrite the View of lc_get_posts
 * see /wp-content/plugins/livecanvas/modules/shortcodes.php
 */

function yc_get_posts_list_view($the_posts, $get_posts_shortcode_atts)
{
    extract($get_posts_shortcode_atts);


    $out = ''; // INIT
    $output_hide_elements = strtolower($output_hide_elements);

    //default is 3 rows
    if ($output_number_of_columns == 1) $column_classes = 'col-12';
    if ($output_number_of_columns == 2) $column_classes = 'col-lg-6';
    if ($output_number_of_columns == 3) $column_classes = 'col-lg-4';
    if ($output_number_of_columns == 4) $column_classes = 'col-lg-3';


    foreach ($the_posts as $the_post) :
        ob_start();
        $locale = get_locale();
    ?>

        <div class="<?php echo $column_classes; ?>">
            <article role="article" id="post-<?php echo $the_post->ID; ?>" class="<?php echo $output_article_class; ?>">

                <?php
                if (strpos($output_hide_elements, 'title')  === false) {
                    echo '<a href="' . get_the_permalink($the_post) . '"><' . $output_heading_tag . ' class="h6 mb-1 max-2-line">' . get_the_title($the_post) . '</' . $output_heading_tag . '></a>';
                }

                if (strpos($output_hide_elements, 'author')  === false) {
                    $authors = get_post_meta($the_post->ID, 'multi_author', true);
                    $user = get_userdata($authors[0]);
                    $user_id = $user->ID;
                    switch ($locale) {
                        case 'en_US':
                            $author = get_user_meta($user_id, 'display_name_en', true);
                            break;

                        default:
                            $author = $user->data->display_name;
                            break;
                    }


                    $author = (empty($author)) ? '' : $author;
                } else {
                    $author = '';
                }

                $date = (strpos($output_hide_elements, 'date')  === false) ? ('<time>' . get_the_date('Y.m.d', $the_post) . '</time>') : ('');

                if (!empty($author) || !empty($date)) {
                    echo '<p class="text-gray-700 mb-1r">' . $date . ' ' . $author . '</p>';
                }
                ?>


            </article>
        </div>

    <?php
        $out .= ob_get_clean();
    endforeach;

    return  "<div class='row " . $output_wrapper_class . "'> " . $out . "</div>";
}


/**
 * Latest News
 */
function yc_latest_news_f($atts = array())
{
    // set up default parameters
    extract(shortcode_atts(array(
        'post_type' => 'post',
        'title' => '最新文章',
        'numberposts' => '3',
    ), $atts));

    /*$lang = get_locale();
        switch ($lang) {
            case 'zh_TW':
                $title = '最新文章';
                break;
            case 'zh_CN':
                $title = '最新文章';
                break;
            case 'ja':
                $title = '最新記事';
                break;
            case 'en_US':
                $title = 'Latest articles';
                break;
            default:
                $title = 'Latest articles';
                break;
        }*/
    $post_args = array(
        'post_type'        => $post_type,
        'numberposts'      => $numberposts,
        'post_status' => 'publish',
        'orderby'          => 'publish_date',
        'meta_key' => '_locale',
        'meta_value' => get_locale(),
    );
    $posts = get_posts($post_args);

    // This is where you run the code and display the output
    $html = '';
    ob_start();
    ?>
    <p class="text-gray-900 mb-1hr mt-3r"><?php echo $title; ?></p>
    <ul class="list-unstyled ps-0">
        <?php foreach ($posts as $post) : ?>
            <li class="border-bottom border-gray-400" style="padding-bottom:1.75rem;margin-bottom:0.625rem;"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php
    $html .= ob_get_clean();

    return $html;
}

add_shortcode('yc_latest_news', 'yc_latest_news_f');




/**
 * Get Categories
 * @param string $view - list or tag
 */
function yc_get_terms_f($atts = array())
{
    // set up default parameters
    extract(shortcode_atts(array(
        'taxonomy' => 'category',
        'title' => '分類',
        'view' => 'list',
        'parent' => '0',
    ), $atts));

    /*$lang = get_locale();
        switch ($lang) {
            case 'zh_TW':
                $title = '分類';
                $exclude = 16;
                break;
            case 'zh_CN':
                $title = '分類';
                $exclude = 16;
                break;
            case 'ja':
                $title = 'カテゴリー';
                $exclude = array(16, 17);
                break;
            case 'en_US':
                $title = 'Category';
                $exclude = '';
                break;
            default:
                $title = 'Category';
                $exclude = '';
                break;
        }*/
    $terms_args = array(
        'orderby' => 'name',
        'taxonomy' => $taxonomy,
        'parent'  => $parent, //resources 7 底下
        //'exclude' => $exclude,
    );
    $terms = get_terms($terms_args);

    if (empty($terms)) return;

    // This is where you run the code and display the output
    $html = '';
    ob_start();
?>
    <p class="text-gray-900 mb-1hr mt-3r"><?php echo $title; ?></p>
    <?php
    if ($view == 'tag') :
    ?>
        <?php foreach ($terms as $term) : ?>
            <a href="<?php echo get_term_link($term->term_id); ?>" class="post-tags"><?php echo $term->name; ?></a>
        <?php endforeach; ?>
    <?php else : ?>
        <ul class="list-unstyled ps-0">
            <?php
            foreach ($terms as $term) :
                //var_dump($term);
                if ($term->parent == 0) :
            ?>
                    <li class="small mb-2 cat-item cat-item-<?php echo $term->term_id; ?>"><a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a></li>

                    <?php
                    $child_terms_args = array(
                        'orderby' => 'name',
                        'taxonomy' => $taxonomy,
                        'parent'  => $term->term_id, //resources 7 底下
                        //'exclude' => $exclude,
                    );
                    $child_terms = get_terms($child_terms_args);
                    foreach ($child_terms as $child_term) :
                    ?>
                        <li class="small mb-2 cat-item cat-item-<?php echo $child_term->term_id; ?> ps-1r"><a href="<?php echo get_term_link($child_term->term_id); ?>"> - <?php echo $child_term->name; ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
<?php
    endif;

    $html .= ob_get_clean();

    return $html;
}

add_shortcode('yc_get_terms', 'yc_get_terms_f');
