<?php

    // Add Comment
    if (!empty($_POST)) {

        //validate
        $errors = [];
    
        if (empty($_POST['name'])) {
          $errors['name'] = "A name is required";
        } else
              if (!preg_match("/^[a-zA-Z]+[a-zA-Z ]*$/", $_POST['name'])) {
          $errors['name'] = "name can only have letters and spaces";
        }

        if (!empty($_POST['website'])) {
            if (!filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
                $errors['website'] = "The website field must contain a valid URL.";
            }
        }
        
    
        if (empty($_POST['content'])) {
          $errors['content'] = "A comment is required";
        }
    
    
    
        if (empty($errors)) {
          //save to database
          $data = [];
          $data['name'] = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $data['website'] = filter_var($_POST['website'], FILTER_SANITIZE_URL);
          $data['content'] = filter_var($_POST["content"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $data['post_id'] = $row['id'];
    
          $query = "INSERT INTO comments (name,website,content,post_id) VALUES (:name,:website,:content,:post_id)";
          
          query($query, $data);
    
          redirect("post/" . $row['category_slug'] . "/" . $row['sub_category_slug'] . "/" . $row['slug'] . "#comments");
        }else{
           // redirect("post/" . $row['category_slug'] . "/" . $row['sub_category_slug'] . "/" . $row['slug'] . "#comments");
        }
      }

?>

<div>
    <img src="<?=get_image($row['image'])?>" style="width: 200px; height: 200px; object-fit: cover;" />
    <h3><?=esc($row['title'])?></h3>
    <p><?=add_root_to_images($row['content'])?></p>
    <p><?=esc($row['category'] ?? 'Unknown') . '>' . esc($row['sub_category'] ?? 'Unknown')?></p>
    <p><?=esc(date("jS M, Y",strtotime($row['date'])))?></p>
    <p>created by</p>

    <!-- Comment Section -->

    <section id="comments">
        <h2>Comments</h2>
    <?php if (!empty($errors)) : ?>
        <p>Please fix the errors below</p>
    <?php endif; ?>
    <form method="post">
        <label>Name</label>
        <input name="name" type="text" value="<?= old_value('name') ?>" required />
        <?php if (!empty($errors['name'])) : ?>
        <p><?= $errors['name'] ?></p>
        <?php endif; ?>
        <label>Website (Optional)</label>
        <input name="website" type="url" value="<?= old_value('website') ?>" />
        <?php if (!empty($errors['website'])) : ?>
        <p><?= $errors['website'] ?></p>
        <?php endif; ?>
        <label>Comment</label>
        <textarea name="content" required><?= old_value('content') ?></textarea>
        <?php if (!empty($errors['content'])) : ?>
        <p><?= $errors['content'] ?></p>
        <?php endif; ?>
        <button type="submit">Submit Comment</button>
    </form>

    <?php

        // Fetch Comments
        $limit = 10;
        $offset = ($PAGE['page_number'] - 1) * $limit;

        $query = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY id DESC LIMIT 10 OFFSET $offset";
        $rows = query($query, ['post_id' => $row['id']]);

    ?>

    <?php if(!empty($rows)) : ?>
        <?php foreach($rows as $row) : ?>
            <?php if(!empty($row['website'])) : ?>
                <a href="<?=$row['website']?>" target="_blank"><h3><?=esc($row['name'])?></h3></a>
            <?php else : ?>
                <h3><?=esc($row['name'])?></h3>
            <?php endif; ?>
            <p><?= date("jS M, Y", strtotime($row['date'])) ?></p>
            <p><?=esc($row['content'])?></p>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Be the first to leave a comment on this post!</p>
    <?php endif; ?>

        <div>
            <a href="<?= $PAGE['first_link'] ?>">First Page</a>
            <a href="<?= $PAGE['prev_link'] ?>">Prev Page</a>
            <a href="<?= $PAGE['next_link'] ?>">Next Page</a>
        </div>
        </section>
</div>