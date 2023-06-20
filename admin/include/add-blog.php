<?php
   require_once "db.php";
   session_start();

   if (isset($_POST['submit-blog'])) {
       $title                          =   $_POST['blog-title'];
       $metaTitle                      =   $_POST['blog-meta-title'];
       $blogCategory                   =   $_POST['blog-category'];
       $blogSumary                     =   $_POST['blog-sumary'];
       $blogContent                    =   $_POST['blog-content'];
       $blogTags                       =   $_POST['blog-tags'];
       $blogPath                       =   $_POST['blog-path'];
       $homePagePlacement              =   $_POST['blog-home-page-placement'];


       $date = date("Y-m-d");
       $time = date("H:i:s");

       if (empty($title)) {
           formError("emptytitle");
       } elseif (empty($blogCategory)) {
           formError("emptyCategory");
       } elseif (empty($blogSumary)) {
           formError("emptySumary");
       } elseif (empty($blogContent)) {
           formError("emptyContent");
       } elseif (empty($blogTags)) {
           formError("emptyTags");
       } elseif (empty($blogPath)) {
           formError("emptyPath");
       }
       if (strpos($blogPath, " ")!== false) {
           formError("pathcontainspaces");
       }
       if (empty($homePagePlacement)) {
           $homePagePlacement = 0;
       }
       $sqlCheckBlogTitle      =   "SELECT v_post_title FROM blog_post WHERE  v_post_title='$title' AND f_post_status !='2' ";
       $queryCheckBlogTitle    =   mysqli_query($conn, $sqlCheckBlogTitle);

       $sqlCheckBlogPath       =   "SELECT v_post_path FROM blog_post WHERE  v_post_path='$blogPath' AND f_post_status !='2' ";
       $queryCheckBlogPath     =   mysqli_query($conn, $sqlCheckBlogPath);

       if (mysqli_num_rows($queryCheckBlogTitle) > 0) {
           formError("titlebeenused");
       } elseif (mysqli_num_rows($queryCheckBlogPath) > 0) {
           formError("pathbeenused");
       }

       if ($homePagePlacement != 0) {

           $sqlCheckBlogHomePagePlac     =   "SELECT * FROM blog_post WHERE  n_home_page_placement='$homePagePlacement' AND f_post_status !='2'";
           $queryCheckBlogHomePagePlac   =    mysqli_query($conn, $sqlCheckBlogHomePagePlac);

           if (mysqli_num_rows($queryCheckBlogHomePagePlac)) {
               $sqlUpdateBlogHomePagePlac    =   "UPDATE blog_post SET n_home_page_placement='$homePagePlacement' AND f_post_status !='2'";

               if (!mysqli_query($conn, $sqlUpdateBlogHomePagePlac)) {
                formError("HomePagePlacement");
           }    
        }
    }
        $mainImgUrl =   uploadImage($_FILES["main-blog-image"]["name"],"main-blog-image","main");
        $altImgUrl =    uploadImage($_FILES["alt-blog-image"]["name"],"alt-blog-image","alt");

        $sqlAddBlog = "INSERT INTO blog_post(n_category_id,v_post_title,v_post_meat_title,v_post_path,v_post_Sumary,
        v_post_content,v_main_image_url,v_alt_image_url,n_home_page_placement
        ,f_post_status,d_date_created,d_time_created)
        Values ('$blogCategory','$title','$metaTitle','$blogPath','$blogSumary','$blogContent','$mainImgUr','$altImgUrl',
        '$homePagePlacement','1','$date','$time')";
        if(mysqli_query($conn,$sqlAddBlog)){
            mysqli_close($conn);
            
           unset($_SESSION['blogTitle']);
           unset($_SESSION['blogMetaTilte']);
           unset($_SESSION['blogCategory']);
           unset($_SESSION['blogSumary']);
           unset($_SESSION['blogContent']);
           unset($_SESSION['blogTags']);
           unset($_SESSION['blogPath']);
           unset($_SESSION['blogHomePagePlacement']);

            header("Location: ../blogs.php?addblog=success");
            exit();

        }  
        else{
        formError("sqlerror");
        }
}
else
{
        header("Location: ../index.php");
        exit();
}       
 

   function  formError($errorCode){
        require_once "db.php";
        $_SESSION['blogTitle']                   =  $_POST['blog-title'];
        $_SESSION['blogMetaTilte']               =  $_POST['blog-meta-title'];
        $_SESSION['blogCategory']                =  $_POST['blog-category'];
        $_SESSION['blogSumary']                  =  $_POST['blog-sumary'];
        $_SESSION['blogContent']                 =  $_POST['blog-content'];
        $_SESSION['blogTags']                    =  $_POST['blog-tags'];
        $_SESSION['blogPath']                    =  $_POST['blog-path'];
        $_SESSION['blogHomePagePlacement']       =  $_POST['blog-home-page-placement'];

        mysqli_close($conn);
        header("Location: ../write-a-blog.php?addblog=".$errorCode);
        exit();
   }

    function uploadImage($img, $imgName,$imgType){
    $imgUrl = "";
    $valiExts = array("jpg","png","jpeg","bmp","gif");
    if($img == ""){
        formError("empty".$imgType."image");
    }
    else if($_FILES[$imgName]["size"] <= 0){
            formError($imgType."imageerror");
    }
    else{
        $ext    =   strtolower(end(explode(".",$img)));
        if (!in_array($ext, $valiExts)) {
            formError("invalidateType".$imgType."image");
        }
        $folder         =   "../images/blog-images/";
        $imgNewName     =   rand(10000,990000).'_'.time().'.'.$ext;
        $imgPath        =   $folder.$imgNewName;

        if(move_uploaded_file($_FILES[$imgName]['tmp_name'],$imgPath)){
            $imgUrl =   "http://localhost/temp/blog/admin/images/blog-images/".$imgNewName;
        }
        else{
            formError("Erroruploading".$imgType."Images");
        }
        
    }
    return $imgUrl;
}