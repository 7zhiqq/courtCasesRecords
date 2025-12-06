<?php
    require_once 'include/config.php';

    if (isset($_GET['id'])) {

        $lawyer_id = trim($_GET['id']);

        if ($lawyer_id === '') {
            header("Location: lawyers.php?status=error");
            exit();
        }

        $stmt = mysqli_prepare(
            $conn,
            "DELETE FROM lawyer_tbl WHERE lawyer_id = ?"
        );

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $lawyer_id);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header("Location: lawyers.php?status=deleted");
                exit();
            }

            mysqli_stmt_close($stmt);
        }

        header("Location: lawyers.php?status=error");
        exit();
    }

    header("Location: lawyers.php");
    exit();
?>
