<!-- Edit Course Modal -->
    <div class="modal fade" id="editcourses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Edit Course</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../adminphp/updatecourse.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="update_cid" id="update_cid">
                        <div class="mb-3">
                            <label for="cname" class="form-label">Course name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control shadow-none" id="updatecname" name="updatecname" placeholder="Enter course name" autofocus required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary shadow-none" name="updatecoursedata">Update Course</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Edit Course Modal Ends-->
<!-- Delete Course Modal -->
    <div class="modal fade" id="deletecourses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Delete Course</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../adminphp/deletecourses.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="delete_cid" id="delete_cid">
                        <p class="text-danger">Corresponding Books as well as Branches related to this course will also get deleted and cannot be recovered!!!!</p>
                        <h5>Do you still want to Delete this Data??</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger shadow-none" name="deletecoursedata">Yes!! Delete it</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Delete Course Modal Ends-->