<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;



?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Required meta tags -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- wp_head begin -->
    <?php wp_head(); ?>
    <!-- wp_head end -->
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header>
        <div class="container d-flex flex-wrap align-items-center">
            <nav class="navbar fixed-top navbar-expand-lg w-100">
                <div class="container">
                    <a href="<?php echo site_url(); ?>" class="d-flex align-items-end me-md-auto text-white text-decoration-none h5 mb-0" style="line-height: 0.7em;">
                        Code-WP<span class="logo-dot ms-1"></span>
                        <!--img src="" sizes="" alt="logo" width="128" height="94"-->


                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon d-flex align-items-center"><i class="text-white fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end text-center" id="navbarTogglerDemo01">
                        <ul class="navbar-nav me-0 me-md-3 mb-2 mb-lg-0">


                            <li class="nav-item dropdown">
                                <a class="nav-link hover-border" href="<?= site_url('all-posts') ?>">
                                    <span>WordPress Dev</span>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link hover-border" aria-current="page" href="mailto:frencyliu@gmail.com" target="_blank">
                                    <span>&lt; 找專家<span class="logo-dot ms-1"></span>/&gt;</span>

                                </a>
                            </li>
                            <!-- <li class="nav-item ms-lg-2">
                                <a class="nav-link py-2">
                                    <i class="fa-duotone fa-signal-bars"></i>
                                    <i class="fa-light fa-signal-bars-slash"></i>
                                </a>
                            </li> -->



                            <!-- <li class="nav-item text-lg-start text-center pe-lg-1hr position-relative mm-lang">
                                <a class="nav-link dropdown-toggle py-0 py-xl-2" href="#" id="nav-about" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i id="lang_2_char" class="far fa-globe me-1"></i>
                                    <?= $locale_text ?> </a>
                                <ul class="dropdown-menu text-lg-start text-center py-0" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item <?= $locale_active_en ?>" href="<?= site_url('en') ?>">English</a></li>
                                    <li><a class="dropdown-item <?= $locale_active_tw ?>" href="<?= site_url() ?>">繁體中文</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

    </header>

    <main id='theme-main'>