<?php
require_once 'include/config.php';

if (isset($_POST['updateJudge'])) {
    if (!isset($_POST['judge_id'])) {
        header("Location: judges.php?status=error");
        exit();
    }

    $judge_id = trim($_POST['judge_id']);
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($first_name === '' || $last_name === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: judges.php?status=invalid");
        exit();
    }

    $stmt = mysqli_prepare($conn, "UPDATE judge_tbl SET judge_firstname = ?, judge_lastname = ?, judge_email = ? WHERE judge_id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email, $judge_id);
        $exec = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($exec) {
            header("Location: judges.php?status=success&editstatus=success");
            exit();
        }
    }

    header("Location: judges.php?status=error");
    exit();
} else {
    header("Location: judges.php");
    exit();
}
?>