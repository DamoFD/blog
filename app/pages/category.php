<?php
    include('../app/pages/includes/header.php');
?>

<h1>Category</h1>

    <?php

    $limit = 10;
    $offset = ($PAGE['page_number'] - 1) * $limit;

    $category_slug = $url[1] ?? null;

    if($category_slug){

    $query = "SELECT posts.*, categories.category, categories.slug as category_slug, sub_categories.sub_category, sub_categories.slug as sub_category_slug 
          FROM posts 
          JOIN categories ON posts.category_id = categories.id 
          JOIN sub_categories ON posts.sub_category_id = sub_categories.id
          WHERE posts.category_id IN
          (SELECT id FROM categories WHERE slug = :category_slug)
          ORDER BY posts.id DESC 
          LIMIT $limit
          OFFSET $offset";

    $rows = query($query,['category_slug'=>$category_slug]);
    }

    if(!empty($rows)) {
        foreach($rows as $row){
        include('../app/pages/includes/post-card.php');
        }
    }else{
        echo "No items found!";
    }
    
    ?>

<div>
        <a href="<?= $PAGE['first_link'] ?>">First Page</a>
        <a href="<?= $PAGE['prev_link'] ?>">Prev Page</a>
        <a href="<?= $PAGE['next_link'] ?>">Next Page</a>
    </div>

<?php
    include('../app/pages/includes/footer.php');
?>