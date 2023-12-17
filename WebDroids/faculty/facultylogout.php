<?php
/* Admin Logout where the Session to particular user will be destroyed */
    session_start();
    session_unset();
    session_destroy();
    header("location: ../faculty/facultylogin.php");
    exit();
?>