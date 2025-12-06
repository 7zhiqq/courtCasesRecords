<?php
    require_once 'include/config.php';
    
    function genLawyerID($first_name, $last_name, $year, $conn) {
        $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
        $year2 = substr($year, -2); // 2025 -> 25

        $prefix = "L" . $initials . $year2;

        $query = "SELECT lawyer_id 
                  FROM lawyer_tbl 
                  WHERE lawyer_id LIKE '%$year2%' 
                  ORDER BY CAST(RIGHT(lawyer_id, 2) AS UNSIGNED) DESC 
                  LIMIT 1";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $last_number = intval(substr($row['lawyer_id'], -2)); 
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;  // First for the year
        }

        $new_id = $prefix . str_pad($new_number, 2, '0', STR_PAD_LEFT);

        return $new_id;
    }


    if (isset($_POST['addLawyer'])) {
        $first_name = trim($_POST['first_name']);
        $last_name  = trim($_POST['last_name']);
        $email      = trim($_POST['email']);

        $created_at_year = date('Y');
        $lawyer_id = genLawyerID($first_name, $last_name, $created_at_year, $conn);

        $stmt = $conn->prepare("INSERT INTO lawyer_tbl (lawyer_id, lawyer_firstname, lawyer_lastname, lawyer_email) 
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss", 
            $lawyer_id, 
            $first_name, 
            $last_name, 
            $email
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: lawyers.php?status=success");
            exit();
        } else {
            header("Location: lawyers.php?status=error");
            exit();
        }

        $stmt->close();
    }

?>