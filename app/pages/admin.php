<?php

    if(!logged_in()){

        redirect('login');

    }

    $section = $url[1] ?? 'dashboard';
    $action = $url[2] ?? 'view';
    $id = $url[3] ?? 0;

    $filename = "../app/pages/admin/" . $section . ".php";
    if(!file_exists($filename)){

        $filename = "../app/pages/admin/404.php";

    }

    if(!empty($_POST))
        {

    // Add New User
    if($action == 'add'){

          //validate
          $errors = [];

          if(empty($_POST['name']))
          {
            $errors['name'] = "A name is required";
          }else
          if(!preg_match("/^[a-zA-Z]+[a-zA-Z ]*$/", $_POST['name']))
          {
            $errors['name'] = "name can only have letters and spaces";
          }

          $query = "SELECT id FROM admin WHERE email = :email LIMIT 1";
          $email = query($query, ['email'=>$_POST['email']]);

          if(empty($_POST['email']))
          {
            $errors['email'] = "A email is required";
          }else
          if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
          {
            $errors['email'] = "Email not valid";
          }else
          if($email)
          {
            $errors['email'] = "That email is already in use";
          }

          if(empty($_POST['password']))
          {
            $errors['password'] = "A password is required";
          }else
          if(strlen($_POST['password']) < 8)
          {
            $errors['password'] = "Password must be 8 character or more";
          }else
          if($_POST['password'] !== $_POST['confirm_pwd'])
          {
            $errors['password'] = "Passwords do not match";
          }

          }
   
          if(empty($errors))
          {
            //save to database
            $data = [];
            $data['name'] = $_POST['name'];
            $data['email']    = $_POST['email'];
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = "INSERT INTO admin (name,email,password) VALUES (:name,:email,:password)";

            query($query, $data);

            redirect('admin/users');

          }
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <? echo APP_NAME; ?></title>

    <link href="<?php echo ROOT; ?>/assets/css/dashboard.css" rel="stylesheet" />
</head>
<body>
<nav>
        <ul>
            <li>
                <a href="<?php echo ROOT; ?>/admin">Dashboard</a>
            </li>
            <li>
                Front-End
            </li>
            <li>
            <a href="<?php echo ROOT; ?>/admin/users">Users</a>
            </li>
            <li>
            <a href="<?php echo ROOT; ?>/admin/categories">Categories</a>
            </li>
            <li>
            <a href="<?php echo ROOT; ?>/admin/posts">Posts</a>
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