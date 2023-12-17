<!-- Change Password Modal -->
    <div class="modal fade" id="changepassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Change your Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="php/changepasswordauth.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="oldpass" class="form-label mt-3">Current password <span style="color:red">*</span></label>
                            <input type="password" class="form-control shadow-none" id="oldpass" name="oldpass" autofocus placeholder="Enter current password" required>
                            <label for="newpass" class="form-label mt-3">New password <span style="color:red">*</span></label>
                            <input type="password" class="form-control shadow-none" id="newpass" name="newpass" placeholder="Enter new password" required>
                            <label for="cpass" class="form-label mt-3">Confirm password <span style="color:red">*</span></label>
                            <input type="password" class="form-control shadow-none" id="cpass" name="cpass" placeholder="Enter confirm password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary shadow-none">Update Password</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- End Change Password Modal -->