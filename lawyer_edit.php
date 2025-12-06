<?php     
    require_once 'include/config.php';    
    include 'include/head.php' ;

    $query = "SELECT * 
              FROM lawyer_tbl";
    $result = mysqli_query($conn, $query);
    $lawyers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php foreach ($lawyers as $lawyer): ?>
    <div id="editLawyerModal-<?= $lawyer['lawyer_id'] ?>" class="modal">
        <div class="modal-content" style="width:450px">
            <span class="close">
                <i class="h3 bi bi-x"></i>
            </span>
            <div class="modal-header">
                <h5 class="modal-title" id="addCaseModalLabel">
                    <i class="bi bi-pencil-square"></i> 
                    Edit Lawyer
                </h5>
            </div>
            <form action="lawyer_edit_success.php" method="POST" class="form-modal">
                <input type="hidden" name="lawyer_id" value="<?= htmlspecialchars($lawyer['lawyer_id']) ?>">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">First Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="first_name" value="<?= htmlspecialchars($lawyer['lawyer_firstname']) ?>">
                    </div>
                </div> 
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Last Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="last_name" value="<?= htmlspecialchars($lawyer['lawyer_lastname']) ?>">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($lawyer['lawyer_email']) ?>">
                    </div>
                </div>     
                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-secondary btn-sm">Clear</button>
                    <button type="submit" class="btn btn-primary btn-sm" name="updateLawyer">Submit</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach ?>

<link rel="stylesheet" href="css/modal.css">
<script src="js/modal_edit_lawyer.js"></script>