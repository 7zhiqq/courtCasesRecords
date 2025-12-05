<?php
    $query = "SELECT 
                COUNT(*) AS total_cases, 
                SUM(CASE WHEN status='open' THEN 1 ELSE 0 END) AS 'open_cases', 
                SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) AS 'pending_cases', 
                SUM(CASE WHEN priority='high' THEN 1 ELSE 0 END) AS 'high_priority' 
              FROM case_tbl";

    $result = mysqli_query($conn, $query);
    $stats = mysqli_fetch_assoc($result);

    $totalCases = $stats['total_cases'];
    $openCases = $stats['open_cases'];
    $pendingCases = $stats['pending_cases'];
    $highPriority = $stats['high_priority'];
?>