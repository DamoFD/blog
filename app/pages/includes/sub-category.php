<?php

    $query = "SELECT * FROM sub_categories WHERE slug = :sub_category_slug LIMIT 1";

    $sub_category = query_row($query,['sub_category_slug'=>$sub_category_slug]);

    $query = "SELECT posts.*, categories.slug as category_slug, categories.category as category
    FROM posts 
    JOIN sub_categories ON posts.sub_category_id = sub_categories.id
    JOIN categories ON posts.category_id = categories.id
    WHERE sub_categories.slug = :sub_category_slug
    LIMIT $limit
    OFFSET $offset";

    $posts = query($query, ['sub_category_slug' => $sub_category_slug]);

?>


<div>
    <h1>Posts For <?=$sub_category['sub_category']?></h1>
    <img src="<?=get_image($sub_category['image'])?>" />
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
                <a href="<?=ROOT?>/category/<?=$category_slug?>"><?=$posts[0]['category']?></a> >
            </li>
            <li>
                <p><?=$sub_category['sub_category']?></p>
            </li>
        </ul>
    </nav>

    <?php if(!empty($posts)) : ?>
    <?php foreach($posts as $post) : ?>
        <a href="<?=ROOT?>/post/<?=$category_slug?>/<?=$sub_category_slug?>/<?=$post['slug']?>">
        <img src="<?=get_image($post['image'])?>" />
        <h2><?=$post['title']?></h2>
    </a>
    <?php endforeach; ?>
    <?php else : ?>
        <p>This category has no posts</p>
    <?php endif; ?>
</div>