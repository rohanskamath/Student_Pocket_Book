<?php

/* Form Validation Function */
function is_empty($var,$text,$location,$ms,$data)
{
    if(empty($var))
    {
        $em="The ".$text." is required";
        header("Location: $location?$ms=$em&$data");
        exit;
    }
    return 0;
}

function isbn_func($var,$text,$location,$ms,$data)
{
    if(is_numeric($var))
    {
        $em="The ".$text." should contain valid name";
        header("Location: $location?$ms=$em&$data");
        exit;
    }
    return 0;
}
function sem_func($var1,$var,$text,$location,$ms,$data)
{
    if(!is_numeric($var))
    {
        $em="The ".$text." should be number";
        header("Location: $location?$ms=$em&$data");
        exit;
    }
    if($var1==4 || $var1==3)
    {
        if($var>4)
        {
            $em="The ".$text." for MCA/MSc should be less than 4";
            header("Location: $location?$ms=$em&$data");
            exit;
        }
    }
    else if($var1==1)
    {
        if($var>3)
        {
            $em="The ".$text." for M-Tech should be less than 3";
            header("Location: $location?$ms=$em&$data");
            exit;
        }    
    }
    return 0;
}
?>