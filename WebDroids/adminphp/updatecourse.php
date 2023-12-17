<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";

    if(isset($_POST['updatecoursedata']))
    {
        $cid=$_POST['update_cid'];
        $cname=$_POST['updatecname'];

        if(preg_match('/^([A-Z a-z]*)$/',$cname))
        {
            //Updating into Database
            $sql="update courses set course_name=? where course_id=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([strToUpper($cname),$cid]);

            //If there is no error while updating the data
            if($res)
            {
                $_SESSION['success']="Course Updated Successfully!!!!";
                header("Location: ../admin/admindashboard.php");
                exit;
            }
            else
            {
                $_SESSION['failed']="Unknown Error occured!!!";
                header("Location: ../admin/admindashboard.php");
                exit;
            }
        }
        else
        {
            $_SESSION['failed']="Please Enter Valid Course name!!!";
            header("Location: ../admin/admindashboard.php");
            exit;
        }
    }
    else
    {
        header("Location: ../admin/admindashboard.php");
        exit;
    }
}
?>