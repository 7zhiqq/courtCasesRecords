<?php
    require_once 'include/config.php';
    include 'include/head.php';

    // Get party ID from URL
    $party_id = mysqli_real_escape_string($conn, $_GET['party_id']);
    $case_number = mysqli_real_escape_string($conn, $_GET['case']);

    // Fetch party details
    $party_query = "
        SELECT *
        FROM parties_tbl
        WHERE party_id = '$party_id'
    ";
    $party_result = mysqli_query($conn, $party_query);
    $party = mysqli_fetch_assoc($party_result);

    // Fetch lawyer list
    $lawyer_query = "SELECT * FROM lawyer_tbl";
    $lawyer_result = mysqli_query($conn, $lawyer_query);
?>
<div id="editPartyModal" class="modal">
    <div class="modal-content">
        <span class="close"><i class="h3 bi bi-x"></i></span>

        <div class="modal-header">
            <h5 class="modal-title">
                <i class="bi bi-pencil-square"></i> Edit Party
            </h5>
        </div>

        <form action="case_edit_party_success.php" method="POST" class="form-modal">
            <input type="hidden" name="party_id" value="<?= $party['party_id']; ?>">
            <input type="hidden" name="case_number" value="<?= htmlspecialchars($case_number); ?>">

            <div class="row g-3">
                <div class="col mb-3">
                    <label class="form-label fw-semibold">Represented By (Lawyer)</label>
                    <select name="represented_by" class="form-select">
                        <option value="">-- Select Lawyer --</option>

                        <?php while ($lawyer = mysqli_fetch_assoc($lawyer_result)) : ?>
                            <option value="<?= $lawyer['lawyer_id']; ?>"
                                <?= ($party['represented_by'] == $lawyer['lawyer_id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($lawyer['lawyer_lastname'] . ", " . $lawyer['lawyer_firstname']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col mb-6">
                    <label class="form-label fw-semibold">Party Name <span class="text-danger">*</span></label>
                    <input type="text" name="party_name" class="form-control"
                           value="<?= htmlspecialchars($party['party_name']); ?>" required>
                </div>

                <div class="col mb-3">
                    <label class="form-label fw-semibold">Role / Type <span class="text-danger">*</span></label>
                    <select name="party_role" class="form-select" required>
                        <?php
                        $roles = [
                            "Plaintiff","Defendant","Respondent","Complainant","Petitioner",
                            "Appellee","Accused","Suspect","Victim","Witness","Representative","Other"
                        ];

                        foreach ($roles as $role) {
                            $selected = ($party['party_role'] == $role) ? "selected" : "";
                            echo "<option $selected>$role</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row g-3">
                <div class="col mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control"
                           value="<?= htmlspecialchars($party['phone']); ?>">
                </div>
                <div class="col mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= htmlspecialchars($party['email']); ?>">
                </div>
            </div>

            <div class="row g-3">
                <div class="col mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" class="form-control" rows="2"><?= 
                        htmlspecialchars($party['address']); ?></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="case_view.php?case=<?= urlencode($case_number); ?>" class="btn btn-secondary btn-sm">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="css/modal.css">
