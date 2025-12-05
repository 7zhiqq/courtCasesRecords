<?php
    require_once 'include/config.php';

    if (!isset($_GET['case'])) {
        header("Location: cases.php");
        exit();
    }

    $case_id = mysqli_real_escape_string($conn, $_GET['case']);

    $query = "SELECT 
                cp.id AS cp_id,
                cp.case_id,
                cp.party_id,
                cp.role,

                p.party_name,
                p.phone,
                p.email,
                p.address,

                ca.lawyer_id AS represented_by
              FROM case_parties_tbl cp
              JOIN parties_tbl p ON cp.party_id = p.party_id
              LEFT JOIN case_assignments_tbl ca ON ca.party_id = cp.party_id AND ca.case_id = cp.case_id
              WHERE cp.case_id = '$case_id'
    ";

    $result = mysqli_query($conn, $query);
    $parties = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $parties[] = $row;
    }

    $lawyer_list = [];
    $lawyers = mysqli_query($conn, "SELECT * FROM lawyer_tbl");
    while ($lawyer = mysqli_fetch_assoc($lawyers)) {
        $lawyer_list[$lawyer['lawyer_id']] = $lawyer['lawyer_lastname'] . ", " . $lawyer['lawyer_firstname'];
    }

    $roles = ["Plaintiff","Defendant","Respondent","Complainant","Petitioner","Appellee","Accused","Suspect","Victim","Witness","Representative","Other"];
?>

<?php foreach ($parties as $party): ?>
    <div id="editPartyModal-<?= $party['party_id'] ?>" class="modal">
        <div class="modal-content">
            <span class="close">\
                <i class="h3 bi bi-x"></i>
            </span>
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-pencil-square"></i> Edit Party
                </h5>
            </div>

            <form action="case_edit_party_success.php" method="POST" class="form-modal">
                <input type="hidden" name="party_id" value="<?= $party['party_id'] ?>">
                <input type="hidden" name="case_id" value="<?= htmlspecialchars($case_id) ?>">

                <div class="row g-3">

                    <div class="col mb-3">
                        <label class="form-label fw-semibold">Represented By (Lawyer)</label>
                        <select name="represented_by" class="form-select">
                            <option value="">-- Select Lawyer --</option>
                            <?php foreach ($lawyer_list as $lid => $lname): ?>
                                <option value="<?= $lid ?>" <?= ($party['represented_by'] == $lid) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($lname) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col mb-6">
                        <label class="form-label fw-semibold">Party Name <span class="text-danger">*</span></label>
                        <input type="text" name="party_name" class="form-control" required value="<?= htmlspecialchars($party['party_name']) ?>">
                    </div>

                    <div class="col mb-3">
                        <label class="form-label fw-semibold">Role / Type <span class="text-danger">*</span></label>
                        <select name="party_role" class="form-select" required>
                            <option value="">-- Select Role --</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role ?>" <?= ($party['role'] === $role) ? 'selected' : '' ?>><?= $role ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="row g-3">

                    <div class="col mb-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($party['phone']) ?>">
                    </div>

                    <div class="col mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($party['email']) ?>">
                    </div>

                </div>

                <div class="row g-3">

                    <div class="col mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="address" class="form-control" rows="2"><?= htmlspecialchars($party['address']) ?></textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="case_view.php?case=<?= urlencode($case_id); ?>" class="btn btn-secondary btn-sm">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
<?php endforeach; ?>

<link rel="stylesheet" href="css/modal.css">
<script src="js/modal_edit_party.js"></script>
