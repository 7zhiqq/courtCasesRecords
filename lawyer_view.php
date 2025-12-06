<?php
    require_once 'include/config.php';
    include 'include/head.php';
    include 'include/header.php';
    require_once 'include/functions.php';

    if (isset($_GET['id'])){
        $lawyer_id = mysqli_real_escape_string($conn, $_GET['id']); 

        $query = "SELECT * 
                  FROM lawyer_tbl 
                  WHERE lawyer_id = '$lawyer_id'";
        $result = mysqli_query($conn, $query);
        $lawyer = mysqli_fetch_assoc($result); 

        if (!$lawyer) {
            header("Location: lawyers_page.php");
            exit();
        }
    } else {
        header("Location: lawyers_page.php");
        exit();
    }
?>
<div class="layout d-flex">
    <?php include 'include/sidebar.php'; ?>

    <div class="main-content p-4">

        <!-- Lawyer Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            
            <div>
                <h4 class="fw-semibold mb-1">
                    <?php echo htmlspecialchars('Atty. ' . $lawyer['lawyer_firstname'] . ' ' . $lawyer['lawyer_lastname']); ?>
                </h4>
                <small class="text-muted fs-6 d-flex align-items-center gap-3 mt-1">
                    <span>
                        <i class="bi bi-person-square"></i> 
                        <?php echo htmlspecialchars($lawyer['lawyer_id']); ?>
                    </span>
                    <span>
                        <i class="bi bi-envelope-at"></i>
                        <?php echo htmlspecialchars($lawyer['lawyer_email']); ?>
                    </span>
                </small>
            </div>

            <div class="d-flex gap-2 mt-3 mt-md-0">
                <a href="lawyer_delete.php?id=<?= urlencode($lawyer['lawyer_id']) ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this lawyer?');">
                    <i class="bi bi-trash"></i>
                </a>

                <a href="cases.php" class="btn btn-warning btn-sm">
                    <i class="bi bi-archive"></i>
                </a>

                <button class="btn btn-primary btn-sm editLawyerBtn" data-lawyer-id="<?= $lawyer['lawyer_id']; ?>">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>

                <a href="lawyers.php" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            </div>
        </div>

        <hr>
        <div class="mt-4">
            <p class="fw-semibold">
                Parties Represented
            </p>

            <?php include 'include/queries/case_query.php'; ?>

            <?php if (count($cases_data) > 0): ?>
                
                <?php foreach ($cases_data as $case_id => $case_info): ?>

                    <div class="shadow-sm mb-4">
                        <div class="card-body">
                            <table class="table table-sm table-borderless align-middle">
                                <tbody>
                                    <?php foreach ($case_info['parties'] as $party): ?>
                                        <tr>
                                            <td width="35%">
                                                <strong><?= htmlspecialchars($case_id) ?></strong>
                                            </td>
                                            <td width="35%">
                                                <strong><?= htmlspecialchars($party['party_name']); ?></strong>
                                            </td>
                                            <td width="20%">
                                                <span class="badge bg-info">
                                                    <?= htmlspecialchars($party['party_type']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small>
                                                    <div><?= htmlspecialchars($party['phone']); ?></div>
                                                    <div><?= htmlspecialchars($party['email']); ?></div>
                                                </small>
                                            </td>
                                            <td>
                                                <a href="case_view.php?case=<?= urlencode($case_id); ?>" 
                                                    class="btn btn-sm btn-primary">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="alert alert-info">
                    No cases assigned yet.
                </div>

            <?php endif; ?>

        </div>

    </div>
</div>

<?php include 'lawyer_edit.php'; ?>
