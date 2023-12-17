<?php
session_start();
    if(isset($_POST['email']) && isset($_POST['password'])){

        /*Database Connection*/
        include "../connection.php";
        
        /*Calling validation function*/
        include "../adminphp/validation.php";

        /*Geting data from POST Request and store them in var */
        $email=$_POST['email'];
        $password=$_POST['password'];

        $text="Email";
        $location="../admin/adminlogin.php";
        $ms="error";
        is_empty($email,$text,$location,$ms,"");

        $text="Password";
        $location="../admin/adminlogin.php";
        $ms="error";
        is_empty($password,$text,$location,$ms,"");

        //Search Email id
        $sql="Select * from admin where email=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$email]);
        //checking if email is exist
        if($stmt->rowCount()===1)
        {
            $user=$stmt->fetch();

            $user_id=$user['id'];
            $user_email=$user['email'];
            $user_password=$user['password'];
            $user_name1=$user['full_name'];
            if($email === $user_email)
            {
                if(password_verify($password,$user_password))
                {
                    $_SESSION['user_id']=$user_id;
                    $_SESSION['user_email']=$user_email;
                    $_SESSION['user_name1']=$user_name1;
                    header("Location: ../admin/admindashboard.php");
                }
                else
                {
                    $em = "Incorrect Email-ID or password!!!";
                    header("Location: ../admin/adminlogin.php?error=$em");
                }
            }
            else
            {
                $em = "Incorrect Email-ID or password!!!";
                header("Location: ../admin/adminlogin.php?error=$em");
            }
        }
        else
        {
            $em = "Incorrect Email-ID or password!!!";
            header("Location: ../admin/adminlogin.php?error=$em");
        }
    }
    else
    {
        #Redirect to adminLogin page
        header("Location: ../admin/adminlogin.php");
    }
?>