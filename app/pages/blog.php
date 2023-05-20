<?php
    include('../app/pages/includes/header.php');
?>

<h1>Blog</h1>

    <?php

    $limit = 10;
    $offset = ($PAGE['page_number'] - 1) * $limit;
    
    $query = "SELECT posts.*, categories.category, sub_categories.sub_category 
          FROM posts 
          JOIN categories ON posts.category_id = categories.id 
          JOIN sub_categories ON posts.sub_category_id = sub_categories.id 
          ORDER BY posts.id DESC 
          LIMIT $limit
          OFFSET $offset";

    $rows = query($query);
    if($rows) {
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