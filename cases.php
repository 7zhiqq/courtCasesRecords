<?php
    require_once 'include/config.php';
    include 'include/head.php';
    include 'include/header.php';
    include 'include/functions.php';
    
    include 'include/queries/case_counts.php';

    $query = "SELECT c.*, j.judge_firstname, j.judge_lastname
            FROM case_tbl c
            LEFT JOIN judge_tbl j
            ON c.judge_id = j.judge_id";

    $result = mysqli_query($conn, $query);
    $cases = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php if (isset($_GET['status'])): ?>
    <div class="status-toast <?= $_GET['status'] == 'success' ? 'success' : 'error' ?>">
        <span class="close-toast"><i class="bi bi-x"></i></span>

        <?php if ($_GET['status'] === 'success'): ?>
            <i class="bi bi-check-circle-fill icon"></i>
            <div>
                <strong>Success</strong>
                <p>Case added successfully.</p>
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

            <button class="btn btn-primary btn-sm" id="addCaseBtn">
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
                <table class="table table-hover align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" width="130">Case ID</th>
                            <th class="text-center" width="100">Type</th>
                            <th width="200">Case Title</th>
                            <th width="150">Judge</th>
                            <th class="text-center" width="130">Filing Date</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th class="text-center" width="140">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="noResultsRow" style="display: none;">
                            <td colspan="8" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="bi bi-funnel" style="font-size: 40px; color: #bfc5d2;"></i>
                                    <p class="mt-2 mb-2" style="color:#555; font-size:15px;">
                                        No cases found matching your filters
                                    </p>
                                    <button id="clearFiltersBtn" class="btn btn-outline-secondary btn-sm">
                                        Clear Filters
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <?php foreach ($cases as $case): ?>
                        <tr>
                            <td class="text-center fw-semibold"><?= htmlspecialchars($case['case_number']); ?></td>
                            <td><?= typeBadge($case['case_type']); ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($case['case_title']); ?></td>

                            <td>
                                <?php if (!empty($case['judge_firstname'])): ?>
                                    <?= htmlspecialchars('Hon. ' . $case['judge_firstname'] . ' ' . $case['judge_lastname']); ?>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center"><?= htmlspecialchars($case['filing_date']); ?></td>
                            <td><?= statusBadge($case['status']); ?></td>
                            <td><?= priorityBadge($case['priority']); ?></td>

                            <td class="text-center">
                                <a href="case_view.php?case=<?= $case['case_number']; ?>" class="table-btn btn-view">View</a>
                                <a href="case_archive.php?case=<?= $case['case_number']; ?>" 
                                   class="table-btn btn-archive" 
                                   onclick="return confirm('Are you sure?')">
                                   <i class="bi bi-archive"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
