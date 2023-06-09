<?php

// Add New User
if ($action == 'add') {

  if (!empty($_POST)) {

    //validate
    $errors = [];

    if (empty($_POST['name'])) {
      $errors['name'] = "A name is required";
    } else
          if (!preg_match("/^[a-zA-Z]+[a-zA-Z ]*$/", $_POST['name'])) {
      $errors['name'] = "name can only have letters and spaces";
    }

    $query = "SELECT id FROM admin WHERE email = :email LIMIT 1";
    $email = query($query, ['email' => $_POST['email']]);

    if (empty($_POST['email'])) {
      $errors['email'] = "A email is required";
    } else
          if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Email not valid";
    } else
          if ($email) {
      $errors['email'] = "That email is already in use";
    }

    if (empty($_POST['password'])) {
      $errors['password'] = "A password is required";
    } else
          if (strlen($_POST['password']) < 8) {
      $errors['password'] = "Password must be 8 character or more";
    } else
          if ($_POST['password'] !== $_POST['confirm_pwd']) {
      $errors['password'] = "Passwords do not match";
    }

    // validate image
    $allowed = ['image/jpeg', 'image/png', 'image/webp'];
    if(!empty($_FILES['image']['name'])){
      $destination = "";
      if(!in_array($_FILES['image']['type'], $allowed)){
        $errors['image'] = "Image format not supported";
      }else{
        $folder = "uploads/";
        if(!file_exists($folder)){
          mkdir($folder, 0777, true);
        }

        $destination = $folder . time() . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        resize_image($destination);
      }
    }



    if (empty($errors)) {
      //save to database
      $data = [];
      $data['name'] = $_POST['name'];
      $data['email']    = $_POST['email'];
      $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $query = "INSERT INTO admin (name,email,password) VALUES (:name,:email,:password)";

      if(!empty($destination)){
        $data['image'] = $destination;
        $query = "INSERT INTO admin (name,email,password,image) VALUES (:name,:email,:password,:image)";
      }
      
      query($query, $data);

      redirect('admin/users');
    }
  }

  // Edit User
} elseif ($action == 'edit') {

  $query = "SELECT * FROM admin WHERE id = :id LIMIT 1";
  $row = query_row($query, ['id' => $id]);

  if (!empty($_POST)) {

    if ($row) {

      //validate
      $errors = [];

      if (empty($_POST['name'])) {
        $errors['name'] = "A name is required";
      } else
        if (!preg_match("/^[a-zA-Z]+[a-zA-Z ]*$/", $_POST['name'])) {
        $errors['name'] = "name can only have letters and spaces";
      }

      $query = "SELECT id FROM admin WHERE email = :email && id != :id LIMIT 1";
      $email = query($query, ['email' => $_POST['email'], 'id' => $id]);

      if (empty($_POST['email'])) {
        $errors['email'] = "A email is required";
      } else
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email not valid";
      } else
        if ($email) {
        $errors['email'] = "That email is already in use";
      }

      if (empty($_POST['password'])) {
      } else
        if (strlen($_POST['password']) < 8) {
        $errors['password'] = "Password must be 8 character or more";
      } else
        if ($_POST['password'] !== $_POST['confirm_pwd']) {
        $errors['password'] = "Passwords do not match";
      }

      // Validate Image
      $allowed = ['image/jpeg', 'image/png', 'image/webp'];
      if (!empty($_FILES['image']['name'])) {

        $destination = "";
        if (!in_array($_FILES['image']['type'], $allowed)) {

          $errors['image'] = "Image format not supported";
        } else {

          $folder = "uploads/";
          if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
          }

          $destination = $folder . time() . $_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'], $destination);
          resize_image($destination);
        }
      }

      if (empty($errors)) {
        //save to database
        $data = [];
        $data['name'] = $_POST['name'];
        $data['email']    = $_POST['email'];
        $data['id'] = $id;

        $update_fields = "name = :name, email = :email";

        if (!empty($_POST['password'])) {

          $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
          $update_fields .= ", password = :password";
        }

        if (!empty($destination)) {
          $data['image'] = $destination;
          $update_fields .= ", image = :image";
        }

        $query = "UPDATE admin SET $update_fields WHERE id = :id LIMIT 1";

        query($query, $data);
        redirect('admin/users');
      }
    }
  }
} elseif ($action == 'delete') {

  $query = "SELECT * FROM admin WHERE id = :id LIMIT 1";
  $row = query_row($query, ['id' => $id]);

  if (!empty($_POST)) {

    if ($row) {

      //validate
      $errors = [];

      if (empty($errors)) {
        // Delete from database
        $data = [];
        $data['id'] = $id;

        $query = "DELETE FROM admin WHERE id = :id LIMIT 1";

        query($query, $data);

        if(file_exists($row['image']))
        unlink($row['image']);
        
        redirect('admin/users');
      }
    }
  }
}