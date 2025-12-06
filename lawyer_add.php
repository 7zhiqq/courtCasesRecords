<?php     
    require_once 'include/config.php';    
    include 'include/head.php' ;
?>

<div id="addLawyerModal" class="modal" >
    <div class="modal-content" style="width:450px">
        <span class="close">
            <i class="h3 bi bi-x"></i>
        </span>
        <div class="modal-header">
            <h5 class="modal-title" id="addCaseModalLabel">
                <i class="bi bi-person-plus"></i> 
                Add Judge
            </h5>
        </div>
        <form action="lawyer_add_success.php" method="POST" class="form-modal">
            <div class="row mb-2">
                <div class="col-md-12">
                    <label class="form-label fw-bold">First Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="first_name" placeholder="Lawyer First Name" required>
                </div>
            </div> 
            <div class="row mb-2">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Last Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="last_name" placeholder="Lawyer Last Name" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Lawyer Email" required>
                </div>
            </div>     
            <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-secondary btn-sm">Clear</button>
                <button type="submit" class="btn btn-primary btn-sm" name="addLawyer">Submit</button>
            </div>
        </form>
    </div>
</div>
