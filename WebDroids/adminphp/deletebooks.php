<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";

    if(isset($_POST['deletebooksdata']))
    {
        $bkid=$_POST['delete_bkid'];

        $sql2  = "select * from books where isbn=?";
        $stmt2=$conn->prepare($sql2);
        $stmt2->execute([$bkid]);
        $the_book=$stmt2->fetch();

        if($stmt2->rowCount() > 0)
        {
            //Deleting in Database
            $sql="delete from books where isbn=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$bkid]);

            //If there is no error while updating the data
            if($res)
            {
                $cover=$the_book['cover'];
                $file=$the_book['file'];
                $c_b_c = "../img/uploads/cover/$cover";
                $c_f = "../img/uploads/files/$file";
                unlink($c_b_c);
                unlink($c_f);
                $_SESSION['success']="Book deleted Successfully.....";
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
    }
    else
    {
        header("Location: ../admin/admindashboard.php");
        exit;
    }
}
?>