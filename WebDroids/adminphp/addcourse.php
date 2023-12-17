<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";

    //checks if course name is submitted
    if(isset($_POST['course_name']))
    {
        //Get data from POST request and store it in variable
        $cname=strToUpper($_POST['course_name']);
        if(preg_match('/^([A-Z a-z]*)$/',$cname))
        {
            $sql1="select course_name from courses where course_name=?";
            $stmt1=$conn->prepare($sql1);
            $stmt1->execute([$cname]);
            if($stmt1->rowCount()>0)
            {
                $courseName=$stmt1->fetch();
                $dcourse=$courseName['course_name'];
                if($cname === $dcourse)
                {
                    $_SESSION['failed'] = "Course is already present!!!";
                    header("Location: ../admin/admindashboard.php");
                    exit;
                }
                else
                {
                    //Inserting into Database
                    $sql="insert into courses(course_name,admin_id) values (?,?)";
                    $stmt=$conn->prepare($sql);
                    $res=$stmt->execute([$cname,$_SESSION['user_id']]);

                    //If there is no error while inserting the data
                    if($res)
                    {
                        $_SESSION['success']="Added New Course Successfully.....";
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
                //Inserting into Database
                $sql="insert into courses(course_name,admin_id) values (?,?)";
                $stmt=$conn->prepare($sql);
                $res=$stmt->execute([$cname,$_SESSION['user_id']]);

                //If there is no error while inserting the data
                if($res)
                {
                    $_SESSION['success']="Added New Course Successfully.....";
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
