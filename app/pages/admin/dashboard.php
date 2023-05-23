<?php

include("../app/pages/admin/analytics/analytics-functions.php");

$user = $_SESSION['USER'];

// Calculate Percent Change in views
date_default_timezone_set('America/Los_Angeles');
$today = date('Y, m, d');
$yesterday = date('Y, m, d', strtotime("-1 day"));

$viewsToday = isset($last_requests_by_day[$today]) ? $last_requests_by_day[$today] : 0;
$viewsYesterday = isset($last_requests_by_day[$yesterday]) ? $last_requests_by_day[$yesterday] : 0;

if ($viewsYesterday > 0) {
    $viewPercentChange = (($viewsToday - $viewsYesterday) / $viewsYesterday) * 100;
} else {
    $viewPercentChange = $viewsToday > 0 ? 100 : 0;
}

// Calculate Percent Change in Visitors
$visitorsToday = isset($last_visitors_by_day[$today]) ? array_sum($last_visitors_by_day[$today]) : 0;
$visitorsYesterday = isset($last_visitors_by_day[$yesterday]) ? array_sum($last_visitors_by_day[$yesterday]) : 0;

if ($visitorsYesterday > 0) {
    $visitorPercentChange = (($visitorsToday - $visitorsYesterday) / $visitorsYesterday) * 100;
} else {
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
    <div class="grid">
        <div class="card">
            <h2 class="font-poppins light-header">TODAY'S VIEWS</h2>
            <div class="row">
                <p class="font-roboto amount"><?= array_sum($last_requests_by_daytime) ?></p>
                <div class="percent">
                    <p class="font-roboto <?php echo $viewPercentChange >= 0 ? "positive" : "negative"; ?>"><?= round($viewPercentChange, 2) ?>%</p>
                    <img src="<?= ROOT ?>/assets/svg/<?php echo $viewPercentChange >= 0 ? "arrow-up.svg" : "arrow-down.svg"; ?>" />
                </div>
            </div>
        </div>
        <div class="card">
            <h2 class="font-poppins light-header">TODAY'S VISITORS</h2>
            <div class="row">
                <p class="font-roboto amount"><?= $visitorsToday ?></p>
                <div class="percent">
                    <p class="font-roboto <?php echo $visitorPercentChange >= 0 ? "positive" : "negative"; ?>"><?= round($visitorPercentChange, 2) ?>%</p>
                    <img src="<?= ROOT ?>/assets/svg/<?php echo $visitorPercentChange >= 0 ? "arrow-up.svg" : "arrow-down.svg"; ?>" />
                </div>
            </div>
        </div>
        <div class="card">
            <h2 class="font-poppins light-header">UNREAD NOTIFICATIONS</h2>
            <div class="row">
                <p class="font-roboto amount"><?=$unread['emails'] + $unread['comments']?></p>
            </div>
        </div>
        <div class="card">
            <h2 class="font-poppins light-header">UNREAD EMAILS</h2>
            <div class="row">
                <p class="font-roboto amount"><?=$unread['emails']?></p>
            </div>
        </div>
        <div class="card">
            <?php include("../app/pages/admin/analytics/traffic.php"); ?>
        </div>
        <div class="card">
            <?php include("../app/pages/admin/analytics/referrers.php"); ?>
        </div>
        <div class="card email-container">
            <div class="email-head">
                <div class="email-text-container">
                    <h2 class="font-sans font-size-med email-header">Emails</h2>
                    <p class="font-poppins email-header-text">Recent Emails</p>
                </div>
                <a class="font-roboto" href="<?= ROOT ?>/admin/emails">See all Emails <img src="<?= ROOT ?>/assets/svg/arrow-right.svg" /></a>
            </div>

            <?php
            
                // Retrieve Emails from database
                $query = "SELECT * FROM emails ORDER BY id DESC LIMIT 10";

                $emails = query($query);

            ?>

                <?php if (!empty($emails)) : ?>
                    <?php foreach ($emails as $email) : ?>
            <div class="email-row">
                <div class="email-read <?=$email['seen'] == 1 ? "read" : "unread";?>">
                    <img src="<?php echo $email['seen'] == 1 ? ROOT . "/assets/svg/green-dot.svg" : ROOT . "/assets/svg/red-dot.svg"; ?>" />
                    <p class="font-roboto"><?=$email['seen'] == 1 ? "Read" : "Unread"; ?></p>
                </div>
                <div class="email-subject">
                    <h3 class="font-poppins"><?= esc(substr($email['content'], 0, 20)) . esc((strlen($email['content'])) > 20 ? "..." : "") ?></h3>
                </div>
                <div class="reply-email">
                    <p class="font-roboto"><?=esc($email['email'])?></p>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="card">
            <h2 class="font-sans comment-header">Recent Comments</h2>
            <p class="font-poppins comment-header-text">Here are your latest comments</p>
            <div>
                <?php
                
                        // Fetch comments
                        $query = "SELECT comments.*,
                        (SELECT title FROM posts WHERE comments.post_id = posts.id) as post_title
                        FROM comments
                        ORDER BY id DESC
                        LIMIT 5";

                        $comments = query($query);
                
                ?>

                <?php if(!empty($comments)) : ?>
                    <?php foreach($comments as $comment) : ?>
                <div class="comment-row">
                    <div>
                        <h3 class="font-poppins comment-text-dark"><?=esc($comment['name'])?></h3>
                        <p class="font-roboto comment-text-light"><?= esc(substr($comment['content'], 0, 20)) . esc((strlen($comment['content'])) > 20 ? "..." : "") ?></p>
                    </div>
                    <div class="message-info">
                        <p class="font-poppins comment-text-dark"><?=esc($comment['post_title'])?></p>
                        <p class="font-roboto comment-text-light"><?=$comment['date']?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
                <a class="font-roboto comments-link" href="<?=ROOT?>/admin/comments">SEE ALL COMMENTS<img src="<?= ROOT ?>/assets/svg/arrow-right.svg" /></a>
            </div>
        </div>
    </div>
</section>