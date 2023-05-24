<?php
include('../app/pages/includes/header.php');
?>

<section id="blog">

    <?php

    $query = "SELECT posts.*, categories.category, categories.slug as category_slug, sub_categories.sub_category, sub_categories.slug as sub_category_slug 
          FROM posts 
          JOIN categories ON posts.category_id = categories.id 
          JOIN sub_categories ON posts.sub_category_id = sub_categories.id 
          ORDER BY posts.id DESC 
          LIMIT 6";

    $rows = query($query);

    ?>

    <div class="hero">
        <h1 class="color-secondary font-sans font-size-header">Blog</h1>
        <p class="font-poppins font-size-med header-text">Tips, tricks, and advice from a full stack developer.</p>
        <div class="overlay"></div>
        <img class="hero-img" src="<?= ROOT ?>/assets/images/blog-hero.jpg" />
    </div>

    <div class="container">
        <nav>
            <ul class="font-roboto font-size-small">
                <li><a href="<?= ROOT ?>">Home</a> > </li>
                <li>Blog</li>
            </ul>
        </nav>
        <h2 class="font-size-header font-sans">Featured Posts</h2>
        <div class="feat-posts">
            <?php if ($rows) : ?>
                <?php foreach ($rows as $row) : ?>
                    <div class="row">
                        <a href="<?= ROOT ?>/post/<?= $row['category_slug'] ?>/<?= $row['sub_category_slug'] ?>/<?= $row['slug'] ?>">
                            <img src="<?= get_image($row['image']) ?>" class="post-img" />
                        </a>
                        <div class="post-content">
                            <h3 class="font-sans"><?= esc($row['title']) ?></h3>
                            <p class="font-roboto"><?= substr($row['content'], 0, 30) ?></p>
                            <p class="font-poppins font-size-small">
                                <a href="<?= ROOT ?>/category/<?= $row['category_slug'] ?>">
                                    <?= esc($row['category'] ?? 'Unknown') ?>
                                </a>
                                >
                                <a href="<?= ROOT ?>/category/<?= $row['category_slug'] ?>/<?= $row['sub_category_slug'] ?>">
                                    <?= esc($row['sub_category'] ?? 'Unknown') ?>
                                </a>
                            </p>
                            <p class="font-roboto font-size-small date"><?= esc(date("jS M, Y", strtotime($row['date']))) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No items found!</p>
            <?php endif; ?>
        </div>

        <h2 class="font-sans font-size-header">Top Categories</h2>
        <a class="font-poppins font-size-med" href="<?= ROOT ?>/category">See all categories</a>

        <?php

        $query = "SELECT * FROM categories ORDER BY id DESC LIMIT 6";

        $rows = query($query);

        ?>

        <div class="feat-categories">
            <?php if ($rows) : ?>
                <?php foreach ($rows as $row) : ?>
                    <div class="row">
                        <img src="<?= get_image($row['image']) ?>" class="category-img" />
                        <h3 class="font-sans"><?= esc($row['category']) ?></h3>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No items found!</p>
            <?php endif; ?>
        </div>
    </div>


</section>

<?php
include('../app/pages/includes/footer.php');
?>