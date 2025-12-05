<?php
    if (isset($_GET['case'])) {
        $case_number = mysqli_real_escape_string($conn, $_GET['case']); 

        $query = "SELECT c.*, j.judge_firstname, j.judge_lastname
                FROM case_tbl c
                LEFT JOIN judge_tbl j 
                ON c.judge_id = j.judge_id
                WHERE c.case_number = '$case_number'";
        $result = mysqli_query($conn, $query);
        $case = mysqli_fetch_assoc($result); 

        if (!$case) {
            header("Location: cases.php");
            exit();
        }
    } else {
        header("Location: cases.php");
        exit();
    }
?>