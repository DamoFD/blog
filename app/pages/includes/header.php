<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - <?= APP_NAME ?></title>
    <link href="<?php echo ROOT; ?>/assets/css/dashboard.css" rel="stylesheet" />
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
    <header>
        <nav>
            <ul>
                <li>
                    <a class="<?=$url[0] == 'home' ? 'active' : ''?>" href="<?= ROOT ?>">Home</a>
                </li>
                <li>
                    <a class="<?=$url[0] == 'blog' ? 'active' : ''?>" href="<?= ROOT ?>/blog">Blog</a>
                </li>
                <li>
                    <a class="<?=$url[0] == 'contact' ? 'active' : ''?>" href="<?= ROOT ?>/contact">Contact</a>
                </li>
            </ul>
        </nav>
        <form action="<?=ROOT?>/search" role="search">
            <input value="<?=$_GET['find'] ?? ''?>" name="find" type="search" placeholder="Search..." aria-label="Search" />
            <button type="submit">Search</button>
        </form>
    </header>