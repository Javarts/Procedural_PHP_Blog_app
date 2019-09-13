<?php 
$title = " READ MORE";
include("inc/header.php");


if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $post_slug = $_GET['slug'];

$get_views_query = mysqli_query($connect, "UPDATE posts SET post_views_count = post_views_count +1 WHERE post_id = $post_slug ");
confirmQuery($get_views_query);

    
 ?>

<body>

    <!-- Navigation -->
    <?php include ("inc/navbar.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">


                <!-- Blog Post -->

                <?php 

                $display_post_query = mysqli_query($connect, "SELECT * FROM posts WHERE post_id = $post_slug");
                while ($row = mysqli_fetch_assoc($display_post_query)) {
                    $p_id = $row['post_id'];
                    $p_cat_id = $row['post_category_id'];
                    $p_title = $row['post_title'];
                    $p_author = $row['post_author'];
                    $p_date = $row['post_date'];
                    $p_image = $row['post_image'];
                    $p_content = $row['post_content'];
                    $p_status = $row['post_status'];
                    ?>

                <!-- Title -->
                 <h2>
                    <a href=""><?php echo $p_title; ?></a>
                </h2>
                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $p_author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2019 at <?php echo $p_date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/uploads/<?php echo $p_image ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $p_content; ?></p>
            <?php } 

                // if no id is found in the url? redirect the user to index.
                }else {
                    header("Location: index.php");
                }

             ?>
                <hr><br>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    
                    <?php 
                        if (isset($_POST['submit_comment'])) {
                            $post_comment_id = $post_slug;
                            $comment_name = $_POST['comment_name'];
                            $comment_email = $_POST['comment_email'];
                            $comment_body = $_POST['comment_body'];
                            $comment_status = "unapproved";

                            if (empty($comment_name) && empty($comment_email) && empty($comment_body)) {
                                echo "<p class=\"alert alert-danger\">Please fill out all fields</p>";
                            }else{
                                $insert_comment = mysqli_query($connect, "INSERT INTO comments VALUES (null, $post_comment_id, '$comment_name', '$comment_email', '$comment_body', '$comment_status', now())");
                                confirmQuery($insert_comment);
                            }

                            $P_comment_count = mysqli_query($connect, "UPDATE posts SET post_comment_count = post_comment_count +1 WHERE post_id = $post_slug");
                            confirmQuery($P_comment_count);
                        }
                    ?>

                    <h4>Leave a Comment:</h4>
                    <form action="" method="POST" >
                       <div class="form-group">
                           <label for="name">Name:</label>
                           <input type="text" class="form-control" name="comment_name" placeholder="John doe">
                       </div>

                        <div class="form-group">
                           <label for="name">E-mail:</label>
                           <input type="text" class="form-control" name="comment_email" placeholder="(eg:) javarts@gmail.com">
                       </div>

                        <div class="form-group">
                           <label for="name">Comment</label>
                           <textarea name="comment_body" id="" cols="30" rows="10" class="form-control" placeholder="leave a comment"></textarea>
                       </div>

                       <div class="form-group">
                           <button type="submit" name="submit_comment" class="btn btn-primary">Comment</button>
                       </div>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <?php 

                        $getComments = mysqli_query($connect, "SELECT * FROM comments WHERE comment_post_id = $post_slug AND comment_status = 'approved' ");
                        while ($row = mysqli_fetch_assoc($getComments)) {
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_body = $row['comment_content'];
                        ?>
                        <a class="pull-left" href="#">
                            <img class="media-object" src="images" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small>January 7th, 2019 at <?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_body; ?>
                        </div>
                        <br><br>

                        <?php } ?>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include ("inc/sidebar.php"); ?>
            <div class="clearfix"></div><br><br>

        <!-- Footer -->
        <?php include ("inc/footer.php"); ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
