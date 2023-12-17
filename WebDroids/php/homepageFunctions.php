<?php
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
    //Get All Branches related to Courses
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

    //Get all Branches
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
    //Get all approved Books
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
    //search books using search bar
    function search_books($conn,$key)
    {
        $key="%{$key}%";
        $status="Approved";
        $sql="Select * from books b join author a on b.author_id=a.author_id join branches br on b.branch_id=br.branch_id join courses c on c.course_id=b.course_id where (b.title like ? or b.isbn like ? or br.branch_name like ? or a.author_name like ? or c.course_name like ?) and status=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$key,$key,$key,$key,$key,$status]);
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
    //Get faculty info by id
    function get_student($id,$conn)
    {
        $sql="select * from students where id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount()==1)
        {
            $user_id=$stmt->fetch();
            return $user_id;
        }
        else
        {
            return 0;
        }
    }
    //Get books by Courses
    function get_books_by_CourseID($conn,$id)
    {
        $status="Approved";
        $sql="Select * from books where course_id=? and status=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id,$status]);
        if($stmt->rowCount()>0)
        {
            $books=$stmt->fetchAll();
        }
        else
        {
            $books=0;
        }
        return $books;
    }
    //Get Course name
    function get_current_course($conn,$id)
    {
        $sql="Select * from courses where course_id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount()>0)
        {
            $course=$stmt->fetch();
        }
        else
        {
            $course=0;
        }
        return $course;
    }
    //Get books by branches
    function get_books_by_BranchID($conn,$id)
    {
        $status="Approved";
        $sql="Select * from books where branch_id=? and status=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id,$status]);
        if($stmt->rowCount()>0)
        {
            $books=$stmt->fetchAll();
        }
        else
        {
            $books=0;
        }
        return $books;
    }
    //Get current branch
    function get_current_branch($conn,$id)
    {
        $sql="Select * from branches where branch_id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount()>0)
        {
            $branch=$stmt->fetch();
        }
        else
        {
            $branch=0;
        }
        return $branch;
    }
    //Get all Books related to Authors
    function get_books_by_AuthorID($conn,$id)
    {
        $status="Approved";
        $sql="Select * from books where author_id=? and status=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id,$status]);
        if($stmt->rowCount()>0)
        {
            $books=$stmt->fetchAll();
        }
        else
        {
            $books=0;
        }
        return $books;
    }
    //Get current Author
    function get_current_Author($conn,$id)
    {
        $sql="Select * from author where author_id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount()>0)
        {
            $author=$stmt->fetch();
        }
        else
        {
            $author=0;
        }
        return $author;
    }
?>