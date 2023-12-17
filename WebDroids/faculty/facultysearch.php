<?php
session_start();

if(!isset($_GET['search']) || empty($_GET['search']))
{
    header("Location: facultydashboard.php");
    exit;
}

//if the faculty is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    //Including books/Authors/Category functions and Database Connection file
    include "../connection.php";
    include "../facultyphp/facultydashboardFunctions.php";
    $key=$_GET['search'];
    
    $books=search_books($conn,$key);
    $authors=get_all_authors($conn);
    $courses=get_all_courses($conn);
    $branches=get_all_branches($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../assets/admindashboard.css">
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
                                <input type="text" name="search" class="form-control search-input" placeholder="Search books by Title, Author, Course, Branch" autofocus autocomplete="off">
                                <button class="input-group-textbtn btn btn-primary shadow-none"><img src="../img/search.png" width="21"></button>
                            </div>
                        </form>
                    </div>
                <!--Search bar Ends-->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <a class="nav-link fw-bold dashboard-text" href="facultyprofile.php">
                            <i class="fas fa-user me-2 dashboard-text"></i><span class="text-light fw-bold">Hello!! <?php echo $_SESSION['user_name2']; ?></span>
                        </a>
                    </ul>
                </div>
            </nav>
            <!-- Header Ends-->
            <hr class="bg-white mt-3">
                <!--Dashboard Containers-->
                <?php 
                     if($books==0)
                     { ?>
                        <div class="row mx-4 mt-5">
                            <h2 class="mb-2 mt-4 heading" id="allbooks">Books Overview</h2>
                            <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">Books which are present in the Inventory</p>
                            <div class="alert alert-warning text-center" role="alert">
                                <img src="../img/empty-search.png" alt="Loading..." width="100"><br>There is no Books in Database
                            </div>
                        </div>
                <?php }
                      else
                      {
                ?>
                <div class="row mx-4 mt-5">
                    <h2 class="mb-2 mt-4 heading" id="allbooks">Books Overview</h2>
                    <p style="color:yellow; text-align: center;font-size:14px;" class="fw-bold">Books which are present in the Inventory</p>
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
            <!--Dashboard Container Ends-->
    </div><!--Page Content Wrapper Ends-->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>      
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
    <script>
        //Delete course data from table
        $(document).ready(function (){
            $('.deletecoursebtn').on('click',function(){
                $('#deletecourses').modal('show');

                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                $('#delete_cid').val(data[0]);
            });
        });
        //Delete Book from table
        $(document).ready(function (){
            $('.deletebookbtn').on('click',function(){
                $('#deletebooks').modal('show');

                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                console.log(data);
                $('#delete_bkid').val(data[0]);
            });
        });
    </script>
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
    <script src="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css"></script>
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