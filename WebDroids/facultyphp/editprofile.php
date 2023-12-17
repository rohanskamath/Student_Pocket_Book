<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";
            
    /*Calling validation function*/
    include "../facultyphp/validation.php";

    //checks if Input field are NULL or not
    if(isset($_POST['fid']) && isset($_POST['fname']) && isset($_POST['fphone']))
    {
        //Get data from POST request and store it in varPOST
        $fid=$_POST['fid'];
        $fname=$_POST['fname'];
        $fphone=$_POST['fphone'];
        
        //Form Validation
        $text="Name";
        $location="../faculty/facultyprofile.php";
        $ms="id=$fid&error";
        is_empty($fname,$text,$location,$ms,"");

        $text="Phone Number";
        $location="../faculty/facultyprofile.php";
        $ms="id=$fid&error";
        is_empty($fphone,$text,$location,$ms,"");

        $sql1="select phone from faculty where phone=?";
        $stmt1=$conn->prepare($sql1);
        $stmt1->execute([$fphone]);
        if($stmt1->rowCount()>0)
        {
            $faculty=$stmt1->fetch();
            $ffphone=$faculty['phone'];
            if($fphone == $ffphone)
            {
                $em = "Phone Number already present!!!";
                header("Location: ../faculty/facultyprofile.php?error=$em&id=$fid");
            }
        }
        else
        {
            $sql="update faculty set name=?,phone=? where id=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$fname,$fphone,$fid]);
            //If there is no error while updating the data
            if($res)
            {
                $sm="Profile Updated Successfully!!!";
                header("Location: ../faculty/facultyprofile.php?success=$sm&id=$fid");
                exit;
            }
            else
            {
                $em="Unknown Error occured!!!";
                header("Location: ../faculty/facultyprofile.php?error=$em&id=$fid");
                exit;
            }
        }
        if(!empty($fphone))
        {
            $sql="update faculty set name=?,phone=? where id=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$fname,$fphone,$fid]);
            //If there is no error while updating the data
            if($res)
            {
                $sm="Profile Updated Successfully!!!";
                header("Location: ../faculty/facultyprofile.php?success=$sm&id=$fid");
                exit;
            }
            else
            {
                $em="Unknown Error occured!!!";
                header("Location: ../faculty/facultyprofile.php?error=$em&id=$fid");
                exit;
            }
        }
    }
    else
    {
        header("Location: ../faculty/facultyprofile.php");
        exit;
    }
}
?>