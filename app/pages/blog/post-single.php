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

        // Send notification email
        $to = 'contact@damionvoshall.com';
        $subject = $data['name'] . " commented on your post!";
        $post_url = ROOT . '/' . $row['category_slug'] . '/' . $row['sub_category_slug'] . '/' . $row['slug'] . "#comments";
        $body = "From: " . $data['name'] . "\n Post: " . $post_url . "\n Comment:\n " . $data['content'];
        $headers = 'From: '.$to."\r\n";
        mail($to, $subject, $body, $headers);

        redirect("post/" . $row['category_slug'] . "/" . $row['sub_category_slug'] . "/" . $row['slug'] . "#comments");
    }
}

?>

<section id="post">
    <img src="<?= get_image($row['image']) ?>" class="hero-image" />
    <div class="content">
        <h1 class="font-sans font-size-header"><?= esc($row['title']) ?></h1>
        <nav>
            <ul class="font-roboto">
                <li>
                    <a href="<?= ROOT ?>">Home</a> >
                </li>
                <li>
                    <a href="<?= ROOT ?>/blog">Blog</a> >
                </li>
                <li>
                    <a href="<?= ROOT ?>/category">Categories</a> >
                </li>
                <li>
                    <a href="<?= ROOT ?>/category/<?= $row['category_slug'] ?>"><?= $row['category'] ?></a> >
                </li>
                <li>
                    <a href="<?= ROOT ?>/category/<?= $row['category_slug'] ?>/<?= $row['sub_category_slug'] ?>"><?= $row['sub_category'] ?></a> >
                </li>
                <li>
                    <p><?= esc($row['title']) ?></p>
                </li>
            </ul>
        </nav>
        <div class="date-by">
            <p class="date font-roboto"><?= esc(date("jS M, Y", strtotime($row['date']))) ?></p>
            <p class="by font-roboto">By Damion Voshall</p>
        </div>
        <hr />
        <div class="content-post"><?= add_root_to_images($row['content']) ?></div>
    </div>
</section>

<!-- Comment Section -->

<section id="comments">
    <hr />
    <div class="form-container">
        <h2 class="font-sans font-size-header">Comments</h2>
        <?php if (!empty($errors)) : ?>
            <p class="error font-roboto font-size-small">Please fix the errors below</p>
        <?php endif; ?>
        <form method="post">
            <label class="font-poppins font-size-med">Name</label>
            <input name="name" type="text" value="<?= old_value('name') ?>" required />
            <?php if (!empty($errors['name'])) : ?>
                <p class="error font-roboto font-size-small"><?= $errors['name'] ?></p>
            <?php endif; ?>
            <label class="font-poppins font-size-med">Website (Optional)</label>
            <input name="website" type="url" value="<?= old_value('website') ?>" />
            <?php if (!empty($errors['website'])) : ?>
                <p class="error font-roboto font-size-small"><?= $errors['website'] ?></p>
            <?php endif; ?>
            <label class="font-poppins font-size-med">Comment</label>
            <textarea name="content" required><?= old_value('content') ?></textarea>
            <?php if (!empty($errors['content'])) : ?>
                <p class="error font-roboto font-size-small"><?= $errors['content'] ?></p>
            <?php endif; ?>
            <button class="font-poppins font-size-med" type="submit">Submit Comment</button>
        </form>
    </div>

    <?php

    // Fetch Comments
    $limit = 10;
    $offset = ($PAGE['page_number'] - 1) * $limit;

    $query = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY id DESC LIMIT 10 OFFSET $offset";
    $rows = query($query, ['post_id' => $row['id']]);

    ?>

    <?php if (!empty($rows)) : ?>
        <?php foreach ($rows as $row) : ?>
            <div class="comment-head">
                <?php if (!empty($row['website'])) : ?>
                    <a href="<?= $row['website'] ?>" target="_blank">
                        <h3 class="font-poppins font-size-med"><?= esc($row['name']) ?></h3>
                    </a>
                <?php else : ?>
                    <h3 class="font-poppins font-size-med"><?= esc($row['name']) ?></h3>
                <?php endif; ?>
                <p class="date font-roboto"><?= date("jS M, Y", strtotime($row['date'])) ?></p>
            </div>
            <p class="font-roboto font-size-small"><?= esc($row['content']) ?></p>
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