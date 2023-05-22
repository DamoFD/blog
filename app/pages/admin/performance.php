<?php

include("../app/pages/admin/analytics/analytics-functions.php");

?>

<!-- Graph JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section id="performance">
    <h1 class="font-size-header font-sans">Performance</h1>
    <div class="graph-card">
        <?php include("../app/pages/admin/analytics/all-time-stats.php"); ?>
    </div>
    <div class="graph-card">
        <?php include("../app/pages/admin/analytics/average-user.php"); ?>
    </div>
    <div class="graph-card">
        <?php include("../app/pages/admin/analytics/traffic.php"); ?>
    </div>
    <div class="graph-card">
        <?php include("../app/pages/admin/analytics/realtime.php"); ?>
    </div>
    <div class="graph-card">
        <?php include("../app/pages/admin/analytics/referrers.php"); ?>
    </div>
    <div class="graph-card">
        <?php include("../app/pages/admin/analytics/languages.php"); ?>
    </div>
    <div class="graph-card">
        <?php include("../app/pages/admin/analytics/browsers.php"); ?>
    </div>
    <div class="graph-card">
        <?php include("../app/pages/admin/analytics/os.php"); ?>
    </div>
    <div class="graph-card">
        <?php include("../app/pages/admin/analytics/pages.php"); ?>
    </div>
</section>