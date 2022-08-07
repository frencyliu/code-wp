<?php

/**
 * 找出標題是只有英文的文章 && '_locale' 欄位 == unset
 * 並將post_meta中的 '_locale' 欄位，改成 en_US
 * 其餘文章改成 zh_TW
 *
 * \s 對空白字元(包括空格、tab、換行enter)
 * preg_match('/[^A-Za-z0-9\,\?\-\.\'\’\:\“\”\–\/\— ]/'
 */


function update_post_to_EN_or_TW_locale()
{
    //判斷那些文章只有英文
    $args = array(
        'post_type' => 'post',
        'numberposts' => -1,
        /* 'meta_key' => '_locale',
        'meta_compare' => 'NOT EXISTS', */
    );

    $all_posts = get_posts($args);
    $en_post = 0;
    $en_post_id = '';
    $tw_post = 0;
    $tw_post_id = '';
    //echo '文章數量: ' . count($all_posts) . '<br>';
    foreach ($all_posts as $post) {
        $title = $post->post_title;
        if (!preg_match('/[^A-Za-z0-9\,\?\-\.\'\’\:\“\”\–\/\— ]/', $title)) {
            //echo '<p style="color:red;">英文: ' . $title . '</p>';
            update_post_meta($post->ID, '_locale', 'en_US');
            $en_post = $en_post + 1;
            $en_post_id .= $post->ID . ', ';
        } else {
            //echo '<p>中文: ' . $title . '</p>';
            update_post_meta($post->ID, '_locale', 'zh_TW');
            $tw_post = $tw_post + 1;
            $tw_post_id .= $post->ID . ', ';
        }
    }
    if (class_exists('WP_CLI')) {
        WP_CLI::success('Find ' . count($all_posts) . ' Posts without _locale value');
        WP_CLI::success('Update ' . $en_post . ' Posts to en_US _locale');
        WP_CLI::success('Update ' . $tw_post . ' Posts to zh_TW _locale');
    }


    $log  = 'Date: ' . date("Y / m / d") . PHP_EOL .
    'Find ' . count($all_posts) . ' Posts without _locale value' . PHP_EOL .
    'Update ' . $en_post . ' Posts to en_US _locale' . PHP_EOL .
    'ID: ' . $en_post_id . PHP_EOL .
    "-------------------------" . PHP_EOL .
    'Update ' . $tw_post . ' Posts to zh_TW _locale' . PHP_EOL .
    'ID: ' . $tw_post_id . PHP_EOL .
    "-------------------------" . PHP_EOL;
    //Save string to log, use FILE_APPEND to append.
    file_put_contents( __DIR__ . '/log_' . date("Y.m.j") . '.log', $log, FILE_APPEND);
}
if (class_exists('WP_CLI')) {
    WP_CLI::add_command('locale_en', 'update_post_to_EN_or_TW_locale');
}
