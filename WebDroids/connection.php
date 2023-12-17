<?php

$server="localhost";
$username="root";
$password="";
$database="webdroid";
    /* Creating database connection using the PHP Data Objects(PDO) */
    try
    {
        $conn=new PDO("mysql:host=$server;dbname=$database",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Connection Failed: ".$e->getMessage();
    }
?>