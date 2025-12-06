<?php     
    require_once 'include/config.php';    
    include 'include/head.php' ;

    $query = "SELECT * 
              FROM judge_tbl";
    $result = mysqli_query($conn, $query);
    $judges = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php foreach ($judges as $judge): ?>
    <div id="editJudgeModal-<?= $judge['judge_id'] ?>" class="modal">
        <div class="modal-content" style="width:450px">
            <span class="close">
                <i class="h3 bi bi-x"></i>
            </span>
            <div class="modal-header">
                <h5 class="modal-title" id="addCaseModalLabel">
                    <i class="bi bi-pencil-square"></i> 
                    Edit Judge
                </h5>
            </div>
            <form action="judge_edit_success.php" method="POST" class="form-modal">
                <input type="hidden" name="judge_id" value="<?= htmlspecialchars($judge['judge_id']) ?>">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">First Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="first_name" value="<?= htmlspecialchars($judge['judge_firstname']) ?>">
                    </div>
                </div> 
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Last Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="last_name" value="<?= htmlspecialchars($judge['judge_lastname']) ?>">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($judge['judge_email']) ?>">
                    </div>
                </div>     
                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-secondary btn-sm">Clear</button>
                    <button type="submit" class="btn btn-primary btn-sm" name="updateJudge">Submit</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach ?>

<link rel="stylesheet" href="css/modal.css">
<script src="js/modal_edit_judge.js"></script>