<?php 
    require_once 'include/config.php';
    require_once 'include/head.php';
    require_once 'include/navbar.php';

    if (!isset($_GET['case'])) {
        header("Location: cases.php");
        exit();
    }

    $case_id = htmlspecialchars($_GET['case']);
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
