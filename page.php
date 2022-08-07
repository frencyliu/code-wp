<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$URL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


?>
<!-- <div class="py-6 bg-light">
    <div class="container text-center">
        <h1 class="display-4"><?php the_title(); ?></h1>

  </div>
</div> -->

<div class="container my-3r">
    <div class="row px-1r">
        <div class="col-lg-10 mt-3r mt-md-6r offset-lg-1 py-2r px-lg-2r px-1r rounded-2 post-body">
        <p class="mt-0 pe-1r pe-lg-0 small text-gray-700 d-flex justify-content-between">
                <span><i class="fa-light fa-clock me-2"></i><?php the_readding_time(); ?> mins read ‧ <i class="fa-light fa-calendar-day me-2"></i><?php echo date('Y/m/d', get_post_time('U')); ?></span>

                <?php the_level(); ?></p>
            <h1><?php the_title(); ?></h1>
            <hr>
            <?php

            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
            else :
                _e('Sorry, no posts matched your criteria.', 'textdomain');
            endif;
            ?>


            <div class="col-12">
                <h2>覺得不錯的話，請給我點個推薦<i class="fa-duotone fa-thumbs-up text-secondary ms-2"></i></h2>
                <p>您的支持與鼓勵是我們前進的最大動力！</p>
            </div>
            <?php the_share_btn_and_fb(); ?>

        </div>
    </div>
</div>


<script>
    //FB分享按鈕
    document.querySelector('.fa-facebook-f').addEventListener('click', function() {
        FB.ui({
            method: 'share',
            display: 'popup',
            href: '<?php echo $URL; ?>',
        }, function(response) {});
    }, false);
</script>

<script src="https://platform.linkedin.com/in.js" type="text/javascript">
    lang: en_US
</script>


<?php get_footer();
