<?php

include("../app/pages/admin/analytics/analytics-functions.php");

?>

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
</section>

<!-- Graph JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>