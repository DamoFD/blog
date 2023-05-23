<?php if ($section == 'mark-all') : ?>


<?php else : ?>
    <section id="emails">
        <div class="row">
            <h1 class="font-sans font-size-header">Emails</h1>
            <a class="font-roboto" href="<?php echo ROOT; ?>/admin/emails/mark-all">Mark All Read</a>
        </div>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th>#</th>
                    <th>Read</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
                <?php

                $limit = 10;
                $offset = ($PAGE['page_number'] - 1) * $limit;

                $query = "SELECT * FROM emails ORDER BY id DESC LIMIT 10 OFFSET $offset";
                $rows = query($query);

                ?>

                <?php if (!empty($rows)) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['seen'] == 1 ? "<p class='green'>Read</p>" : "<p class='red'>Unread</p>"; ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= esc($row['email']) ?></td>
                            <td><?= date("jS M, Y", strtotime($row['date'])) ?></td>
                            <td>
                                <a class="view" href="<?php echo ROOT; ?>/admin/emails/view/<?php echo $row['id'] ?>">View</a>
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