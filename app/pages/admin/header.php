<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= APP_NAME ?></title>

    <!-- Bootstrap For Summernote Dependency -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

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
                    <a href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                    <p>ANALYTICS</p>
                </li>
                <li class="nav-item"><a href="#about">Performance</a></li>
                <li class="nav-item"><a href="#portfolio">Live Site</a></li>
                <li class="nav-item">
                    <p>BLOG</p>
                </li>
                <li class="nav-item">
                    <a href="#contact">Posts</a>
                </li>
                <li class="nav-item"><a>Categories</a></li>
                <li class="nav-item"><a>Users</a></li>
                <li class="nav-item"><p>NOTIFICATIONS</p></li>
                <li class="nav-item"><a>Emails</a></li>
                <li class="nav-item"><a>Comments</a></li>
            </ul>
        </nav>
        <!--!Primary Navigation-->
    </header>
    <!--!start #header-->
    <main>