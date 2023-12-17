<!-- Add Author Modal -->
    <div class="modal fade" id="addauthor" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add New Author</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../adminphp/addauthor.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="author" class="form-label">Authors Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control shadow-none" id="author" name="author_name" placeholder="Enter authors name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary shadow-none">Add Author</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- End Author Modal -->