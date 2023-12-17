<!-- Edit Author Modal -->
    <div class="modal fade" id="editauthors" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Edit Authors</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../adminphp/updateauthor.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="update_aid" id="update_aid">
                        <div class="mb-3">
                            <label for="cname" class="form-label">Author name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control shadow-none" id="updateauthor" name="updateauthor" placeholder="Enter authors name" autofocus required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary shadow-none" name="updateauthordata">Update Author</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Edit Author Modal Ends-->