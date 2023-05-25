<section id="categories">
    <div class="hero">
        <h1 class="color-secondary font-sans font-size-header">Categories</h1>
        <p class="font-poppins font-size-med header-text">Explore, share, and find exactly what you're looking for in these categories.</p>
        <div class="overlay"></div>
        <img class="hero-img" src="<?= ROOT ?>/assets/images/blog-hero.jpg" />
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
                    <p>Categories</p>
                </li>
            </ul>
        </nav>
        <div class="feat-categories">
            <?php foreach ($rows as $row) : ?>
                <a href="<?= ROOT ?>/category/<?= $row['slug'] ?>">
                    <img src="<?= get_image($row['image']) ?>" class="category-img" />
                    <h2 class="font-sans category-head"><?= $row['category'] ?></h2>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>