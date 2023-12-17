<?php
session_start();
    if(isset($_POST['signupName']) && isset($_POST['signupEmail']) && isset($_POST['signupPass']) && isset($_POST['signupCPass'])){

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
        $dept=$_POST['signupDept'];
        $profile="Faculty";
        if(!empty($name) && !empty($email) && !empty($password) && !empty($cpassword) && !empty($dept))
        {
            $sql1="select email from faculty where email=?";
            $stmt1=$conn->prepare($sql1);
            $stmt1->execute([$email]);
            if($stmt1->rowCount()>0)
            {
                $faculty=$stmt1->fetch();
                $femail=$faculty['email'];
                if($email === $femail)
                {
                    $em = "Email-Id is already present!!!";
                    header("Location: ../faculty/facultyregistration.php?error=$em");
                }
            }
            else
            {
                $encryptpass=password_hash($password,PASSWORD_DEFAULT);
                $encryptcpass=password_hash($cpassword,PASSWORD_DEFAULT);
                $sql2="Select regno from faculty order by id DESC Limit 1";
                $stmt2= $conn->prepare($sql2);
                $stmt2->execute();
                if($stmt2->rowCount() == 1)
                {
                    $res=$stmt2->fetchcolumn();
                }
                $fregno=$res;
                /*Inserting records to the table */
                $sql3="insert into faculty (regno,name,email,password,cpassword,profile_type,dept) values(?,?,?,?,?,?,?)";
                $stmt3=$conn->prepare($sql3);
                $stmt3->execute([$fregno+1,$name,$email,$encryptpass,$encryptcpass,$profile,$dept]);
                $sm = "Acccount is successfully created!!!";
                header("Location: ../faculty/facultylogin.php?success=$sm");
            }
        }
        else
        {
            $em = "Please Fill out All Fields!!!";
            header("Location: ../faculty/facultyregistration.php?error=$em");
        }
    }
    else
    {
        #Redirect to adminRegistration page
        header("Location: ../faculty/facultyregistration.php");
    }
?>