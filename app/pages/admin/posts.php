<?php if ($action == 'add') : ?>
    <h2>Create Post</h2>
    <form method="post" enctype="multipart/form-data">

        <?php if (!empty($errors)) : ?>
            <p>Please fix the errors below</p>
        <?php endif; ?>

        <label>
            <p>Featured Image</p>
            <img class="image-preview-edit" src="<?= get_image('') ?? '' ?>" style="width: 100px; height: 100px; object-fit: cover;" />
            <input onchange="display_image_edit(this.files[0])" type="file" name="image" style="display: none;" />
        </label>

        <?php if (!empty($errors['image'])) : ?>
            <p><?= $errors['image'] ?></p>
        <?php endif; ?>

        <script>
            function display_image_edit(file) {
                document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
            }
        </script>

        <label>Title</label>
        <input name="title" type="text" value="<?= old_value('title') ?>" />
        <?php if (!empty($errors['title'])) : ?>
            <p><?= $errors['title'] ?></p>
        <?php endif; ?>

        <label>Content</label>
        <textarea rows="8" name="content">
            <?= old_value('content') ?>
        </textarea>
        <?php if (!empty($errors['content'])) : ?>
            <p><?= $errors['content'] ?></p>
        <?php endif; ?>

        <label>Active</label>
        <select name="disabled">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>

        <label>Category</label>
        <select id="category" name="category">
            <option value="">Select</option>
            <?php
            $query = "SELECT * FROM categories ORDER BY id DESC";
            $categories = query($query);
            ?>

            <?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $cat) : ?>
                    <option <?= old_select('category', $cat['id']) ?> value="<?= $cat['id'] ?>"><?= $cat['category'] ?></option>
                <?php endforeach; ?>
            <?php endif; ?>

        </select>
        <?php if (!empty($errors['category'])) : ?>
            <p><?= $errors['category'] ?></p>
        <?php endif; ?>

        <label>Sub-Category</label>
        <select id="sub-category" name="sub-category">
            <option value="" disabled selected>Select a Sub-Category</option>
            <?php
            $query = "SELECT * FROM sub_categories ORDER BY id DESC";
            $subcategories = query($query);
            ?>
            <?php if (!empty($subcategories)) : ?>
                <?php foreach ($subcategories as $subcategory) : ?>
                    <option <?= old_select('sub-category', $subcategory['id']) ?> data-category="<?= $subcategory['category_id'] ?>" value="<?= $subcategory['id'] ?>"><?= $subcategory['sub_category'] ?></option>
                <?php endforeach; ?>
            <?php endif; ?>

            <script>
                document.getElementById('category').addEventListener('change', function() {
                    var categoryID = this.value;
                    var subCategorySelect = document.getElementById('sub-category');

                    // Reset sub-category select box to its default state
                    subCategorySelect.selectedIndex = 0;

                    for (var i = 0; i < subCategorySelect.options.length; i++) {
                        var option = subCategorySelect.options[i];
                        // Skip the first (default) option
                        if (i === 0) continue;
                        if (option.dataset.category === categoryID) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    }
                });
            </script>


        </select>
        <?php if (!empty($errors['sub-category'])) : ?>
            <p><?= $errors['sub-category'] ?></p>
        <?php endif; ?>

        <a href="<?php echo ROOT; ?>/admin/posts">Cancel</a>
        <button type="submit">Create</button>
    </form>

