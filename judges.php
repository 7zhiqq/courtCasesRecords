<?php
    require_once 'include/config.php';
    include 'include/head.php';
    include 'include/header.php';

    $query = "SELECT * 
              FROM judge_tbl";
    $result = mysqli_query($conn, $query);
    $judges = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php if (isset($_GET['status'])): ?>
    <div class="status-toast <?= $_GET['status'] === 'success' ? 'success' : 'error' ?>">
        <span class="close-toast"><i class="bi bi-x"></i></span>

        <?php if ($_GET['status'] === 'success'): ?>

            <?php if (isset($_GET['editstatus']) && $_GET['editstatus'] === 'success'): ?>
                <i class="bi bi-check-circle-fill icon"></i>
                <div>
                    <strong>Success</strong>
                    <p>Judge edited successfully.</p>
                </div>
            <?php else: ?>
                <i class="bi bi-check-circle-fill icon"></i>
                <div>
                    <strong>Success</strong>
                    <p>Judge added successfully.</p>
                </div>
            <?php endif; ?>

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
                <h5 class="fw-semibold mb-1">Judge</h5>
                <p class="text-muted mb-0">View and track all judges</p>
            </div>

            <button class="btn btn-primary btn-sm" id="addJudgeBtn">
                <i class="bi bi-person-plus"></i> 
                Add Judge
            </button>
        </div>

        <div class="mt-4">
            <?php if (count($judges) > 0): ?>
                <table class="table table-striped table-hover align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Judge ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-center" width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($judges as $judge): ?>
                            <tr>
                                <td><?= htmlspecialchars($judge['judge_id']); ?></td>
                                <td><?= htmlspecialchars('Hon. ' . $judge['judge_firstname'] . ' ' . $judge['judge_lastname']); ?></td>
                                <td><?= htmlspecialchars($judge['judge_email']); ?></td>
                                <td class="text-center">
                                    <a href="judge_view.php?id=<?= urlencode($judge['judge_id']); ?>" 
                                    class="btn btn-sm btn-primary">
                                        View
                                    </a>

                                    <button class="btn btn-warning btn-sm editJudgeBtn" data-judge-id="<?= $judge['judge_id']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <a href="judge_archive.php?id=<?= urlencode($judge['judge_id']); ?>" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to archive this judge?');">
                                        <i class="bi bi-archive"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">No judge found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'judge_add.php'; ?>
<?php include 'judge_edit.php'; ?>

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
    

