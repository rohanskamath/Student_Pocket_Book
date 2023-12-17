<!-- Delete Books Modal -->
    <div class="modal fade" id="approvebooks" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Approve New Book Request</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../adminphp/bookapprove.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="approve_bkid" id="approve_bkid">
                        <p class="text-success">This Book will be Approved and store in Inventory!!!</p>
                        <h5>Do you still want to accept this request??</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success shadow-none" name="approvebooksdata">Yes!! Accept it</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Delete Books Modal Ends-->