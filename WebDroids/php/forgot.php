<?php
include "../connection.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
function sendmail($email,$reset_token)
{
    include "../PHPMailer/Exception.php";
    include "../PHPMailer/PHPMailer.php";
    include "../PHPMailer/SMTP.php";
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'kaushikmendon8@gmail.com';                     //SMTP username
        $mail->Password   = 'bxgcrniwnkimhanq';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('kaushikmendon8@gmail.com', 'Student Pocket Book');
        $mail->addAddress($email);     //Add a recipient
    
        //Content
        $mail->isHTML(true);         
        $mail->Subject = 'Password reset link from Student Pocket Book';
        $mail->Body    = "We have got the request from you to reset your password <br> <b>Click the link below!!!</b><br>
        <a href='http://localhost/PHPProject/WebDroids/resetforgotpass.php?email=$email&reset_token=$reset_token'> Reset Password</a>
        <br><br><br>Thank You,<br>Team Webdroids";
    
        $mail->send();
        return true;
    } 
    catch (Exception $e)
    {
        return false;
    }
    
}
if(isset($_POST['email']))
{
    $email=$_POST['email'];
    if(!empty($email))
    {
        $sql="select email from students where email=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$email]); 
        if($stmt->rowCount()===1)
        {
            $reset_token=bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/kolkata');
            $date=date("Y-m-d");
            $sql="update students set token='$reset_token',tokenexpire='$date' where email=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$email]);
            if($res && sendmail($email,$reset_token))
            {
                $sm = "Reset Link Sent Successfully!!";
                header("Location: ../forgotpass.php?success=$sm");
            }
            else
            {
                $em = "Reset Password Link Not Sent!!!";
                header("Location: ../forgotpass.php?error=$em");
            }
        }
        else
        {
            $em = "Account is Not Present!!!";
            header("Location: ../forgotpass.php?error=$em");
        }
    }
    else
    {
        $em = "Please Fill out Email-ID Field!!!";
        header("Location: ../forgotpass.php?error=$em");
    }
}

?>