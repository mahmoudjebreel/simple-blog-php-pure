<?php
    require_once  "include/db.php";
    $sqlCategories      =   "SELECT * FROM blog_category";
    $queryCategories    =   mysqli_query($conn,$sqlCategories);
    $numCategories      =   mysqli_num_rows($queryCategories);


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
                           Blog Categroies
                        </h1>
                    </div>
             </div>
             
             <?php
                if(isset($_REQUEST['addcategroy'])){
                    if($_REQUEST['addcategroy'] == "success"){
                        echo '<div class="alert alert-success" role="alert">
                                <strong>Success!</strong>  Category Add.
                            </div>';;

                    }
                    else if($_REQUEST['addcategroy'] == "error"){
                        echo '<div class="alert alert-danger" role="alert">
                                 <strong>Error!</strong> Category Was Not Add.
                            </div>';;
                    }
                  
                }
                elseif(isset($_REQUEST['editcategory'])){
                    if($_REQUEST['editcategory'] == "success"){
                        echo '<div class="alert alert-success" role="alert">
                                <strong>Success!</strong> Change To The Category Were Saved.
                            </div>';;

                    }
                    else if($_REQUEST['editcategory'] == "error"){
                        echo '<div class="alert alert-error" role="alert">
                                 <strong>Error!</strong> Change To The Category Were Not Saved.
                            </div>';;
                    }
                }
                elseif(isset($_REQUEST['deletecategory'])){
                    if($_REQUEST['deletecategory'] == "success"){
                        echo '<div class="alert alert-success" role="alert">
                                <strong>Success!</strong> This Category Was Deleted.
                            </div>';;

                    }
                    else if($_REQUEST['deletecategory'] == "error"){
                        echo '<div class="alert alert-error" role="alert">
                                 <strong>Error!</strong> This Category Was Not Deleted..
                            </div>';;
                    }
                }
             ?>
                    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add A Categroy
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="POST" action="include/add-category.php">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" name="category-name">
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Title</label>
                                            <input class="form-control" name="category-meta-title">
                                        </div>
                                        <div class="form-group">
                                            <label>Categroy Path (lower case, no spaces)</label>
                                            <input class="form-control" name="category-path">
                                        </div>
                                   
                                        <button type="submit" class="btn btn-default" name="add-category-btn">Add Categroy</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                             
                     <div class="panel panel-default">
                            <div class="panel-heading">
                            All Categroy
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Meta Title</th>
                                                <th>Categroy Path</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $contuner   =   0;
                                            while ($rowCategroy  = mysqli_fetch_assoc($queryCategories)) {
                                                $contuner ++ ;
                                                $id             =   $rowCategroy['n_category_id'];
                                                $name           =   $rowCategroy['v_category_title'];
                                                $metaTitle      =   $rowCategroy['v_category_meta_title'];
                                                $categoryPath   =   $rowCategroy['v_category_path'];
                                             ?>
                                            <tr>
                                                <td><?php echo $contuner?></td>
                                                <td><?php echo $name?></td>
                                                <td><?php echo $metaTitle?></td>
                                                <td><?php echo $categoryPath?></td>
                                                <td>
                                                    <button  class="alert alert-warning" role="alert" class="popup-button" onclick="window.open('../category.php?group=<?php echo $categoryPath; ?>','_blank')">View</button>
                                                    <button  class="alert alert-secondary" role="alert" data-toggle="modal" data-target="#edit<?php echo $id;?>" class="popup-button">Edit</button>
                                                    <button  class="alert alert-danger" role="alert" class="alert alert-secondary" role="alert" data-toggle="modal" data-target="#delete<?php echo $id;?>" class="popup-button">Delete</button>
                                                </td>
                                                    <div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form role="form" method="POST" action="include/edit-category.php">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="category_id" value="<?php echo $id; ?>">
                                                                    <div class="form-group"> 
                                                                        <label>Name</label>
                                                                        <input class="form-control" name="edit-category-name" value="<?php echo $name; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Meta Title</label>
                                                                        <input class="form-control" name="edit-category-meta-title" value="<?php echo $metaTitle; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Category Path</label>
                                                                        <input class="form-control" name="edit-category-path" value="<?php echo $categoryPath; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="edit-category-btn">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                 </div>
                                                <div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form role="form" method="POST" action="include/edit-category.php">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="category_id" value="<?php echo $id; ?>">
                                                                    <div class="form-group"> 
                                                                        <label>Name</label>
                                                                        <input class="form-control" name="edit-category-name" value="<?php echo $name; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Meta Title</label>
                                                                        <input class="form-control" name="edit-category-meta-title" value="<?php echo $metaTitle; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Category Path</label>
                                                                        <input class="form-control" name="edit-category-path" value="<?php echo $categoryPath; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="edit-category-btn">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                 </div>
                                            

                                                 <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form role="form" method="POST" action="include/delete-category.php">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Delete Category</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="category_id" value="<?php echo $id; ?>">
                                                                   <p>Are You Sure That You Want Delete This Category? </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="delete-category-btn">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                 </div>
                                                </tr>
                                            <?php
                                                }   
                                            
                                            ?>

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