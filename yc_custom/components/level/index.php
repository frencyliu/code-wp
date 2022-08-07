<?php
/*=============================================
        Level / difficulty / 難度分級
=============================================*/
function the_level()
{
    global $post;
    $levels = get_the_terms($post->ID, 'level');
    //var_dump($levels);
    foreach ($levels as $key => $level) :
        extract(get_object_vars($level));

        switch ($slug) {
            case 'easy':
                $bg_class = 'bg-success';
                break;
            case 'normal':
                $bg_class = 'bg-warning';
                break;
            case 'hard':
                $bg_class = 'bg-danger';
                break;
            case 'hell':
                $bg_class = 'bg-pink';
                break;
            default:
                $bg_class = 'bg-success';
                break;
        }
    ?>
        <a style="height:1.5rem;width:1.5rem;" href="<?= get_term_link($term_id, 'level') ?>" data-bs-toggle="tooltip" title="<?= $description ?>" data-bs-placement="right" class="text-decoration-none text-white <?= $bg_class ?> me-1 p-1"><?= $name ?></a>
<?php
    endforeach;
}


function the_levels($args = ['hide_empty' => false]){

    $levels = get_terms('level', $args);
    $re_levels = [];
    foreach ($levels as $key => $level) :

        if( $level->slug == 'easy' ) $re_levels[0] = $level;
        if( $level->slug == 'normal' ) $re_levels[1] = $level;
        if( $level->slug == 'hard' ) $re_levels[2] = $level;
        if( $level->slug == 'hell' ) $re_levels[3] = $level;
    endforeach;
    ksort($re_levels);
    foreach ($re_levels as $key => $level) :
        extract(get_object_vars($level));


        switch ($slug) {
            case 'easy':
                $bg_class = 'bg-success';
                break;
            case 'normal':
                $bg_class = 'bg-warning';
                break;
            case 'hard':
                $bg_class = 'bg-danger';
                break;
            case 'hell':
                $bg_class = 'bg-pink';
                break;
            default:
                $bg_class = 'bg-success';
                break;
        }
    ?>
        <a style="height:1.5rem;width:1.5rem;" href="<?= get_term_link($term_id, 'level') ?>" data-bs-toggle="tooltip" title="<?= $description ?>" data-bs-placement="bottom" class="text-decoration-none text-white <?= $bg_class ?> me-1 p-1"><?= $name ?></a>
<?php
    endforeach;
}