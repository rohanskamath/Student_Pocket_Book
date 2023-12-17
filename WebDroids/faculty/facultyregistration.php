<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Signup form</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">    
</head>
<body>
    <!--Signup Form-->
    <div id="page" class="site signup-show">
        <div class="container">
            <div class="wrapper">
                <div class="signup">
                    <div class="container-heading">
                        <div class="y-style">
                            <div class="logo"><img src="../img/new logo manipal.png" width="250" alt=""></div>
                            <div class="welcome">
                                <h2 class="welcometitle">Sign up<br>Now</h2>
                                <p>Register to login to the portal.</p>
                            </div>
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="y-style">
                            <form action="../facultyphp/registrationauth.php" method="post">
                                <?php if (isset($_GET['error'])){ ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=htmlspecialchars($_GET['error']);?>
                                    </div>
                                <?php } ?>
                                <p>
                                    <label for="signupName">Full Name <span>*</span></label>
                                    <input type="text" placeholder="Enter your full name" name="signupName" id="signupName" autofocus autocomplete="off">
                                    <small class="validation"></small>
                                </p>
                                <p>
                                    <label for="signupEmail">Email <span>*</span></label>
                                    <input type="text" placeholder="Enter your email" name="signupEmail" id="signupEmail" autocomplete="off" onkeyup="validateInput()">
                                    <small class="validation"></small>
                                </p>
                                <p>
                                    <label for="signupPass">Password <span>*</span></label>
                                    <input type="password" placeholder="Enter password" name="signupPass" id="signupPass" autocomplete="off" onkeyup="validateInput()">
                                    <small class="validation"></small>
                                </p>
                                <p>
                                    <label for="signupCPass">Confirm Password <span>*</span></label>
                                    <input type="Password" placeholder="Enter same password again" name="signupCPass" id="signupCPass" autocomplete="off" onkeyup="validateInput()">
                                    <small class="validation"></small>
                                </p>
                                <p>
                                    <label for="signupDept">Department <span>*</span></label>
                                    <input type="text" placeholder="Enter your Department" name="signupDept" id="signupDept" autocomplete="off" onkeyup="validateInput()">
                                    <small class="validation"></small>
                                </p>
                                <p><button type="submit">Register</button></p>
                            </form>
                            <div class="afterform">
                                <p>Already have an account? <a href="facultylogin.php" class="t-login">Login here</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //Checking for Validations*/
        var fname=document.getElementById("signupName");
        var email=document.getElementById('signupEmail');
        var pass=document.getElementById('signupPass');
        var cpass=document.getElementById('signupCPass');
        var dept=document.getElementById('signupDept');
        function validateInput()
        {
            if(dept.value=="")
            {
                onError(dept,"*Please fill Department Field!!!*")
            }
            else
            {
                onSuccess(dept);
            }
            if(fname.value=="")
            {
                onError(fname,"*Please fill Name Field!!!*")
            }
            else
            {
                onSuccess(fname);
            }
            if(email.value=="")
            {
                onError(email,"*Please fill Email-ID Field!!!*");
            }
            else
            {
                if(!isValidEmail(email.value.trim()))
                {
                    onError(email,"*Email is not Valid!!!*");
                }
                else
                {
                    onSuccess(email);
                }
            }
            if(pass.value=="")
            {
                onError(pass,"*Please fill Password Field!!!*")
            }
            else
            {
                if(!pass.value.match(/[0-9]/))
                {
                    onError(pass,"*Password Must contain numbers!!*")
                }
                else
                {
                    if(!pass.value.match(/[a-z]/))
                    {
                        onError(pass,"*Password Must contain Lower Case Letter!!*")
                    }
                    else
                    {
                        if(!pass.value.match(/[A-Z]/))
                        {
                            onError(pass,"*Password Must contain Upper Case Letter!!*")
                        }
                        else
                        {
                            if(!pass.value.match(/[!\@\#\$\%\^\(\)\_\-\+\=\?\>\<\.\,]/))
                            {
                                onError(pass,"*Password Must contain Symbols!!*")
                            }
                            else
                            {
                                if(pass.value.length <= 5)
                                {
                                    onError(pass,"*Must contain atleast 6 characters!!*")
                                }
                                else
                                {
                                    onSuccess(pass);
                                }
                            }
                        }
                    }
                }        
            }
            if(cpass.value=="")
            {
                onError(cpass,"*Please fill Confirm Password Field!!*")
            }
            else
            {
                if(pass.value!=cpass.value)
                {
                    onError(cpass,"*Passwords are not Matching!!*")
                }
                else
                {
                    onSuccess(cpass);
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
        function isValidEmail(email){
            return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
        }
    </script>
    <script src="../assets/script.js"></script>
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
</body>
</html>