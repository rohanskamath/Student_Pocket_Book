<!-- Add Course Modal -->
    <div class="modal fade" id="addcourses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Course</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../adminphp/addcourse.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cname" class="form-label">Course name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control shadow-none" id="cname" name="course_name" placeholder="Enter course name" autofocus required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary shadow-none">Add Course</button>
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- End Course Modal -->