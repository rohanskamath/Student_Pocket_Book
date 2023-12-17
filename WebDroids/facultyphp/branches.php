<option value="">--- Select Branch---</option>
<?php

    //Database Connection
    include "../connection.php";

    if(isset($_POST['course_id']))
    {
        $course_id=$_POST['course_id'];
        $sql="select * from branches where course_id=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$course_id]);
        if($stmt->rowCount() > 0)
        {
            $branches=$stmt->fetchAll();
        }
        foreach($branches as $branch)
        {
?>
<select>
    <option value="<?php echo $branch['branch_id']?>"><?php echo $branch['branch_name']?></option>
</select>
<?php
        }
    }
/*

Using MySQLi
<?php
    //Database Connection
    $conn=mysqli_connect("localhost","root","","Webdroid");
    if($conn)
    {
        if(isset($_POST['course_id'])){
            $course_id=$_POST['course_id'];
            $sql="select * from branches where course_id='$course_id'";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result))
            {
?>
<select>
    <option value="<?php echo $row['branch_id']?>"><?php echo $row['branch_name']?></option>
</select>
<?php
            }
        }
    }
    else
    {
        echo "Not Connected";
    }
?>
*/
?>