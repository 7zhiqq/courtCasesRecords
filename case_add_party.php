<?php
    require_once 'include/config.php';

    if (!isset($_GET['case'])) {
        header("Location: cases.php");
        exit();
    }

    $query = "SELECT *
              FROM lawyer_tbl";
    $result = mysqli_query($conn, $query);

    $case_number = mysqli_real_escape_string($conn, $_GET['case']);
?>

<div id="addPartyModal" class="modal">
    <div class="modal-content">
        <span class="close">
            <i class="h3 bi bi-x"></i>
        </span>
        <div class="modal-header">
            <h5 class="modal-title" id="addPartyModalLabel">
                <i class="bi bi-folder-plus"></i>
                Add New Party
            </h5>
        </div>
        <form action="case_add_party_success.php" method="POST" class="form-modal">
            <input type="hidden" name="case_number" value="<?= htmlspecialchars($case_number); ?>">
            <div class="row g-3">
                <div class="col mb-3">
                    <label class="form-label fw-semibold">Represented By (Lawyer)</label>
                    <select name="represented_by" class="form-select">
                        <option value="">-- Select Lawyer --</option>
                        <?php while ($lawyer = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?= $lawyer['lawyer_id']; ?>">
                                <?= htmlspecialchars($lawyer['lawyer_lastname'] . ", " . $lawyer['lawyer_firstname']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col mb-6">
                    <label class="form-label fw-semibold">Party Name <span class="text-danger">*</span></label>
                    <input type="text" name="party_name" class="form-control" required>
                </div>
                <div class="col mb-3">
                    <label class="form-label fw-semibold">Role / Type <span class="text-danger">*</span></label>
                    <select name="party_role" class="form-select" required>
                        <option value="">-- Select Role --</option>
                        <option>Plaintiff</option>
                        <option>Defendant</option>
                        <option>Respondent</option>
                        <option>Complainant</option>
                        <option>Petitioner</option>
                        <option>Appellee</option>
                        <option>Accused</option>
                        <option>Suspect</option>
                        <option>Victim</option>
                        <option>Witness</option>
                        <option>Representative</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>
            <div class="row g-3">
                <div class="col mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="col mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
            <div class="row g-3">
                <div class="col mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="case_view.php?case=<?= urlencode($case['case_number']); ?>"
                class="btn btn-secondary btn-sm">Cancel</a>
                <button type="submit" class="btn btn-primary btn-sm">Save Party</button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="css/modal.css">