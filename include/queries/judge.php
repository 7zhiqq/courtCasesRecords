<?php
    $judge_query = "SELECT judge_id, judge_firstname, judge_lastname
                    FROM judge_tbl
                    ORDER BY judge_lastname ASC";
    $judge_result = mysqli_query($conn, $judge_query);
    $judges = mysqli_fetch_all($judge_result, MYSQLI_ASSOC);
?>