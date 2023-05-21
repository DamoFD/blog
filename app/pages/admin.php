<?php

    if(!logged_in()){

        redirect('login');

    }

    $section = $url[1] ?? 'dashboard';
    $action = $url[2] ?? 'view';
    $id = $url[3] ?? 0;
    $sub_action = $url[4] ?? 'view';
    $sub_id = $url[5] ?? 0;

    $filename = "../app/pages/admin/" . $section . ".php";
    if(!file_exists($filename)){

        $filename = "../app/pages/admin/404.php";

    }

    if($section == 'users'){

        require_once("../app/pages/admin/users-controller.php");

    }elseif($section == 'categories'){
        if($action == 'sub-categories'){
            require_once("../app/pages/admin/sub-categories-controller.php");
        }else{

        require_once("../app/pages/admin/categories-controller.php");
        }

    }elseif($section == 'posts'){

        require_once("../app/pages/admin/posts-controller.php");

    }

    
    

?>

<?php

    include('../app/pages/admin/header.php');
    
    include('../app/pages/admin/nav.php');
    
?>
    <h1>Dashboard</h1>

    <?php

        require_once($filename);

    ?>

</main>
<script src="<?=ROOT?>/assets/js/admin.js"></script>
</body>
</html>