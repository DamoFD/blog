<section id="average-user">
<h2 class="font-size-med font-poppins">Average Visitor</h2>
<div class="content-container">
    <div class="row">
        <p class="font-size-small font-roboto">Views</p>
        <p class="font-size-small font-roboto amount"><?php echo "".round(($total_requests/$total_visitors), 2).""; ?></p>
    </div>
    <div class="row">
        <p class="font-size-small font-roboto">Country</p>
        <p class="font-size-small font-roboto amount"><?php echo "".array_keys($top_countriesvo)[0].""; ?></p>
    </div>
    <div class="row">
        <p class="font-size-small font-roboto">Language</p>
        <p class="font-size-small font-roboto amount"><?php echo "".array_keys($top_languages)[0].""; ?></p>
    </div>
    <div class="row">
        <p class="font-size-small font-roboto">Browser</p>
        <p class="font-size-small font-roboto amount"><?php echo "".array_keys($top_browsers)[0].""; ?></p>
    </div>
    <div class="row">
        <p class="font-size-small font-roboto">OS</p>
        <p class="font-size-small font-roboto amount"><?php echo "".array_keys($top_oss)[0].""; ?></p>
    </div>
    <div class="row">
        <p class="font-size-small font-roboto">ISP</p>
        <p class="font-size-small font-roboto amount"><?php echo "".array_keys($top_isps)[0].""; ?></p>
    </div>
</div>
</section>