<?php

// Add New Sub-Category
if ($sub_action == 'add') {

  if (!empty($_POST)) {

    //validate
    $errors = [];

    if (empty($_POST['sub-category'])) {
      $errors['sub-category'] = "A sub-category is required";
    } else
          if (!preg_match("/^[a-zA-Z]+[a-zA-Z ]*$/", $_POST['sub-category'])) {
      $errors['sub-category'] = "Sub-Category can only have letters and spaces";
    }

    $slug = str_to_url($_POST['sub-category']);

    $query = "SELECT id FROM sub_categories WHERE slug = :slug LIMIT 1";
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
      $data['category_id'] = $id;
      $data['sub_category'] = $_POST['sub-category'];
      $data['slug']    = $slug;
      $data['disabled'] = $_POST['disabled'];

      $query = "INSERT INTO sub_categories (category_id,sub_category,slug,disabled) VALUES (:category_id,:sub_category,:slug,:disabled)";

      if(!empty($destination)){
        $data['image'] = $destination;
        $query = "INSERT INTO sub_categories (category_id,sub_category,slug,disabled,image) VALUES (:category_id,:sub_category,:slug,:disabled,:image)";
      }
      
      query($query, $data);

      redirect("admin/categories/sub-categories/$id");
    }
  }

  // Edit Sub-Category
} elseif ($sub_action == 'edit') {

  $query = "SELECT * FROM sub_categories WHERE id = :id LIMIT 1";
  $row = query_row($query, ['id' => $sub_id]);

  if (!empty($_POST)) {

    if ($row) {

      //validate
      $errors = [];

      if (empty($_POST['sub-category'])) {
        $errors['sub-category'] = "A sub-category is required";
      } else
        if (!preg_match("/^[a-zA-Z]+[a-zA-Z ]*$/", $_POST['sub-category'])) {
        $errors['sub-category'] = "sub-category can only have letters and spaces";
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
        $data['category_id'] = $id;
        $data['sub_category'] = $_POST['sub-category'];
        $data['disabled'] = $_POST['disabled'];
        $data['id'] = $sub_id;

        $update_fields = "category_id = :category_id, sub_category = :sub_category, disabled = :disabled";

        if (!empty($destination)) {
          $data['image'] = $destination;
          $update_fields .= ", image = :image";
        }

        $query = "UPDATE sub_categories SET $update_fields WHERE id = :id LIMIT 1";

        query($query, $data);
        redirect("admin/categories/sub-categories/$id");
      }
    }
  }
} elseif ($sub_action == 'delete') {

  $query = "SELECT * FROM sub_categories WHERE id = :id LIMIT 1";
  $row = query_row($query, ['id' => $sub_id]);

  if (!empty($_POST)) {

    if ($row) {

      //validate
      $errors = [];

      if (empty($errors)) {
        // Delete from database
        $data = [];
        $data['id'] = $sub_id;

        $query = "DELETE FROM sub_categories WHERE id = :id LIMIT 1";

        query($query, $data);

        if(file_exists($row['image']))
        unlink($row['image']);
        
        redirect("admin/categories/$id");
      }
    }
  }
}