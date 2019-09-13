<?php $title = "ADD POST"; ?>
<div class="col-md-8">

	<?php 

		if (isset($_POST['create_user'])) {

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

			if (empty($user_firstname) || empty($user_lastname) || empty($user_role) || empty($username) || empty($user_email) || empty($user_password)) {
				echo "	<script>alert('please fill in all fields')</script>";
			}else {
				$insert_user_query = mysqli_query($connect, "INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_role) VALUES ('$username', '$user_password', '$user_firstname', '$user_lastname', '$user_email','$user_role')");
				confirmQuery($insert_user_query);	
				echo "<div class='alert alert-success'> user was created:" . " " . "<a href='users.php'>View users</a> </div>";
			}
		}
	 ?>

	<form action="" method="POST" enctype="multipart/form-data">
		
		<div class="form-group">
			<label for="author">Firstname</label>
			<input type="text" class="form-control" name="user_firstname">
		</div>

		<div class="form-group">
			<label for="status">Lastname</label>
			<input type="text" class="form-control" name="user_lastname">
		</div>

		<div class="form-group">
			<label for="post_category">Role</label><br>
			<select name="user_role" id="">
				<option selected="" disabled="">User Role</option>
				<option value="admin">Admin</option>
				<option value="subscriber">User</option>
			</select>
		</div>

		<!-- <div class="form-group">
			<label for="image">Post image</label>
			<input type="file" class="form-control" name="image">
		</div> -->

		<div class="form-group">
			<label for="tags">Username</label>
			<input type="text" class="form-control" name="username">
		</div>

		<div class="form-group">
			<label for="content">E-mail</label>
		<input type="email" class="form-control" name="user_email">
		</div>

		<div class="form-group">
			<label for="content">Password</label>
		<input type="password" class="form-control" name="user_password">
		</div>

		<div class="form-group">
			<button class="btn btn-primary" name="create_user">Add User</button>
		</div>

	</form>
</div>