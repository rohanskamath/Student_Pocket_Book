<?php
session_start();

//if the faculty is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    //Including books/Authors/Category functions and Database Connection file
    include "../connection.php";
    include "../facultyphp/facultydashboardFunctions.php";

    $books=get_all_books($conn,$_SESSION['user_id']);
    $authors=get_all_authors($conn);
    $courses=get_all_courses($conn);
    $branches=get_all_branches($conn);
    $faculties=get_all_faculties($conn);
    $admin=get_all_admin($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
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
        include("editauthors.php");
    ?>
    <!-- End Author Modal -->
    <!-- changepassword Modal -->
    <?php
        include("changepassword.php");
    ?>
    <!-- End changepassword Modal -->
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <a href="https://manipal.edu/mit.html" target="_blank"><img src="../img/new logo manipal black.png" alt="MAHE" title="Manipal University" class="manipal-logo"></a>
            </div>
                <div class="list-group list-group-flush my-3">
                    <a href="facultydashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                            class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <button type="button" class="btn bg-transparent second-text fw-bold list-group-item list-group-item-action shadow-none" data-bs-toggle="modal" data-bs-target="#addauthor">
                            <i class="fas fa-paperclip me-2"></i>Add Author</button>
                    <a href="addbooks.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fa fa-book me-2"></i>Add Books</a>
                    <a href="facultyprofile.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-user me-2" data-toggle="modal"></i>My Profile</a>
                    <button type="button" class="btn bg-transparent second-text fw-bold list-group-item list-group-item-action shadow-none" data-bs-toggle="modal" data-bs-target="#changepassword">
                            <i class="fa fa-key me-2"></i>Change Password</button>
                    <a href="facultylogout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                            class="fas fa-power-off me-2"></i>Logout</a>
                </div>
            </div>
            <!-- Sidebar Ends-->
            <!-- Header-->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-dark py-4 px-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left dashboard-text fs-4 me-3" id="menu-toggle"></i>
                        <a href="facultydashboard.php" class="text-decoration-none"><h2 class="fs-2 m-0 dashboard-text">Dashboard</h2></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!--Search bar-->
                        <div class="col-md-6 col-lg-6 col-11 mx-auto myauto search-box">
                            <form action="facultysearch.php" method="get">
                                <div class="input-group form-container">
                                <input type="text" name="search" class="form-control search-input" placeholder="Search books by Title, Author, Course, Branch" autofocus="autofocus" autocomplete="off">
                                    <button class="input-group-textbtn btn btn-primary shadow-none"><img src="../img/search.png" width="21"></button>
                                </div>
                            </form>
                        </div>
                    <!--Search bar Ends-->
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                            <a class="nav-link fw-bold dashboard-text" href="facultyprofile.php">
                                <i class="fas fa-user me-2 dashboard-text"></i><span class="text-light fw-bold">Hello!! <?php echo $_SESSION['user_name2']; ?> </span>
                            </a>
                        </ul>
                    </div>
                </nav>
                <!-- Header Ends-->
                <!--Dashboard Containers-->
                <div class="container-fluid px-4">
                    <div class="row g-3 my-2">
                        <div class="col-md-3 mt-5 ml-5">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <a href="#allbooks" class="dashboard-link">All Books</a>
                                </div>
                                <i class="fa fa-book fs-1 border rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mt-5 ml-5">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <a href="#courses" class="dashboard-link">Courses</a>
                                </div>
                                <i class="fas fa-chart-line fs-1 border rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mt-5 ml-5">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <a href="#authors" class="dashboard-link">Authors</a>
                                </div>
                                <i class="fas fa-user fs-1 border rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mt-5 ml-5">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <a href="#branches" class="dashboard-link">Branches</a>
                                    </div>
                                    <i class="fas fa-project-diagram fs-1 border rounded-full secondary-bg p-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-white mt-5">
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
                    <!--All Books Section-->
                    <?php 
                        if($books==0)
                        { ?>
                            <div class="row mx-4 mt-5">
                                <h2 class="mb-2 mt-4 heading" id="allbooks">Books Overview</h2>
                                <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">Books which are uploaded by you</p>
                                <div class="alert alert-warning text-center" role="alert">
                                    <img src="../img/empty.png" alt="Loading..." width="100"><br>There is no Books in Database
                                </div>
                            </div>
                    <?php }
                        else
                        {
                    ?>
                    <div class="row mx-4 mt-5">
                        <h2 class="mb-2 mt-4 heading" id="allbooks">Books Overview</h2>
                        <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">Books which are uploaded by you</p>
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
                                        <th scope="col">Edit</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($books as $book)
                                        { 
                                    ?>
                                    <tr>
                                        <td><?=$book['isbn']?></td>
                                        <td>
                                            <img width="100" src="../img/uploads/cover/<?=$book['cover']?>" alt="Book Cover Page" title="Book Cover Page">
                                            <a class="d-block text-decoration-none text-center" href="../img/uploads/files/<?=$book['file']?>" target="_blank"><?=$book['title']?></a>
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
                                                        if($author['author_id']==$book['author_id'])
                                                        {
                                                            echo $author['author_name'];
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td><?=$book['description']?></td>
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
                                                        if($course['course_id']==$book['course_id'])
                                                        {
                                                            echo $course['course_name'];
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td><?=$book['semester']?></td>
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
                                                    if($book['branch_id']==$branch['branch_id'])
                                                    {
                                                        echo $branch['branch_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                        <td>
                                            <a href="editbooks.php?id=<?=$book['id']?>" class="btn btn-outline-warning text-dark ps-4 pe-4 shadow-none">Edit</a><br>
                                        </td>
                                        <td><?=$book['status']?></td>
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
                    <!--End of All Books Section-->
                    <hr class="bg-white mt-5">
                    <!--Authors Section-->
                    <?php 
                        if($authors==0)
                        {?>
                            <div class="row mx-4 mt-5">
                                <h2 class="mb-2 mt-4 heading" id="allbooks">Authors of the Books</h2>
                                <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">List of Authors who have published their books</p>
                                <div class="alert alert-warning text-center" role="alert">
                                    <img src="../img/empty.png" alt="Loading..." width="100"><br>There is no Authors in Database
                                </div>
                            </div>
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="row mx-4 mt-5">
                        <h2 class="mb-2 mt-4 heading" id="authors">Authors of the Books</h2>
                        <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">List of Authors who have published their books</p>
                        <div class="col table-responsive-sm">
                            <table class="table table-bordered bg-white table-striped rounded shadow-sm text-center" id="books">
                                <thead>
                                    <tr>
                                        <th scope="col">SL no.</th>
                                        <th scope="col">Name of the Author</th>
                                        <th scope="col">Added By</th>
                                        <th colspan="2" scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $i = 0;
                                        foreach ($authors as $author)
                                        { 
                                            $i++;
                                    ?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=$author['author_name']?></td>
                                        <td>
                                        <?php
                                            if($admin==0 || $faculties==0)
                                            {
                                                echo "Undefined";
                                            }
                                            else
                                            {
                                                foreach ($admin as $ad)
                                                {
                                                    if($author['admin_id']==$ad['id'])
                                                    {
                                                        echo $ad['full_name'];
                                                    }
                                                }
                                                foreach($faculties as $faculty)
                                                {
                                                    if($author['faculty_id']==$faculty['id'])
                                                    {
                                                        echo $faculty['name'];
                                                    }
                                                }
                                            }
                                        ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-warning text-dark ps-4 pe-4 shadow-none editauthorbtn">Edit</button>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!--End of Author Section-->
                    <?php
                        }
                    ?>
                    <hr class="bg-white mt-5">
                    <!--Course Section-->
                    <?php 
                        if($courses==0)
                        {?>
                            <div class="row mx-4 mt-5">
                                <h2 class="mb-2 mt-4 heading" id="allbooks">Course Overview</h2>
                                <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">Courses present in the Institution</p>
                                <div class="alert alert-warning text-center" role="alert">
                                    <img src="../img/empty.png" alt="Loading..." width="100"><br>There is no Courses in Database
                                </div>
                            </div>
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="row mx-4 mt-5">
                        <h2 class="mb-2 mt-4 heading" id="courses">Course Overview</h2>
                        <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">Courses present in the Institution</p>
                        <div class="col table-responsive-sm">
                            <table class="table table-bordered bg-white table-striped rounded shadow-sm text-center" id="books">
                                <thead>
                                    <tr>
                                        <th scope="col">SL no.</th>
                                        <th scope="col">Course Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $j=0;
                                        foreach ($courses as $course)
                                        {
                                            $j++;
                                    ?>
                                    <tr>
                                        <td><?=$j?></td>
                                        <td><?=$course['course_name']?></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!--End of Course Section--->
                    <?php
                        }
                    ?><!--Branches Section-->
                    <hr class="bg-white mt-5">
                    <?php 
                    if($branches==0)
                    {?>
                        <div class="row mx-4 mt-5">
                            <h2 class="mb-2 mt-4 heading" id="allbooks">View Branches</h2>
                            <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">View/Edit/Delete Branches for a particular course</p>
                            <div class="alert alert-warning text-center" role="alert">
                                <img src="../img/empty.png" alt="Loading..." width="100"><br>There is no Branches in Database
                            </div>
                        </div>
                <?php
                    }
                    else
                    {
                ?>
                <div class="row mx-4 mt-5">
                    <h2 class="mb-2 mt-4 heading" id="branches">View Branches</h2>
                    <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">View Branches for a particular course</p>
                    <div class="col table-responsive-sm">
                        <table class="table table-bordered bg-white table-striped rounded shadow-sm text-center" id="books">
                            <thead>
                                <tr>
                                    <th scope="col">Branch-ID</th>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Branch Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($branches as $branch)
                                    { 
                                ?>
                                <tr>
                                    <td><?=$branch['branch_id']?></td>
                                    <td><?=$branch['course_name']?></td>
                                    <td><?=$branch['branch_name']?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div><!--End of Branches Section-->
                <?php
                    }
                ?>
                </div><!--Dashboard Container ends-->
            </div><!--Page contain wrapper ends-->
        </div><!--Wrapper container-->
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script>
            /** Transition of Admin Left Navigation Menu**/
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");

            toggleButton.onclick = function () {
                el.classList.toggle("toggled");
            };
            //retrive course data from table
            $(document).ready(function (){
                $('.editcoursebtn').on('click',function(){
                    $('#editcourses').modal('show');

                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    $('#update_cid').val(data[0]);
                    $('#updatecname').val(data[1]);
                });
            });
            //retrive author data from table
            $(document).ready(function (){
                $('.editauthorbtn').on('click',function(){
                    $('#editauthors').modal('show');

                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    $('#update_aid').val(data[0]);
                    $('#updateauthor').val(data[1]);
                });
            });
        </script>
    </body>
</html>
<?php
}
else
{
    header("location: ../faculty/facultylogin.php");
    exit();
}
?>