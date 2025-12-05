<?php
    require_once 'include/config.php';

    if (isset($_POST['addCase'])) {
        $case_number = $_POST['case_number'];
        $case_title = $_POST['case_title'];
        $filing_date = $_POST['filing_date'];
        $case_type = $_POST['case_type'];
        $status = $_POST['status'];
        $court_jurisdiction = $_POST['court_jurisdiction'];
        $priority = $_POST['priority'];
        $judge_id = $_POST['judge_id'];
        $description = $_POST['description'];

        $insert_query = "INSERT INTO case_tbl (case_number, case_title, filing_date, case_type, status, court_jurisdiction, judge_id, case_description, priority)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $insert_query);

        $stmt->bind_param(
            "sssssssss", 
            $case_number,
            $case_title,
            $filing_date,
            $case_type,
            $status,
            $court_jurisdiction,
            $judge_id,
            $description,
            $priority
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: cases.php?status=success");
            exit();
        } else {
            header("Location: cases.php?status=error");
            exit();
        }

        mysqli_stmt_close($stmt);
    }
?>
