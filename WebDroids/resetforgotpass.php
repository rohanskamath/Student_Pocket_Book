<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">    
</head>
<body>
    <!--Signup Form-->
    <div id="page" class="site signup-show">
        <div class="container">
            <div class="wrapper">
                <div class="signup">
                    <div class="container-heading">
                        <div class="y-style">
                        <div class="logo"><img src="img/new logo manipal.png" width="250" alt=""></div>
                            <div class="welcome">
                                <h2 class="welcometitle">Reset Password</h2>
                                <p>Reset your password by creating new password.</p>
                            </div>
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="y-style">
                            <form action="php/resetpasswordauth.php" method="post">
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
                                <p>
                                    <label for="forpassEmail">Email <span>*</span></label>
                                    <input type="text" placeholder="Enter your email" id="forpassEmail" autocomplete="off" onkeyup="validateInput()" autofocus>
                                    <small class="validation"></small>
                                </p>
                                <p>
                                    <label for="forpassPass">New Password <span>*</span></label>
                                    <input type="password" placeholder="Enter password" id="forpassPass" autocomplete="off" onkeyup="validateInput()">
                                    <small class="validation"></small>
                                </p>
                                <p>
                                    <label for="forpassCPass">Confirm Password <span>*</span></label>
                                    <input type="password" placeholder="Enter same password again" id="forpassCPass" autocomplete="off" onkeyup="validateInput()">
                                    <small class="validation"></small>
                                </p>
                                <p><button type="submit">Change Password</button></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //Checking for Validations*/
        var email=document.getElementById('forpassEmail');
        var pass=document.getElementById('forpassPass');
        var cpass=document.getElementById('forpassCPass');
        var form=document.getElementById('form');
        function validateInput()
        {
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
        document.querySelector("button").addEventListener('click',(event)=>{
            event.preventDefault()
            validateInput();
        });
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
    <script src="assets/script.js"></script>
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
</body>
</html>