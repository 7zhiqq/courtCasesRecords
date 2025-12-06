<?php
require_once 'include/config.php';

if (isset($_POST['updateLawyer'])) {
    if (!isset($_POST['lawyer_id'])) {
        header("Location: lawyers.php?status=error");
        exit();
    }

    $lawyer_id = trim($_POST['lawyer_id']);
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($first_name === '' || $last_name === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: lawyers.php?status=invalid");
        exit();
    }

    $stmt = mysqli_prepare($conn, "UPDATE lawyer_tbl SET lawyer_firstname = ?, lawyer_lastname = ?, lawyer_email = ? WHERE lawyer_id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email, $lawyer_id);
        $exec = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($exec) {
            header("Location: lawyers.php?status=success&editstatus=success");
            exit();
        }
    }

    header("Location: lawyers.php?status=error");
    exit();
} else {
    header("Location: lawyers.php");
    exit();
}
?>