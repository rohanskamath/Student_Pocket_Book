<?php
session_start();

//if the admin is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    //Including books/Authors/Category functions and Database Connection file
    include "../connection.php";
    include "../adminphp/admindashboardFunctions.php";

    $branches=get_all_branches($conn);
    $apbooks=get_all_Approvedbooks($conn);
    $rjbooks=get_all_Rejectedbooks($conn);
    $penbooks=get_all_Pendingbooks($conn);
    $authors=get_all_authors($conn);
    $courses=get_all_courses($conn);
    $faculties=get_all_faculties($conn);
    $admin=get_all_admin($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Book Request</title>
    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
    <script src="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css"></script>
    <link rel="stylesheet" href="../assets/admindashboard.css">
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>
    <!-- Add Author Modal -->
    <?php
        include("addauthor.php");
    ?>
    <!-- End Author Modal -->
    <!-- Add Branch Modal -->
    <?php
        include("editbranches.php");
    ?>
    <!-- End Branch Modal -->
    <!-- Add Course Modal -->
    <?php
        include("addcourses.php");
    ?>
    <!-- End Course Modal -->
    <!-- changepassword Modal -->
    <?php
        include("changepassword.php");
    ?>
    <!-- End changepassword Modal -->
    <!-- Approval && Rejection Modal -->
    <?php
        include("approvalmodal.php");
        include("rejectmodal.php");
    ?>
    <!-- End Approval && Rejection Modal -->
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <a href="https://manipal.edu/mit.html" target="_blank"><img src="../img/new logo manipal black.png" alt="MAHE" title="Manipal University" class="manipal-logo"></a>
            </div>
                <div class="list-group list-group-flush my-3">
                    <a href="admindashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                            class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="bookapproval.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fa fa-check-circle me-2" data-toggle="modal"></i>Book Approvals</a>
                    <a href="addbooks.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fa fa-book me-2"></i>Add Books</a>
                    <button type="button" class="btn bg-transparent second-text fw-bold list-group-item list-group-item-action shadow-none" data-bs-toggle="modal" data-bs-target="#addcourses">
                                <i class="fas fa-chart-line me-2"></i>Add Courses</button>
                    <a href="addbranches.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-project-diagram me-2"></i>Add Branches</a>
                    <button type="button" class="btn bg-transparent second-text fw-bold list-group-item list-group-item-action shadow-none" data-bs-toggle="modal" data-bs-target="#addauthor">
                                    <i class="fas fa-paperclip me-2"></i>Add Author</button>
                    <button type="button" class="btn bg-transparent second-text fw-bold list-group-item list-group-item-action shadow-none" data-bs-toggle="modal" data-bs-target="#changepassword">
                            <i class="fa fa-key me-2"></i>Change Password</button>
                    <a href="adminlogout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                            class="fas fa-power-off me-2"></i>Logout</a>
                </div>
        </div>
        <!-- Sidebar Ends-->
        <!-- Header-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-dark py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left dashboard-text fs-4 me-3" id="menu-toggle"></i>
                    <a href="admindashboard.php" class="text-decoration-none"><h2 class="fs-2 m-0 dashboard-text">Dashboard</h2></a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <a class="nav-link fw-bold dashboard-text" href="#">
                            <i class="fas fa-user me-2 dashboard-text"></i><span class="text-light fw-bold">Hello!! <?php echo $_SESSION['user_name1']; ?></span>
                        </a>
                    </ul>
                </div>
            </nav>
            <!-- Header Ends-->
            <hr class="bg-white mt-3">
            <?php
                if(isset($_SESSION['success']) && $_SESSION['success']!='')
                {
                    echo '<div class="alert alert-success ms-5 me-5 alert-dismissible fade show" role="alert">
                    <strong>Sucess!!!!! </strong>'.$_SESSION['success'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    unset($_SESSION['success']);
                }
                if(isset($_SESSION['failed']) && $_SESSION['failed']!='')
                {
                    echo '<div class="alert alert-danger ms-5 me-5 alert-dismissible fade show" role="alert">
                    <strong>Failed!!!!! </strong>'.$_SESSION['failed'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    unset($_SESSION['failed']);
                }
                ?>
                <!--Dashboard Containers-->
                <!--Pending Request Section-->
                <?php 
                     if($penbooks==0)
                     { ?>
                        <div class="row mx-4 mt-5">
                            <h2 class="mb-2 mt-4 heading" id="allbooks">New Book Requests</h2>
                            <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">View All the Accepted/Rejected/Pending Books uploaded by Faculty</p>
                            <h2 class="mb-2 mt-5 heading">Pending Requests</h2>
                            <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">Accept/Reject Books for a particular Course</p>
                            <div class="alert alert-warning text-center" role="alert">
                                <img src="../img/empty.png" alt="Loading..." width="100"><br>There is no Pending Request
                            </div>
                        </div>
                <?php }
                      else
                      {
                ?>
                <div class="row mx-4 mt-5">
                    <h2 class="mb-2 mt-4 heading" id="allbooks">New Book Requests</h2>
                    <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">View All the Accepted/Rejected/Pending Books uploaded by Faculty</p>
                    <div class="col table-responsive-sm">
                        <h2 class="mb-2 mt-5 heading" id="allbooks">Pending Requests</h2>
                        <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">Accept/Reject Books for a particular Course</p>
                        <table class="table table-bordered bg-white table-striped rounded shadow-sm text-center" id="books">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">ISBN</th>
                                    <th scope="col">Book Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Branch</th>
                                    <th scope="col">Uploaded By</th>
                                    <th colspan="2" scope="col">Accept/Reject</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($penbooks as $pbook)
                                    { 
                                ?>
                                <tr>
                                    <td><?=$pbook['isbn']?></td>
                                    <td>
                                        <img width="100" src="../img/uploads/cover/<?=$pbook['cover']?>" alt="Book Cover Page" title="Book Cover Page">
                                        <a class="d-block text-decoration-none text-center" href="../img/uploads/files/<?=$pbook['file']?>" target="_blank"><?=$pbook['title']?></a>
                                    </td>
                                    <td>
                                        <?php
                                            if($authors==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($authors as $author)
                                                {
                                                    if($author['author_id']==$pbook['author_id'])
                                                    {
                                                        echo $author['author_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?=$pbook['description']?></td>
                                    <td>
                                        <?php
                                            if($courses==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($courses as $course)
                                                {
                                                    if($course['course_id']==$pbook['course_id'])
                                                    {
                                                        echo $course['course_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?=$pbook['semester']?></td>
                                    <td>
                                        <?php
                                            if($branches==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($branches as $branch)
                                                {
                                                    if($pbook['branch_id']==$branch['branch_id'])
                                                    {
                                                        echo $branch['branch_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($faculties==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($faculties as $faculty)
                                                {
                                                    if($pbook['faculty_id']==$faculty['id'])
                                                    {
                                                        echo $faculty['name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success ps-4 pe-4 shadow-none approvebooksbtn">Accept</a><br>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger shadow-none rejectbooksbtn">Reject</button>
                                    </td>
                                    <td><?=$pbook['status']?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                }
                ?>
                <!--Pending Section Ends-->
                <hr class="bg-white mt-3">
                <!--Approved Request Section-->
                <?php 
                     if($apbooks==0)
                     { ?>
                        <div class="row mx-4 mt-5">
                            <h2 class="mb-4 mt-2 heading">Approved Requests</h2>
                            <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">View all Approved Books for a particular Course in this section</p>
                            <div class="alert alert-warning text-center" role="alert">
                                <img src="../img/empty.png" alt="Loading..." width="100"><br>There is no Approved Request
                            </div>
                        </div>
                <?php }
                      else
                      {
                ?>
                <div class="row mx-4 mt-5">
                    <h2 class="mb-2 mt-2 heading">Approved Requests</h2>
                    <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">View all Approved Books for a particular Course in this section</p>
                    <div class="col table-responsive-sm">
                        <table class="table table-bordered bg-white table-striped rounded shadow-sm text-center" id="books">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">ISBN</th>
                                    <th scope="col">Book Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Branch</th>
                                    <th scope="col">Uploaded By</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($apbooks as $abook)
                                    { 
                                ?>
                                <tr>
                                    <td><?=$abook['isbn']?></td>
                                    <td>
                                        <img width="100" src="../img/uploads/cover/<?=$abook['cover']?>" alt="Book Cover Page" title="Book Cover Page">
                                        <a class="d-block text-decoration-none text-center" href="../img/uploads/files/<?=$abook['file']?>" target="_blank"><?=$abook['title']?></a>
                                    </td>
                                    <td>
                                        <?php
                                            if($authors==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($authors as $author)
                                                {
                                                    if($author['author_id']==$abook['author_id'])
                                                    {
                                                        echo $author['author_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?=$abook['description']?></td>
                                    <td>
                                        <?php
                                            if($courses==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($courses as $course)
                                                {
                                                    if($course['course_id']==$abook['course_id'])
                                                    {
                                                        echo $course['course_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?=$abook['semester']?></td>
                                    <td>
                                        <?php
                                            if($branches==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($branches as $branch)
                                                {
                                                    if($abook['branch_id']==$branch['branch_id'])
                                                    {
                                                        echo $branch['branch_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($faculties==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($admin as $ad)
                                                {
                                                    if($abook['admin_id']==$ad['id'])
                                                    {
                                                        echo $ad['full_name'];
                                                    }
                                                }
                                                foreach ($faculties as $faculty)
                                                {
                                                    if($abook['faculty_id']==$faculty['id'])
                                                    {
                                                        echo $faculty['name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?=$abook['status']?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    }
                ?>
                <!--Approved Request Section Ends-->
                <hr class="bg-white mt-3">
                <?php 
                     if($rjbooks==0)
                     { ?>
                        <div class="row mx-4 mt-5">
                            <h2 class="mb-4 mt-2 heading">Rejected Requests</h2>
                            <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">View all Rejected Books for a particular Course in this section</p>
                            <div class="alert alert-warning text-center" role="alert">
                                <img src="../img/empty.png" alt="Loading..." width="100"><br>There is no Rejected Request
                            </div>
                        </div>
                <?php }
                      else
                      {
                ?>
                <!--Rejected Request Section-->
                <div class="row mx-4 mt-5">
                    <h2 class="mb-4 mt-2 heading">Rejected Requests</h2>
                    <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">View all Rejected Books for a particular Course in this section</p>
                    <div class="col table-responsive-sm">
                        <table class="table table-bordered bg-white table-striped rounded shadow-sm text-center" id="books">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">ISBN</th>
                                    <th scope="col">Book Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Branch</th>
                                    <th scope="col">Uploaded By</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($rjbooks as $rbook)
                                    { 
                                ?>
                                <tr>
                                    <td><?=$rbook['isbn']?></td>
                                    <td>
                                        <img width="100" src="../img/uploads/cover/<?=$rbook['cover']?>" alt="Book Cover Page" title="Book Cover Page">
                                        <a class="d-block text-decoration-none text-center" href="../img/uploads/files/<?=$rbook['file']?>" target="_blank"><?=$rbook['title']?></a>
                                    </td>
                                    <td>
                                        <?php
                                            if($authors==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($authors as $author)
                                                {
                                                    if($author['author_id']==$rbook['author_id'])
                                                    {
                                                        echo $author['author_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?=$rbook['description']?></td>
                                    <td>
                                        <?php
                                            if($courses==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($courses as $course)
                                                {
                                                    if($course['course_id']==$rbook['course_id'])
                                                    {
                                                        echo $course['course_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?=$rbook['semester']?></td>
                                    <td>
                                        <?php
                                            if($branches==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($branches as $branch)
                                                {
                                                    if($rbook['branch_id']==$branch['branch_id'])
                                                    {
                                                        echo $branch['branch_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($faculties==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($faculties as $faculty)
                                                {
                                                    if($rbook['faculty_id']==$faculty['id'])
                                                    {
                                                        echo $faculty['name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?=$rbook['status']?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                 }
                ?>
                <!--Reject Request Section Ends-->
            </div>
        </div><!--Page Content Wrapper Ends-->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>      
    <script>
        /** Transition of Admin Left Navigation Menu**/
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
        </script>
        <script>
        //Approve Books request from table
        $(document).ready(function (){
            $('.approvebooksbtn').on('click',function(){
                $('#approvebooks').modal('show');

                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                $('#approve_bkid').val(data[0]);
            });
        });
        //Reject Books request from table
        $(document).ready(function (){
            $('.rejectbooksbtn').on('click',function(){
                $('#rejectbooks').modal('show');

                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                $('#reject_bkid').val(data[0]);
            });
        });
    </script>
</body>
</html>
<?php
}
else
{
    header("location: ../admin/adminlogin.php");
    exit();
}
?>