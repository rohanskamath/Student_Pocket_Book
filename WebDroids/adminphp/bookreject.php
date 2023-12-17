<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";

    if(isset($_POST['rejectbooksdata']))
    {
        $bid=$_POST['reject_bkid'];

        //Updating status in Database
        $sql="update books set status='Rejected' where isbn=?";
        $stmt=$conn->prepare($sql);
        $res=$stmt->execute([$bid]);

        //If there is no error while updating the data
        if($res)
        {
            $_SESSION['success']="Book has been Rejected!!!";
            header("Location: ../admin/bookapproval.php");
            exit;
        }
        else
        {
            $_SESSION['failed']="Unknown Error occured!!!";
            header("Location: ../admin/bookapproval.php");
            exit;
        }
    }
    else
    {
        header("Location: ../admin/bookapproval.php");
        exit;
    }
}
?>