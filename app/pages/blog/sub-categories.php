<?php

$query = "SELECT * FROM categories WHERE slug = :category_slug LIMIT 1";

$category = query_row($query, ['category_slug' => $category_slug]);

$query = "SELECT sub_categories.* 
    FROM sub_categories 
    JOIN categories ON sub_categories.category_id = categories.id
    WHERE categories.slug = :category_slug
    LIMIT $limit
    OFFSET $offset";

$sub_categories = query($query, ['category_slug' => $category_slug]);

?>


<section id="sub-categories">
    <div class="hero">
        <h1 class="color-secondary font-sans font-size-header">Sub-Categories For <?= $category['category'] ?></h1>
        <p class="font-poppins font-size-med header-text">Explore, share, and find exactly what you're looking for in these categories.</p>
        <div class="overlay"></div>
        <img class="hero-img" src="<?= get_image($category['image']) ?>" />
    </div>
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="<?= ROOT ?>">Home</a> >
                </li>
                <li>
                    <a href="<?= ROOT ?>/blog">Blog</a> >
                </li>
                <li>
                    <a href="<?= ROOT ?>/category">Categories</a> >
                </li>
                <li>
                    <p><?= $category['category'] ?></p>
                </li>
            </ul>
        </nav>

        <div class="feat-categories">
            <?php if (!empty($sub_categories)) : ?>
                <?php foreach ($sub_categories as $sub_category) : ?>
                    <a href="<?= ROOT ?>/category/<?= $category['slug'] ?>/<?= $sub_category['slug'] ?>">
                        <img src="<?= get_image($sub_category['image']) ?>" class="category-img" />
                        <h2 class="font-sans category-head"><?= $sub_category['sub_category'] ?></h2>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <p>This category has no sub-categories</p>
            <?php endif; ?>
        </div>
    </div>
</section>