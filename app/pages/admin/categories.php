<?php if ($action == 'add') : ?>
    <section id="add-category">
        <h1 class="font-sans font-size-header">Create Category</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (!empty($errors)) : ?>
                <p>Please fix the errors below</p>
            <?php endif; ?>

            <label class="img">
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

            <label>Category</label>
            <input name="category" type="text" value="<?= old_value('category') ?>" />
            <?php if (!empty($errors['category'])) : ?>
                <p><?= $errors['category'] ?></p>
            <?php endif; ?>

            <label>Active</label>
            <select name="disabled">
                <option value="0">Yes</option>
                <option value="1">No</option>
            </select>

            <div class="btns">
                <a href="<?php echo ROOT; ?>/admin/categories">Cancel</a>
                <button type="submit">Create</button>
            </div>
        </form>
    </section>

<?php elseif ($action == 'edit') : ?>

    <section id="edit-category">
        <h1 class="font-sans font-size-header">Edit Category</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (!empty($row)) : ?>
                <?php if (!empty($errors)) : ?>
                    <p>Please fix the errors below</p>
                <?php endif; ?>

                <label class="img">
                    <img class="image-preview-edit" src="<?= get_image($row['image'] ?? '') ?>" style="width: 100px; height: 100px; object-fit: cover;" />
                    <input onchange="display_image_edit(this.files[0])" type="file" name="image" style="display: none;" />
                </label>

                <script>
                    function display_image_edit(file) {
                        document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
                    }
                </script>

                <label>Category</label>
                <input name="category" type="text" value="<?= old_value('category', $row['category']) ?>" />
                <?php if (!empty($errors['category'])) : ?>
                    <p><?= $errors['category'] ?></p>
                <?php endif; ?>

                <label>Active</label>
                <select name="disabled">
                    <option <?= old_select('disabled', '0', $row['disabled']) ?> value="0">Yes</option>
                    <option <?= old_select('disabled', '1', $row['disabled']) ?> value="1">No</option>
                </select>
                <?php if (!empty($errors['disabled'])) : ?>
                    <p><?= $errors['disabled'] ?></p>
                <?php endif; ?>

                <div class="btns">
                    <a href="<?= ROOT ?>/admin/categories">Cancel</a>
                    <button type="submit">Submit Changes</button>
                </div>
            <?php else : ?>

                <p>Category not found.</p>

            <?php endif; ?>
        </form>
    </section>

<?php elseif ($action == 'delete') : ?>

    <section id="delete-category">
        <h1 class="font-sans font-size-header">Delete Category</h1>
        <p class="font-roboto font-size-med warning">Are you sure that you want to delete this category?</p>
        <form method="post">

            <?php if (!empty($row)) : ?>
                <?php if (!empty($errors)) : ?>
                    <p>Please fix the errors below</p>
                <?php endif; ?>

                <label>Category</label>
                <input name="category" type="text" value="<?= old_value('category', $row['category']) ?>" readonly />
                <?php if (!empty($errors['category'])) : ?>
                    <p><?= $errors['category'] ?></p>
                <?php endif; ?>

                <label>Slug</label>
                <input name="slug" type="text" value="<?= old_value('slug', $row['slug']) ?>" readonly />
                <?php if (!empty($errors['slug'])) : ?>
                    <p><?= $errors['slug'] ?></p>
                <?php endif; ?>

                <div class="btns">
                    <a href="<?php echo ROOT; ?>/admin/categories">Cancel</a>
                    <button class="delete" type="submit">DELETE</button>
                </div>
            <?php else : ?>

                <p>Category not found.</p>

            <?php endif; ?>
        </form>
    </section>
<?php elseif ($action == 'sub-categories') : ?>

    <?php require_once('sub-categories.php'); ?>

<?php else : ?>

    <section id="categories">
        <div class="row">
            <h1 class="font-sans font-size-header">Categories</h1>
            <a class="font-roboto" href="<?php echo ROOT; ?>/admin/categories/add">Add New</a>
        </div>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Slug</th>
                    <th>Sub-Categories</th>
                    <th>Posts</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php

                $limit = 10;
                $offset = ($PAGE['page_number'] - 1) * $limit;

                $query = "SELECT categories.*, 
          (SELECT COUNT(*) FROM sub_categories WHERE sub_categories.category_id = categories.id) as sub_category_count, 
          (SELECT COUNT(*) FROM posts WHERE posts.category_id = categories.id) as post_count
          FROM categories 
          ORDER BY id DESC 
          LIMIT 10 
          OFFSET $offset";

                $rows = query($query);

                ?>

                <?php if (!empty($rows)) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['category'] ?></td>
                            <td>
                                <img src="<?= get_image($row['image'] ?? '') ?>" style="width: 100px; height: 100px; object-fit: cover;" />
                            </td>
                            <td><?= $row['slug'] ?></td>
                            <td><a href="<?php echo ROOT; ?>/admin/categories/sub-categories/<?php echo $row['id'] ?>"><?= $row['sub_category_count'] ?></a></td>
                            <td><?= $row['post_count'] ?></td>
                            <td><?= $row['disabled'] == 0 ? 'True' : 'False' ?></td>
                            <td>
                                <a class="edit" href="<?php echo ROOT; ?>/admin/categories/edit/<?php echo $row['id'] ?>">Edit</a>
                                <a class="delete" href="<?php echo ROOT; ?>/admin/categories/delete/<?php echo $row['id'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
        <div>
            <a href="<?= $PAGE['first_link'] ?>">First Page</a>
            <a href="<?= $PAGE['prev_link'] ?>">Prev Page</a>
            <a href="<?= $PAGE['next_link'] ?>">Next Page</a>
        </div>
    </section>

<?php endif; ?>