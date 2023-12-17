<?php
    //Encrypting password using password_hash
    // echo password_hash("ka@1234",PASSWORD_DEFAULT);

    // $name="Visit WSchools";
    // if(preg_match("/^[a-zA-Z]+$/",$name)){
    //     echo "suceess";
    // }
    // else{
    //     echo "failed";
    // }
    // if(preg_match('/[a-zA-Z]/',$name))

    include "../connection.php";

    // $sql="Select isbn from books order by isbn DESC Limit 1";
    // $stmt= $conn->prepare($sql);
    // $stmt->execute();
    // if($stmt->rowCount() == 1)
    // {
    //     $res=$stmt->fetchcolumn();
    // }
    // echo $res;

//SET @num := 0;

//UPDATE your_table SET id = @num := (@num+1);

//ALTER TABLE your_table AUTO_INCREMENT =1;

            // $email="gautham12@gmail.com";
            // $phone=8496231587;
            // $sql1="select * from faculty where email=?";
            // $stmt1=$conn->prepare($sql1);
            // $stmt1->execute([$email]);
            // if($stmt1->rowCount()>0)
            // {
            //     $faculty=$stmt1->fetch();
            //     $femail=$faculty['email'];
            //     $fphone=$faculty['phone'];
            //     if($email === $femail)
            //     {
            //         echo $femail;
            //     }
            //     if($phone == $fphone)
            //     {
            //         echo $fphone;
            //     }
            // }
            //<div class="logo"><img src="../img/Manipal_logo_white.png" width="250" alt=""></div>

            /*
            var phone=document.getElementById('signupPhone');
            if (phone.value == "") {
                onError(phone, "*Please fill phone number!!*")
            }
            else 
            {
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
        }*/
?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPB Home Page</title>
    bootstrap 5 CDN-->
    <!--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="overlay"></div>
  header Section
  <header>
      <nav class="navbar navbar-expand-lg navbar-dark">
          <div class="container-fluid">
            <a href="https://manipal.edu/mit.html" target="_blank"><img src="#" alt="MIT Logo" width="260"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
              Search bar
                <div class="col-md-6 col-lg-6 col-11 mx-auto myauto search-box">
                  <div class="input-group form-container">
                      <input type="text" name="search" class="form-control search-input" placeholder="Search by Title, Author or ISBN" autofocus="autofocus" autocomplete="off">
                        <button class="input-group-textbtn btn btn-primary shadow-none">
                            <img src="img/search.png" width="21">
                        </button>
                  </div>
                </div>
                Search bar Ends
                <ul class="navbar-nav ms-auto text-center mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">All Books</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">About us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Rohan Kamath</a>
                  </li>
                </ul>
              </div>
          </div>
        </nav>
  </header>
  header Section Ends

  Footer Section Start
  <div class="footer">
    <div class="copyright">Copyright &copy; WebDroids | All Right Reserved.</div>
  </div>
  bootstrap 5 Js bundle CDN
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

            <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item shadow-none mt-3 bg-transparent p-0" href="studentprofile.php"><i class="fas fa-user me-2 dashboard-text"></i>My Profile</a></li>
              <li><button type="button" class="btn bg-transparent shadow-none mt-3 p-0" data-bs-toggle="modal" data-bs-target="#changepassword">
                  <i class="fa fa-key me-2"></i>Change Password</button></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item mt-3 mb-2 bg-transparent" href="logout.php"><i class="fas fa-power-off me-2"></i>Logout</a></li>
            </ul>
                  .dropdownlist{
        list-style: none; 
        background-color:white;
        width: 100%;
        position: absolute;
        padding: 10px;
        border-radius: 5px;
        display: none;
      }
      .dropdownlist li{
        display: block;
        position: relative;
      }
      .dropdownlist li button{
        padding: 0px;
        border: 1px solid transparent;
      }
      .open-menu{
        display: block;
      }-->