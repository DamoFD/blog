<?php

include("../app/pages/admin/analytics/analytics.php");

$user = $_SESSION['USER'];

?>

<section id="dashboard">
    <?=$total_visitors?>
    <div class="header-text">
        <h1 class="font-size-header color-black-1 font-sans">Dashboard</h1>
        <p class="font-size-small font-poppins color-black-2">Hey <?= $user['name'] ?> - <span class="font-roboto">here's what's happening with your blog today.</span></p>
    </div>
    <button
                id="sign-in-btn"
                type="button"
                class="btn btn-primary btn-rounded"
                style="display: none"
                onclick="signIn()"
              >
                Login
              </button>
              <button
                type="button"
                class="btn btn-primary btn-rounded"
                style="display: none"
                onclick="loadData()"
              >
                Load Data
              </button>
              <p id="displaUsers"></p>
              <p id="displayPageViews"></p>
              <p id="displaySessions"></p>
</section>
