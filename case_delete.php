<?php
    require_once 'include/config.php';

    if (isset($_GET['id'])) {

        $case_number = trim($_GET['id']);

        if ($case_number === '') {
            header("Location: cases.php?status=error");
            exit();
        }

        $stmt = mysqli_prepare(
            $conn,
            "DELETE FROM case_tbl WHERE case_number = ?"
        );

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $case_number);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header("Location: cases.php?status=deleted");
                exit();
            }

            mysqli_stmt_close($stmt);
        }

        header("Location: cases.php?status=error");
        exit();
    }

    header("Location: cases.php");
    exit();
?>
