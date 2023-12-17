<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";

    if(isset($_POST['updatebranchdata']))
    {
        $bid=$_POST['update_bid'];
        $bname=$_POST['updatebname'];
        if(is_numeric($bname))
        {
            $_SESSION['failed']="Invalid Branch Name!!!";
            header("Location: ../admin/viewbranches.php");
            exit;
        }
        else
        {
            //Updating into Database
            $sql="update branches set branch_name=? where branch_id=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$bname,$bid]);

            //If there is no error while updating the data
            if($res)
            {
                $_SESSION['success']="Branch Updated Successfully!!!";
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
    }
    else
    {
        header("Location: ../admin/viewbranches.php");
        exit;
    }
}
?>