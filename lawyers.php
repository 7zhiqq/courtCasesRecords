<?php
    require_once 'include/config.php';
    include 'include/head.php';
    include 'include/header.php';

    $query = "SELECT * 
              FROM lawyer_tbl";
    $result = mysqli_query($conn, $query);
    $lawyers = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                <p>Lawyer added successfully.</p>
            </div>

        <?php elseif ($_GET['status'] === 'deleted'): ?>
            <i class="bi bi-trash3-fill icon"></i>
            <div>
                <strong>Deleted</strong>
                <p>Lawyer deleted successfully.</p>
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-semibold mb-1">Lawyer</h5>
                <p class="text-muted mb-0">View and track all lwayers</p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button class="table-btn btn btn-primary btn-sm" style="width: 175px;height:36px">
                    <i class="bi bi-person-plus"></i> Add Lawyer
                </button>
                <div class="search-input position-relative">
                    <i class="bi bi-search position-absolute" 
                    style="color:#7a7a7a; top: 50%; left: 10px; transform: translateY(-50%);"></i>
                    <input type="text" class="form-control" 
                        placeholder="Search lawyer by name, id..." 
                        style="border: 1px solid #7a7a7a; border-radius: 5px; width: 220px; height: 36px; padding-left: 30px;margin-right:-50px">
                </div>
            </div>
        </div>

        <div class="mt-4">
            <?php if (count($lawyers) > 0): ?>
                <table class="table table-striped table-hover align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Lawyer ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-center" width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lawyers as $lawyer): ?>
                            <tr>
                                <td><?= htmlspecialchars($lawyer['lawyer_id']); ?></td>
                                <td><?= htmlspecialchars('Hon. ' . $lawyer['lawyer_firstname'] . ' ' . $lawyer['lawyer_lastname']); ?></td>
                                <td><?= htmlspecialchars($lawyer['lawyer_email']); ?></td>
                                <td class="text-center">
                                    <a href="lawyer_view.php?id=<?= urlencode($lawyer['lawyer_id']); ?>" 
                                    class="table-btn btn-view">
                                        View
                                    </a>

                                    <button class="table-btn btn btn-primary btn-sm editLawyerBtn" data-lawyer-id="<?= $lawyer['lawyer_id']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">No lawyer found.</div>
            <?php endif; ?>
        </div>
        <script src="js/lawyer_search.js"></script>
    </div>
</div>

<?php include 'lawyer_add.php'; ?>
<?php include 'lawyer_edit.php'; ?>

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
    

