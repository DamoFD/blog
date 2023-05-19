<h2>Users</h2>
<button>Add New</button>

<table>
    <tr>
        <th>#</th>
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
        <td><?=esc($row['email']) ?></td>
        <td><? if(!empty($row['date'])) echo date("jS M, Y", strtotime($row['date'])) ?></td>
        <td><button>Edit</button><button>Trash</button></td>
    </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>