<?php if($sub_action == 'add'): ?>
    <h2>Create Sub-Category</h2>

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

        <label>Sub-Category</label>
        <input name="sub-category" type="text" value="<?=old_value('sub-category')?>" />
        <?php if(!empty($errors['sub-category'])): ?>
            <p><?=$errors['sub-category']?></p>
        <?php endif; ?>

        <label>Active</label>
        <select name="disabled">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>

        <a href="<?php echo ROOT; ?>/admin/categories/sub-categories/<?=$id?>">Cancel</a>
        <button type="submit">Create</button>
    </form>

<?php elseif($sub_action == 'edit'): ?>

    <h2>Edit Sub-Category</h2>
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

        <label>Sub-Category</label>
        <input name="sub-category" type="text" value="<?=old_value('sub-category', $row['sub_category'])?>" />
        <?php if(!empty($errors['sub-category'])): ?>
            <p><?=$errors['sub-category']?></p>
        <?php endif; ?>

        <label>Active</label>
        <select name="disabled">
            <option <?=old_select('disabled', '0', $row['disabled'])?> value="0">Yes</option>
            <option <?=old_select('disabled', '1', $row['disabled'])?> value="1">No</option>
        </select>
        <?php if(!empty($errors['disabled'])): ?>
            <p><?=$errors['disabled']?></p>
        <?php endif; ?>

        <a href="<?=ROOT?>/admin/categories/sub-categories/<?=$id?>">Cancel</a>
        <button type="submit">Submit Changes</button>
        <?php else: ?>

            <p>Sub-Category not found.</p>

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
    <?php
        $limit = 10;
        $offset = ($PAGE['page_number'] - 1) * $limit;

        $query = "SELECT sub_categories.*, 
          (SELECT COUNT(*) FROM posts WHERE posts.sub_category_id = sub_categories.id) as post_count
          FROM sub_categories 
          WHERE category_id = $id
          ORDER BY id DESC 
          LIMIT 10 
          OFFSET $offset";

        $rows = query($query);
        
        $query = "SELECT category FROM categories WHERE id= :id LIMIT 1";

        $category_row = query_row($query, ['id' => $id]);
    
    ?>

    <h2>Sub-Categories For <?=$category_row['category']?></h2>
<a href="<?php echo ROOT; ?>/admin/categories/sub-categories/<?=$id?>/add">Add New</a>

<table>
    <tr>
        <th>#</th>
        <th>Sub-Category</th>
        <th>Image</th>
        <th>Slug</th>
        <th>Posts</th>
        <th>Active</th>
        <th>Action</th>
    </tr>

    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['id'] ?></td>
        <td><?=$row['sub_category'] ?></td>
        <td>
            <img src="<?=get_image($row['image'] ?? '')?>" style="width: 100px; height: 100px; object-fit: cover;" />
        </td>
        <td><?=$row['slug']?></td>
        <td><?=$row['post_count']?></td>
        <td><?=$row['disabled'] == 0 ? 'True': 'False'?></td>
        <td>
            <a href="<?php echo ROOT; ?>/admin/categories/sub-categories/<?php echo $id . "/edit" . "/" . $row['id'] ?>">Edit</a>
            <a href="<?php echo ROOT; ?>/admin/categories/sub-categories/<?php echo $id . "delete" . $row['id'] ?>">Delete</a>
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