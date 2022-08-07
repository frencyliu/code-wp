<?php


define('YC_VER', '1.0.1');
define('YC_DIR', __DIR__);

/**
 * YC custom function
 */


/* shell test
exec('ls -al', $out);
echo '<pre>';
var_dump($out);
echo '</pre>';
 */


require_once __DIR__ . '/include.php';





// Dequeue YARP CSS Style Sheet
add_filter("yarpp_enqueue_related_style", "__return_false");

function yc_equene()
{
    global $post;
    wp_dequeue_script('bootstrap5');
    wp_enqueue_script('bootstrap5-footer', get_template_directory_uri() . "/js/bootstrap.bundle.min.js", array(), YC_VER, true);

    wp_enqueue_script('jquery', site_url() . 'wp-includes/js/jquery/jquery.min.js', array(), YC_VER);
    wp_enqueue_script('YC', get_stylesheet_directory_uri() . '/assets/js/yc.js#asyncload', array('jquery'), YC_VER, true);


    //只在文章時載入
    if (get_post_type() == 'post' || get_post_type() == 'tutorial') {
        //PrismJS 程式碼高亮
        wp_enqueue_script('prismjs', get_stylesheet_directory_uri() . '/assets/prismjs/prism.js#asyncload', array(), YC_VER, true);
        wp_enqueue_style('prismjs', get_stylesheet_directory_uri() . '/assets/prismjs/prism.css', array(), YC_VER);
    }

    // 只有特定文章才載入
    $enable_twentytwenty = ['custom-wcmp'];
    if (in_array($post->post_name, $enable_twentytwenty)) {
        wp_enqueue_style('twentytwenty_css', YC_ROOT_URL . 'assets/twentytwenty/css/twentytwenty.css');
        wp_enqueue_script('event_move_js', YC_ROOT_URL . 'assets/twentytwenty/js/jquery.event.move.js', array('jquery-core'), '');
        wp_enqueue_script('twentytwenty_js', YC_ROOT_URL . 'assets/twentytwenty/js/jquery.twentytwenty.js', array('event_move_js'), '');
    }
}
add_action('wp_enqueue_scripts', 'yc_equene', 200);

function yc_add_in_head()
{
?>
    <meta property="fb:app_id" content="1054104258833483" />
    <link rel="icon" href="<?= IMG_URL ?>/favicon.png" type="image/png" sizes="64x64">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GPRHMKKW1B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GPRHMKKW1B');
    </script>

<?php
}
add_action('wp_head', 'yc_add_in_head', 200);


function yc_add_in_body()
{
?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v14.0&appId=1054104258833483&autoLogAppEvents=1" nonce="3MBMUJfc"></script>
<?php
}
add_action('wp_body_open', 'yc_add_in_body', 200);

//set default feature image
function save_to_page_feature_img($post_id, $post, $update)
{
    // Only set for post_type = post!
    if (!has_post_thumbnail($post_id)) {
        update_post_meta($post_id, '_thumbnail_id', '294');
    }
}
//add_action('wp_insert_post', 'save_to_page_feature_img', 200, 3);



function picostrap_pagination($args = array(), $class = 'pagination justify-content-center')
{

    if (!isset($args['total']) && $GLOBALS['wp_query']->max_num_pages <= 1) {
        return;
    }

    $args = wp_parse_args(
        $args,
        array(
            'mid_size'           => 2,
            'prev_next'          => true,
            'prev_text'          => __('&laquo;', 'picostrap'),
            'next_text'          => __('&raquo;', 'picostrap'),
            'type'               => 'array',
            'current'            => max(1, get_query_var('paged')),
            'screen_reader_text' => __('Posts navigation', 'picostrap'),
        )
    );

    $links = paginate_links($args);
    if (!$links) {
        return;
    }

?>

    <nav aria-labelledby="posts-nav-label">

        <h2 id="posts-nav-label" class="visually-hidden">
            <?php echo esc_html($args['screen_reader_text']); ?>
        </h2>

        <ul class="<?php echo esc_attr($class); ?>">

            <?php
            foreach ($links as $key => $link) {
            ?>
                <li class="page-item <?php echo strpos($link, 'current') ? 'active' : ''; ?>">
                    <?php echo str_replace('page-numbers', 'page-link', $link); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>
                </li>
            <?php
            }
            ?>

        </ul>

    </nav>

<?php
}


function add_logoDot_to_title($title, $id = null)
{
    if (!function_exists('get_current_screen')) {
        return $title . '<span class="logo-dot ms-1"></span>';
    } else {
        return $title;
    }
}
add_filter('the_title', 'add_logoDot_to_title', 10, 2);


function my_localizable_post_types($localizable)
{
    $custom_post_types = array('tutorial'); // your custom post name
    return array_merge($localizable, $custom_post_types);
}
add_filter('bogo_localizable_post_types', 'my_localizable_post_types', 10, 1);


/*=============================================
                  BREADCRUMBS
=============================================*/

function the_breadcrumb()
{

?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <i class="fa-thin fa-list-tree me-2 text-gray-700"></i>
                <a href="<?= get_option('home'); ?>"><?= bloginfo('name'); ?></a>
            </li>

            <?php
            // Check if the current page is a category, an archive or a single page. If so show the category or archive name.
            if (is_category() || is_single()) : ?>
                <li class="breadcrumb-item"><?php the_category(', '); ?></li>
                <?php elseif (is_archive() || is_single()) :
                if (is_day()) : ?>
                    <li class="breadcrumb-item"><?php printf(__('%s', 'text_domain'), get_the_date()); ?></li>
                <?php elseif (is_month()) : ?>
                    <li class="breadcrumb-item"><?php printf(__('%s', 'text_domain'), get_the_date(_x('F Y', 'monthly archives date format', 'text_domain'))); ?></li>
                <?php elseif (is_year()) : ?>
                    <li class="breadcrumb-item"><?php printf(__('%s', 'text_domain'), get_the_date(_x('Y', 'yearly archives date format', 'text_domain'))); ?></li>
                <?php else : ?>
                    <li class="breadcrumb-item"><?php _e('Blog Archives', 'text_domain'); ?></li>
                <?php endif;
            endif;

            // If the current page is a single post, show its title with the separator
            if (is_single()) : ?>
                <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
            <?php endif;

            // If the current page is a static page, show its title.
            if (is_page()) : ?>
                <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>

            <?php endif;
            ?>

        </ol>
    </nav>
<?php
}
/*
* Credit: http://www.thatweblook.co.uk/blog/tutorials/tutorial-wordpress-breadcrumb-function/
*/


// 文章狀態改變時，清除快取
add_action('transition_post_status', 'clear_wprocket_cache', 10, 3);


function clear_wprocket_cache($new_status, $old_status, $post)
{

    if ($post->post_type === 'post' || $post->post_type === 'page' || $post->post_type === 'tutorial') {
        if ('publish' === $new_status) {

            // Clear cache.
            if (function_exists('rocket_clean_domain')) {
                rocket_clean_domain();
            }

            // Clear minified CSS and JavaScript files.
            if (function_exists('rocket_clean_minify')) {
                rocket_clean_minify();
            }



            // Preload cache.
            if (function_exists('run_rocket_sitemap_preload')) {
                run_rocket_sitemap_preload();
            }
        }
    }
}

//Query文章時也考慮 其他 CPT
add_action('pre_get_posts', 'query_post_type');

function query_post_type($query) {
  if($query->is_main_query()
    && ( is_category() || is_tag() )) {
        $query->set( 'post_type', array('post','tutorial') );
  }
}