<?php elseif ($action == 'edit') : ?>

    <h2>Edit Post</h2>
    <form method="post" enctype="multipart/form-data">

        <?php if (!empty($row)) : ?>
            <?php if (!empty($errors)) : ?>
                <p>Please fix the errors below</p>
            <?php endif; ?>

            <div>
                <label>
                    <img class="image-preview-edit" src="<?= get_image($row['image'] ?? '') ?>" style="width: 100px; height: 100px; object-fit: cover;" />
                    <input onchange="display_image_edit(this.files[0])" type="file" name="image" style="display: none;" />
                </label>

                <script>
                    function display_image_edit(file) {
                        document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
                    }
                </script>
            </div>

            <label>Title</label>
            <input name="title" type="text" value="<?= old_value('title', $row['title']) ?>" />
            <?php if (!empty($errors['title'])) : ?>
                <p><?= $errors['title'] ?></p>
            <?php endif; ?>

            <label>Content</label>
            <textarea rows="8" name="content">
            <?= old_value('content',$row['content']) ?>
            </textarea>
            <?php if (!empty($errors['content'])) : ?>
                <p><?= $errors['content'] ?></p>
            <?php endif; ?>

            <label>Active</label>
            <select name="disabled">
                <option <?= old_select('disabled', '0', $row['disabled']) ?> value="0">Yes</option>
                <option <?= old_select('disabled', '1', $row['disabled']) ?> value="1">No</option>
            </select>
            <?php if (!empty($errors['disabled'])) : ?>
                <p><?= $errors['disabled'] ?></p>
            <?php endif; ?>

            <label>Category</label>
        <select id="category" name="category">
            <option value="">Select</option>
            <?php
            $query = "SELECT * FROM categories ORDER BY id DESC";
            $categories = query($query);
            ?>

            <?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $cat) : ?>
                    <option <?= old_select('category', $cat['id'], $row['category_id']) ?> value="<?= $cat['id'] ?>"><?= $cat['category'] ?></option>
                <?php endforeach; ?>
            <?php endif; ?>

        </select>
        <?php if (!empty($errors['category'])) : ?>
            <p><?= $errors['category'] ?></p>
        <?php endif; ?>

        <label>Sub-Category</label>
        <select id="sub-category" name="sub-category">
            <option value="" disabled selected>Select a Sub-Category</option>
            <?php
            $query = "SELECT * FROM sub_categories ORDER BY id DESC";
            $subcategories = query($query);
            ?>
            <?php if (!empty($subcategories)) : ?>
                <?php foreach ($subcategories as $subcategory) : ?>
                    <option <?= old_select('sub-category', $subcategory['id'], $row['sub_category_id']) ?> data-category="<?= $subcategory['category_id'] ?>" value="<?= $subcategory['id'] ?>"><?= $subcategory['sub_category'] ?></option>
                <?php endforeach; ?>
            <?php endif; ?>

            <script>
                document.getElementById('category').addEventListener('change', function() {
                    var categoryID = this.value;
                    var subCategorySelect = document.getElementById('sub-category');

                    // Reset sub-category select box to its default state
                    subCategorySelect.selectedIndex = 0;

                    for (var i = 0; i < subCategorySelect.options.length; i++) {
                        var option = subCategorySelect.options[i];
                        // Skip the first (default) option
                        if (i === 0) continue;
                        if (option.dataset.category === categoryID) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    }
                });
            </script>


        </select>
        <?php if (!empty($errors['sub-category'])) : ?>
            <p><?= $errors['sub-category'] ?></p>
        <?php endif; ?>

            <a href="<?= ROOT ?>/admin/posts">Cancel</a>
            <button type="submit">Submit Changes</button>
        <?php else : ?>

            <p>Post not found.</p>

        <?php endif; ?>
    </form>

<?php elseif ($action == 'delete') : ?>

    <h2>Delete Post</h2>
    <p>Are you sure that you want to delete this Post?</p>
    <form method="post">

        <?php if (!empty($row)) : ?>
            <?php if (!empty($errors)) : ?>
                <p>Please fix the errors below</p>
            <?php endif; ?>

            <label>Title</label>
            <input name="title" type="text" value="<?= old_value('title', $row['title']) ?>" readonly />
            <?php if (!empty($errors['title'])) : ?>
                <p><?= $errors['title'] ?></p>
            <?php endif; ?>

            <label>Slug</label>
            <input name="slug" type="text" value="<?= old_value('slug', $row['slug']) ?>" readonly />
            <?php if (!empty($errors['slug'])) : ?>
                <p><?= $errors['slug'] ?></p>
            <?php endif; ?>


            <a href="<?php echo ROOT; ?>/admin/posts">Cancel</a>
            <button type="submit">DELETE</button>
        <?php else : ?>

            <p>Post not found.</p>

        <?php endif; ?>
    </form>

<?php else : ?>

    <h2>Posts</h2>
    <a href="<?php echo ROOT; ?>/admin/posts/add">Add New</a>

    <table>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Image</th>
            <th>Slug</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php

        $limit = 10;
        $offset = ($PAGE['page_number'] - 1) * $limit;

        $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 10 OFFSET $offset";

        $rows = query($query);

        ?>

        <?php if (!empty($rows)) : ?>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td>
                        <img src="<?= get_image($row['image'] ?? '') ?>" style="width: 100px; height: 100px; object-fit: cover;" />
                    </td>
                    <td><?= $row['slug'] ?></td>
                    <td><?= date("jS M, Y", strtotime($row['date'])) ?></td>
                    <td>
                        <a href="<?php echo ROOT; ?>/admin/posts/edit/<?php echo $row['id'] ?>">Edit</a>
                        <a href="<?php echo ROOT; ?>/admin/posts/delete/<?php echo $row['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <div>
        <a href="<?= $PAGE['first_link'] ?>">First Page</a>
        <a href="<?= $PAGE['prev_link'] ?>">Prev Page</a>
        <a href="<?= $PAGE['next_link'] ?>">Next Page</a>
    </div>

<?php endif; ?>