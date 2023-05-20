<?php

// Add New Category
if ($action == 'add') {

  if (!empty($_POST)) {

    //validate
    $errors = [];

    if (empty($_POST['category'])) {
      $errors['category'] = "A category is required";
    } else
          if (!preg_match("/^[a-zA-Z]+[a-zA-Z ]*$/", $_POST['category'])) {
      $errors['category'] = "Category can only have letters and spaces";
    }

    $slug = str_to_url($_POST['category']);

    $query = "SELECT id FROM categories WHERE slug = :slug LIMIT 1";
    $slug_row = query($query, ['slug' => $slug]);

    if ($slug_row){

        $slug .= rand(1000, 9999);

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
      $data['category'] = $_POST['category'];
      $data['slug']    = $slug;
      $data['disabled'] = $_POST['disabled'];

      $query = "INSERT INTO categories (category,slug,disabled) VALUES (:category,:slug,:disabled)";

      if(!empty($destination)){
        $data['image'] = $destination;
        $query = "INSERT INTO categories (category,slug,disabled,image) VALUES (:category,:slug,:disabled,:image)";
      }
      
      query($query, $data);

      redirect('admin/categories');
    }
  }

  // Edit Category
} elseif ($action == 'edit') {

  $query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
  $row = query_row($query, ['id' => $id]);

  if (!empty($_POST)) {

    if ($row) {

      //validate
      $errors = [];

      if (empty($_POST['category'])) {
        $errors['category'] = "A category is required";
      } else
        if (!preg_match("/^[a-zA-Z]+[a-zA-Z ]*$/", $_POST['category'])) {
        $errors['category'] = "category can only have letters and spaces";
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
        $data['category'] = $_POST['category'];
        $data['disabled'] = $_POST['disabled'];
        $data['id'] = $id;

        $update_fields = "category = :category, disabled = :disabled";

        if (!empty($destination)) {
          $data['image'] = $destination;
          $update_fields .= ", image = :image";
        }

        $query = "UPDATE categories SET $update_fields WHERE id = :id LIMIT 1";

        query($query, $data);
        redirect('admin/categories');
      }
    }
  }
} elseif ($action == 'delete') {

  $query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
  $row = query_row($query, ['id' => $id]);

  if (!empty($_POST)) {

    if ($row) {

      //validate
      $errors = [];

      if (empty($errors)) {
        // Delete from database
        $data = [];
        $data['id'] = $id;

        $query = "DELETE FROM categories WHERE id = :id LIMIT 1";

        query($query, $data);

        if(file_exists($row['image']))
        unlink($row['image']);
        
        redirect('admin/categories');
      }
    }
  }
}