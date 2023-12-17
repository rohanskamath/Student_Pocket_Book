<?php
session_start();
    if(isset($_POST['email']) && isset($_POST['password'])){

        /*Database Connection*/
        include "../connection.php";
        
        /*Calling validation function*/
        include "../php/validation.php";

        /*Geting data from POST Request and store them in var */
        $email=strtolower($_POST['email']);
        $password=$_POST['password'];

        $text="Email";
        $location="../faculty/facultylogin.php";
        $ms="error";
        is_empty($email,$text,$location,$ms,"");

        $text="Password";
        $location="../faculty/facultylogin.php";
        $ms="error";
        is_empty($password,$text,$location,$ms,"");

        //Search Email id
        $sql="Select * from faculty where email=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$email]);
        //checking if email is exist
        if($stmt->rowCount()===1)
        {
            $user=$stmt->fetch();

            $user_id=$user['id'];
            $user_name2=$user['name'];
            $user_email=$user['email'];
            $user_password=$user['password'];
            if($email === $user_email)
            {
                if(password_verify($password,$user_password))
                {
                    $_SESSION['user_id']=$user_id;
                    $_SESSION['user_email']=$user_email;
                    $_SESSION['user_name2']=$user_name2;
                    header("Location: ../faculty/facultydashboard.php");
                }
                else
                {
                    $em = "Incorrect Email-ID or password!!!";
                    header("Location: ../faculty/facultylogin.php?error=$em");
                }
            }
            else
            {
                $em = "Incorrect Email-ID or password!!!";
                header("Location: ../faculty/facultylogin.php?error=$em");
            }
        }
        else
        {
            $em = "Incorrect Email-ID or password!!!";
            header("Location: ../faculty/facultylogin.php?error=$em");
        }
    }
    else
    {
        #Redirect to Faculty Login page
        header("Location: ../faculty/facultylogin.php");
    }
?>