<?php
    require_once 'include/config.php';
    include 'include/head.php';
    include 'include/header.php';
    require_once 'include/functions.php';

    if (isset($_GET['id'])){
        $judge_id = mysqli_real_escape_string($conn, $_GET['id']); 

        $query = "SELECT * 
                  FROM judge_tbl 
                  WHERE judge_id = '$judge_id'";
        $result = mysqli_query($conn, $query);
        $judge = mysqli_fetch_assoc($result); 

        if (!$judge) {
            header("Location: judges_page.php");
            exit();
        }
    } else {
        header("Location: judges_page.php");
        exit();
    }

    $case_query = "SELECT case_number, case_title, case_type, status
                   FROM case_tbl
                   WHERE judge_id = '$judge_id'";
    $case_result = mysqli_query($conn, $case_query);
    $assigned_cases = mysqli_fetch_all($case_result, MYSQLI_ASSOC);
?>


<div class="layout d-flex">
    <?php include 'include/sidebar.php'; ?>
    <div class="main-content">
        <div class="d-flex flex-column flex-md-row align-items-md-center mb-2 pb-3">
            <div class="card-header">
                <h5 class="fw-semibold mb-1 d-flex align-items-center gap-2 flex-wrap">
                    <?php echo htmlspecialchars('Hon. ' . $judge['judge_firstname'] . ' ' . $judge['judge_lastname']); ?>
                </h5>
                <small class="text-muted fs-6">
                    <i class="bi bi-person-square"></i>
                        <?php echo htmlspecialchars($judge['judge_id']); ?>
                    <i class="bi bi-envelope-at"></i>
                        <?php echo htmlspecialchars($judge['judge_email']); ?>
                </small>
            </div>

            <div class="text-md-end mt-3 mt-md-0 d-flex gap-2 ms-md-auto">
                <button class="btn btn-primary btn-sm btn-edit">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>

                <a href="judges.php" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            </div>
        </div>
        <hr>
        <div class="card-body mt-0">
            <p class="fw-semibold">
                Cases Assigned:
            </p>
            <ul class="list-group mb-3">
                <?php if (empty($assigned_cases)): ?>
                    <li class="list-group-item text-muted">No cases assigned.</li>
                <?php else: ?>
                    <?php foreach ($assigned_cases as $case): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <strong><?= htmlspecialchars($case['case_number']); ?></strong>
                                <?= typeBadge($case['case_type']); ?>
                                <?= statusBadge($case['status']); ?><br>
                                <div><?= htmlspecialchars($case['case_title']); ?></div>
                            </div>
                            <a href="case_view.php?case=<?= urlencode($case['case_number']); ?>" class="btn btn-sm btn-primary">
                                View
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <!-- <a href="judge_edit.php?id=<?= $judge['judge_id']; ?>" class="btn btn-warning">Edit</a>
            <a href="judge_archive.php?id=<?= $judge['judge_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Archive</a>
            <a href="judges_page.php" class="btn btn-secondary">Back to List</a> -->
        </div>
    </div>
</div>

