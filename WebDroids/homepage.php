<?php
session_start();

//if the student is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    //Including books/Authors/Category functions and Database Connection file
    include "connection.php";
    include "php/homepageFunctions.php";

    $books=get_all_Approvedbooks($conn);
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
    <title>SPB Home Page</title>
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
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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
                <img src="img/search.png" width="21"></button>
          </div>
        </form>
        </div>
        <!--Search bar Ends-->
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 navbar-right me-5">
          <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#books">All Books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Services</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="toggleMenu()">
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
  <!--Moving Slide Starts-->
  <div id="home" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#home" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#home" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#home" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/slideimg/home-1.jpeg" class="d-block w-100" alt="MITLibrary">
        <div class="carousel-caption">
          <h5>Student Pocket Book</h5>
          <p>Books are referred to as a man's best friend.</p>
          <p><a href="#books" class="btn btn-outline-warning mt-3">Know More</a></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/slideimg/home-2.jpg" class="d-block w-100" alt="MITLibrary">
        <div class="carousel-caption">
          <h5>MIT Library Portal</h5>
          <p>Libraries play a vital role in providing people with reliable content.</p>
          <p><a href="https://libportal.manipal.edu/MIT/MIT.aspx" target="_blank" class="btn btn-outline-warning mt-3">Know More</a></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/slideimg/home-3.jpeg" class="d-block w-100" alt="MITLibrary">
        <div class="carousel-caption">
          <h5>Question Paper Portal</h5>
          <p>To access all the previous year question papers for your Exam.</p>
          <p><a href="https://libportal.manipal.edu/MIT/Question%20Paper.aspx" target="_blank" class="btn btn-outline-warning mt-3">Know More</a></p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#home" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#home" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!--Moving Slide Ends-->
  <?php
    if(isset($_SESSION['success']) && $_SESSION['success']!='')
    {
      echo '<div class="alert alert-success ms-5 me-5 mt-5 p-4 alert-dismissible fade show" role="alert">
      <strong>Sucess!!!!! </strong>'.$_SESSION['success'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
      unset($_SESSION['success']);
    }
    if(isset($_SESSION['failed']) && $_SESSION['failed']!='')
    {
      echo '<div class="alert alert-danger ms-5 me-5 mt-5 p-4 alert-dismissible fade show" role="alert">
      <strong>Failed!!!!! </strong>'.$_SESSION['failed'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
      unset($_SESSION['failed']);
    }
  ?>
  <!--Fast Access Section starts-->
  <div class="mt-5">
      <h2 class="mb-2 mt-4 text-center" style="color:#072b5a;">Fast Access</h2>
      <p style="color:black; text-align: center;font-size:14px; line-height: 1.5;" class="fw-bold">Access all books of any branch/course/author by selecting any one of the groups</p>
    </div>
  <div class="container1">
    <div class="box">
      <div class="list-group overflow-auto">
        <a href="#" class="list-group-item list-group-item-action active">Course</a>
      <?php foreach ($courses as $course) { ?>
        <a href="courses.php?id=<?=$course['course_id']?>" class="list-group-item list-group-item-action"><?=$course['course_name']?></a>
      <?php } ?>
      </div>
    </div>
    <div class="box">
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">Branches</a>
      <?php foreach ($branches as $branch) { ?>
        <a href="branches.php?id=<?=$branch['branch_id']?>" class="list-group-item list-group-item-action"><?=$branch['branch_name']?></a>
      <?php } ?>
      </div>
    </div>
    <div class="box">
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">Author</a>
      <?php foreach ($authors as $author) { ?>
        <a href="authors.php?id=<?=$author['author_id']?>" class="list-group-item list-group-item-action"><?=$author['author_name']?></a>
      <?php } ?>
      </div>
    </div>
  </div>
  <!--Fast Access Section Ends-->
  <hr id="books">
  <!-- All Books Section starts-->
  <section class="books m-5">
  <?php 
    if($books==0)
    { ?>
      <div class="mb-5">
        <h2 class="mb-2 mt-4 text-center" style="color:#072b5a;">Books Overview</h2>
        <p style="color:black; text-align: center;font-size:14px;line-height: 1.5;" class="fw-bold">All books related to particular branch/courses/semesters</p>
      </div>
      <div class="alert alert-warning text-center" role="alert">
        <img src="../img/empty.png" alt="Loading..." width="100"><br>There is no Books in Database
      </div>
  <?php }
        else
        {?>
    <div class="mb-5">
      <h2 class="mb-2 mt-4 text-center" style="color:#072b5a;">Books Overview</h2>
      <p style="color:black; text-align: center;font-size:14px;line-height: 1.5;" class="fw-bold">All books related to particular branch/courses/semesters</p>
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
        <b>Course: </b><?php  foreach ($courses as $course)
                              {
                                  if($course['course_id']==$book['course_id'])
                                  {
                                    echo $course['course_name'];
                                  }
                              }?><br><br>
        <b>Branch: </b><?php  foreach ($branches as $branch)
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
  <!-- All Books Section ends-->
  <hr id="services">
  <!-- Services Section starts-->
  <section class="services section-Padding mb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-header text-center pb-5 mt-5">
            <h2 class="mb-2 mt-4" style="color:#072b5a;">Services</h2>
            <p style="color:black; text-align: center;font-size:14px;line-height: 1.5;" class="fw-bold">Get all Textbook related to your branches of all Semesters</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-4">
          <div class="card h-100 text-white text-center bg-dark pb-2">
            <div class="card-body">
              <i class="bi bi-subtract"></i>
              <h3 class="card-title mt-4 text-warning">Course Wise</h3>
              <p style="line-height: 1.5; font-size:1em;">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
              Doloremque voluptates sapiente unde recusandae quos reiciendis? 
              Similique, earum id, velit neque, a sint debitis quos ipsa magni quas voluptatibus. Perferendis, dolor!
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4">
          <div class="card h-100 text-white text-center bg-dark pb-2">
            <div class="card-body">
              <i class="bi bi-subtract"></i>
              <h3 class="card-title mt-4 text-warning">Semester Wise</h3>
              <p style="line-height: 1.5; font-size:1em;">Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Doloremque voluptates sapiente unde recusandae quos reiciendis? 
              Similique, earum id, velit neque, a sint debitis quos ipsa magni quas voluptatibus. Perferendis, dolor!
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4">
          <div class="card h-100 text-white text-center bg-dark pb-2">
            <div class="card-body">
              <i class="bi bi-subtract"></i>
              <h3 class="card-title mt-4 text-warning">Branch Wise</h3>
              <p style="line-height: 1.5; font-size:1em;"> 
              Similique, earum id, velit neque, a sint debitis quos ipsa magni quas voluptatibus. Perferendis, dolor!
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Services Section ends-->
  <!--Footer Section Start-->
  <footer class="bg-dark p-5 text-center text-white">
      <div>Copyright &copy; WebDroids | All Right Reserved.</div>
  </footer>
  <!-- bootstrap 5 Js bundle CDN-->
  <script>
    let submenu=document.getElementById("navbarDropdown");
    function toggleMenu()
    {
      submenu.classList.toggle("open-menu");
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
else
{
    header("location: login.php");
    exit();
}
?>