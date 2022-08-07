<?php
/**
 * 後台編輯器介面優化
 */

function adjust_adminbar_css()
{
    $screen = get_current_screen();
    if (in_array($screen->id, array('post', 'page', 'tutorial'))) {
?>
        <style>

            #wp-content-editor-tools {
                position: sticky !important;
                top: 64px !important;
                background: #fff !important;
            }

            .mce-top-part {
                position: sticky !important;
                top: 130px !important;
            }
        </style>
<?php
    }
}
add_action('admin_head', 'adjust_adminbar_css');
