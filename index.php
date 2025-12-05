<?php
    require_once 'include/config.php';
    include 'include/head.php';
    include 'include/header.php';

    include 'include/queries/case_counts.php';

?>

<div class="layout d-flex">
    <?php include 'include/sidebar.php'; ?>
    <div class="main-content">
        <h5 class="fw-semibold">Dashboard Overview</h5>
        <p class="text-muted">
            Welcome back! Here's what's happening with your cases.
        </p>

        <div class="row g-3 mt-2">
            <?php include 'include/case_summary.php'; ?>
        </div>    
    </div>
</div>

