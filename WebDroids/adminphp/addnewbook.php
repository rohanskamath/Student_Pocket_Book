<?php
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";
            
    /*Calling validation function*/
    include "../adminphp/validation.php";

    /*Calling File Upload function*/
    include "../adminphp/fileUpload.php";

    //checks if Input field are NULL or not
    if(isset($_POST['btitle']) && isset($_POST['bdescription']) && isset($_POST['book_author']) && isset($_POST['book_courses']) && isset($_POST['book_branches']) && isset($_FILES['book_file']) && isset($_FILES['book_cover']))
    {
        //Get data from POST request and store it in variable
        $btitle=$_POST['btitle'];
        $bdescription=$_POST['bdescription'];
        $bauthor=$_POST['book_author'];
        $bcourse=$_POST['book_courses'];
        $bsem=$_POST['sem'];
        $bbranch=$_POST['book_branches'];
        
        //Making url Data format
        $user_input='title='.$btitle.'&Course='.$bcourse.'&Branch='.$bbranch.'&Author='.$bauthor.'&Sem='.$bsem.'&Description='.$bdescription;

        //Form Validation
        $text="Book Title";
        $location="../admin/addbooks.php";
        $ms="error";
        is_empty($btitle,$text,$location,$ms,$user_input);
        isbn_func($btitle,$text,$location,$ms,$user_input);

        $text="Book Description";
        $location="../admin/addbooks.php";
        $ms="error";
        is_empty($bdescription,$text,$location,$ms,$user_input);

        $text="Author of the Book";
        $location="../admin/addbooks.php";
        $ms="error";
        is_empty($bauthor,$text,$location,$ms,$user_input);

        $text="Course Field";
        $location="../admin/addbooks.php";
        $ms="error";
        is_empty($bcourse,$text,$location,$ms,$user_input);

        $text="Branch Field";
        $location="../admin/addbooks.php";
        $ms="error";
        is_empty($bbranch,$text,$location,$ms,$user_input);

        $text="Semester Field";
        $location="../admin/addbooks.php";
        $ms="error";
        is_empty($bsem,$text,$location,$ms,$user_input);
        sem_func($bcourse,$bsem,$text,$location,$ms,$user_input);

        //Book Cover Uploading
        $allowed_img_exts=array("jpg","jpeg","png");
        $path="cover";
        $book_cover=upload_file($_FILES['book_cover'],$allowed_img_exts,$path);

        //if error occured while uploading books
        if($book_cover['status']=="error")
        {
            $em=$book_cover['data'];
            header("Location: ../admin/addbooks.php?error=$em&$user_input");
            exit;
        }
        else
        {
            //File Uploading
            $allowed_file_exts=array("pdf","docx","pptx");
            $path="files";
            $file=upload_file($_FILES['book_file'],$allowed_file_exts,$path);

            //if error occured while uploading books
            if($file['status']=="error")
            {
                $em=$file['data'];
                header("Location: ../admin/addbooks.php?error=$em&$user_input");
                exit;
            }
            else
            {
                /* Getting new File name and Book cover name*/
                $file_URL=$file['data'];
                $book_cover_url=$book_cover['data'];

                //Generate ISBN Number
                $sql="Select isbn from books order by isbn DESC Limit 1";
                $stmt= $conn->prepare($sql);
                $stmt->execute();
                if($stmt->rowCount() == 1)
                {
                    $res=$stmt->fetchcolumn();
                }
                $isbn=$res;
                $status="Approved";
                //Insert data into database
                $sql="insert into books(isbn,title,author_id,description,course_id,branch_id,semester,admin_id,cover,file,status) values(?,?,?,?,?,?,?,?,?,?,?)";
                $stmt=$conn->prepare($sql);
                $res=$stmt->execute([$isbn+1,$btitle,$bauthor,$bdescription,$bcourse,$bbranch,$bsem,$_SESSION['user_id'],$book_cover_url,$file_URL,$status]);
                //If there is no error while inserting the data
                if($res)
                {
                    $sm="Added New Book Successfully.....";
                    header("Location: ../admin/addbooks.php?success=$sm");
                    exit;
                }
                else
                {
                    $em="Unknown Error occured!!!";
                    header("Location: ../admin/addbooks.php?error=$em");
                    exit;
                }
            }
        }
    }
    else
    {
        header("Location: ../admin/addbooks.php");
        exit;
    }
}
?>