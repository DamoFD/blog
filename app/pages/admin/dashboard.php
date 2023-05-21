<?php

include("../app/pages/admin/analytics/analytics-functions.php");

$user = $_SESSION['USER'];

?>

<section id="dashboard">
    <div class="header-text">
        <h1 class="font-size-header color-black-1 font-sans">Dashboard</h1>
        <p class="font-size-small font-poppins color-black-2">Hey <?= $user['name'] ?> - <span class="font-roboto">here's what's happening with your blog today.</span></p>
    </div>
    <div>
        <?php include("../app/pages/admin/analytics/all-time-stats.php"); ?>
    </div>
</section>
