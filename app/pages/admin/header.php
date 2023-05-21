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

<body>
    <!--start #header-->
    <header id="header" class="header__main">
        <!--Primary Navigation-->
        <nav class="navbar">
            <a href="/">
                <img src="<?=ROOT?>/assets/svg/site-logo.svg" class="header-img" />
            </a>
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav no-search">
                <li class="nav-item">
                    <a class="<?=$section == 'dashboard' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin">Dashboard</a>
                </li>
                <li class="nav-item">
                    <p>ANALYTICS</p>
                </li>
                <li class="nav-item"><a href="#about">Performance</a></li>
                <li class="nav-item"><a href="<?=ROOT?>">Live Site</a></li>
                <li class="nav-item">
                    <p>BLOG</p>
                </li>
                <li class="nav-item">
                    <a class="<?=$section == 'posts' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin/posts">Posts</a>
                </li>
                <li class="nav-item"><a class="<?=$section == 'categories' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin/categories">Categories</a></li>
                <li class="nav-item"><a class="<?=$section == 'users' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin/users">Users</a></li>
                <li class="nav-item"><p>NOTIFICATIONS</p></li>
                <li class="nav-item"><a>Emails</a></li>
                <li class="nav-item"><a>Comments</a></li>
                <li class="nav-item"><a href="<?php echo ROOT; ?>/logout">Log Out</a></li>
            </ul>
        </nav>
        <!--!Primary Navigation-->
    </header>
    <!--!start #header-->
    <main>