<?php 
include("inc/admin-header.php");
delete_categories();

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
                            Categories
                        </h1>

                        <div class="col-sm-6">

                            <form action="" method="POST">
                            <?php add_categories(); ?>
                                <div class="form-group">
                                    <label for="cat_title">Category Title</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                 <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="add_cat" value="Add Category">
                                </div>
                            </form><br>
                            

                            <!-- edit post form -->
                             <form action="" method="POST">

                                <div class="form-group">
                                    <?php 
                                     if (isset($_GET['edit-cat'])) {
                                        $edit_url_key = $_GET['edit-cat'];

                                    $get_cat_title_query = mysqli_query($connect, "SELECT * FROM categories WHERE cat_id = $edit_url_key ");
                                    while ($row = mysqli_fetch_assoc($get_cat_title_query)) {
                                        $edit_cat_id = $row['cat_id'];
                                        $edit_cat_title = $row['cat_title'];

                                    if (isset($_POST['edit_cat'])) {
                                        $edit_category = $_POST['edit_category'];
                                        if ($edit_category == "" || empty($edit_category)) {
                                            echo 'This field is required';
                                        }else {
                                             $edit_cat_query = mysqli_query($connect, "UPDATE categories SET cat_title = '$edit_category' WHERE cat_id = $edit_url_key ");
                                            if ($edit_cat_query) {
                                                echo '<script>alert("Updated")</script>';
                                                header("Location: categories.php");
                                            }
                                        }
                                    }
                                    ?> 
                                    <label for="cat_title">Edit Title</label>
                                    <input type="text" class="form-control" name="edit_category" value="<?php if(isset($edit_cat_title)){echo $edit_cat_title; }   ?>"><br>
                                    <input type="submit" class="btn btn-primary" name="edit_cat" value="Update category">
                                <?php }} ?>
                                </div>
                            </form>
                            

                        </div>
                        
                        <div class="col-sm-6">
                            <table class="table table-bordered table-condensed table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>CATEGORY TITLE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php 
                                    $num = 1;
                                    $cat_query =  mysqli_query($connect, "SELECT * FROM categories ORDER BY cat_id ASC");
                                    while ($row = mysqli_fetch_assoc($cat_query)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                    ?>
                                    <tr>
                                        <td><?php echo $num++ ; ?></td>
                                        <td><?php echo $cat_title; ?></td>
                                        <td>
                                            <a href="categories.php?edit-cat=<?php echo $cat_id ?>" class="btn btn-primary btn-xs">edit</a>
                                            <a href="categories.php?delete-cat=<?php echo $cat_id ?>" class="btn btn-danger btn-xs">delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div> <!-- /.row -->

            </div> <!-- /.container-fluid -->

        </div> <!-- /#page-wrapper -->

    </div> <!-- /#wrapper -->
    
<?php include("inc/admin-footer.php") ?>