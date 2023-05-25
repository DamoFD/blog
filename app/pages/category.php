<?php
    include('../app/pages/includes/header.php');
?>

    <?php

    $limit = 12;
    $offset = ($PAGE['page_number'] - 1) * $limit;

    $category_slug = $url[1] ?? null;
    $sub_category_slug = $url[2] ?? null;

    if(empty($category_slug)){

        $query = "SELECT * FROM categories ORDER BY category DESC LIMIT $limit OFFSET $offset";

        $rows = query($query);

    if(!empty($rows)){
        include('../app/pages/blog/categories.php');
    }else{
        echo "no categories found!";
    }
}

    elseif(!empty($category_slug) && empty($sub_category_slug)){

    $query = "SELECT * FROM categories WHERE slug = :category_slug LIMIT 1";

    $row = query_row($query,['category_slug'=>$category_slug]);
    

    if(!empty($row)) {
        include('../app/pages/blog/sub-categories.php');
    }else{
        echo "No items found!";
    }
}

    elseif(!empty($category_slug) && !empty($sub_category_slug)){
        
        $query = "SELECT * FROM sub_categories WHERE slug = :sub_category_slug LIMIT 1";
        $sub_category = query_row($query,['sub_category_slug'=>$sub_category_slug]);

        $query = "SELECT * FROM categories WHERE slug = :category_slug LIMIT 1";
        $category = query_row($query,['category_slug'=>$category_slug]);

        if(!empty($sub_category) && !empty($category)) {
            include('../app/pages/blog/sub-category.php');
        }else{
            echo "No items found!";
        }
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