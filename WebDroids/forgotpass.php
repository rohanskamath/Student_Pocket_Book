<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password Page</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">    
</head>
<body>
    <!--Forgot Password Page-->
    <div id="page" class="site signup-show">
        <div class="container">
            <div class="wrapper">
                <div class="signup">
                    <div class="container-heading">
                        <div class="y-style">
                        <div class="logo"><img src="img/new logo manipal.png" width="250" alt=""></div>
                            <div class="welcome">
                                <h2 class="welcometitle">Forgot Passord?</h2>
                                <p>No worries!!Reset password using your Email-ID.</p>
                            </div>
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="y-style">
                            <form action="php/forgot.php" method="post">
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
                                    <label for="signupEmail">Email <span>*</span></label>
                                    <input type="text" placeholder="Enter your email" id="signupEmail" name="email" autofocus autocomplete="off" onkeyup="validateInput()">
                                    <small class="validation"></small>
                                </p>
                                <p><button type="submit">Send Password reset link</button></p>
                            </form>
                            <div class="afterform">
                                <p>&lt;&lt;<a href="login.php" class="t-signup"> Back to Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        /*Email textbox Vlidations*/
        var email=document.getElementById('signupEmail');
        function validateInput()
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