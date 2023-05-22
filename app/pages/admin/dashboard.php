<?php

include("../app/pages/admin/analytics/analytics-functions.php");

$user = $_SESSION['USER'];

// Calculate Percent Change in views
date_default_timezone_set('America/Los_Angeles');
$today = date('Y, m, d');
$yesterday = date('Y, m, d', strtotime("-1 day"));

$viewsToday = isset($last_requests_by_day[$today]) ? $last_requests_by_day[$today] : 0;
$viewsYesterday = isset($last_requests_by_day[$yesterday]) ? $last_requests_by_day[$yesterday] : 0;

if($viewsYesterday > 0){
    $viewPercentChange = (($viewsToday - $viewsYesterday) / $viewsYesterday) * 100;
}else{
    $viewPercentChange = $viewsToday > 0 ? 100 : 0;
}

// Calculate Percent Change in Visitors
$visitorsToday = isset($last_visitors_by_day[$today]) ? array_sum($last_visitors_by_day[$today]) : 0;
$visitorsYesterday = isset($last_visitors_by_day[$yesterday]) ? array_sum($last_visitors_by_day[$yesterday]) : 0;

if($visitorsYesterday > 0){
    $visitorPercentChange = (($visitorsToday - $visitorsYesterday) / $visitorsYesterday) * 100;
}else{
    $visitorPercentChange = $visitorsToday > 0 ? 100 : 0;
}



?>

<!-- Graph JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section id="dashboard">
    <div class="header-text">
        <h1 class="font-size-header color-black-1 font-sans">Dashboard</h1>
        <p class="font-size-small font-poppins color-black-2">Hey <?= $user['name'] ?> - <span class="font-roboto">here's what's happening with your blog today.</span></p>
    </div>
    <div class="card">
        <h2 class="font-poppins light-header">TODAY'S VIEWS</h2>
        <div class="row">
        <p class="font-roboto amount"><?=array_sum($last_requests_by_daytime)?></p>
        <div class="percent">
        <p class="font-roboto <?php echo $viewPercentChange >= 0 ? "positive" : "negative"; ?>"><?=round($viewPercentChange, 2)?>%</p>
        <img src="<?=ROOT?>/assets/svg/<?php echo $viewPercentChange >= 0 ? "arrow-up.svg" : "arrow-down.svg"; ?>" />
        </div>
        </div>
    </div>
    <div class="card">
        <h2 class="font-poppins light-header">TODAY'S VISITORS</h2>
        <div class="row">
            <p class="font-roboto amount"><?=$visitorsToday?></p>
            <div class="percent">
            <p class="font-roboto <?php echo $visitorPercentChange >= 0 ? "positive" : "negative"; ?>"><?=round($visitorPercentChange, 2)?>%</p>
            <img src="<?=ROOT?>/assets/svg/<?php echo $visitorPercentChange >= 0 ? "arrow-up.svg" : "arrow-down.svg"; ?>" />
            </div>
        </div>
    </div>
    <div class="card">
        <h2 class="font-poppins light-header">UNREAD NOTIFICATIONS</h2>
        <div class="row">
        <p class="font-roboto amount">35</p>
        </div>
    </div>
    <div class="card">
        <h2 class="font-poppins light-header">UNREAD EMAILS</h2>
        <div class="row">
        <p class="font-roboto amount">13</p>
        </div>
    </div>
    <div class="card">
        <?php include("../app/pages/admin/analytics/traffic.php"); ?>
    </div>
    <div class="card">
        <?php include("../app/pages/admin/analytics/referrers.php");?>
    </div>
    <div class="card">
        <h2 class="font-sans font-size-med email-header">Emails</h2>
        <p class="font-poppins font-size-small email-header-text">Recent Emails</p>
        <div class="email-row">
            <div class="email-read">
                <p>Read</p>
            </div>
            <div class="email-subject">
                <h3>Wordpress Website</h3>
                <p class="mobile-hidden">question about how too...</p>
            </div>
            <div class="email-date mobile-hidden">
                <p>Jan 17, 2022</p>
                <p>Sent from form</p>
            </div>
            <div class="reply-email">
                <p>john@john.com</p>
            </div>
            <div class="email-btn">
                <img src="<?=ROOT?>/assets/svg/three-dots.svg" />
            </div>
        </div>
        <div class="email-row">
            <div class="email-read">
                <p>Read</p>
            </div>
            <div class="email-subject">
                <h3>Wordpress Website</h3>
                <p class="mobile-hidden">question about how too...</p>
            </div>
            <div class="email-date mobile-hidden">
                <p>Jan 17, 2022</p>
                <p>Sent from form</p>
            </div>
            <div class="reply-email">
                <p>john@john.com</p>
            </div>
            <div class="email-btn">
                <img src="<?=ROOT?>/assets/svg/three-dots.svg" />
            </div>
        </div>
        <div class="email-row">
            <div class="email-read">
                <p>Read</p>
            </div>
            <div class="email-subject">
                <h3>Wordpress Website</h3>
                <p class="mobile-hidden">question about how too...</p>
            </div>
            <div class="email-date mobile-hidden">
                <p>Jan 17, 2022</p>
                <p>Sent from form</p>
            </div>
            <div class="reply-email">
                <p>john@john.com</p>
            </div>
            <div class="email-btn">
                <img src="<?=ROOT?>/assets/svg/three-dots.svg" />
            </div>
        </div>
    </div>
</section>
