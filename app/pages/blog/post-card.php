<a href="<?=ROOT?>/post/<?=$row['category_slug']?>/<?=$row['sub_category_slug']?>/<?=$row['slug']?>">
<div>
    <img src="<?=get_image($row['image'])?>" style="width: 200px; height: 200px; object-fit: cover;" />
    <h3><?=esc($row['title'])?></h3>
    <p><?=substr($row['content'], 0, 30)?></p>
    <p><?=esc($row['category'] ?? 'Unknown') . '>' . esc($row['sub_category'] ?? 'Unknown')?></p>
    <p><?=esc(date("jS M, Y",strtotime($row['date'])))?></p>
    <p>created by</p>
</div>
</a>