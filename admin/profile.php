<?php 
$title = "VIEW - POSTS";
include("inc/admin-header.php");
    
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $query = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username' ");

        while ($row = mysqli_fetch_assoc($query)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
        }
    }


    if (isset($_POST['update_profile'])) {
        $U_name = $_POST['username'];
        $U_password = $_POST['user_password'];
        $U_firstname = $_POST['user_firstname'];
        $U_lastname = $_POST['user_lastname'];
        $U_role = $_POST['user_role'];

        $update_profile = mysqli_query($connect, 
            "UPDATE users SET 
            username = '$U_name',  
            user_password = '$U_password', 
            user_firstname = '$U_firstname', 
            user_lastname = '$U_lastname', 
            user_role = '$U_role' WHERE username = '$username' ");
        confirmQuery($update_profile);
        if ($update_profile) {
            $msg = "<div class=\"alert alert-success\"><b>Profile Updated</b></div>";
        }
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
                        User Profile
                    </h1>
                        <?php if (isset($msg) && !empty($msg)) {
                                echo $msg;
                            } 
                        ?>
                        <form action="" method="POST" enctype="multipart/form-data">
        
                            <div class="form-group">
                                <label for="author">Firstname</label>
                                <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
                            </div>

                            <div class="form-group">
                                <label for="status">Lastname</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
                            </div>

                            <div class="form-group">
                                <label for="post_category">Role</label><br>
                                <select name="user_role" >
                                    <option value="" ><?php echo  $user_role; ?></option>
                                <?php 
                                    if ($user_role == 'admin') {
                                        echo "<option value=\"subscriber\">User</option>";
                                    }else {
                                        echo "<option value=\"admin\">Admin</option>";
                                    }
                                 ?>
                                </select>
                            </div>
                     
                            <!-- <div class="form-group">
                                <label for="image">Post image</label>
                                <input type="file" class="form-control" name="image">
                            </div> -->

                            <div class="form-group">
                                <label for="tags">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $username  ?>">
                            </div>

                            <div class="form-group">
                                <label for="content">E-mail</label>
                            <input type="email" class="form-control" disabled="" name="user_email" value="<?php echo $user_email ?>">
                            </div>

                            <div class="form-group">
                                <label for="content">Password</label>
                            <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" name="update_profile">Update Profile</button>
                            </div>

                        </form>
                </div>
            </div> <!-- /.row -->

        </div> <!-- /.container-fluid -->

    </div> <!-- /#page-wrapper -->

    </div> <!-- /#wrapper -->

<?php include("inc/admin-footer.php") ?>