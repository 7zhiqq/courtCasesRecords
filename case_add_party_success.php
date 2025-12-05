<?php
    require_once 'include/config.php';

    function generatePartyID($conn) {
        $party_query = "SELECT party_id 
                        FROM parties_tbl 
                        ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $party_query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $lastID = intval(substr($row['party_id'], 4));
            $newID = $lastID + 1;
        } else {
            $newID = 1;
        }

        return "PTY-" . str_pad($newID, 4, "0", STR_PAD_LEFT);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $case_number    = $_POST['case_number'];
        $party_name     = $_POST['party_name'];
        $party_role     = $_POST['party_role'];
        $phone          = $_POST['phone'];
        $email          = $_POST['email'];
        $address        = $_POST['address'];

        $represented_by = !empty($_POST['represented_by']) ? $_POST['represented_by'] : NULL;

        $party_id_gen = generatePartyID($conn);

        $query = "INSERT INTO parties_tbl (party_id, party_name, party_type, phone, email, address)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        $stmt->bind_param("ssssss", $party_id_gen, $party_name, $party_role, $phone, $email, $address);
        $stmt->execute();
        $stmt->close();

        $query2 = "INSERT INTO case_parties_tbl (case_id, party_id, role)
                   VALUES (?, ?, ?)";
        $stmt2 = mysqli_prepare($conn, $query2);
        $stmt2->bind_param("sss", $case_number, $party_id_gen, $party_role);
        $stmt2->execute();
        $stmt2->close();

        if ($represented_by !== NULL && $represented_by !== "") {
            $query3 = "INSERT INTO case_assignments_tbl (case_id, party_id, lawyer_id)
                       VALUES (?, ?, ?)";
            $stmt3 = mysqli_prepare($conn, $query3);
            $stmt3->bind_param("sss", $case_number, $party_id_gen, $represented_by);
            $stmt3->execute();
            $stmt3->close();
        }

        $query4 = "UPDATE case_tbl 
                   SET updated_at = NOW() 
                   WHERE case_number = ?";
        $stmt4 = mysqli_prepare($conn, $query4);
        $stmt4->bind_param("s", $case_number);
        $stmt4->execute();
        $stmt4->close();

        header("Location: case_view.php?case=$case_number&party_added=1&tab=parties&status=success");
        exit();
    }
?>
