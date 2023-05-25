<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=ucfirst($page_name)?> - <?= APP_NAME ?></title>
    <link rel="icon" type="image/x-icon" href="<?=ROOT?>/assets/svg/icon-logo.svg" />

    <!-- Custom CSS -->

    <?php if($page_name == 'post') : ?>
        <link href="<?=ROOT?>/assets/css/post.css" rel="stylesheet" />
    <?php else: ?>
        <link href="<?php echo ROOT; ?>/assets/css/page.css" rel="stylesheet" />
    <?php endif; ?>
</head>

<!-- Google Analytics -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-796KMRC183"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-796KMRC183');
</script>

<body>
    <!--start #header-->
    <header id="header" class="header__main">
        <!--Primary Navigation-->
        <nav class="navbar">
            <a href="<?=ROOT?>">
                <img src="<?=ROOT?>/assets/svg/site-logo.svg" class="header-img" />
            </a>
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav no-search">
                <li class="nav-item"><a class="<?= $url[0] == 'home' ? 'active' : '' ?>" href="<?= ROOT ?>">Home</a></li>
                <li class="nav-item"><a class="<?= $url[0] == 'about' ? 'active' : '' ?>" href="<?= ROOT ?>/about">About</a></li>
                <li class="nav-item"><a class="<?= $url[0] == 'about' ? 'active' : '' ?>" href="<?= ROOT ?>/portfolio">Portfolio</a></li>
                <li class="nav-item"><a class="<?= $url[0] == 'blog' ? 'active' : '' ?>" href="<?= ROOT ?>/blog">Blog</a></li>
                <li class="nav-item">
                    <a class="<?= $url[0] == 'contact' ? 'active' : '' ?>" href="<?= ROOT ?>/contact">Contact</a>
                </li>
            </ul>
        </nav>
        <!--!Primary Navigation-->
    </header>
    <!--!start #header-->

    <main>