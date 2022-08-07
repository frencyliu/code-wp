<?php
use Knp\Snappy\Image;
/**
 * KnpLabs/snappy
 * Snappy is a PHP library allowing thumbnail, snapshot or PDF generation from a url or a html page. It uses the excellent webkit-based wkhtmltopdf and wkhtmltoimage available on OSX, linux, windows.
 * @see https://github.com/KnpLabs/snappy
 */
require __DIR__ . '/../composer/vendor/autoload.php';

/**
 * 使用 getopt 接受參數 getopt('n:') 取得 -n 跟 -p 的值
 * @see https://blog.csdn.net/qq_36663951/article/details/82760613
 *
 */

$opt = getopt('n:p:');
$file_name = $opt['n'];
$uploadpath = $opt['p'];

ob_start();
// 載入你要輸出的 HTML 檔案
include_once( __DIR__ . '/post_thumbnail_HTML_template.html' );
$html = ob_get_clean();

$snappy = new Image('/usr/local/bin/wkhtmltoimage');
$snappy->generateFromHtml($html, $uploadpath . '/' . $file_name . '.png', [
    'crop-w' => 1200,
    'crop-h' => 630,
    'crop-x' => 8,
    'crop-y' => 8,
]);





 ?>
