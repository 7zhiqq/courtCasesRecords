<?php
    require_once 'include/config.php';
    include 'include/head.php';
    include 'include/header.php';
    include 'include/functions.php';

    include 'include/queries/case_viewer.php';

    $active = $_GET['tab'] ?? 'parties'; 

    if (isset($_GET['case'])) {
        $case_number = mysqli_real_escape_string($conn, $_GET['case']);

        $sql = "SELECT cp.role, p.*
                FROM case_parties_tbl cp
                INNER JOIN parties_tbl p ON cp.party_id = p.party_id
                WHERE cp.case_id = '$case_number'";

        $result = mysqli_query($conn, $sql);

        $plaintiff = '';
        $defendant = '';

        while ($row = mysqli_fetch_assoc($result)) {
            if (strtolower($row['role']) == "plaintiff" || strtolower($row['role']) == "complainant") {
                $plaintiff = $row['party_name'];
            }
            if (strtolower($row['role']) == "accused" || strtolower($row['role']) == "defendant") {
                $defendant = $row['party_name'];
            }
        }

        if (empty($plaintiff)) {
            $plaintiff = '—';
        }
        if (empty($defendant)) {
            $defendant = '—';
        }
    }

    include 'include/queries/count.php';
?>  
<?php if (isset($_GET['status'])): ?>
    <div class="status-toast <?= $_GET['status'] == 'success' ? 'success' : 'error' ?>">
        <span class="close-toast"><i class="bi bi-x"></i></span>

        <?php if ($_GET['status'] === 'success'): ?>
            <i class="bi bi-check-circle-fill icon"></i>
            <div>
                <strong>Success</strong>
                <p>Case edited successfully.</p>
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
        <div class="d-flex flex-column flex-md-row align-items-md-center mb-4 pb-3">
            <div>
                <h5 class="fw-semibold mb-1 d-flex align-items-center gap-2 flex-wrap">
                    <?= htmlspecialchars($case['case_title'], ENT_QUOTES, 'UTF-8'); ?>
                    <?= priorityBadge($case['priority']); ?>
                </h5>
                <small class="text-muted">
                    <i class="bi bi-calendar4"></i>
                    <?= htmlspecialchars('Last update on ' . $case['updated_at'], ENT_QUOTES, 'UTF-8'); ?>
                </small>
            </div>

            <div class="text-md-end mt-3 mt-md-0 d-flex gap-2 ms-md-auto">
                <button class="btn btn-primary btn-sm btn-edit">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>

                <a href="cases.php" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            </div>
        </div>

        <div class="card-row d-flex flex-column flex-md-row align-items-md-center mb-4 pb-3">
            <div class="col-auto">
                <div class="card border-blue">
                    <div class="case-content">
                        <div class="d-flex align-items-center mb-1">
                            <h6 class="text-uppercase text-muted mb-0">Case Number</h6>
                            <div class="ms-auto">
                                <?= typeBadge($case['case_type']); ?>
                            </div>
                        </div>
                        <div class="mt-2 mb-0">
                             <div class="fw-semibold">
                                <?= htmlspecialchars($case['case_number']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                <div class="card border-green">
                    <div class="case-content">
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                            <h6 class="text-uppercase text-muted mb-0">Status & Priority</h6>
                        </div>
                        <div class="mt-2 mb-0">
                            <?= statusBadge($case['status']); ?>
                            <?= priorityBadge($case['priority']); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                <div class="card border-purple">
                    <div class="case-content">
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                            <h6 class="text-uppercase text-muted mb-0">Presiding Judge</h6>
                        </div>
                        <div class="mt-2 mb-0">
                             <div class="fw-semibold">
                                <?= htmlspecialchars($case['judge_lastname'] . ', ' . $case['judge_firstname']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-details p-3 mb-4">
            <div class="card-d-content row mb-3">
                <div class="col-md-4">
                    <h6 class="text-uppercase text-muted small mb-1">Filing Date</h6>
                    <div class="fw-semibold">
                        <?= htmlspecialchars($case['filing_date']); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <h6 class="text-uppercase text-muted small mb-1">Court Jurisdiction</h6>
                    <div class="fw-semibold">
                        <?= htmlspecialchars($case['court_jurisdiction']); ?>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="card-d-content col-md-6">
                    <h6 class="text-uppercase text-muted small mb-1">Plaintiff</h6>
                    <div class="fw-semibold">
                        <?= htmlspecialchars($plaintiff); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="text-uppercase text-muted small mb-1">Defendant</h6>
                    <div class="fw-semibold">
                        <?= htmlspecialchars($defendant); ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-desc">
            <h6 class="text-uppercase text-muted mb-0">Case Description</h6>
            <div class="mt-2 mb-0">
                <?= htmlspecialchars($case['case_description']); ?>
            </div>
        </div>

        <div class="card-tabs">
            <?php
                include 'include/tabs/case_tabs.php';
            ?>
        </div>

        <div class="tab-content mt-3">
            <?php 
                if ($active == 'parties') {
                    include 'include/tabs/case_parties.php';
                } elseif ($active == 'documents') {
                    include 'include/tabs/case_documents.php';
                }
            ?>
        </div>
    </div>
</div>

<?php include 'case_edit.php'; ?>
<?php include 'case_add_party.php'; ?>
<?php include 'case_add_docs.php'; ?>

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


