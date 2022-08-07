<?php

function the_readding_time()
{
    global $post;

    $lang = get_locale();
    if ($lang == 'en_US') {
        $word_count = str_word_count(strip_tags(get_the_content()));
    } else {
        $word_count = mb_strlen(strip_tags(get_the_content()));
    }
    $mins_to_read = ceil($word_count / 250);
    echo $mins_to_read;
}


function get_the_readding_time()
{
    global $post;

    $lang = get_locale();
    if ($lang == 'en_US') {
        $word_count = str_word_count(strip_tags(get_the_content()));
    } else {
        $word_count = mb_strlen(strip_tags(get_the_content()));
    }
    $mins_to_read = ceil($word_count / 250);
    return $mins_to_read;
}
