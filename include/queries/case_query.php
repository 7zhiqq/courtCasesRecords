<?php
    $cases_query = "SELECT DISTINCT cp.case_id, cp.party_id, cp.role, p.party_name, p.party_type, p.phone, p.email
                    FROM case_parties_tbl cp
                    INNER JOIN case_assignments_tbl ca ON cp.case_id = ca.case_id AND cp.party_id = ca.party_id
                    INNER JOIN parties_tbl p ON ca.party_id = p.party_id
                    WHERE ca.lawyer_id = '$lawyer_id'
                    ORDER BY cp.case_id ASC, p.party_name ASC";
    
    $cases_result = mysqli_query($conn, $cases_query);
    $cases_count = mysqli_num_rows($cases_result);
    
    $cases_data = array();
    while ($row = mysqli_fetch_assoc($cases_result)) {
        $case_id = $row['case_id'];
        if (!isset($cases_data[$case_id])) {
            $cases_data[$case_id] = array(
                'parties' => array()
            );
        }
        $cases_data[$case_id]['parties'][] = $row;
    }
?>