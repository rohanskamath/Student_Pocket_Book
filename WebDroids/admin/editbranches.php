<!-- Edit brbranches Modal -->
    <div class="modal fade" id="editbranches" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Edit Branch</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../adminphp/updatebranch.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="update_bid" id="update_bid">
                        <div class="mb-3">
                            <label for="updatecname" class="form-label">Course name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control shadow-none" id="updatecname" name="updatecname" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="updatebname" class="form-label">Branch name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control shadow-none" id="updatebname" name="updatebname" placeholder="Enter branch name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary shadow-none" name="updatebranchdata">Update branch</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Edit branches Modal Ends-->
<!-- Delete branches Modal-->
    <div class="modal fade" id="deletebranches" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Delete Branch</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../adminphp/deletebranches.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="delete_bid" id="delete_bid">
                        <p class="text-danger">This Branch will get deleted and cannot be recovered!!!!</p>
                        <h5>Do you still want to Delete this Data??</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger shadow-none" name="deletebranchdata">Yes!! Delete it</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Delete branches Modal Ends-->