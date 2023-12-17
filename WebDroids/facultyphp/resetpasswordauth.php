<?php

    if(isset($_POST['email']) && isset($_POST['newpass']) && isset($_POST['cpass']))
    {
        /*Database Connection*/
        include "../connection.php";
        
       /*Geting data from POST Request and store them in var */
        $email=$_POST['email'];
        $newpassword=$_POST['newpass'];
        $cpassword=$_POST['cpass'];
        $encryptpass=password_hash($newpassword,PASSWORD_DEFAULT);
        $encryptcpass=password_hash($cpassword,PASSWORD_DEFAULT);

        if(!empty($email) && !empty($newpassword) && !empty($cpassword))
        {
            $sql1="select email from faculty where email=?";
            $stmt1=$conn->prepare($sql1);
            $stmt1->execute([$email]);
            if($stmt1->rowCount()>0)
            {
                if (password_verify($newpassword, $encryptcpass))
                {
                    $stmt=$conn->prepare("update faculty set password=?,cpassword=? where email=?");
                    $stmt->execute([$encryptcpass,$encryptcpass,$email]); 
                    $sm="Your Password is Changed!!";
                    header("Location: ../faculty/facultylogin.php?success=$sm");
                }
            }
            else
            {
                $em = "Account is Not Present!!!";
                header("Location: ../faculty/facultylogin.php?error=$em");
            }
        }
        else
        {
            $em = "Please Fill out All Fields!!!";
            header("Location: ../faculty/facultylogin.php?error=$em");
        }
    }
?>