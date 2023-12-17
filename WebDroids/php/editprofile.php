<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";
            
    /*Calling validation function*/
    include "validation.php";

    //checks if Input field are NULL or not
    if(isset($_POST['sid']) && isset($_POST['sname']) && isset($_POST['sphone']))
    {
        //Get data from POST request and store it in varPOST
        $sid=$_POST['sid'];
        $sname=$_POST['sname'];
        $sphone=$_POST['sphone'];
        
        //Form Validation
        $text="Name";
        $location="../studentprofile.php";
        $ms="id=$sid&error";
        is_empty($sname,$text,$location,$ms,"");

        $text="Phone Number";
        $location="../studentprofile.php";
        $ms="id=$sid&error";
        is_empty($sphone,$text,$location,$ms,"");

        $sql1="select phone from students where phone=?";
        $stmt1=$conn->prepare($sql1);
        $stmt1->execute([$sphone]);
        if($stmt1->rowCount()>0)
        {
            $student=$stmt1->fetch();
            $ssphone=$student['phone'];
            if($sphone == $ssphone)
            {
                $em = "Phone Number already present!!!";
                header("Location: ../studentprofile.php?error=$em&id=$sid");
            }
        }
        else
        {
            $sql="update students set name=?,phone=? where id=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$sname,$sphone,$sid]);
            //If there is no error while updating the data
            if($res)
            {
                $sm="Profile Updated Successfully!!!";
                header("Location: ../studentprofile.php?success=$sm&id=$sid");
                exit;
            }
            else
            {
                $em="Unknown Error occured!!!";
                header("Location: ../studentprofile.php?error=$em&id=$sid");
                exit;
            }
        }
        if(!empty($sphone))
        {
            $sql="update students set name=?,phone=? where id=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$sname,$sphone,$sid]);
            //If there is no error while updating the data
            if($res)
            {
                $sm="Profile Updated Successfully!!!";
                header("Location: ../studentprofile.php?success=$sm&id=$sid");
                exit;
            }
            else
            {
                $em="Unknown Error occured!!!";
                header("Location: ../studentprofile.php?error=$em&id=$sid");
                exit;
            }
        }
    }
    else
    {
        header("Location: ../studentprofile.php");
        exit;
    }
}
?>