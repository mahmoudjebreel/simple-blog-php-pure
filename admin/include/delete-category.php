<?php
    require_once "db.php";
    if(isset($_POST['delete-category-btn'])){
        $id             =   $_POST['category_id'];

        $sqlDeleteCategory  = "DELETE FROM blog_category WHERE n_category_id='$id'";
        if(mysqli_query($conn,$sqlDeleteCategory)){
            mysqli_close($conn);
            header("Location: ../blog-categroy.php?deletecategory=success");
            exit();
        }  
        else{
            mysqli_close($conn);
            header("Location: ../blog-categroy.php?deletecategory=error");
            exit();
        }
    }
    else{
        header("Location: ../index.php");
        exit();
    }