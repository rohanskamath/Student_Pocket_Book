<?php
session_start();

//if the admin is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    //Including books/Authors/Category functions and Database Connection file
    include "../connection.php";
    include "../adminphp/admindashboardFunctions.php";

    $courses=get_all_courses($conn);

    if(isset($_GET['course_id']))
    {
        $courses=$_GET['course_id'];
    }
    else
    {
        $course_id=0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Branches</title>
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
        include("addcourses.php");
    ?>
    <!-- End Branch Modal -->
    <!-- changepassword Modal -->
    <?php
        include("changepassword.php");
        include("deletebooks.php");
    ?>
    <!-- End changepassword Modal -->
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
            <!--Dashboard Containers-->
            <div class="row">
                <div class="mx-auto col-10 col-md-8 col-lg-6 mb-5">
                    <form action="../adminphp/addbranch.php" method="post" enctype="multipart/form-data" class="shadow bg-light p-4 rounded mt-3" style="width: 90%; max-width: 50rem;">
                        <h1 class="text-center pb-3 display-4 fs-3 fw-bold">Add New Branch</h1>
                        <?php if (isset($_GET['error'])){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?=htmlspecialchars($_GET['error']);?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])){ ?>
                            <div class="alert alert-success" role="alert">
                                <?=htmlspecialchars($_GET['success']);?>
                            </div>
                        <?php } ?>
                        <div class="form-group mt-3">
                            <label for="book_courses">Select Course <span style="color: red;">*</span></label>
                            <select id="book_courses" name="book_courses" class="form-control shadow-none">
                                <option  value="0">--- Select Course ---</option>
                                <?php
                                    foreach ($courses as $course)
                                    {
                                        if($course_id==$course['course_id'])
                                        {
                                ?>
                                    <option value="<?php echo $course['course_id']?>">
                                        <?=$course['course_name']?>
                                    </option>
                                <?php   }
                                        else
                                        {
                                ?>
                                    <option value="<?php echo $course['course_id']?>">
                                        <?=$course['course_name']?>
                                    </option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="bdescription">New Branch <span style="color: red;">*</span></label>
                            <input type="text" class="form-control shadow-none" id="branch" name="branch" placeholder="Enter new branch name">
                        </div>
                        <div class="form-group mt-3 modal-footer justify-content-center">
                            <table>
                                <tr>
                                    <td class="pe-5"><button type="submit" class="btn btn-outline-primary shadow-none">Add branch</button></td>
                                    <td><a href="viewbranches.php" class="btn btn-outline-danger shadow-none" role="button" aria-pressed="true">View Branches</a></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--Dashboard Container Ends-->
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