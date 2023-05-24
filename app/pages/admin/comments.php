<?php if($action == 'mark-all') : ?>
<section id="mark-all-comments">
    <h1 class="font-sans font-size-header">Mark All Comments As Read</h1>
    <p class="font-poppins font-size-med">Are you sure that you would like to mark all comments as read?</p>
    <form method="post">
        <div class="btns">
        <a href="<?php echo ROOT; ?>/admin/comments">Cancel</a>
        <button class="delete" type="submit">YES</button>
        </div>
    </form>
</section>

<?php elseif($action == 'read') : ?>

    <?php

        $query = "SELECT comments.*, 
                categories.slug as category_slug, 
                sub_categories.slug as sub_category_slug, 
                posts.slug as post_slug
                FROM comments
                JOIN posts ON comments.post_id = posts.id
                JOIN categories ON posts.category_id = categories.id
                JOIN sub_categories ON posts.sub_category_id = sub_categories.id
                WHERE comments.id = :id
                LIMIT 1";
        
        $row = query_row($query, ['id' => $id]);
        
    ?>

<section id="view-comment">
    <?php if(!empty($row)) : ?>
    <h1 class="font-sans font-size-header">Comment By, <?=esc($row['name'])?></h1>
    <div class="content-head">
        <h2 class="font-poppins font-size-med"><?=esc($row['name'])?></h2>
        <p class="font-poppins font-size-med"><?= date("jS M, Y", strtotime($row['date'])) ?></p>
    </div>
    <a href="<?=$row['website']?>"><p class="font-roboto font-size-small"><?=esc($row['website'])?></p></a>
    <div class="content">
        <p class="font-roboto font-size-small"><?=esc($row['content'])?></p>
    </div>
    <div class="btns">
        <a class="font-roboto font-size-small" href="<?=ROOT?>/admin/comments">Back</a>
        <form method="post"><button class="font-roboto font-size-small" type="submit">Delete</button></form>
        <a class="font-roboto font-size-small" href="<?=ROOT?>/post/<?=$row['category_slug']?>/<?=$row['sub_category_slug']?>/<?=$row['post_slug']?>#comments">View Post Comments</a>
    </div>
    <?php else : ?>
        <p>This comment does not exist.</p>
    <?php endif; ?>
</section>

<?php else : ?>
    <section id="comments">
        <div class="row">
            <h1 class="font-sans font-size-header">Comments</h1>
            <a class="font-roboto" href="<?php echo ROOT; ?>/admin/comments/mark-all">Mark All Read</a>
        </div>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th>#</th>
                    <th>Read</th>
                    <th>Name</th>
                    <th>Website</th>
                    <th>Post Slug</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php

                $limit = 10;
                $offset = ($PAGE['page_number'] - 1) * $limit;

                $query = "SELECT comments.*,  
                posts.slug as post_slug
                FROM comments
                JOIN posts ON comments.post_id = posts.id
                ORDER BY comments.id DESC
                LIMIT 10
                OFFSET $offset";


                $rows = query($query);

                ?>

                <?php if (!empty($rows)) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['seen'] == 1 ? "<p class='green'>Read</p>" : "<p class='red'>Unread</p>"; ?></td>
                            <td><?= esc($row['name']) ?></td>
                            <td><a href="<?=$row['website']?>" target="_blank"><?= esc($row['website']) ?></a></td>
                            <td><?=$row['post_slug']?></td>
                            <td><?= date("jS M, Y", strtotime($row['date'])) ?></td>
                            <td>
                                <a class="view" href="<?=ROOT?>/admin/comments/read/<?=$row['id']?>">View</a>
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