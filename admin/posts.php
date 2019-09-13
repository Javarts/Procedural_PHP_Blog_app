<?php 
$title = "VIEW - POSTS";
include("inc/admin-header.php");
delete_categories();

if (isset($_GET['source'])) {
    $source = $_GET['source'];
}else {
    $source = "";
}

?>
<body>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include("inc/admin-alpha-nav.php") ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php if (isset($source) && $source == "add-post") {
                                  echo 'Add Post'; 
                                } elseif (isset($source) && $source == "edit-post") {
                                    echo 'Edit Post'; 
                                }else{
                                    echo 'All Posts'; 
                                }
                            ?>
                        </h1>
                        
                        <?php 
                            switch ($source) {
                                case "add-post":
                                    include("add-post.php");  
                                    break;

                                case "edit-post":
                                    include("edit-post.php");  
                                    break;
                                
                                default:
                                    include("view_all_posts.php");
                                    break;
                            }

                         ?>



                    </div>
                </div> <!-- /.row -->

            </div> <!-- /.container-fluid -->

        </div> <!-- /#page-wrapper -->

    </div> <!-- /#wrapper -->

<?php include("inc/admin-footer.php") ?>