<?php
    require_once "db.php";
    if(isset($_POST['delete-blog-btn'])){
        $id             =   $_POST['blog_post_id'];

        $sqlDeleteBlogs  = "UPDATE blog_post SET f_post_status ='2' WHERE n_blog_post_id='$id'";
        if(mysqli_query($conn,$sqlDeleteBlogs)){
            mysqli_close($conn);
            header("Location: ../blogs.php?deleteblogpost=success");
            exit();
        }  
        else{
            mysqli_close($conn);
            header("Location: ../blogs.php?deleteblogpost=error");
            exit();
        }
    }
    else{
        header("Location: ../index.php");
        exit();
    }