<?php if($action == 'add'): ?>
    <h2>Create User</h2>
    <form method="post">

        <?php if (!empty($errors)): ?>
            <p>Please fix the errors below</p>
        <?php endif; ?>

        <label>Name</label>
        <input name="name" type="text" value="<?=old_value('name')?>" />
        <?php if(!empty($errors['name'])): ?>
            <p><?=$errors['name']?></p>
        <?php endif; ?>

        <label>Email</label>
        <input name="email" type="email" value="<?=old_value('email')?>" />
        <?php if(!empty($errors['email'])): ?>
            <p><?=$errors['email']?></p>
        <?php endif; ?>

        <label>Password</label>
        <input name="password" type="password" value="<?=old_value('password')?>" />
        <?php if(!empty($errors['password'])): ?>
            <p><?=$errors['password']?></p>
        <?php endif; ?>

        <label>Confirm Password</label>
        <input name="confirm_pwd" type="password" value="<?=old_value('confirm_pwd')?>" />
        <a href="<?php echo ROOT; ?>/admin/users">Cancel</a>
        <button type="submit">Create</button>
    </form>

<?php elseif($action == 'edit'): ?>

    <h2>Edit User</h2>
    <form method="post">

        <?php if(!empty($row)): ?>
        <?php if (!empty($errors)): ?>
            <p>Please fix the errors below</p>
        <?php endif; ?>

        <label>Name</label>
        <input name="name" type="text" value="<?=old_value('name', $row['name'])?>" />
        <?php if(!empty($errors['name'])): ?>
            <p><?=$errors['name']?></p>
        <?php endif; ?>

        <label>Email</label>
        <input name="email" type="email" value="<?=old_value('email', $row['email'])?>" />
        <?php if(!empty($errors['email'])): ?>
            <p><?=$errors['email']?></p>
        <?php endif; ?>

        <label>Password (Leave Empty to Keep Old Password)</label>
        <input name="password" type="password" value="<?=old_value('password')?>" />
        <?php if(!empty($errors['password'])): ?>
            <p><?=$errors['password']?></p>
        <?php endif; ?>

        <label>Confirm Password</label>
        <input name="confirm_pwd" type="password" value="<?=old_value('confirm_pwd')?>" />
        <a href="<?php echo ROOT; ?>/admin/users">Cancel</a>
        <button type="submit">Submit Changes</button>
        <?php else: ?>

            <p>User not found.</p>

        <?php endif; ?>
    </form>

<?php elseif($action == 'delete'): ?>

<?php else: ?>

<h2>Users</h2>
<a href="<?php echo ROOT; ?>/admin/users/add">Add New</a>

<table>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php
    
        $query = "SELECT * FROM admin ORDER BY id DESC";
        $rows = query($query);
    
    ?>

    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['id'] ?></td>
        <td><?=$row['name'] ?></td>
        <td><?=esc($row['email']) ?></td>
        <td><?=date("jS M, Y", strtotime($row['date'])) ?></td>
        <td>
            <a href="<?php echo ROOT; ?>/admin/users/edit/<?php echo $row['id'] ?>">Edit</a>
            <a href="<?php echo ROOT; ?>/admin/users/delete/<?php echo $row['id'] ?>">Delete</a>
        </td>
    </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php endif; ?>