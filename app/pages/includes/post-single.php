<div>
    <img src="<?=get_image($row['image'])?>" style="width: 200px; height: 200px; object-fit: cover;" />
    <h3><?=esc($row['title'])?></h3>
    <p><?=add_root_to_images($row['content'])?></p>
    <p><?=esc($row['category'] ?? 'Unknown') . '>' . esc($row['sub_category'] ?? 'Unknown')?></p>
    <p><?=esc(date("jS M, Y",strtotime($row['date'])))?></p>
    <p>created by</p>
</div>