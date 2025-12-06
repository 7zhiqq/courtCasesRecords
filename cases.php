<?php
    require_once 'include/config.php';
    include 'include/head.php';
    include 'include/header.php';
    include 'include/functions.php';
    
    include 'include/queries/case_counts.php';
    include 'include/queries/cases.php';
?>

<?php if (isset($_GET['status'])): ?>
    <div class="status-toast 
        <?= $_GET['status'] === 'success' ? 'success' : 
            ($_GET['status'] === 'deleted' ? 'danger' : 'error') ?>">

        <span class="close-toast"><i class="bi bi-x"></i></span>

        <?php if ($_GET['status'] === 'success'): ?>
            <i class="bi bi-check-circle-fill icon"></i>
            <div>
                <strong>Success</strong>
                <p>Case added successfully.</p>
            </div>

        <?php elseif ($_GET['status'] === 'deleted'): ?>
            <i class="bi bi-trash3-fill icon"></i>
            <div>
                <strong>Deleted</strong>
                <p>Case deleted successfully.</p>
            </div>

        <?php else: ?>
            <i class="bi bi-exclamation-circle-fill icon"></i>
            <div>
                <strong>Error</strong>
                <p>Something went wrong. Please try again.</p>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>



<div class="layout d-flex">
    <?php include 'include/sidebar.php'; ?>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-semibold mb-1">Case Records</h5>
                <p class="text-muted mb-0">Manage and track all court cases</p>
            </div>

            <button class="table-btn btn btn-primary btn-sm" id="addCaseBtn" style="width: 150px;height:36px">
                <i class="bi bi-folder-plus"></i>
                Add New Case
            </button>
        </div>

        <div class="row g-3 mt-2">
            <?php include 'include/case_summary.php'; ?>
        </div>

        <div class="search-bar d-flex gap-2 mt-3">
            <?php include 'include/search.php' ?>
        </div>

        <div class="table-container mt-3">
            <div class="table-responsive">
                <?php include 'include/tables/case_table.php' ?>
            </div>
        </div>

        <script src="js/case_search.js"></script>
    </div>
</div>

<?php include 'case_add.php'; ?>

<link rel="stylesheet" href="css/modal.css">
<script src="js/modal.js"></script>

<script>
    document.querySelectorAll('.close-toast').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.parentElement.style.display = 'none';
        });
    });

    setTimeout(() => {
        const toast = document.querySelector('.status-toast');
        if (toast) toast.style.display = 'none';
    }, 4000);
</script>
