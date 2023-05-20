<?php
    include('../app/pages/includes/header.php');
?>

<h1>Blog</h1>

    <?php
    
    $slug = $url[1] ?? null;

    if($slug){
    $query = "SELECT posts.*, categories.category, sub_categories.sub_category 
          FROM posts 
          JOIN categories ON posts.category_id = categories.id 
          JOIN sub_categories ON posts.sub_category_id = sub_categories.id 
          WHERE posts.slug = :slug
          LIMIT 1";
    }

    $row = query_row($query, ['slug' => $slug]);
    if(!empty($row)) {
        include('../app/pages/includes/post-single.php');
    }else{
        echo "No items found!";
    }
    
    ?>

<?php
    include('../app/pages/includes/footer.php');
?>