<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login Page</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">    
</head>
<body>
    <!--Login Form-->
    <div id="page" class="site login-show">
        <div class="container">
            <div class="wrapper">
                <div class="login">
                    <div class="container-heading">
                        <div class="y-style">
                        <div class="logo"><img src="img/new logo manipal.png" width="250" alt=""></div>
                            <div class="welcome">
                                <h2 class="welcometitle">Welcome<br>Back</h2>
                                <p>Prepare well for the Exams.</p>
                            </div>
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="y-style">
                            <form action="php/auth.php" method="post">

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
                                    <label for="email">Email <span>*<span></label>
                                    <input type="text" name="email" id="email" placeholder="Enter your email" autofocus autocomplete="off">
                                </p>
                                <p>
                                    <label for="password">Password <span>*</span></label>
                                    <input type="password" name="password" id="password" placeholder="Enter password" autocomplete="off">
                                </p>
                                <p class="check">
                                    <input type="checkbox" id="remember" onclick="showPassword()">
                                    <label for="remember" class="showpass">Show Password</label>
                                </p>
                                <p class="forgot"><a href="forgotpass.php">Forgot Password?</a></p>
                                <p><button type="submit">Login</button></p>
                            </form>
                            <div class="afterform">
                                <p>Don't have an account? <a href="registration.php" class="t-signup">Register</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    /* Show Password Function */
        function showPassword()
        {
            const showPassword=document.getElementById('remember');
            if(password.type=="password")
            {
                password.type="text";
            }
            else
            {
                password.type="password";
            }
        }
    </script>
    <script src="assets/script.js"></script>
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
</body>
</html>