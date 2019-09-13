<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php?query=wow" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div><!-- /.input-group -->
        </form>
    </div>

    <!-- Login -->
    <div class="well">
        <h4>Login</h4>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="Login" type="submit">Login  </button>
                </span>
            </div>
        </form>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                <?php 

                    $cat_query = mysqli_query($connect, "SELECT * FROM categories LIMIT 4");
                    while ($row = mysqli_fetch_assoc($cat_query)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                    }
                 ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

   <?php include("inc/widget.php") ?>

</div>