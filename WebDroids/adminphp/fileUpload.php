<?php

//File Upload Helper function
function upload_file($files,$allowed_exs,$path)
{
    //Get Data and store them in variable.
    $file_name=$files['name'];
    $tmp_name=$files['tmp_name'];
    $error=$files['error'];
    //if there is no error occured while uploading
    if($error ===0)
    {
        //get File Extension and store it in var
        $file_ext=pathinfo($file_name,PATHINFO_EXTENSION);

        /* Converting the file extension into lower case and store it into variable*/
        $file_ex_loc=strtolower($file_ext);

        /* Check if the file extension exists in $allowed_ex array*/
        if(in_array($file_ex_loc,$allowed_exs))
        {
            /*Renaming the file with random Strings */
            $new_file_name=uniqid("",true).'.'.$file_ex_loc;
            //assigning upload path
            $file_upload_path='../img/uploads/'.$path.'/'.$new_file_name;
            //Moving uploded file to root directory upload/$path folder
            move_uploaded_file($tmp_name,$file_upload_path);

            /*Creating error message associative array with named keys status and data*/
            $sm['status']='success';
            $sm['data']=$new_file_name;
            //Return the sm array
            return $sm;
        }
        else
        {
            /*Creating error message associative array with named keys status and data*/
            $em['status']='error';
            $em['data']='You cannot upload files of this type!!!';
            //Return the em array
            return $em;
        }
    }
    else
    {
        /*Creating error message associative array with named keys status and data*/
        $em['status']='error';
        $em['data']='Error occurred while uploading!!!';
        //Return the em array
        return $em;
    }
}
?>