<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    if(isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['cpass']))
    {
        /*Database Connection*/
        include "../connection.php";
        
       /*Geting data from POST Request and store them in var */
        $email=$_SESSION['user_email'];
        $oldpassword=$_POST['oldpass'];
        $newpassword=$_POST['newpass'];
        $cpassword=$_POST['cpass'];
        $encryptoldpass=password_hash($oldpassword,PASSWORD_DEFAULT);
        $encryptpass=password_hash($newpassword,PASSWORD_DEFAULT);
        $encryptcpass=password_hash($cpassword,PASSWORD_DEFAULT);

        $sql="select password from students where email=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$email]); 
        if($stmt->rowCount()==1)
        {
            $result=$stmt->fetchColumn();
        }
        if (password_verify($oldpassword, $result))
        {
            if (password_verify($newpassword, $encryptcpass))
            {
                $stmt=$conn->prepare("update students set password=?,cpassword=? where email=?");
                $stmt->execute([$encryptcpass,$encryptcpass,$email]); 
                $_SESSION['success']="Your Password has been Changed Successfully.....";
                header("Location: ../homepage.php");
                exit;
            }
            else
            {
                $_SESSION['failed']="New Password and Confirm Password doesnot match!!!";
                header("Location: ../homepage.php");
                exit;
            }   
        }    
        else
        {
            $_SESSION['failed']="Current Password Entered is Incorrect!!!";
            header("Location: ../homepage.php");
            exit;
        }         
    }
    else
    {
        header("Location: ../homepage.php");
        exit;
    }
}
?>