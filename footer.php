</main>


<footer>
    <div class="container text-white">
        <div class="row">
            <div class="col-lg-4 mb-3r">

                <div class="d-flex">
                    <a href="<?= site_url('webpush') ?>" target="_blank" class="d-flex align-items-end text-white text-decoration-none h5 mb-1r">
                        Code-WP<span class="logo-dot ms-1" style="opacity: 0; background-color: rgb(243, 13, 251);"></span>
                    </a>
                    <a class="ms-2 mt-n2" href="<?= site_url('webpush') ?>" target="_blank" data-bs-toggle="tooltip" title="🔔 開啟通知，獲取最新消息！" data-bs-custom-class="text-nowrap w-auto">
                        <?php the_notification_bell(); ?>
                    </a>
                </div>
                <p class="small">Unleash the Power of WordPress.</p>
                <div id="webpushr-subscription-button" data-size="medium" data-button-text="接受通知" data-subscriber-count-text="個用戶已經接受通知" data-background-color="#38bdf8"></div>

                <ul class="list-group list-group-horizontal mt-2">

                    <li class="list-group-item bg-transparent px-1r border-0"><a href="https://www.facebook.com/groups/wp.valley" target="_blank" data-bs-toggle="tooltip" title="Code-WP 官方
                    "><i class="fa-brands fa-facebook text-white h4"></i></a></li>

                    <li class="list-group-item bg-transparent px-1r border-0"><a href="mailto:frencyliu@gmail.com" target="_blank" data-bs-toggle="tooltip" title="寫信給我
                    "><i class="fa-solid fa-circle-envelope text-white h4"></i></a></li>

                    <li class="list-group-item bg-transparent px-1r border-0"><a href="https://www.facebook.com/groups/wp.valley" target="_blank" data-bs-toggle="tooltip" title="加入台灣 WordPress 社群
                    "><i class="fa-solid fa-circle-w text-white h4"></i></a></li>




                </ul>
                <div class="d-flex align-items-end">
                    <p class="small mb-0 me-1r">built with </p>
                    <a href="https://livecanvas.com/?ref=2933" target="_blank">
                        <img src="https://livecanvas.com/wp-content/uploads/2021/01/logo_new.svg" alt="" data-bs-toggle="tooltip" title="此網站是由 LiveCanvas 製作而成" style="max-width:7rem"></a>
                </div>


            </div>
            <div class="col-lg-2 col-6">
                <h4 class="text-gray-700 hp fw-bold">&lt; SERVICES /&gt;</h4>
                <ul class="list-group">
                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= '#' //site_url('road-map')
                                                                                                        ?>" class="hover-border small"><span data-bs-toggle="tooltip" title="建置中...">Custimize</span></a></li>
                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= '#' //site_url('road-map')
                                                                                                        ?>" class="hover-border small"><span data-bs-toggle="tooltip" title="建置中...">Solution</span></a></li>
                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= '#' //site_url('road-map')
                                                                                                        ?>" class="hover-border small"><span data-bs-toggle="tooltip" title="建置中...">Bootstrpap Code Block</span></a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h4 class="text-gray-700 hp fw-bold">&lt; ARTICLES /&gt;</h4>
                <ul class="list-group">
                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= site_url('category/wordpress-dev') ?>" class="hover-border small"><span>WordPress 開發日誌</span></a></li>
                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= site_url('category/wordpress-dev-tutorial') ?>" class="hover-border small"><span>WordPress 教程</span></a></li>
                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= '#' //site_url('category/wordpress-dev-tutorial')
                                                                                                        ?>" class="hover-border small"><span data-bs-toggle="tooltip" title="建置中...">LiveCanvas 教程</span></a></li>
                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= '#' //site_url('category/wordpress-dev-tutorial')
                                                                                                        ?>" class="hover-border small"><span data-bs-toggle="tooltip" title="建置中...">Bootstrap 教程</span></a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h4 class="text-gray-700 hp fw-bold">&lt; ABOUT /&gt;</h4>
                <ul class="list-group">
                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= site_url('manifesto') ?>" class="hover-border small"><span>Manifesto</span></a></li>
                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= site_url('road-map') ?>" class="hover-border small"><span>Road Map</span></a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h4 class="text-gray-700 hp fw-bold text-nowrap">&lt; LIVECANVAS❤️ /&gt;</h4>
                <ul class="list-group">

                    <li class="list-group-item bg-transparent px-0 text-white border-0 py-0"><a href="<?= site_url('livecanvas')
                                                                                                        ?>" class="hover-border small"><span data-bs-toggle="tooltip" title="LiveCanvas 是我們推薦的頁面編輯器">Why LiveCanvas</span></a></li>
                </ul>
            </div>
            <div class="col-lg-10 offset-lg-1 border-top border-gray-700 pt-1r">
                <div class="row">
                    <div class="col-lg-6 d-flex justify-content-lg-end justify-content-center order-lg-2">
                        <p class="text-center small px-2"><a class="text-gray-700" href="<?= site_url('privacy') ?>">Privacy</a></p>
                        <!-- <p class="text-center small px-2"><a class="text-gray-700">Terms</a></p> -->
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <p class="text-lg-start text-center small text-gray-700">Copyright © <?php echo date('Y') ?> YC-TECH.CO All Right Reserved.</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</footer>


<?php wp_footer(); ?>
<script defer>
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>

</body>

</html>