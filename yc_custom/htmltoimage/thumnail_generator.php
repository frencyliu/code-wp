<?php
/**
 * 圖片產生器
 * 產生 html
 */

add_action('transition_post_status', 'thumnail_generator', 10, 3);

function thumnail_generator($new_status, $old_status, $post)
{
    if ( $new_status != 'publish' ) return;
    global $post;
    $title = get_the_title();
    $levels = get_the_terms( $post->ID, 'level');
    $level = $levels[0]->slug;
    $time_to_read = get_the_readding_time() . ' mins';
    $date = date('Y/m/d');



    switch ($level) {
        case 'easy':
            $lv_text = "易";
            $lv_bg = "bg-success";
            break;
        case 'normal':
            $lv_text = "普";
            $lv_bg = "bg-warning";
            break;
        case 'hard':
            $lv_text = "難";
            $lv_bg = "bg-danger";
            break;
        case 'hell':
            $lv_text = "HEN難";
            $lv_bg = "bg-pink";
            break;

        default:
            $lv_text = "易";
            $lv_bg = "bg-success";
            break;
    }


    ob_start();
?>

    <html lang="zh-TW">

    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?= site_url() ?>/wp-content/plugins/wp_aio_yc/assets/fontawesome-pro-6/css/all.min.css">
        <style>
            @font-face {
                font-family: 'Courier New';
                src: url('<?= site_url() ?>/wp-content/themes/YC-TECH/yc_custom/htmltoimage/courier_new.ttf') format('truetype');
            }

            :root {
                font-size: 32px;
            }

            .card {
                width: 1140px;
                height: 575px;
                background-color: #0f172a;
                padding: 1rem;
                position: relative;
            }

            .card-body {
                padding: 0rem 1.5em;
            }

            .card-body h2 {
                text-align: center;
                margin-top: 240px;
                line-height: 2;
                font-family: 'Courier New', Courier, monospace;
            }

            .position-absolute {
                position: absolute;
            }

            .card-head {
                top: 2rem;
                left: 2rem;
                font-family: 'Courier New', Courier, monospace;
            }



            .card-footer span {
                white-space: nowrap;
                min-width: 300px;
                font-size: 0.875rem;
                font-family: 'Courier New', Courier, monospace;
            }

            .card-footer i {
                margin-right: 0.25rem;
            }


            .small {
                font-size: 0.875%;
            }

            .text-white {
                color: #fff;
            }

            .text-gray-700 {
                color: rgb(128, 128, 128);
            }

            .level {
                height: 1.5rem;
                width: 1.5rem;
                text-decoration: none;
                color: white;
                margin-right: 0.25rem;
                padding: 0.25rem;
            }

            .bg-success {
                background-color: rgb(142, 215, 130);
            }

            .bg-warning {
                background-color: rgb(243, 152, 0);
            }

            .bg-danger {
                background-color: rgb(240, 116, 112);
            }

            .bg-pink {
                background-color: rgb(255, 155, 204);
            }

            .dot {
                width: 0.3em;
                height: 0.3em;
                display: inline-block;
                background-color: #ff9bcc;
            }
        </style>
    </head>

    <body>
        <div class="card">
            <div class="card-head position-absolute">
                <span class="level text-white <?= $lv_bg ?>"><?= $lv_text ?></span>
            </div>
            <div class="card-body">
                <h2 class="text-white"><?= $title ?><span class="dot"></span></h2>
            </div>
            <div class="card-footer">
                <span class="text-gray-700 position-absolute" style="bottom:2rem;left:2rem;"><i class="fa-light fa-clock"></i><?= $time_to_read ?>
                </span>
                <span class="text-gray-700 position-absolute" style="text-align:right;bottom:2rem;right:2rem;"><i class="fa-light fa-calendar-day"></i><?= $date ?></span>
            </div>

        </div>
    </body>

    </html>

<?php
    $html = ob_get_clean();


    file_put_contents(__DIR__ . '/post_thumbnail_HTML_template.html', $html);

/*
 * 執行shell
 * 輸出成圖片
 * 傳參 @see https://blog.csdn.net/qq_36663951/article/details/82760613
 * 把 post{id} 作為 n 的 value 傳進 htmltoimage.php
*/
$command = 'php ' . __DIR__ . '/htmltoimage.php -n' . 'post' . get_the_ID() . ' -p' . wp_upload_dir()['path'];
$output = shell_exec($command);


//

// $filename should be the path to a file in the upload directory.
$imagePath = wp_upload_dir()['path'] . '/post' . get_the_ID() . '.png';
$filetype = wp_check_filetype( basename( $imagePath ), null );
    $wp_upload_dir = wp_upload_dir();

    $attachment = array(
        'post_mime_type' => $filetype['type'],
        'post_title' => sanitize_file_name(basename($imagePath)),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    // So here we attach image to its parent's post ID from above
    $attach_id = wp_insert_attachment( $attachment, $imagePath, get_the_ID());
    // Attachment has its ID too "$attach_id"
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $imagePath );
    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2= set_post_thumbnail( $parent_post_id, $attach_id );


}




