<?php
    require_once 'include/config.php';

    if (isset($_GET['id'])) {

        $judge_id = trim($_GET['id']);

        if ($judge_id === '') {
            header("Location: judges.php?status=error");
            exit();
        }

        $stmt = mysqli_prepare(
            $conn,
            "DELETE FROM judge_tbl WHERE judge_id = ?"
        );

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $judge_id);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header("Location: judges.php?status=deleted");
                exit();
            }

            mysqli_stmt_close($stmt);
        }

        header("Location: judges.php?status=error");
        exit();
    }

    header("Location: judges.php");
    exit();
?>
