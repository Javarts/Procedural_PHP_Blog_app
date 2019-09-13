<?php 
$title = " READ MORE";
include("inc/header.php");

if (isset($_GET['author']) && !empty($_GET['author'])) {
    $post_author = $_GET['author'];
}

    
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

                $display_post_query = mysqli_query($connect, "SELECT * FROM posts WHERE post_author = '$post_author'");
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
                    <a href="post.php?slug=<?php echo $p_id ?>"><?php echo $p_title; ?></a>
                </h2>
                <!-- Author -->
                <p class="lead">
                    by <a href="author-post.php?author=<?php echo $p_author; ?>&p_id=<?php echo $p_id ?>"><?php echo $p_author; ?></a>
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
            <?php } ?>
                <hr>


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
