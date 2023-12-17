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
        $em="The ".$text." should contain valid number";
        header("Location: $location?$ms=$em&$data");
        exit;
    }
    return 0;
}
?>