<?php
    $partyQuery = "SELECT 
                    cp.role,
                    p.party_id,
                    p.party_name,
                    p.phone,
                    p.email,
                    p.address,
                    CONCAT(l.lawyer_lastname, ', ', l.lawyer_firstname) 
                    AS represented_by
                FROM case_parties_tbl cp
                JOIN parties_tbl p 
                    ON cp.party_id = p.party_id
                LEFT JOIN case_assignments_tbl ca
                    ON ca.case_id = cp.case_id
                    AND ca.party_id = cp.party_id
                LEFT JOIN lawyer_tbl l
                    ON l.lawyer_id = ca.lawyer_id
                WHERE cp.case_id = '$case_number'
                ORDER BY p.party_name ASC";
    $partyResult = mysqli_query($conn, $partyQuery);
    $partyCount = mysqli_num_rows($partyResult);

    $docQuery = "SELECT COUNT(*) AS total_docs 
                FROM case_documents_tbl 
                WHERE case_id = '$case_number'";
    $docsResult = mysqli_query($conn, $docQuery);
    $docData = mysqli_fetch_assoc($docsResult);
    $documentCount = $docData['total_docs'];

?>