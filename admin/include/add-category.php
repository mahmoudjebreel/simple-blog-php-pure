<?php

    require_once "db.php";

    if(isset($_POST['add-category-btn'])){
        $name           =   $_POST['category-name'];
        $metaTitle      =   $_POST['category-meta-title'];
        $categoryPath   =   $_POST['category-path'];

        $date = date("Y-m-d");
        $time = date("H:i:s");

        $sqlAddCategories   = "INSERT INTO blog_category(v_category_title,v_category_meta_title,v_category_path,d_date_created,d_time_created) Values ('$name','$metaTitle','$categoryPath','$date','$time')";
        if(mysqli_query($conn,$sqlAddCategories)){
            mysqli_close($conn);
            header("Location: ../blog-categroy.php?addcategroy=success");
            exit();
        }  
        else{
            mysqli_close($conn);
            header("Location: ../blog-categroy.php?addcategroy=error");
            exit();
        }
    }
    else{
        header("Location: ../index.php");
        exit();
    }