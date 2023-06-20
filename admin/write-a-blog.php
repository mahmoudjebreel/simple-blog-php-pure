<?php
    require_once "include/db.php";
    session_start();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Dream</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
    <?php include_once "header.php";?>
        <!--/. NAV TOP  -->
        <?php include_once "sidebar.php";?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                          Write A Blog
                        </h1>
                    </div>
                </div> 
                <?php
                     if(isset($_REQUEST['addblog'])){
                        if($_REQUEST['addblog'] == "emptytitle"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Add A Blog Title.
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "emptyCategory"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Select A Blog Category.
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "emptySumary"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Add A Blog Sumary.
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "emptyContent"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Add A Blog Content.
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "emptyTags"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Add A Blog Tags.
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "emptyPath"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Add A Blog Path.
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "sqlerror"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Try Agin !
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "pathcontainspaces"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Do Not Add Any Spaces In The Blog Path .
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "emptymainimage"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Upload A Main Image .
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "emptyaltimage"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong>  Please Upload An Alternate Image .
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "mainimageerror"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong>  Please Upload Another Main Image.
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "altimageerror"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Please Upload Another Alternate Image .
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "invalidtypemainimage"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Main Images -> Upload Only jpg, jpeg, png, gif, bmp, images
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "invalidtypealtimage"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Alternate Images -> Upload Only jpg, jpeg, png, gif, bmp, images
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "erroruploadingmainimage"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Alternate Images -> There Was An Error While Uploading . Please Try Agin Later !
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "erroruploadingaltimage"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Alternate Images -> There Was An Error While Uploading . Please Try Agin Later !
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "titlebeenused"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> This Title Been Used In Another Blog . Please Enter A Different Title .
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "pathbeenused"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> This Path Been Used In Another Blog . Please Enter A Different Path .
                                </div>';
                        }
                        else if($_REQUEST['addblog'] == "HomePagePlacement"){
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> An Unexpected Error Please Trying To set The Home Page Placement.
                                </div>';
                        }
                      
                      
                      
                    }

                 ?>
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Write A Blog
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="POST" action="include/add-blog.php"  enctype="multipart/form-data" onsubmit="return validateImage();">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input class="form-control" name="blog-title" value="<?php if(isset($_SESSION['blogTitle'])){
                                                echo $_SESSION['blogTitle'];
                                            } ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Title</label>
                                            <input class="form-control" name="blog-meta-title"  value="<?php if(isset($_SESSION['blogMetaTilte'])){
                                                echo $_SESSION['blogMetaTilte'];
                                            } ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Blog Category</label>
                                            <select class="form-control" name="blog-category">
                                                <option >Select Category</option>
                                                <?php

                                                    $sqlCategories      =   "SELECT * FROM blog_category";
                                                    $queryCategories    =   mysqli_query($conn,$sqlCategories);
                                                    while($rowCategories = mysqli_fetch_assoc($queryCategories)){
                                                        $cid      =   $rowCategories['n_category_id'];
                                                        $cName    =   $rowCategories['v_category_title'];
                                                        
                                                        if(isset($_SESSION['blogCategory'])){
                                                            if($_SESSION['blogCategory'] == $cid){
                                                                echo "<option value='".$cid."' selected=''>".$cName."</option>";
                                                            }else{
                                                                echo "<option value='".$cid."'>".$cName."</option>";
                                                            }
                                                        }
                                                        else{
                                                             echo "<option value='".$cid."'>".$cName."</option>";
                                                        }
                                                    }
                                                   
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Main Image</label>
                                            <input type="file" name="main-blog-image"  id="main-blog-image">
                                        </div>
                                        <div class="form-group">
                                            <label>Alternate Image</label>
                                            <input type="file" name="alt-blog-image"  id="alt-blog-image">
                                        </div>
                                        <div class="form-group">
                                            <label>Sumary</label>
                                            <textarea class="form-control" rows="3" name="blog-sumary" value="<?php if(isset($_SESSION['blogSumary'])){
                                                echo $_SESSION['blogSumary'];
                                            } ?>"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Blog Content</label>
                                            <textarea class="form-control" rows="3" name="blog-content" value="<?php if(isset($_SESSION['blogContent'])){
                                                echo $_SESSION['blogContent'];
                                            } ?>"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Blog Tags</label>
                                            <input class="form-control" name="blog-tags" value="<?php if(isset($_SESSION['blogTags'])){
                                                echo $_SESSION['blogTags'];
                                            } ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Blog Path</label>
                                            <div class="input-group">
                                            <span class="input-group-addon">www.myblog.com/</span>
                                            <input type="text" class="form-control" placeholder="" name="blog-path" value="<?php if(isset($_SESSION['blogPath'])){
                                                echo $_SESSION['blogPath'];
                                            } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Home Page Placement</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="blog-home-page-placement" id="optionsRadiosInline1" value="1"  <?php if(isset($_SESSION['blogHomePagePlacement'])){
                                              if ($_SESSION['blogHomePagePlacement'] == 2) {
                                                  echo "checke=''";
                                              }
                                              } ?>>1
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="blog-home-page-placement" id="optionsRadiosInline2" value="2" <?php if(isset($_SESSION['blogHomePagePlacement'])){
                                              if ($_SESSION['blogHomePagePlacement'] == 2) {
                                                  echo "checke=''";
                                              }
                                              } ?>>2
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="blog-home-page-placement" id="optionsRadiosInline3" value="3" <?php 
                                            if(isset($_SESSION['blogHomePagePlacement'])){
                                              if ($_SESSION['blogHomePagePlacement'] == 3) {
                                                  echo "checke=''";
                                              }
                                              } ?>>3
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-default" name="submit-blog">Add Blog</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<?php include_once "footer.php";?>
			</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <script>
        function validateImage(){
            var main_img    =   $("#main-blog-image").val();
            var alt_img     =   $("#alt-blog-image").val();

            var exts        =   ['jpg','jpeg','png','gif','bmp'];

            var get_ext_main_img   =   main_img.split('.');
            var get_ext_alt_img    =   alt_img.split('.');

            get_ext_main_img       =   get_ext_main_img.reverse();
            get_ext_alt_img        =   get_ext_alt_img.reverse();

            main_img_check  =  false;
            alt_img_check  =  false;

            if(main_img.length >0){
                if($.inArray(get_ext_main_img[0].tolowerCase(),exts)>= -1){
                    main_img_check  =  true;
                }
                else{
                    alert("Error => Main Images Upload Only jpg, jpeg, png, gif, bmp Images");
                    main_img_check  =  false;
                }
            }
            else{
                    alert("Please Upload A Main Images.");
                    main_img_check  =  false;
            }

            if(alt_img.length >0){
                if($.inArray(get_ext_alt_img[0].tolowerCase(),exts)>= -1){
                    alt_img_check  =  true;
                }
                else{
                    alert("Error => Alternate Images Upload Only jpg, jpeg, png, gif, bmp Images");
                   alt_img_check  =  false;
                }
            }
            else{
                    alert("Please Upload A Alternate Images.");
                    alt_img_check  =  false;
            }

            if(main_img_check == true && alt_img_check == true){
                return true;
            }
            else{
                return false;
            }
        }


    </script>
   
</body>
</html>