<?php
session_start();

//if the Student is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    //Including Student functions and Database Connection file
    include "connection.php";
    include "php/homepageFunctions.php";
    $student=get_student($_SESSION['user_id'],$conn);
    $courses=get_all_courses($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
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
    <!--My Profile Container Starts-->
    <section class="mt-5">
        <div class="row m-4">
            <div class="mx-auto col-10 col-md-8 col-lg-6 p-3 mb-5">
                <form action="php/editprofile.php" method="post" enctype="multipart/form-data" class="shadow bg-light p-4 rounded mt-3" style="width: 90%; max-width: 50rem;">
                    <h1 class="text-center display-4 fs-3 fw-bold mt-4">My Profile</h1>
                    <p class="text-center mt-4 pb-3">You can also Edit/Update your information</p>
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
                        <label class="mb-2 mt-2" for="sname">Full Name <span style="color: red;">*</span></label>
                        <input type="text" value="<?php echo $_SESSION['user_id']; ?>" hidden id="sid" name="sid">
                        <input type="text" value="<?php echo $student['name'];?>" class="form-control shadow-none" id="sname" name="sname">
                    </div>
                    <div class="form-group mt-3">
                        <label class="mb-2 mt-2" for="semail">Email-ID</label>
                        <input type="text" value="<?php echo $_SESSION['user_email'];?>" class="form-control shadow-none" id="semail" name="semail" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label class="mb-2 mt-2" for="sregno">Register Number</label>
                        <input type="text" value="<?php echo $student['regno'];?>" class="form-control shadow-none" id="sregno" name="sregno" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label class="mb-2 mt-2" for="sptype">Profile-Type</label>
                        <input type="text" value="<?php echo $student['profile_type'];?>" class="form-control shadow-none" id="sptype" name="sptype" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label class="mb-2 mt-2" for="scourse">Course</label>
                        <input type="text" value="<?php echo $student['course'];?>" class="form-control shadow-none" id="scourse" name="scourse" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label class="mb-2 mt-2" for="sphone">Contact Number <span style="color: red;">*</span></label>
                        <input type="text" value="<?php echo $student['phone'];?>" class="form-control shadow-none" id="sphone" name="sphone" onkeyup="validateInput()">
                        <small class="text-danger mt-4"></small>
                    </div>
                    <div class="form-group mt-5 modal-footer justify-content-center">
                        <table>
                            <tr>
                                <td class="pe-5"><button type="submit" class="btn btn-outline-primary shadow-none ms-4">Update Profile</button></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--My Profile Container Ends-->
    <!--Footer Section Start-->
    <footer class="bg-dark p-5 text-center text-white bottom">
        <div>Copyright &copy; WebDroids | All Right Reserved.</div>
    </footer>
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function validateInput()
        {
            var phone = document.getElementById("sphone");
            if(!phone.value.match(/[0-9]/)) 
            {
                onError(phone, "*Phone Number should be digit!!*")
            }
            else
            {
                if (phone.value.length != 10)
                {
                    onError(phone, "*Phone Number should be exactly 10 digits!*")
                } 
                else 
                {
                    onSuccess(phone);
                }
            }
        }
        function onSuccess(input)
        {
            let parent=input.parentElement;
            let msgEle=parent.querySelector("small");
            msgEle.style.visibility="hidden";
        }
        function onError(input,msg)
        {
            let parent=input.parentElement;
            let msgEle=parent.querySelector("small");
            msgEle.style.visibility="visible";
            msgEle.innerHTML=msg;
        }
    </script>
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