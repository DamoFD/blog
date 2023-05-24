<div>
    <h1>Categories</h1>
    <nav>
        <ul>
            <li>
                <a href="<?=ROOT?>">Home</a> >
            </li>
            <li>
                <a href="<?=ROOT?>/blog">Blog</a> >
            </li>
            <li>
                <p>Categories</p>
            </li>
        </ul>
    </nav>
    <?php foreach($rows as $row) : ?>
        <a href="<?=ROOT?>/category/<?=$row['slug']?>">
            <img src="<?=get_image($row['image'])?>" />
            <h2><?=$row['category']?></h2>
        </a>
    <?php endforeach; ?>
</div>