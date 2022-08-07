<?php

function the_share_btn($url = '')
{
    if (empty($url)) {
        global $post;
        $url = get_permalink($post->ID);
    }
?>
    <div class="w-100 text-center text-md-end share-btn-icon">
        <!-- <i class="fa-regular fa-bookmark position-relative save_to_fb" data-bs-toggle="tooltip" title="儲存到 Facebook">
            <div class="fb-save position-absolute top-0 start-0" data-uri="<?= $url; ?>" data-size="large" data-lazy="true" style="width:30px;height:30px;overflow: hidden;opacity: 0;"></div>
        </i> -->

        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url; ?>" target="_blank" data-bs-toggle="tooltip" title="分享到 Facebook">
            <i class="fab fa-facebook-f"></i></a>

        <a href="https://twitter.com/intent/tweet?url=<?= $url; ?>" target="_blank" data-bs-toggle="tooltip" title="分享到 Twitter"><i class="fab fa-twitter"></i></a>



        <i class="fab fa-linkedin-in" data-bs-toggle="tooltip" title="分享到 LinkedIn">

            <script type="IN/Share" data-url="<?= $url; ?>"></script>
        </i>

        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?php echo get_permalink() ?>" data-bs-toggle="tooltip" title="發送到 Email"><i class="fal fa-envelope"></i></a>

    </div>

    <script>
        (function($) {
            $(document).ready(function() {
                //儲存到 FB
                // $('.save_to_fb').click(function() {
                //     $('.save_to_fb').toggleClass('saved');
                // });
                //FB分享按鈕
                $('.fa-facebook-f').on('click', function() {
                    FB.ui({
                        method: 'share',
                        display: 'popup',
                        href: '<?= $url; ?>',
                    }, function(response) {});
                }, false);
            });

        })(jQuery)
    </script>

    <script src="https://platform.linkedin.com/in.js" type="text/javascript">
        lang: en_US
    </script>
<?php
}


function the_share_btn_and_fb($url = '')
{
    if (empty($url)) {
        global $post;
        $url = get_permalink($post->ID);
    }
?>
    <div class="col-12 sticky-share bg-primary-200 py-2">
        <div class="row">
            <div class="col-md-auto text-nowrap mb-1r d-flex justify-content-center justify-content-md-start">
                <div class="fb-like" data-href="<?= $url ?>" data-width="" data-layout="button_count" data-action="recommend" data-size="large" data-share="false" data-colorscheme="dark" data-lazy="true"></div>
            </div>


            <div class="col-md mb-1r">
                <?php the_share_btn(); ?>
            </div>
        </div>

    </div>
<?php
}
