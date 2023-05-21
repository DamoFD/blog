<h3>Average Visitor</h3>
<div>
    <div>
        <p>Requests</p>
        <p><?php echo "".round(($total_requests/$total_visitors), 2).""; ?></p>
    </div>
    <div>
        <p>Country</p>
        <p><?php echo "".array_keys($top_countriesvo)[0].""; ?></p>
    </div>
    <div>
        <p>Language</p>
        <p><?php echo "".array_keys($top_languages)[0].""; ?></p>
    </div>
    <div>
        <p>Browser</p>
        <p><?php echo "".array_keys($top_browsers)[0].""; ?></p>
    </div>
    <div>
        <p>OS</p>
        <p><?php echo "".array_keys($top_oss)[0].""; ?></p>
    </div>
    <div>
        <p>ISP</p>
        <p><?php echo "".array_keys($top_isps)[0].""; ?></p>
    </div>
</div>