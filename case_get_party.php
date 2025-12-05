<?php
require_once 'include/config.php';

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['party_id'])) {
    echo json_encode(['error' => 'Missing party_id']);
    exit;
}

$party_id = mysqli_real_escape_string($conn, $_GET['party_id']);

// Optional: accept a case identifier to fetch the role/assignment for that case
$case_id = isset($_GET['case']) ? mysqli_real_escape_string($conn, $_GET['case']) : null;

// Join parties and case_parties so we can return party fields and the role
$party_query = "SELECT p.*, cp.role, ca.lawyer_id AS assigned_lawyer_id
                FROM parties_tbl p
                LEFT JOIN case_parties_tbl cp ON cp.party_id = p.party_id";

if ($case_id) {
    $party_query .= " AND cp.case_id = '$case_id'"; // filter role/assignment for this case
}

$party_query .= "\n                LEFT JOIN case_assignments_tbl ca ON ca.case_id = cp.case_id AND ca.party_id = cp.party_id\n                WHERE p.party_id = '$party_id' LIMIT 1";

$party_result = mysqli_query($conn, $party_query);

if (!$party_result || mysqli_num_rows($party_result) === 0) {
    echo json_encode(['error' => 'Party not found']);
    exit;
}

$party = mysqli_fetch_assoc($party_result);

$lawyer_query = "SELECT * FROM lawyer_tbl ORDER BY lawyer_lastname ASC";
$lawyers_res = mysqli_query($conn, $lawyer_query);
$lawyers = [];
while ($l = mysqli_fetch_assoc($lawyers_res)) {
    $lawyers[] = $l;
}

// Return party + lawyers so the client can populate the select
echo json_encode([
    'party' => $party,
    'lawyers' => $lawyers,
]);
