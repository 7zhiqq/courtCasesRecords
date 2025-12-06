<?php
    require_once 'include/config.php';
    
    function genJudgeID($first_name, $last_name, $year, $conn) {
        // initials of frst and last name plus last 2 digits of the current year
        $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
        $year2 = substr($year, -2); // 2025 -> 25

        $prefix = "H" . $initials . $year2;

        $query = "SELECT judge_id 
                FROM judge_tbl 
                WHERE judge_id LIKE '%$year2%' 
                ORDER BY CAST(RIGHT(judge_id, 2) AS UNSIGNED) DESC 
                LIMIT 1";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $last_number = intval(substr($row['judge_id'], -2)); 
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;  // First nga gin add this year
        }

        // add 2 digits sa number
        $new_id = $prefix . str_pad($new_number, 2, '0', STR_PAD_LEFT);

        return $new_id;
    }


    if (isset($_POST['addJudge'])) {
        $first_name = trim($_POST['first_name']);
        $last_name  = trim($_POST['last_name']);
        $email      = trim($_POST['email']);

        $created_at_year = date('Y');
        $judge_id = genJudgeID($first_name, $last_name, $created_at_year, $conn);

        $stmt = $conn->prepare("INSERT INTO judge_tbl (judge_id, judge_firstname, judge_lastname, judge_email) 
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss", 
            $judge_id, 
            $first_name, 
            $last_name, 
            $email
        );

        if ($stmt->execute()) {
            header("Location: judges.php?status=success");
            exit();
        } else {
            header("Location: cases.php?status=error");
            exit();
        }

        $stmt->close();
    }

?>