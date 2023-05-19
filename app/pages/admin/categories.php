<?php if($action == 'add'): ?>
    <h2>Create Category</h2>
    <form method="post" enctype="multipart/form-data">

        <?php if (!empty($errors)): ?>
            <p>Please fix the errors below</p>
        <?php endif; ?>

        <label>
            <img class="image-preview-edit" src="<?=get_image('') ?? ''?>" style="width: 100px; height: 100px; object-fit: cover;" />
            <input onchange="display_image_edit(this.files[0])" type="file" name="image" style="display: none;" />
        </label>

        <?php if(!empty($errors['image'])): ?>
            <p><?=$errors['image']?></p>
        <?php endif; ?>

        <script>
            function display_image_edit(file) {
                document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
            }
        </script>

        <label>Category</label>
        <input name="category" type="text" value="<?=old_value('category')?>" />
        <?php if(!empty($errors['category'])): ?>
            <p><?=$errors['category']?></p>
        <?php endif; ?>

        <label>Active</label>
        <select name="disabled">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>

        <a href="<?php echo ROOT; ?>/admin/categories">Cancel</a>
        <button type="submit">Create</button>
    </form>

<?php elseif($action == 'edit'): ?>

    <h2>Edit Category</h2>
    <form method="post" enctype="multipart/form-data">

        <?php if(!empty($row)): ?>
        <?php if (!empty($errors)): ?>
            <p>Please fix the errors below</p>
        <?php endif; ?>

        <div>
            <label>
                <img class="image-preview-edit" src="<?=get_image($row['image'] ?? '')?>" style="width: 100px; height: 100px; object-fit: cover;" />
                <input onchange="display_image_edit(this.files[0])" type="file" name="image" style="display: none;" />
            </label>

            <script>

                function display_image_edit(file) {
                    document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
                }

            </script>
        </div>

        <label>Category</label>
        <input name="category" type="text" value="<?=old_value('category', $row['category'])?>" />
        <?php if(!empty($errors['category'])): ?>
            <p><?=$errors['category']?></p>
        <?php endif; ?>

        <label>Active</label>
        <select name="disabled">
            <option <?=old_select('disabled', '0', $row['disabled'])?> value="0">Yes</option>
            <option <?=old_select('disabled', '1', $row['disabled'])?> value="1">No</option>
        </select>
        <?php if(!empty($errors['disabled'])): ?>
            <p><?=$errors['disabled']?></p>
        <?php endif; ?>

        <a href="<?=ROOT?>/admin/categories">Cancel</a>
        <button type="submit">Submit Changes</button>
        <?php else: ?>

            <p>Category not found.</p>

        <?php endif; ?>
    </form>

<?php elseif($action == 'delete'): ?>

    <h2>Delete Category</h2>
    <p>Are you sure that you want to delete this category?</p>
    <form method="post">

        <?php if(!empty($row)): ?>
        <?php if (!empty($errors)): ?>
            <p>Please fix the errors below</p>
        <?php endif; ?>

        <label>Category</label>
        <input name="category" type="text" value="<?=old_value('category', $row['category'])?>" readonly />
        <?php if(!empty($errors['category'])): ?>
            <p><?=$errors['category']?></p>
        <?php endif; ?>

        <label>Slug</label>
        <input name="slug" type="text" value="<?=old_value('slug', $row['slug'])?>" readonly />
        <?php if(!empty($errors['slug'])): ?>
            <p><?=$errors['slug']?></p>
        <?php endif; ?>

        
        <a href="<?php echo ROOT; ?>/admin/categories">Cancel</a>
        <button type="submit">DELETE</button>
        <?php else: ?>

            <p>Category not found.</p>

        <?php endif; ?>
    </form>

<?php else: ?>

<h2>Categories</h2>
<a href="<?php echo ROOT; ?>/admin/categories/add">Add New</a>

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

    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['id'] ?></td>
        <td><?=$row['category'] ?></td>
        <td>
            <img src="<?=get_image($row['image'] ?? '')?>" style="width: 100px; height: 100px; object-fit: cover;" />
        </td>
        <td><?=$row['slug']?></td>
        <td><?=$row['sub_category_count']?></td>
        <td><?=$row['post_count']?></td>
        <td><?=$row['disabled'] == 0 ? 'True': 'False'?></td>
        <td>
            <a href="<?php echo ROOT; ?>/admin/categories/edit/<?php echo $row['id'] ?>">Edit</a>
            <a href="<?php echo ROOT; ?>/admin/categories/delete/<?php echo $row['id'] ?>">Delete</a>
        </td>
    </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
<div>
    <a href="<?=$PAGE['first_link']?>">First Page</a>
    <a href="<?=$PAGE['prev_link']?>">Prev Page</a>
    <a href="<?=$PAGE['next_link']?>">Next Page</a>
</div>

<?php endif; ?>