<?php

    if(!empty($_POST)){
        
        //validate
        $errors = [];

        $query = "select * from admin where email = :email limit 1";
        $row = query($query, ['email'=>$_POST['email']]);

        if($row){

            // check password
            $data = [];
            $data['email'] = $_POST['email'];
            if(password_verify($_POST['password'], $row[0]['password'])){

                // grant access
                authenticate($row[0]);
                redirect('admin');

            }else{
                $errors['email'] = "wrong email or password.";
            }

        }else{
            $errors['email'] = "wrong email or password.";
        }
        }


    

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo APP_NAME; ?></title>
</head>

<body>
    <h1>Login</h1>

    <?php if (!empty($errors['email'])): ?>
        <p><?php echo $errors['email'] ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Email</label>
        <input value="<?php echo old_value('email') ?>" name="email" type="email" required />
        <label>Password</label>
        <input value="<?php echo old_value('password') ?>" name="password" type="password" required />
        <button type="submit">Log In</button>
    </form>
</body>

</html>