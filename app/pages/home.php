<?php
    include('../app/pages/includes/header.php');
?>

    <?php
    
    $query = "SELECT posts.*, categories.category, sub_categories.sub_category 
          FROM posts 
          JOIN categories ON posts.category_id = categories.id 
          JOIN sub_categories ON posts.sub_category_id = sub_categories.id 
          ORDER BY posts.id DESC 
          LIMIT 10";

    $rows = query($query);
    if($rows) {
        foreach($rows as $row){
        include('../app/pages/includes/post-card.php');
        }
    }else{
        echo "No items found!";
    }
    
    ?>

<?php
    include('../app/pages/includes/footer.php');
?>