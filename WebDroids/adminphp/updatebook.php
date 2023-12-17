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
    if(isset($_POST['book_id']) && isset($_POST['btitle']) && isset($_POST['bdescription']) && isset($_POST['book_author']) && isset($_POST['book_courses']) && isset($_POST['book_branches']) && isset($_POST['sem']) && isset($_FILES['book_file']) && isset($_FILES['book_cover']) && isset($_POST['current_file']) && isset($_POST['current_cover']))
    {
        //Get data from POST request and store it in varPOST
        $bid=$_POST['book_id'];
        $btitle=$_POST['btitle'];
        $bdescription=$_POST['bdescription'];
        $bauthor=$_POST['book_author'];
        $bcourse=$_POST['book_courses'];
        $bbranch=$_POST['book_branches'];
        $bsem=$_POST['sem'];

        $bcover=$_POST['current_cover'];
        $bfile=$_POST['current_file'];
        
        //Form Validation
        $text="Book Title";
        $location="../admin/editbooks.php";
        $ms="id=$bid&error";
        is_empty($btitle,$text,$location,$ms,"");
        isbn_func($btitle,$text,$location,$ms,"");

        $text="Book Description";
        $location="../admin/editbooks.php";
        $ms="id=$bid&error";
        is_empty($bdescription,$text,$location,$ms,"");

        $text="Author of the Book";
        $location="../admin/editbooks.php";
        $ms="id=$bid&error";
        is_empty($bauthor,$text,$location,$ms,"");

        $text="Course Field";
        $location="../admin/editbooks.php";
        $ms="id=$bid&error";
        is_empty($bcourse,$text,$location,$ms,"");

        $text="Branch Field";
        $location="../admin/editbooks.php";
        $ms="id=$bid&error";
        is_empty($bbranch,$text,$location,$ms,"");

        $text="Semester Field";
        $location="../admin/editbooks.php";
        $ms="id=$bid&error";
        is_empty($bsem,$text,$location,$ms,"");
        sem_func($bcourse,$bsem,$text,$location,$ms,"");

        //if admin try to update book cover
        if(!empty($_FILES['book_cover']['name']))
        {
            //if admin try to update both
            if(!empty($_FILES['book_file']['name']))
            {
                //Book Cover Uploading
                $allowed_img_exts=array("jpg","jpeg","png");
                $path="cover";
                $book_cover=upload_file($_FILES['book_cover'],$allowed_img_exts,$path);

                //File Uploading
                $allowed_file_exts=array("pdf","docx","pptx");
                $path="files";
                $file=upload_file($_FILES['book_file'],$allowed_file_exts,$path);

                //if error occured while uploading books
                if($book_cover['status']=="error" || $file['status']=="error")
                {
                    //$book_cover['data'];
                    $em="Book cover/file type is mismatch!!!";
                    header("Location: ../admin/editbooks.php?error=$em&id=$bid");
                    exit;
                }
                else
                {
                    //Current book cover location
                    $c_p_book_cover="../img/uploads/cover/$bcover";
                    //Current book file location
                    $c_p_file="../img/uploads/files/$bfile";

                    //Delete from the server
                    unlink($c_p_book_cover);
                    unlink($c_p_file);

                    /* Getting new File name and Book cover name*/
                    $file_URL=$file['data'];
                    $book_cover_url=$book_cover['data'];
                    $sql="update books set title=?,author_id=?,description=?,course_id=?,branch_id=?,semester=?,cover=?,file=? where id=?";
                    $stmt=$conn->prepare($sql);
                    $res=$stmt->execute([$btitle,$bdescription,$bauthor,$bcourse,$bbranch,$bsem,$book_cover_url,$file_URL,$bid]);
                    //If there is no error while updating the data
                    if($res)
                    {
                        $sm="Book Details Updated Successfully!!!!!";
                        header("Location: ../admin/editbooks.php?success=$sm&id=$bid");
                        exit;
                    }
                    else
                    {
                        $em="Unknown Error occured!!!";
                        header("Location: ../admin/editbooks.php?error=$em&id=$bid");
                        exit;
                    }

                }
            }
            else
            {
                //update just cover
                //Book Cover Uploading
                $allowed_img_exts=array("jpg","jpeg","png");
                $path="cover";
                $book_cover=upload_file($_FILES['book_cover'],$allowed_img_exts,$path);
                //if error occured while uploading books
                if($book_cover['status']==="error")
                {
                    $em=$book_cover['data'];
                    header("Location: ../admin/editbooks.php?error=$em&id=$bid");
                    exit;
                }
                else
                {
                    //Current book cover location
                    $c_p_book_cover="../img/uploads/cover/$bcover";

                    //Delete from the server
                    unlink($c_p_book_cover);

                    /* Getting new Book cover name*/
                    $book_cover_url=$book_cover['data'];
                    $sql="update books set title=?,author_id=?,description=?,course_id=?,branch_id=?,semester=?,cover=? where id=?";
                    $stmt=$conn->prepare($sql);
                    $res=$stmt->execute([$btitle,$bauthor,$bdescription,$bcourse,$bbranch,$bsem,$book_cover_url,$bid]);
                    //If there is no error while updating the data
                    if($res)
                    {
                        $sm="Book Details Updated Successfully!!!!!";
                        header("Location: ../admin/editbooks.php?success=$sm&id=$bid");
                        exit;
                    }
                    else
                    {
                        $em="Unknown Error occured!!!";
                        header("Location: ../admin/editbooks.php?error=$em&id=$bid");
                        exit;
                    }
                }
            }
        }
        //if admin try to update book file
        else if(!empty($_FILES['book_file']['name']))
        {
            //Just the Book file
            //File Uploading
            $allowed_file_exts=array("pdf","docx","pptx");
            $path="files";
            $file=upload_file($_FILES['book_file'],$allowed_file_exts,$path);
            //if error occured while uploading books
            if($file['status']=="error" || $file['status']=="error")
            {
                $em=$file['data'];
                header("Location: ../admin/editbooks.php?error=$em&id=$bid");
                exit;
            }
            else
            {
                //Current book file location
                $c_p_file="../img/uploads/files/$bfile";

                //Delete from the server
                unlink($c_p_file);

                /* Getting new File name and Book cover name*/
                $file_URL=$file['data'];
                $sql="update books set title=?,author_id=?,description=?,course_id=?,branch_id=?,semester=?,file=? where id=?";
                $stmt=$conn->prepare($sql);
                $res=$stmt->execute([$btitle,$bauthor,$bdescription,$bcourse,$bbranch,$bsem,$file_URL,$bid]);
                //If there is no error while updating the data
                if($res)
                {
                    $sm="Book Details Updated Successfully!!!!!";
                    header("Location: ../admin/editbooks.php?success=$sm&id=$bid");
                    exit;
                }
                else
                {
                    $em="Unknown Error occured!!!";
                    header("Location: ../admin/editbooks.php?error=$em&id=$bid");
                    exit;
                }
            }
        }
        else
        {
            //Just the Data
            $sql="update books set title=?,author_id=?,description=?,course_id=?,branch_id=?,semester=? where id=?";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$btitle,$bauthor,$bdescription,$bcourse,$bbranch,$bsem,$bid]);
            //If there is no error while updating the data
            if($res)
            {
                $sm="Book Details Updated Successfully!!!!!";
                header("Location: ../admin/editbooks.php?success=$sm&id=$bid");
                exit;
            }
            else
            {
                $em="Unknown Error occured!!!";
                header("Location: ../admin/editbooks.php?error=$em&id=$bid");
                exit;
            }
        }
    }
    else
    {
        header("Location: ../admin/editbooks.php");
        exit;
    }
}
?>