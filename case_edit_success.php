<?php
    require_once 'include/config.php';

    if (isset($_POST['original_case_number'])) {
        $original_case_number = $_POST['original_case_number'];
        $case_number = $_POST['case_number'];
        $case_title = $_POST['case_title'];
        $filing_date = $_POST['filing_date'];
        $case_type = $_POST['case_type'];
        $status = $_POST['status'];
        $court_jurisdiction = $_POST['court_jurisdiction'];
        $priority = $_POST['priority'];
        $judge_id = $_POST['judge_id'];
        $description = $_POST['case_description'];

        $update_query = "UPDATE case_tbl 
                        SET case_number = ?, case_title = ?, filing_date = ?, case_type = ?, status = ?, 
                            court_jurisdiction = ?, judge_id = ?, case_description = ?, priority = ?
                        WHERE case_number = ?";

        $stmt = mysqli_prepare($conn, $update_query);

        mysqli_stmt_bind_param(
            $stmt, 
            "ssssssssss", 
            $case_number,
            $case_title,
            $filing_date,
            $case_type,
            $status,
            $court_jurisdiction,
            $judge_id,
            $description,
            $priority,
            $original_case_number
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: case_view.php?case=" . urlencode($case_number) . "&status=success");
            exit();
        } else {
            header("Location: case_edit.php?case=" . urlencode($original_case_number) . "&status=error");
            exit();
        }

        mysqli_stmt_close($stmt);
    }
?>
