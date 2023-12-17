<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";

    if(isset($_POST['deletebranchdata']))
    {
        $bid=$_POST['delete_bid'];

        //Deleting in Database
        $sql="delete from branches where branch_id=?";
        $stmt=$conn->prepare($sql);
        $res=$stmt->execute([$bid]);

        //If there is no error while updating the data
        if($res)
        {
            $_SESSION['success']="Branch deleted Successfully.....";
            header("Location: ../admin/viewbranches.php");
            exit;
        }
        else
        {
            $_SESSION['failed']="Unknown Error occured!!!";
            header("Location: ../admin/viewbranches.php");
            exit;
        }
    }
    else
    {
        header("Location: ../admin/viewbranches.php");
        exit;
    }
}
?>