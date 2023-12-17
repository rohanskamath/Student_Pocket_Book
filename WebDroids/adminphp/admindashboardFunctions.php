<?php
    //Get All Books function
    function get_all_books($conn)
    {
        $sql="Select * from books where status='pending' or status='approved' order by ISBN desc";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() >0)
        {
            $books=$stmt->fetchAll();
        }
        else
        {
            $books=0;
        }
        return $books;
    }
    //Get All Authors function
    function get_all_authors($conn)
    {
        $sql="Select * from author";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $authors=$stmt->fetchAll();
        }
        else
        {
            $authors=0;
        }
        return $authors;
    }
    //Get All Courses function
    function get_all_courses($conn)
    {
        $sql="Select * from courses";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $branches=$stmt->fetchAll();
        }
        else
        {
            $branches=0;
        }
        return $branches;
    }
    //Get All Student function
    function get_all_students($conn)
    {
        $sql="Select * from students";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $students=$stmt->fetchAll();
        }
        else
        {
            $students=0;
        }
        return $students;
    }
    //Get All Faculties
    function get_all_faculties($conn)
    {
        $sql="Select * from faculty";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $faculties=$stmt->fetchAll();
        }
        else
        {
            $faculties=0;
        }
        return $faculties;
    }
    //Get All Branches
    function get_all_branches($conn)
    {
        $sql="Select courses.course_id,courses.course_name,branches.branch_id,branches.branch_name from courses JOIN branches on branches.course_id=courses.course_id order by branch_id";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $branches=$stmt->fetchAll();
        }
        else
        {
            $branches=0;
        }
        return $branches;
    }
    //Get Book by id function
    function get_book($conn,$id)
    {
        $sql="Select * from books where id=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount() >0)
        {
            $book=$stmt->fetch();
        }
        else
        {
            $book=0;
        }
        return $book;
    }
    //Retrive all Branches
    function get_branches($conn)
    {
        $sql="select * from branches";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0)
        {
            $branches=$stmt->fetch();
        }
        else
        {
            $branches=0;
        }
        return $branches;
    }
    //Retrive all Approved Books
    function get_all_Approvedbooks($conn)
    {
        $sql="Select * from books where status='approved' order by ISBN desc";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() >0)
        {
            $books=$stmt->fetchAll();
        }
        else
        {
            $books=0;
        }
        return $books;
    }
    //Retrive all Rejected Books
    function get_all_Rejectedbooks($conn)
    {
        $sql="Select * from books where status='rejected' order by ISBN desc";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() >0)
        {
            $books=$stmt->fetchAll();
        }
        else
        {
            $books=0;
        }
        return $books;
    }
    //Retrive all Pending Books
    function get_all_Pendingbooks($conn)
    {
        $sql="Select * from books where status='pending' order by ISBN desc";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() >0)
        {
            $books=$stmt->fetchAll();
        }
        else
        {
            $books=0;
        }
        return $books;
    }
    //Search books by Title, Author, Course, Branch
    function search_books($conn,$key)
    {
        $key="%{$key}%";
        $sql="Select * from books b join author a on b.author_id=a.author_id join branches br on b.branch_id=br.branch_id where b.title like ? or b.isbn like ? or br.branch_name like ? or a.author_name like ?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$key,$key,$key,$key]);
        if($stmt->rowCount() > 0)
        {
            $books=$stmt->fetchAll();
        }
        else
        {
            $books=0;
        }
        return $books;
    }
    //Get All Admins
    function get_all_admin($conn)
    {
        $sql="Select * from admin";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $admin=$stmt->fetchAll();
        }
        else
        {
            $admin=0;
        }
        return $admin;
    }
?>