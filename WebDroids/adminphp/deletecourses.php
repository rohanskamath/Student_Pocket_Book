<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";

    if(isset($_POST['deletecoursedata']))
    {
        $cid=$_POST['delete_cid'];

        //Deleting in Database
        $sql="delete from courses where course_id=?";
        $stmt=$conn->prepare($sql);
        $res=$stmt->execute([$cid]);

        //If there is no error while updating the data
        if($res)
        {
            $_SESSION['success']="Course deleted Successfully.....";
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
        header("Location: ../admin/admindashboard.php");
        exit;
    }
}
?>