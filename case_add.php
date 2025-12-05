<?php     
    require_once 'include/config.php';    
    include 'include/head.php' ;

    include 'include/queries/judge.php';
?>

<div id="addCaseModal" class="modal">
    <div class="modal-content">
        <span class="close">
            <i class="h3 bi bi-x"></i>
        </span>
        <div class="modal-header">
            <h5 class="modal-title" id="addCaseModalLabel">
                <i class="bi bi-folder-plus"></i> 
                Add New Case
            </h5>
        </div>
        <form action="case_add_success.php" method="POST" class="form-modal">
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Case Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="case_number" placeholder="e.g., 2024-CV-001" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold">Case Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="case_title" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Filing Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="filing_date" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Case Type <span class="text-danger">*</span></label>
                    <select class="form-select" name="case_type" required>
                        <option value="">-- Select Case Type --</option>
                        <option value="civil">Civil</option>
                        <option value="criminal">Criminal</option>
                        <option value="administrative">Administrative</option>
                        <option value="family">Family</option>
                        <option value="commercial">Commercial</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <option value="">-- Select Status --</option>
                        <option value="pending" selected>Pending</option>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                        <option value="appeal">Appeal</option>
                        <option value="dismissed">Dismissed</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-5">
                    <label class="form-label fw-bold">Assigned Judge <span class="text-danger">*</span></label>
                    <select class="form-select" name="judge_id" required>
                        <option value="">-- Select Judge --</option>
                        <?php foreach ($judges as $judge): ?>
                            <option value="<?= $judge['judge_id']; ?>">
                                <?= htmlspecialchars($judge['judge_lastname'] . ', ' . $judge['judge_firstname']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold">Court Jurisdiction <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="court_jurisdiction" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Priority <span class="text-danger">*</span></label>
                    <select class="form-select" name="priority">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" rows="4"></textarea>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-secondary btn-sm">Clear</button>
                <button type="submit" class="btn btn-primary btn-sm" name="addCase">Create Case</button>
            </div>
        </form>
    </div>
</div>

