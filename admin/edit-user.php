<?php $title = "ADD POST"; ?>
<div class="col-md-8">

	<?php 

		if (isset($_GET['UID'])) {
			$user_ID = $_GET['UID'];
		}

		$QUERY_GET_USERS = mysqli_query($connect, "SELECT * FROM users WHERE user_id = $user_ID ");
		while ($row = mysqli_fetch_assoc($QUERY_GET_USERS)) {
		    $user_fname = $row['user_firstname'];
		    $user_lname = $row['user_lastname'];
		    $username = $row['username'];
		    $user_email = $row['user_email'];
		    $user_pass = $row['user_password'];
		    $user_role = $row['user_role'];
		}

		if (isset($_POST['update_user'])) {

			$user_firstname = $_POST['user_firstname'];
			$user_lastname = $_POST['user_lastname'];
			$user_role = $_POST['user_role'];
			// $post_image = $_FILES['image']['name'];
			// $post_image_temp = $_FILES['image']['tmp_name'];
			$username = $_POST['username'];
			$user_email = $_POST['user_email'];
			$user_password = $_POST['user_password'];  
			// $post_date = date('d-m-y');

			// move_uploaded_file($post_image_temp, "uploads/$post_image");

			// password encryption
			$salt_query = mysqli_query($connect, "SELECT randsalt FROM users");
			confirmQuery($salt_query);

			$row = mysqli_fetch_assoc($salt_query);
			$salt = $row['randsalt'];
			$hashed_password = crypt($user_password, $salt);


			$update_user_query = mysqli_query($connect, "UPDATE users 
				SET 
					username = '$username',
					user_password = '$hashed_password',
					user_firstname = '$user_firstname',
					user_lastname = '$user_lastname',
					user_email = '$user_email',
					user_role = '$user_role'
				  WHERE user_id = $user_ID");


			confirmQuery($update_user_query);	
			if ($update_user_query) {
				echo "	<script>alert('UPDATED')</script>";
			}else{
				echo "	<script>alert('An error Occured')</script>";
			}
		}
	 ?>

	<form action="" method="POST" enctype="multipart/form-data">
		
		<div class="form-group">
			<label for="author">Firstname</label>
			<input type="text" class="form-control" name="user_firstname" value="<?php echo $user_fname ?>">
		</div>

		<div class="form-group">
			<label for="status">Lastname</label>
			<input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lname ?>">
		</div>

		<div class="form-group">
			<label for="post_category">Role</label><br>
			<select name="user_role" >
				<option value="<?php echo  $user_role; ?>" ><?php echo  $user_role; ?></option>
			<?php 
				if ($user_role == 'admin') {
					echo "<option value=\"subscriber\">Suscriber</option>";
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
			<input type="text" class="form-control" name="username" value="<?php echo $username ?>">
		</div>

		<div class="form-group">
			<label for="content">E-mail</label>
		<input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
		</div>

		<div class="form-group">
			<label for="content">Password</label>
		<input type="password" class="form-control" name="user_password" value="<?php echo $user_pass ?>">
		</div>

		<div class="form-group">
			<button class="btn btn-primary" name="update_user">Update</button>
		</div>

	</form>
</div>