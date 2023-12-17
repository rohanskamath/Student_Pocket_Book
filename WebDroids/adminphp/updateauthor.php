<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";

    if(isset($_POST['updateauthordata']))
    {
        $aid=$_POST['update_aid'];
        $aname=$_POST['updateauthor'];
        if(preg_match('/^([A-Z a-z]*)$/',$aname))
        {
            //Updating into Database
            $sql="update author set author_name=?,admin_id=?,faculty_id=NULL where author_id=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([ucwords($aname),$_SESSION['user_id'],$aid]);

            //If there is no error while updating the data
            if($res)
            {
                $_SESSION['success']="Author Name Updated Successfully.....";
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
            $_SESSION['failed']="Please Enter Valid Author name!!!";
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