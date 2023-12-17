<?php
session_start();
    if(isset($_POST['signupName']) && isset($_POST['signupEmail']) && isset($_POST['signupPass']) && isset($_POST['signupCPass']) && isset($_POST['signupcourses'])){

        /*Database Connection*/
        include "../connection.php";

        /*Calling validation function*/
        include "../php/validation.php";

        /*Geting data from POST Request and store them in var */
        $dname=strtolower($_POST['signupName']);
        $name=ucwords($dname);
        $email=strtolower($_POST['signupEmail']);
        $password=$_POST['signupPass'];
        $cpassword=$_POST['signupCPass'];
        $courseId=$_POST['signupcourses'];
        $signupcourses="";
        //Fetch course name
        $sql="select course_name from courses where course_id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$courseId]);
        if($stmt->rowCount()>0)
        {
            $course=$stmt->fetch();
            $signupcourses=$course['course_name'];
            $profile="Student";
            if(!empty($name) && !empty($email) && !empty($password) && !empty($cpassword) && !empty($signupcourses))
            {
                $sql1="select email from students where email=?";
                $stmt1=$conn->prepare($sql1);
                $stmt1->execute([$email]);
                if($stmt1->rowCount()>0)
                {
                    $student=$stmt1->fetch();
                    $semail=$student['email'];
                    if($email === $semail)
                    {
                        $em = "Email-Id is already present!!!";
                        header("Location: ../registration.php?error=$em");
                    }
                }
                else
                {
                    $encryptpass=password_hash($password,PASSWORD_DEFAULT);
                    $encryptcpass=password_hash($cpassword,PASSWORD_DEFAULT);
                    $sql2="Select regno from students order by id DESC Limit 1";
                    $stmt2= $conn->prepare($sql2);
                    $stmt2->execute();
                    if($stmt2->rowCount() == 1)
                    {
                        $res=$stmt2->fetchcolumn();
                    }
                    $sregno=$res;
                    /*Inserting records to the table */
                    $sql3="insert into students (regno,name,email,password,cpassword,profile_type,course) values(?,?,?,?,?,?,?)";
                    $stmt3=$conn->prepare($sql3);
                    $stmt3->execute([$sregno+1,$name,$email,$encryptpass,$encryptcpass,$profile,$signupcourses]);
                    $sm = "Acccount is successfully created!!!";
                    header("Location: ../login.php?success=$sm");
                }
            }
            else
            {
                $em = "Please Fill out All Fields!!!";
                header("Location: ../registration.php?error=$em");
            }
        }
    }
    else
    {
        #Redirect to studentRegistration page
        header("Location: ../registration.php");
    }
?>