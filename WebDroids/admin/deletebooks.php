<!-- Delete Books Modal -->
    <div class="modal fade" id="deletebooks" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Delete Course</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../adminphp/deletebooks.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="delete_bkid" id="delete_bkid">
                        <p class="text-danger">This Book will get deleted and cannot be recovered!!!!</p>
                        <h5>Do you still want to Delete this Data??</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger shadow-none" name="deletebooksdata">Yes!! Delete it</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Delete Books Modal Ends-->