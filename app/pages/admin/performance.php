<?php

include("../app/pages/admin/analytics/analytics-functions.php");

?>

<!-- Graph JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section id="performance">
    <h1>Performance</h1>
    <div>
        <?php include("../app/pages/admin/analytics/all-time-stats.php"); ?>
    </div>
    <div>
        <?php include("../app/pages/admin/analytics/average-user.php"); ?>
    </div>
    <div>
        <?php include("../app/pages/admin/analytics/traffic.php"); ?>
    </div>
    <div>
        <?php include("../app/pages/admin/analytics/realtime.php"); ?>
    </div>
</section>