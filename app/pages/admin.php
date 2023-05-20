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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?=APP_NAME?></title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>/assets/css/dashboard.css" rel="stylesheet" />
</head>
<body>
<nav>
        <ul>
            <li>
                <a class="<?=$section == 'dashboard' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin">Dashboard</a>
            </li>
            <li>
                <a href="<?=ROOT?>">Front-End</a>
            </li>
            <li>
            <a class="<?=$section == 'users' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin/users">Users</a>
            </li>
            <li>
            <a class="<?=$section == 'categories' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin/categories">Categories</a>
            </li>
            <li>
            <a class="<?=$section == 'posts' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin/posts">Posts</a>
            </li>
        </ul>
    </nav>
    <h1>Dashboard</h1>
    <input type="text" placeholder="Search" />
    <a href="<?php echo ROOT; ?>/logout">Sign Out</a>

    <?php

        require_once($filename);

    ?>

</body>
</html>