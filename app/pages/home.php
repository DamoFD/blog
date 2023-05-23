<?php
    include('../app/pages/includes/header.php');
?>

<?php
    include('../app/pages/includes/hero.php');
?>

<?php
    include('../app/pages/includes/method.php');
?>

<?php
    include('../app/pages/includes/skills.php');
?>

<?php
    include('../app/pages/includes/about.php');
?>

<?php
    include('../app/pages/includes/portfolio.php');
?>

<?php
    include('../app/pages/includes/contact.php');
?>

    <?php
    
 /*   $query = "SELECT posts.*, categories.category, categories.slug as category_slug, sub_categories.sub_category, sub_categories.slug as sub_category_slug 
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
    */
    ?> 

<?php
    include('../app/pages/includes/footer.php');
?>