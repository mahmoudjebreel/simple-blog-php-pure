<?php

    require_once "include/db.php";
    $sqlBlogs   =   "SELECT * FROM 	blog_post WHERE f_post_status !='2'";
    $queryBlogs =   mysqli_query($conn,$sqlBlogs);
    $numBlogs   =   mysqli_num_rows($queryBlogs);
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
                           Blogs Posts
                        </h1>
                    </div>
             </div>
             <?php 
                if (isset($_REQUEST['addblog'])) {
                    if ($_REQUEST['addblog'] == "success") {
                        echo '<div class="alert alert-success" role="alert">
                                <strong>Success!</strong>  Blogs Add.
                            </div>';
                        ;
                    } 
                    // elseif ($_REQUEST['addblog'] == "error") {
                    //     echo '<div class="alert alert-danger" role="alert">
                    //              <strong>Error!</strong> Blogs Was Not Add.
                    //         </div>';
                    //     ;
                    // }
                }
                if(isset($_REQUEST['deleteblogpost'])){
                    if($_REQUEST['deleteblogpost'] == "success"){
                        echo '<div class="alert alert-success" role="alert">
                                <strong>Success!</strong> Blog Post Deleted.
                            </div>';;

                    }
                    else if($_REQUEST['deleteblogpost'] == "error"){
                        echo '<div class="alert alert-error" role="alert">
                                 <strong>Error!</strong> Blog Post Not Deleted..
                            </div>';;
                    }
                }
             ?>
                    <div class="row">
                <div class="col-lg-12">
               
                    <!-- /.panel -->
                             
                     <div class="panel panel-default">
                            <div class="panel-heading">
                            All Blogs
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Categroy</th>
                                                <th>Views</th>
                                                <th>Blog Path</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $contuner   =   0;
                                            while ($rowBlog  = mysqli_fetch_assoc($queryBlogs)) {
                                                $contuner ++ ;
                                                $id             =   $rowBlog['n_blog_post_id'];
                                                $name           =   $rowBlog['v_post_title'];
                                                $cId            =   $rowBlog['n_category_id'];
                                                $view           =   $rowBlog['n_blog_post_view'];
                                                $blogPath       =   $rowBlog['v_post_path'];

                                                $sqlGetCategoryName     =   "SELECT v_category_title FROM blog_category WHERE n_category_id='$cId'";
                                                $queryGetCategoryName   =   mysqli_query($conn, $sqlGetCategoryName);
                                                if ($rowGetCategoryName  = mysqli_fetch_assoc($queryGetCategoryName)) {
                                                    $categoryName   =   $rowGetCategoryName['v_category_title'];
                                                } ?>
                                            <tr>
                                                <td><?php echo $contuner ?></td>
                                                <td><?php echo $name?></td>
                                                <td><?php echo $categoryName ?></td>
                                                <td><?php echo $view ?></td>
                                                <td><?php echo $blogPath ?></td>
                                                <td>
                                                    <button  class="alert alert-warning" role="alert"  class="popup-button" onclick="window.open('../single-blog.php?blog=<?php echo $blogPath; ?>','_blank')">View</button>
                                                    <button class="alert alert-secondary" role="alert" class="popup-button" onclick="location.href'edit-blog.php?blogid=<?php echo $id;?>'">Edit</button>
                                                    <button class="alert alert-danger" role="alert"    class="popup-button" data-toggle="modal" data-target="#delete<?php echo $id;?>">Delete</button>
                                                    <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form role="form" method="POST" action="include/delete-blogs.php">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Delete Blog Post</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="blog_post_id" value="<?php echo $id; ?>">
                                                                   <p>Are You Sure That You Want Delete This Blog Post? </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="delete-blog-btn">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                 </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
              
                </div>
                <!-- /.col-lg-12 -->
            </div>
                </div> 
                 <!-- /. ROW  -->
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
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>