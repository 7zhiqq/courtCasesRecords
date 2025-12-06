<?php
    $query = "SELECT c.*, j.judge_firstname, j.judge_lastname
            FROM case_tbl c
            LEFT JOIN judge_tbl j
            ON c.judge_id = j.judge_id";

    $result = mysqli_query($conn, $query);
    $cases = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>