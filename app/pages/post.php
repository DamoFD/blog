<?php
    include('../app/pages/includes/header.php');
?>

<h1>Blog</h1>

    <?php
    
    $catSlug = $url[1] ?? null;
    $subCatSlug = $url[2] ?? null;
    $slug = $url[3] ?? null;

    if($slug){
        $query = "SELECT posts.*, categories.category, categories.slug as category_slug, sub_categories.sub_category, sub_categories.slug as sub_category_slug 
            FROM posts 
            JOIN categories ON posts.category_id = categories.id 
            JOIN sub_categories ON posts.sub_category_id = sub_categories.id 
            WHERE posts.slug = :slug
            AND categories.slug = :catslug
            AND sub_categories.slug = :subcatslug
            LIMIT 1";

        $row = query_row($query, ['slug' => $slug, 'catslug' => $catSlug, 'subcatslug' => $subCatSlug]);
        if(!empty($row)) {
            include('../app/pages/blog/post-single.php');
        } else {
            echo "No items found!";
        }
    }
    
    ?>

<?php
    include('../app/pages/includes/footer.php');
?>
