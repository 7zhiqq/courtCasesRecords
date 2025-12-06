<?php
    require_once 'include/config.php';
    include 'include/head.php';
    include 'include/header.php';
    include 'include/functions.php';

    include 'include/queries/case_counts.php';

    $query_open_pending = "SELECT c.*, j.judge_firstname, j.judge_lastname
                        FROM case_tbl c
                        LEFT JOIN judge_tbl j ON c.judge_id = j.judge_id
                        WHERE c.status IN ('Open', 'Pending')";
    $result_open_pending = mysqli_query($conn, $query_open_pending);
    $open_pending_cases = mysqli_fetch_all($result_open_pending, MYSQLI_ASSOC);

    $query_high_priority = "SELECT c.*, j.judge_firstname, j.judge_lastname
                            FROM case_tbl c
                            LEFT JOIN judge_tbl j ON c.judge_id = j.judge_id
                            WHERE c.priority = 'High'";
    $result_high_priority = mysqli_query($conn, $query_high_priority);
    $high_priority_cases = mysqli_fetch_all($result_high_priority, MYSQLI_ASSOC);
?>

<div class="layout d-flex">
    <?php include 'include/sidebar.php'; ?>

    <div class="main-content w-100">
        <h5 class="fw-semibold">Dashboard Overview</h5>
        <p class="text-muted">
            Welcome back! Here's what's happening with your cases.
        </p>

        <div class="row g-3 mt-2">
            <?php include 'include/case_summary.php'; ?>
        </div>

        <div class="row mt-1 g-4">
            <div class="col-md-6">
                <h6 class="fw-semibold">Open & Pending Cases</h6>
                <table class="table table-hover align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Case ID</th>
                            <th class="text-center">Type</th>
                            <th>Case Title</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($open_pending_cases) === 0): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                No Open or Pending cases found.
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($open_pending_cases as $case): ?>
                        <tr>
                            <td class="text-center fw-semibold"><?= htmlspecialchars($case['case_number']); ?></td>
                            <td class="text-center"><?= typeBadge($case['case_type']); ?></td>
                            <td>
                                <a href="case_view.php?case=<?= urlencode($case['case_number']); ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($case['case_title']); ?>
                                </a>
                            </td>
                            <td><?= statusBadge($case['status']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <h6 class="fw-semibold">High Priority Cases</h6>
                <table class="table table-hover align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Case ID</th>
                            <th class="text-center">Type</th>
                            <th>Case Title</th>
                            <th>Priority</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($high_priority_cases) === 0): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                No High Priority cases found.
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($high_priority_cases as $case): ?>
                        <tr>
                            <td class="text-center fw-semibold"><?= htmlspecialchars($case['case_number']); ?></td>
                            <td class="text-center"><?= typeBadge($case['case_type']); ?></td>
                            <td>
                                <a href="case_view.php?case=<?= urlencode($case['case_number']); ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($case['case_title']); ?>
                                </a>
                            </td>
                            <td><?= priorityBadge($case['priority']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
