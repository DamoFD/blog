<?php

    $query = "SELECT * FROM categories WHERE slug = :category_slug LIMIT 1";

    $category = query_row($query,['category_slug'=>$category_slug]);

    $query = "SELECT sub_categories.* 
    FROM sub_categories 
    JOIN categories ON sub_categories.category_id = categories.id
    WHERE categories.slug = :category_slug
    LIMIT $limit
    OFFSET $offset";

    $sub_categories = query($query, ['category_slug' => $category_slug]);

?>


<div>
    <h1>Sub-Categories For <?=$category['category']?></h1>
    <img src="<?=get_image($category['image'])?>" />
    <nav>
        <ul>
            <li>
                <a href="<?=ROOT?>">Home</a> >
            </li>
            <li>
                <a href="<?=ROOT?>/blog">Blog</a> >
            </li>
            <li>
                <a href="<?=ROOT?>/category">Categories</a> >
            </li>
            <li>
                <p><?=$category['category']?></p>
            </li>
        </ul>
    </nav>

    <?php if(!empty($sub_categories)) : ?>
    <?php foreach($sub_categories as $sub_category) : ?>
        <a href="<?=ROOT?>/category/<?=$category['slug']?>/<?=$sub_category['slug']?>">
        <img src="<?=get_image($sub_category['image'])?>" />
        <h2><?=$sub_category['sub_category']?></h2>
    </a>
    <?php endforeach; ?>
    <?php else : ?>
        <p>This category has no sub-categories</p>
    <?php endif; ?>
</div>