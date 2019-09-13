<?php 
$title = " HOME";
include("inc/header.php"); 
?>
<body>

<!-- Navigation -->
<?php include("inc/navbar.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                 <?php 

                $display_post_query = mysqli_query($connect, "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC");

                while ($row = mysqli_fetch_assoc($display_post_query)) {
                    $p_id = $row['post_id'];
                    $p_cat_id = $row['post_category_id'];
                    $p_title = $row['post_title'];
                    $p_author = $row['post_author'];
                    $p_date = $row['post_date'];
                    $p_image = $row['post_image'];
                    $p_content = $row['post_content'];
                    $p_status = $row['post_status'];

                if ($p_status == 'published') {
                    
                    ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?slug=<?php echo $p_id ?>"><?php echo $p_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author-post.php?author=<?php echo $p_author; ?>"><?php echo $p_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2018 at <?php echo $p_date; ?></p>
                <hr>
                <a href="post.php?slug=<?php echo $p_id ?>"><img class="img-responsive" src="admin/uploads/<?php echo $p_image; ?>" alt=""></a>
                <hr>
                <p><?php echo substr($p_content, 0 ,700); ?></p>
                <a class="btn btn-primary" href="post.php?slug=<?php echo $p_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                <hr>
                    <?php   } }?>

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->
                <hr>

            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include ("inc/sidebar.php"); ?>

        </div>
        <!-- /.row -->

        <hr>

    <!-- Footer -->
    <?php include("inc/footer.php") ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
