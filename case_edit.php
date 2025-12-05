<?php     
    require_once 'include/config.php';    
    include 'include/head.php' ;

    include 'include/queries/judge.php';
?>
<div id="editCaseModal" class="modal">
    <div class="modal-content">
        <span class="close">
            <i class="h3 bi bi-x"></i>
        </span>
        <div class="modal-header">
            <h5 class="modal-title">
                <i class="bi bi-pencil-square"></i> 
                Edit Case
            </h5>
        </div>

        <form action="case_edit_success.php" method="POST" class="form-modal">
            <input type="hidden" name="original_case_number" value="<?= htmlspecialchars($case['case_number']); ?>">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Case Number <span class="text-danger">*</span></label>
                    <input type="text" name="case_number" class="form-control" 
                           value="<?= htmlspecialchars($case['case_number']); ?>" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold">Case Title <span class="text-danger">*</span></label>
                    <input type="text" name="case_title" class="form-control" 
                           value="<?= htmlspecialchars($case['case_title']); ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Filing Date <span class="text-danger">*</span></label>
                    <input type="date" name="filing_date" class="form-control" 
                           value="<?= htmlspecialchars($case['filing_date']); ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Case Type <span class="text-danger">*</span></label>
                    <select class="form-select" name="case_type" required>
                        <option value="civil" <?= $case['case_type']=="civil"?'selected':'' ?>>Civil</option>
                        <option value="criminal" <?= $case['case_type']=="criminal"?'selected':'' ?>>Criminal</option>
                        <option value="administrative" <?= $case['case_type']=="administrative"?'selected':'' ?>>Administrative</option>
                        <option value="family" <?= $case['case_type']=="family"?'selected':'' ?>>Family</option>
                        <option value="commercial" <?= $case['case_type']=="commercial"?'selected':'' ?>>Commercial</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                    <select class="form-select" name="status">
                        <option value="pending" <?= $case['status']=="pending"?'selected':'' ?>>Pending</option>
                        <option value="open" <?= $case['status']=="open"?'selected':'' ?>>Open</option>
                        <option value="closed" <?= $case['status']=="closed"?'selected':'' ?>>Closed</option>
                        <option value="appeal" <?= $case['status']=="appeal"?'selected':'' ?>>Appeal</option>
                        <option value="dismissed" <?= $case['status']=="dismissed"?'selected':'' ?>>Dismissed</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-5">
                    <label class="form-label fw-bold">Judge <span class="text-danger">*</span></label>
                    <select class="form-select" name="judge_id" required>
                        <?php foreach ($judges as $j): ?>
                            <option value="<?= $j['judge_id']; ?>"
                                <?= $j['judge_id']==$case['judge_id']?'selected':'' ?>>
                                <?= htmlspecialchars($j['judge_lastname'] . ', ' . $j['judge_firstname']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold">Court Jurisdiction <span class="text-danger">*</span></label>
                    <input type="text" name="court_jurisdiction" class="form-control" 
                           value="<?= htmlspecialchars($case['court_jurisdiction']); ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Priority <span class="text-danger">*</span></label>
                    <select class="form-select" name="priority" required>
                        <option value="low" <?= $case['priority']=="low"?'selected':'' ?>>Low</option>
                        <option value="medium" <?= $case['priority']=="medium"?'selected':'' ?>>Medium</option>
                        <option value="high" <?= $case['priority']=="high"?'selected':'' ?>>High</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                <textarea name="case_description" class="form-control" rows="4"><?= htmlspecialchars($case['case_description']); ?></textarea>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="case_view.php?case=<?= urlencode($case['case_number']); ?>" 
                class="btn btn-secondary btn-sm">Cancel</a>
                <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="css/modal.css">
<script src="js/modal_edit.js"></script>