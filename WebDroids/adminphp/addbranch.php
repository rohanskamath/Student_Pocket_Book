<?php
    session_start();

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
    {
        /*Database Connection*/
        include "../connection.php";
        
        /*Calling validation function*/
        include "../adminphp/validation.php";

        //checks if Input field are NULL or not
        if(isset($_POST['book_courses']) && isset($_POST['branch']))
        {
            //Get data from POST request and store it in variable
            $course=$_POST['book_courses'];
            $branch=$_POST['branch'];

            //Making url Data format
            $user_input='Course='.$course.'&Branch='.$branch;

            //Form Validation
            $text="Course Field";
            $location="../admin/addbranches.php";
            $ms="error";
            is_empty($course,$text,$location,$ms,$user_input);

            $text="Branch Field";
            $location="../admin/addbranches.php";
            $ms="error";
            is_empty($branch,$text,$location,$ms,$user_input);
            isbn_func($branch,$text,$location,$ms,$user_input);

            $sql="insert into branches (course_id,branch_name,admin_id) values(?,?,?)";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$course,$branch,$_SESSION['user_id']]);
            if($res)
            {
                $sm="Added New Branch Successfully.....";
                header("Location: ../admin/addbranches.php?success=$sm");
                exit;
            }
            else
            {
                $em="Unknown Error occured!!!";
                header("Location: ../admin/addbranches.php?error=$em");
                exit;
            }
        }
        else
        {
            header("Location: ../admin/addbooks.php");
            exit;
        }
    }
?>