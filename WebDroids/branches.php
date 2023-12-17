<?php
session_start();

//if the student is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    if(!isset($_GET['id']))
    {
        header("Location: homepage.php");
        exit;
    }
    //Getting Course ID from GET Request
    $id=$_GET['id'];

    //Including books/Authors/Category functions and Database Connection file
    include "connection.php";
    include "php/homepageFunctions.php";

    $books=get_books_by_BranchID($conn,$id);
    $current_branch=get_current_branch($conn,$id);

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
    <title>Branch: <?=$current_branch['branch_name']?>
    </title>
    <!-- bootstrap 5 CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/homepage.css">
</head>
<body>
    <!-- changepassword Modal -->
    <?php
        include("changepassword.php");
    ?>
    <!-- End changepassword Modal -->
    <!--Navigation Bar Starts-->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-default navbar-static-top">
        <div class="container-fluid">
            <a href="https://manipal.edu/mit.html" target="_blank" class="ms-3 me-5"><img src="img/homelogo.png" alt="MIT Logo" width="80" height="80"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!--Search bar-->
                <div class="col-md-4 col-lg-5 col-11 mx-auto search-box">
                <form action="studentsearch.php" method="get">
                    <div class="input-group form-container">
                        <input type="text" name="search" class="form-control search-input" placeholder="Search books by Title, Author, Course, Branch" autofocus="autofocus" autocomplete="off">
                        <button class="input-group-textbtn btn btn-primary shadow-none">
                            <img src="img/search.png" width="21">
                        </button>
                    </div>
                </form>
                </div>
                <!--Search bar Ends-->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 navbar-right me-5">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">All Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Services</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2 dashboard-text"></i><?php echo $_SESSION['user_name1']; ?></a>
                        <ul class="dropdown-menu" style="width:191px; padding:8px;" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item shadow-none mt-3 bg-transparent p-0 mt-3" href="studentprofile.php"><i class="fas fa-user me-2 dashboard-text"></i>My Profile</a></li>
                            <li><button type="button" class="btn bg-transparent shadow-none mt-4 p-0" data-bs-toggle="modal" data-bs-target="#changepassword">
                                <i class="fa fa-key me-2"></i>Change Password</button></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item mt-3 mb-2 bg-transparent p-0" href="logout.php"><i class="fas fa-power-off me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Navigation Bar Ends-->
    <!-- All Books Section starts-->
    <section class="m-5">
        <?php 
        if($books==0)
        { ?>
        <div class="mt-5 mb-5">
            <h2 class="mb-2 mt-4 text-center" style="color:#072b5a;">Books Overview</h2>
            <p style="color:black; text-align: center;font-size:14px;line-height: 1.5;" class="fw-bold">Download Books related to course <?=$current_branch['branch_name']?> of all Semesters</p>
        </div>
        <div class="alert alert-warning text-center m-3" role="alert">
            <img src="img/empty.png" alt="Loading..." width="100"><br>There is no Books in Database
        </div>
        <?php }
                else
                {?>
                <div class="mt-5 mb-5">
                    <h2 class="mb-2 mt-4 text-center" style="color:#072b5a;">Books Overview</h2>
                    <p style="color:black; text-align: center;font-size:14px;line-height: 1.5;" class="fw-bold">Download Books related to course <?=$current_branch['branch_name']?> of all Semesters</p>
                </div>
                <div class="all_books">
                    <?php foreach ($books as $book) { ?>
                    <div class="book">
                    <img src="img/uploads/cover/<?=$book['cover']?>" width="200"/>
                    <h6><?=$book['title']?></h6>
                    <p>By&nbsp;<?php foreach($authors as $author)
                                { 
                                    if ($author['author_id'] == $book['author_id'])
                                    {
                                        echo $author['author_name'];
                                        break;
                                    }
                                }?><br><br><br>
                    <b>Course: </b>
                    <?php  foreach ($courses as $course)
                        {
                                if($course['course_id']==$book['course_id'])
                                {
                                    echo $course['course_name'];
                                }
                            }?><br><br>
                    <b>Branch: </b>
                    <?php  foreach ($branches as $branch)
                            {
                            if($book['branch_id']==$branch['branch_id'])
                            {
                                echo $branch['branch_name'];
                            }
                        }?><br><br>
                    <b>Semester: </b><?=$book['semester']?></p>
                    <div class="btnbox">
                        <a href="img/uploads/files/<?=$book['file']?>" target="_blank" class="btn btn-primary text-white shadow-none">Open</a>
                        <a href="img/uploads/files/<?=$book['file']?>" download="<?=$book['title']?>" class="btn btn-success text-white shadow-none">Download</a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </section>
    <!--Footer Section Start-->
    <footer class="bg-dark p-5 text-center text-white">
      <div>Copyright &copy; WebDroids | All Right Reserved.</div>
    </footer>
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
else
{
    header("location: homepage.php");
    exit();
}
?>