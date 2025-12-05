<?php
    require_once 'include/config.php';

    if (!isset($_GET['case'])) {
        header("Location: cases.php");
        exit();
    }

    $case_number = mysqli_real_escape_string($conn, $_GET['case']);
?>

<div id="addDocsModal" class="modal">
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
        <form action="case_upload_docs.php" method="POST" class="form-modal" enctype="multipart/form-data">
            <input type="hidden" name="case_number" value="<?= htmlspecialchars($case_number); ?>">
            <div class="col mb-3">
              <label class="form-label fw-semibold">Document Title <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="document_title"  placeholder="e.g. Affidavit, Motion to Dismiss, Order" required>
            </div>
            <div class="col mb-3">
              <label class="form-label fw-semibold">Document File <span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="document_file"  accept=".pdf,.doc,.docx,.jpg,.png" required>
              <small class="text-muted">Allowed: PDF, DOC, DOCX, JPG, PNG</small>
            </div>
            <div class="col mb-3">
              <label class="form-label fw-semibold">Description / Notes</label>
              <textarea name="document_description" class="form-control" rows="3" placeholder="Add some notes (optional)"></textarea>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="case_view.php?case=<?= urlencode($case['case_number']); ?>"
                class="btn btn-secondary btn-sm">Cancel</a>
                <button type="submit" class="btn btn-primary btn-sm">Save Document</button>
            </div>
        </form>
    </div>
  </div>
</div>

<link rel="stylesheet" href="css/modal.css">