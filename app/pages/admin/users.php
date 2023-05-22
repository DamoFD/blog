<?php if ($action == 'add') : ?>
    <section id="add-user">
        <h1 class="font-sans font-size-header">Create User</h1>
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

            <label>Name</label>
            <input name="name" type="text" value="<?= old_value('name') ?>" />
            <?php if (!empty($errors['name'])) : ?>
                <p><?= $errors['name'] ?></p>
            <?php endif; ?>

            <label>Email</label>
            <input name="email" type="email" value="<?= old_value('email') ?>" />
            <?php if (!empty($errors['email'])) : ?>
                <p><?= $errors['email'] ?></p>
            <?php endif; ?>

            <label>Password</label>
            <input name="password" type="password" value="<?= old_value('password') ?>" />
            <?php if (!empty($errors['password'])) : ?>
                <p><?= $errors['password'] ?></p>
            <?php endif; ?>

            <label>Confirm Password</label>
            <input name="confirm_pwd" type="password" value="<?= old_value('confirm_pwd') ?>" />
            <div class="btns">
                <a href="<?php echo ROOT; ?>/admin/users">Cancel</a>
                <button type="submit">Create</button>
            </div>
        </form>
    </section>

<?php elseif ($action == 'edit') : ?>

    <section id="edit-user">
        <h1 class="font-sans font-size-header">Edit User</h1>
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

                <label>Name</label>
                <input name="name" type="text" value="<?= old_value('name', $row['name']) ?>" />
                <?php if (!empty($errors['name'])) : ?>
                    <p><?= $errors['name'] ?></p>
                <?php endif; ?>

                <label>Email</label>
                <input name="email" type="email" value="<?= old_value('email', $row['email']) ?>" />
                <?php if (!empty($errors['email'])) : ?>
                    <p><?= $errors['email'] ?></p>
                <?php endif; ?>

                <label>Password (Leave Empty to Keep Old Password)</label>
                <input name="password" type="password" value="<?= old_value('password') ?>" />
                <?php if (!empty($errors['password'])) : ?>
                    <p><?= $errors['password'] ?></p>
                <?php endif; ?>

                <label>Confirm Password</label>
                <input name="confirm_pwd" type="password" value="<?= old_value('confirm_pwd') ?>" />

                <div class="btns">
                    <a href="<?php echo ROOT; ?>/admin/users">Cancel</a>
                    <button type="submit">Submit Changes</button>
                </div>
            <?php else : ?>

                <p>User not found.</p>

            <?php endif; ?>
        </form>
    </section>

<?php elseif ($action == 'delete') : ?>

    <section id="delete-user">
        <h1 class="font-sans font-size-header">Delete User</h1>
        <p class="font-roboto font-size-med warning">Are you sure that you want to delete this user?</p>
        <form method="post">

            <?php if (!empty($row)) : ?>
                <?php if (!empty($errors)) : ?>
                    <p>Please fix the errors below</p>
                <?php endif; ?>

                <label>Name</label>
                <input name="name" type="text" value="<?= old_value('name', $row['name']) ?>" readonly />
                <?php if (!empty($errors['name'])) : ?>
                    <p><?= $errors['name'] ?></p>
                <?php endif; ?>

                <label>Email</label>
                <input name="email" type="email" value="<?= old_value('email', $row['email']) ?>" readonly />
                <?php if (!empty($errors['email'])) : ?>
                    <p><?= $errors['email'] ?></p>
                <?php endif; ?>

                <div class="btns">
                    <a href="<?php echo ROOT; ?>/admin/users">Cancel</a>
                    <button class="delete" type="submit">DELETE</button>
                </div>
            <?php else : ?>

                <p>User not found.</p>

            <?php endif; ?>
        </form>
    </section>

<?php else : ?>

    <section id="users">
        <div class="row">
            <h1 class="font-sans font-size-header">Users</h1>
            <a class="font-roboto" href="<?php echo ROOT; ?>/admin/users/add">Add New</a>
        </div>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php

                $limit = 10;
                $offset = ($PAGE['page_number'] - 1) * $limit;

                $query = "SELECT * FROM admin ORDER BY id DESC LIMIT 10 OFFSET $offset";
                $rows = query($query);

                ?>

                <?php if (!empty($rows)) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= esc($row['email']) ?></td>
                            <td>
                                <img src="<?= get_image($row['image'] ?? '') ?>" style="width: 100px; height: 100px; object-fit: cover;" />
                            </td>
                            <td><?= date("jS M, Y", strtotime($row['date'])) ?></td>
                            <td>
                                <a class="edit" href="<?php echo ROOT; ?>/admin/users/edit/<?php echo $row['id'] ?>">Edit</a>
                                <a class="delete" href="<?php echo ROOT; ?>/admin/users/delete/<?php echo $row['id'] ?>">Delete</a>
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