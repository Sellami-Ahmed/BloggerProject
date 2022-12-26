<?php
$isAdmin = "";
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once __DIR__ . "\..\controller\UserC.php";
    $isAdmin = isAdmin($_GET["id"]);
}
?>
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/../controller/EditUserC.php?id=" method="POST" enctype="multipart/form-data">
                <div class="modal-body mx-3">
                    <div class="form-group">
                        <label>Post Title:</label>
                        <input required type="text" class="form-control " name="isAdmin" value="<?php echo $isAdmin; ?>">
                    </div>


                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="id">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>