<?php
    require_once 'include/config.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: cases.php");
        exit();
    }

    $party_id = $_POST['party_id'] ?? '';
    $case_id = $_POST['case_id'] ?? '';
    $party_name = $_POST['party_name'] ?? '';
    $party_role = $_POST['party_role'] ?? '';
    $represented_by = isset($_POST['represented_by']) && $_POST['represented_by'] !== '' ? $_POST['represented_by'] : NULL;
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';

    if (empty($party_name) || empty($party_role)) {
        $error_msg = urlencode("Party name and role are required.");
        header("Location: case_view.php?case=" . urlencode($case_id) . "&error=" . $error_msg);
        exit();
    }

    function execute_stmt($conn, $sql, $types, $params) {
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $update_party_sql = "UPDATE parties_tbl 
                        SET party_name = ?, phone = ?, email = ?, address = ? 
                        WHERE party_id = ?";
    execute_stmt($conn, $update_party_sql, "sssss", [$party_name, $phone, $email, $address, $party_id]);

    $update_role_sql = "UPDATE case_parties_tbl 
                        SET role = ? 
                        WHERE case_id = ? AND party_id = ?";
    execute_stmt($conn, $update_role_sql, "sss", [$party_role, $case_id, $party_id]);

    function assign_lawyer($conn, $case_id, $party_id, $lawyer_id) {
        if ($lawyer_id !== NULL) {
            $check_sql = "SELECT 1 
                          FROM case_assignments_tbl 
                          WHERE case_id = ? AND party_id = ?";
            $stmt = mysqli_prepare($conn, $check_sql);
            mysqli_stmt_bind_param($stmt, "ss", $case_id, $party_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            if (mysqli_num_rows($result) > 0) {
                $update_sql = "UPDATE case_assignments_tbl 
                               SET lawyer_id = ? 
                               WHERE case_id = ? AND party_id = ?";
                execute_stmt($conn, $update_sql, "sss", [$lawyer_id, $case_id, $party_id]);
            } else {
                $insert_sql = "INSERT INTO case_assignments_tbl (case_id, party_id, lawyer_id) 
                               VALUES (?, ?, ?)";
                execute_stmt($conn, $insert_sql, "sss", [$case_id, $party_id, $lawyer_id]);
            }
        } else {
            $delete_sql = "DELETE FROM case_assignments_tbl 
                           WHERE case_id = ? AND party_id = ?";
            execute_stmt($conn, $delete_sql, "ss", [$case_id, $party_id]);
        }
    }

    assign_lawyer($conn, $case_id, $party_id, $represented_by);

    header("Location: case_view.php?case=" . urlencode($case_id) . "&status=success");
    exit();
?>
