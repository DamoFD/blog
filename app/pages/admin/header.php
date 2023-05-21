<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= APP_NAME ?></title>

    <!-- Custom CSS File -->
    <link href="<?php echo ROOT; ?>/assets/css/admin.css" rel="stylesheet" />
</head>

<!-- Google Analytics -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-796KMRC183"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-796KMRC183');
</script>

<body>
    <!--start #header-->
    <header id="header" class="header__main">
        <!--Primary Navigation-->
        <nav class="navbar">
            <a href="<?=ROOT?>/admin">
                <img src="<?=ROOT?>/assets/svg/site-logo.svg" class="header-img" />
            </a>
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav no-search">
                <li class="nav-item">
                    <a class="<?=$section == 'dashboard' ? 'active' : ''?>" href="<?=ROOT?>/admin">Dashboard</a>
                </li>
                <li class="nav-item">
                    <p>ANALYTICS</p>
                </li>
                <li class="nav-item"><a class="<?=$section == 'performance' ? 'active' : ''?>" href="<?=ROOT?>/admin/performance">Performance</a></li>
                <li class="nav-item"><a href="<?=ROOT?>">Live Site</a></li>
                <li class="nav-item">
                    <p>BLOG</p>
                </li>
                <li class="nav-item">
                    <a class="<?=$section == 'posts' ? 'active' : ''?>" href="<?=ROOT?>/admin/posts">Posts</a>
                </li>
                <li class="nav-item"><a class="<?=$section == 'categories' ? 'active' : ''?>" href="<?=ROOT?>/admin/categories">Categories</a></li>
                <li class="nav-item"><a class="<?=$section == 'users' ? 'active' : ''?>" href="<?=ROOT?>/admin/users">Users</a></li>
                <li class="nav-item"><p>NOTIFICATIONS</p></li>
                <li class="nav-item"><a>Emails</a></li>
                <li class="nav-item"><a>Comments</a></li>
                <li class="nav-item"><a href="<?=ROOT?>/logout">Log Out</a></li>
            </ul>
        </nav>
        <!--!Primary Navigation-->
    </header>
    <!--!start #header-->
    <main>